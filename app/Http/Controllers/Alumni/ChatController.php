<?php

namespace App\Http\Controllers\Alumni;

use App\Facades\ChatFacade;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $contacts = ChatFacade::getContacts();
        return response()->view('alumni.chat.index', ['contacts' => $contacts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $user_id
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store($user_id, Request $request): RedirectResponse
    {
        // get current user
        $user = auth()->user();

        // get validated data
        $data = $request->validate($this->rules(), $this->messages());

        $data['from'] = $user->id;

        // try to get "encrypted" contact id
        $to = User::where('uid', $user_id)->firstOrFail();

        // check if contact has blocked sender
        if ($to->checkIfUserBlocked($user)) {
            return redirect()->back()->withErrors('Bu kullanıcı sizi engellediği için mesaj gönderemezsiniz.');
        }
        // check if sender has blocked the reciever
        if ($user->checkIfUserBlocked($to)) {
            return redirect()->back()->withErrors('Bu kullanıcıyı engellediğiniz için mesaj gönderemezsiniz.');
        }

        // mark receiver id and sender ip address
        $data['to'] = $to->id;
        $data['sender_ip'] = request()->ip();

        // create the message on the database
        $message = Message::create($data);

        // check if message successfully created
        if ($message->exists) {
            return redirect()->back()->with('success', 'Mesaj başarıyla gönderilmiştir.');
        }
        return redirect()->back()->withErrors('Bir hata oluştu');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'message' => 'required|string|max:8192',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'message.required' => 'Mesaj girmeniz gereklidir.',
            'message.string' => 'Mesajınız sadece karakterler içerebilir.',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return Response
     */
    public function show($id): Response
    {
        // get contact
        $friend = User::where('uid', $id)->firstOrFail();

        // mark all messages with the selected contact as read
        Message::where('from', $friend->id)->where('to', auth()->id())->update(['read' => true]);

        // get all messages between the authenticated user and the selected user
        $messagesBetweenUsers = ChatFacade::getMessages($friend);

        return response()->view('alumni.chat.show', [
            'messages' => $messagesBetweenUsers,
            'friend' => $friend,
            'friend_id' => $friend->uid,
        ]);
    }

    /**
     * Block user
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function block($id): RedirectResponse
    {
        $blocked_user = User::where('uid', $id)->firstOrFail();
        $user = auth()->user();
        $user->blockUser($blocked_user);
        return redirect()->back()->with('success', 'Kullanıcı engellendi.');
    }

    /**
     * Block user
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function unblock($id): RedirectResponse
    {
        $unblocked_user = User::where('uid', $id)->firstOrFail();
        $user = auth()->user();
        $user->unblockUser($unblocked_user);
        return redirect()->back()->with('success', 'Kullanıcı engeli kaldırıldı.');
    }
}
