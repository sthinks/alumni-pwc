<?php

namespace App\Http\Controllers\Alumni;

use App\Event;
use App\Http\Controllers\Controller;
use App\MediaCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        // public, active and future events
        $public = Event::active()->future()->public()->orderBy('created_at', 'desc')->get();

        // add mini description and other useful properties
        $public->map(function ($event) {
            $event->mini_description = Str::words(strip_tags(html_entity_decode($event->event_description)), 10);
            $event->already_joined = $event->users->contains(auth()->user()->id);
            $event->location = $event->location()->first()->city;
            $event->hobby_event = $event->hobbies()->count() > 0;
            $event->last_apply_date_due = $event->event_last_apply_date->lt(now());

            // if this is hobby event
            // we assume that one event can belong to one hobby club
            // but in another phase can belong to many
            if ($event->hobby_event) {
                // then check if user has joined
                $event->hobby_club = $event->hobbies()->first()->hobby_title;
                $event->hobby_event_user_joined = $event->hobbies()->first()->users->contains(auth()->user()->id);
            }
            return $event;
        });

        // private, future and active events
        $private = auth()->user()->privateEvents()->future()->active()->orderBy('created_at', 'desc')->get();
        $private->map(function ($event) {
            $event->mini_description = Str::words(strip_tags(html_entity_decode($event->event_description)), 10);
            $event->already_joined = $event->users->contains(auth()->user()->id);
            $event->location = $event->location()->first()->city;
            $event->last_apply_date_due = $event->event_last_apply_date->lt(now());
            return $event;
        });

        // medias which displayed here
        $event_medias = MediaCategory::where('slug', 'etkinlik-sayfasi')->first();
        if ($event_medias) {
            $event_medias = $event_medias->media()->active()->latest()->get();
            // adjust date values
            $event_medias->map(function ($item) {
                $item->creation_date = $item->created_at->translatedFormat('d F Y');
                $item->poster = route('storage.images', $item->media_poster);
                $item->detail_link = route('media.show', $item->media_seo_url);
                return $item;
            });
        }
        return response()->view('alumni.events.index', [
            'public' => $public,
            'private' => $private,
            'events' => $private->merge($public),
            'event_medias' => $event_medias,
        ]);
    }

    /**
     * Let the user join events
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function join($id): RedirectResponse
    {
        // get intented event
        // to join event;
        // - event should be public
        // - event should be active
        // - event's last apply date is still in the future
        // - event exists
        $event = Event::active()->lastApplyDateValid()->where('event_seo_url', $id)->firstOrFail();
        $event->already_joined = $event->users->contains(auth()->user()->id);
        $event->hobby_event = $event->hobbies()->count() > 0;
        $event->last_apply_date_due = $event->event_last_apply_date->lt(now());

        // if this is hobby event
        // we assume that one event can belong to one hobby club
        // but in another phase can belong to many
        if ($event->hobby_event) {
            // then check if user has joined
            $event->hobby_club = $event->hobbies()->first()->hobby_title;
            $event->hobby_event_user_joined = $event->hobbies()->first()->users->contains(auth()->user()->id);
        }

        // check if user is already joined
        if ($event->already_joined) {
            return redirect()->route('events.show', $id)->withErrors('Zaten bu etkinliğe kayıt oldunuz.');
        }

        // check if event is private
        if ($event->event_is_private) {
            // if event is private then check if user in the guest list
            if (! $event->guests->contains(auth()->user()->id)) {
                return redirect()->route('events.index')->withErrors('Bu etkinliğin davetli listesinde değilsiniz.');
            }
        }

        // check if event has capacity
        if ($event->hasCapacity()) {
            // check if it is hobby event
            if ($event->hobby_event) {
                // check if user has joined
                if (! $event->hobby_event_user_joined) {
                    $event->hobbies()->first()->users()->attach(auth()->user()->id);
                }
            }
            $event->users()->attach(auth()->user()->id, [
                'event_ticket' => Str::uuid(),
            ]);
        } // if event is full then redirect to event page
        else {
            return redirect()->route('events.show', $id)->withErrors('Bu etkinlikte kapasite yetersiz.');
        }

        // redirect the user to the event page
        return redirect()->route('events.show', $id)->with('success', 'Etkinliğe kaydınız alınmıştır.');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return Response|RedirectResponse
     */
    public function show(string $id)
    {
        // get intented event
        // event should be active
        $event = Event::active()->where('event_seo_url', $id)->firstOrFail();
        $event->already_joined = $event->users->contains(auth()->user()->id);
        $event->hobby_event = $event->hobbies()->count() > 0;
        $event->last_apply_date_due = $event->event_last_apply_date->lt(now());

        // if this is hobby event
        // we assume that one event can belong to one hobby club
        // but in another phase can belong to many
        if ($event->hobby_event) {
            // then check if user has joined
            $event->hobby_club = $event->hobbies()->first()->hobby_title;
            $event->hobby_event_user_joined = $event->hobbies()->first()->users->contains(auth()->user()->id);
        }

        // check if event is private
        if ($event->event_is_private) {
            // check for user in the guest list
            if (! $event->guests->contains(auth()->user()->id)) {
                return redirect()->route('events.index')->withErrors('Bu etkinliğin davetli listesinde değilsiniz.');
            }
        }

        return response()->view('alumni.events.show', [
            'event' => $event,
        ]);
    }

    /**
     * Let the user disjoin events
     *
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function disjoin(string $id): RedirectResponse
    {
        // get intented event
        $event = Event::where('event_seo_url', $id)->firstOrFail();

        // check if this user joined this event
        if (! $event->users->contains(auth()->user()->id)) {
            return redirect()->route('events.index')->withErrors('Bu etkinliğe kayıt olmadınız.');
        }

        // disjoin user from event
        $event->users()->detach(auth()->user()->id);
        return redirect()->route('events.index')->with('success', 'Etkinlikten kaydınız silinmiştir.');
    }
}
