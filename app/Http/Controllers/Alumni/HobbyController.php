<?php

namespace App\Http\Controllers\Alumni;

use App\Events\ProfileUpdated;
use App\Events\UserJoinedHobbyClub;
use App\Hobby;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class HobbyController extends Controller
{
    /**
     * number of items to be displayed per page
     */
    private const PAGINATE = 12;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        // get hobbies
        $hobbies = Hobby::active()->orderBy('created_at', 'desc')->paginate(self::PAGINATE);
        $hobbies->map(function ($hobby) {
            $hobby->mini_description = Str::words(strip_tags($hobby->hobby_description), 10);
        });
        return response()->view('alumni.hobbies.index', [
            'hobbies' => $hobbies,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $seo_url
     *
     * @return Response
     */
    public function show(string $seo_url): Response
    {
        // get hobby
        $hobby = Hobby::active()->where('hobby_seo_url', $seo_url)->firstOrFail();
        $hobby->already_joined = $hobby->users->contains(auth()->user()->id);

        // get hobby events
        $hobby_events = $hobby->events()->active()->future()->latest()->get();
        // add needed information to events
        $hobby_events->map(function ($event) {
            $event->mini_description = Str::words(strip_tags($event->event_description), 10);
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
        });

        // get hobby media
        $hobby_medias = $hobby->medias()->active()->latest()->get();
        // adjust date values
        $hobby_medias->map(function ($item) {
            $item->creation_date = $item->created_at->translatedFormat('d F Y');
            $item->poster = route('storage.images', $item->media_poster);
            $item->detail_link = route('media.show', $item->media_seo_url);
            return $item;
        });

        return response()->view('alumni.hobbies.show', [
            'hobby' => $hobby,
            'hobby_events' => $hobby_events,
            'hobby_medias' => $hobby_medias,
        ]);
    }

    /**
     * Let the user join hobby clubs where possible
     *
     * @param string $seo_url
     *
     * @return RedirectResponse
     */
    public function join(string $seo_url): RedirectResponse
    {
        // get hobby
        $hobby = Hobby::active()->where('hobby_seo_url', $seo_url)->firstOrFail();

        // check if user joined before
        if ($hobby->users->contains(auth()->user()->id)) {
            return redirect()->route('hobbies.show', $seo_url)->withErrors('Bu hobi kulübüne zaten üyesiniz.');
        }

        // join
        $hobby->users()->attach(auth()->user()->id);

        // update the crm
        event(new ProfileUpdated(auth()->user()));

        // dispatch event
        event(new UserJoinedHobbyClub($hobby, auth()->user()));

        return redirect()->route('hobbies.show', $seo_url)->with('success', 'Hobi kulübüne başarıyla katıldınız.');
    }

    /**
     * Let the user disjoin hobby clubs where possible
     *
     * @param string $seo_url
     *
     * @return RedirectResponse
     */
    public function disjoin(string $seo_url): RedirectResponse
    {
        // get hobby
        $hobby = Hobby::active()->where('hobby_seo_url', $seo_url)->firstOrFail();

        // check if user joined before
        if (! $hobby->users->contains(auth()->user()->id)) {
            return redirect()->route('hobbies.show', $seo_url)->withErrors('Bu hobi kulübüne üye değilsiniz.');
        }

        // disjoin
        $hobby->users()->detach(auth()->user()->id);

        // update the crm
        event(new ProfileUpdated(auth()->user()));

        return redirect()->route('hobbies.show', $seo_url)->with('success', 'Hobi kulübünden başarıyla ayrıldınız.');
    }
}
