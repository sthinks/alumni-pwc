<?php

namespace App\Http\Controllers;

use App\City;
use App\Event;
use App\Hobby;
use App\Notifications\EventCancelled;
use App\Notifications\UserInvitedForEvent;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EventController extends Controller
{
    private $cities;

    // config settings
    private $config;

    // users
    private $users;

    // hobby clubs
    private $clubs;

    // Events
    private $events;

    public function __construct()
    {
        $this->cities = City::all();
        $this->config = Config::get('constants.event');
        $this->users = User::approved()->get();
        $this->clubs = Hobby::all();
        $this->events = Event::withCount('users')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('admin.events.index', [
            'events' => $this->events,
            'cities' => $this->cities,
        ]);
    }

    /**
     * Display a listing of the resource according to search filter
     *
     * @return Response|RedirectResponse
     */
    public function search(Request $request)
    {
        // Get validated data
        $validated = $request->validate($this->searchRules());

        // Start building the query
        $query = Event::withCount('users');

        // If event title filtered
        if (isset($validated['event_title'])) {
            $query->where('event_title', 'LIKE', "%{$validated['event_title']}%");
        }

        // If number of attendees filtered
        if (isset($validated['event_attendees'])) {
            // Separate numbers
            $event_attendees = explode('-', $validated['event_attendees']);

            if (count($event_attendees) !== 2) {
                return redirect()->route('manager.events.index')->withErrors('Katılımcı sayısını doğru formatta giriniz!');
            }

            // Adjust values
            $event_attendees = array_map(static function ($value) {
                return (int) trim($value);
            }, $event_attendees);

            // Sort values
            sort($event_attendees);

            // List values
            [$small, $big] = $event_attendees;

            // Apply the filters
            $query->having('users_count', '>=', $small);
            $query->having('users_count', '<=', $big);
        }

        // If event city filtered
        if ($validated['event_city'] !== '-1') {
            $query->where('event_city', (int) $validated['event_city']);
        }

        // If event started date filtered
        if (isset($validated['event_start_date'])) {
            $query->whereDate('event_start_date', '>=', $validated['event_start_date']);
        }

        // If event end date filtered
        if (isset($validated['event_end_date'])) {
            $query->whereDate('event_start_date', '<=', $validated['event_end_date']);
        }

        // if event privacy filtered
        if (in_array($validated['event_private_status'], ['0', '1'], true)) {
            $query->where('event_is_private', (int) $validated['event_private_status']);
        }

        // Get filtered events
        $events = $query->get();

        return response()->view('admin.events.index', ['events' => $events, 'cities' => $this->cities, 'posted' => $validated]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'event_title' => 'nullable|string|max:255',
            'event_city' => 'nullable|integer',
            'event_attendees' => 'nullable|string',
            'event_start_date' => 'nullable|date_format:Y-m-d',
            'event_end_date' => 'nullable|date_format:Y-m-d',
            'event_private_status' => 'nullable|string',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.events.create', [
            'cities' => $this->cities,
            'users' => $this->users,
            'hobbies' => $this->clubs,
            'config' => $this->config,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Get validated data
        $data = $request->validate($this->rules(), $this->messages());

        // Extract hobby id from validated data
        $hobby_id = $data['hobby_club'] ?? null;
        unset($data['hobby_club']);

        // Handle checkboxes
        $data['event_is_visible'] = isset($data['event_is_visible']);
        $data['event_is_private'] = isset($data['event_is_private']);

        // Handle invited users
        $data['event_private_users'] = $data['event_private_users'] ?? [];

        // If event is private, cast user id values to integer before saving to the database
        $invitedUsers = [];
        if ($data['event_is_private']) {
            $invitedUsers = array_map(static function ($user_id) {
                return (int) trim($user_id);
            }, $data['event_private_users']);
        }
        unset($data['event_private_users']);

        // Handle image upload
        if ($request->hasFile('event_poster')) {
            // Store the image on the variable
            $image = $request->file('event_poster');

            // Assign an unique name to the file
            $fileName = sprintf('%s.%s', Str::uuid(), $image->getClientOriginalExtension());

            // Store the file on the public disk
            $image->storePubliclyAs('public/uploads', $fileName);

            // Record the file name on the database
            $data['event_poster'] = $fileName;
        }

        // Store in the database
        $eventStored = Event::create($data);

        // Check if it is recorded
        if ($eventStored->exists) {
            // If hobby club is selected, make the relationship
            if (isset($hobby_id)) {
                $eventStored->hobbies()->attach($hobby_id);
            } // if hobby club is not selected and event is private
            elseif (count($invitedUsers) > 0) {
                foreach ($invitedUsers as $invited) {
                    $eventStored->guests()->attach($invited);
                }

                // notify users
                Notification::send($eventStored->guests()->get(), new UserInvitedForEvent($eventStored));
            }

            return redirect()->route('manager.events.index')->with('success', 'Etkinlik başarıyla oluşturulmuştur.');
        }
        return redirect()->back()->withErrors('Etkinlik oluşturulurken bir hata oluştu');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'event_title' => 'required|string|max:255',
            'event_abstract' => 'nullable|string|max:255',
            'event_description' => 'required|string',
            'event_poster' => sprintf('nullable|dimensions:width=%d,height=%d|mimes:jpeg,png,jpg|max:%d', $this->config['image']['poster']['width'], $this->config['image']['poster']['height'], $this->config['image']['poster']['max_size']),
            'event_city' => 'required|integer',
            'event_venue' => 'required|string|max:255',
            'event_capacity' => 'required|integer',
            'event_start_date' => 'date_format:Y-m-d\TH:i',
            'event_end_date' => 'date_format:Y-m-d\TH:i',
            'event_last_apply_date' => 'date_format:Y-m-d\TH:i',
            'event_is_visible' => 'nullable|string',
            'event_is_private' => 'nullable|string',
            'event_private_users' => 'required_if:event_is_private,==,on|nullable|array',
            'event_private_users.*' => 'required_if:event_is_private,==,on|exists:users,id',
            'hobby_club' => 'nullable|integer|exists:hobbies,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'event_poster.dimensions' => sprintf('Etkinlik görseli %d px yüksekliğinde ve %d px genişliğinde olmalıdır', $this->config['image']['poster']['height'], $this->config['image']['poster']['width']),
            'event_poster.max' => sprintf('Etkinlik görseli en fazla %d mb olmalıdır', $this->config['image']['poster']['max_size'] / 1048),
            'event_poster.mimes' => 'Etkinlik görseli için jpeg, png, jpg formatlarını uygun dosyalar yükleyebilirsiniz.',
            'event_private_users.required_if' => 'Etkinliği private olarak işaretlediğiniz için, etkinliğe davet ettiğiniz kullanıcıları belirtmeniz gerekmektedir',
            'hobby_club.exists' => 'Hobi kulübü bulunamadı',
            'event_private_users.*.exists' => 'Davet edilen kullanıcı bulunamadı',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     *
     * @return Response
     */
    public function show(Event $event): Response
    {
        return response()->view('admin.events.show', [
            'users' => $event->users()->get(),
            'event' => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     *
     * @return Response
     */
    public function edit(Event $event): Response
    {
        return response()->view('admin.events.edit', [
            'event' => $event,
            'cities' => $this->cities,
            'hobbies' => $this->clubs,
            'users' => $this->users,
            'config' => $this->config,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        // Get validated data
        $data = $request->validate($this->rules(), $this->messages());

        // Handle checkboxes
        $data['event_is_visible'] = isset($data['event_is_visible']);
        $data['event_is_private'] = isset($data['event_is_private']);

        // Handle invited users
        $data['event_private_users'] = $data['event_private_users'] ?? [];

        // If event is private, cast user id values to integer before saving to the database
        $notifyUsers = []; // avoiding resending notifications
        $alreadyInvited = $event->guests()->get(); // users are already invited
        $invited = null;   // this is new guests
        $removedUsers = null;
        if ($data['event_is_private']) {
            $invited = array_map(static function ($user_id) {
                return (int) trim($user_id);
            }, $data['event_private_users']);
            $invited = User::whereIn('id', $invited)->get();
            $notifyUsers = $invited->diff($alreadyInvited);
            $removedUsers = $alreadyInvited->diff($invited);
        }
        unset($data['event_private_users']);

        // Handle image upload if uploaded
        if ($request->hasFile('event_poster')) {
            // Store the image on the variable
            $image = $request->file('event_poster');

            // Assign an unique name to the file
            $fileName = sprintf('%s.%s', Str::uuid(), $image->getClientOriginalExtension());

            // Store the file on the public disk
            $image->storePubliclyAs('public/uploads', $fileName);

            // Record the file name on the database
            $data['event_poster'] = $fileName;
        }

        // Update the event
        $updated = $event->update($data);
        // Check if it is updated
        if ($updated) {
            // Notify newly invited users
            if (isset($invited) && $invited->count() > 0) {
                $event->guests()->sync($invited);
                Notification::send($notifyUsers, new UserInvitedForEvent($event));
            }
            // remove users joined the event
            // who are not invited anymore
            if (isset($removedUsers) && $removedUsers->count() > 0) {
                $event->users()->detach($removedUsers);
            }

            return redirect()->back()->with('success', 'Etkinlik başarıyla güncellenmiştir.');
        }

        return redirect()->back()->withErrors('Etkinlik güncellenirken bir hata oluştu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     *
     * @return RedirectResponse
     */
    public function destroy(Event $event): RedirectResponse
    {
        try {
            // Get users
            $users = $event->users()->get();

            // Delete event
            $event->delete();

            // Notify users
            Notification::send($users, new EventCancelled($event));

            return redirect()->route('manager.events.index')->with('success', 'Etkinlik başarıyla silinmiştir.');
        } catch (Exception $exception) {
            activity()->performedOn(new Event())->causedBy(auth()->id())->withProperties($event->toArray())->log($exception->getMessage());

            return redirect()->back()->withErrors('Etkinlik silinirken bir hata oluştu!');
        }
    }
}
