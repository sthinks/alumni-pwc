<?php

namespace App\Chat;

use App\Message;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class Chatapp
{
    /**
     * Get contacts of authenticated user
     *
     * @return array<User>|Collection|\Illuminate\Support\Collection
     */
    public function getContacts()
    {
        $user = auth()->user();
        // get all contacts
        $all_chats = Message::where('from', $user->id)
            ->orWhere('to', $user->id)->groupBy(['from', 'to'])->get(['from', 'to']);
        $from = $all_chats->implode('from', ',');
        $from = explode(',', $from);

        $to = $all_chats->implode('to', ',');
        $to = explode(',', $to);

        $all_contacts = array_unique(array_merge($from, $to));

        $all_contacts = array_map('intval', $all_contacts);

        $all_contacts = array_diff($all_contacts, [$user->id]);

        $contacts = User::whereIn('id', $all_contacts)->get();

        // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->orderBy('id', 'desc')
            ->get();

        // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        // add last message
        return $contacts->map(function ($contact) use ($user) {
            $contact->lastmessage = Message::where(function ($q) use ($contact, $user) {
                $q->where('from', $user->id);
                $q->where('to', $contact->id);
            })->orWhere(function ($q) use ($contact, $user) {
                $q->where('from', $contact->id);
                $q->where('to', $user->id);
            })->orderBy('id', 'DESC')->first();
            return $contact;
        });
    }

    /**
     * Mark all conversation seen
     *
     * @param User $friend
     */
    public function markConversationSeen(User $friend)
    {
        $user = auth()->user();
        Message::where('from', $friend->id)->where('to', $user->id)->update(['read' => true]);
    }

    /**
     * Get all messages between "authenticated user" and their friend
     *
     * @param User $friend
     *
     * @return \Illuminate\Support\Collection
     */
    public function getMessages(User $friend)
    {
        return Message::where(function ($q) use ($friend) {
            $q->where('from', auth()->id());
            $q->where('to', $friend->id);
        })->orWhere(function ($q) use ($friend) {
            $q->where('from', $friend->id);
            $q->where('to', auth()->id());
        })->orderBy('id', 'asc')->get(['from', 'to', 'created_at', 'message']);
    }

    /**
     * Count Unseen messages
     *
     * @return int
     */
    public function countUnseenMessages(): int
    {
        return Message::where('to', auth()->id())
            ->where('read', 0)
            ->distinct()
            ->count('from');
    }
}
