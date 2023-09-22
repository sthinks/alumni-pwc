<?php

namespace App\Http\Controllers;

use App\Hobby;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class HobbyController extends Controller
{
    /**
     * @var mixed Config settings
     */
    private $config;

    public function __construct()
    {
        $this->config = Config::get('constants.hobby');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        // Get all hobby clubs
        $hobbies = Hobby::withCount('users')->get();
        return response()->view('admin.hobby.index', ['hobbies' => $hobbies]);
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
        $query = Hobby::withCount('users');

        // If event title filtered
        if (isset($validated['hobby_title'])) {
            $query->where('hobby_title', 'LIKE', "%{$validated['hobby_title']}%");
        }

        // If number of attendees filtered
        if (isset($validated['hobby_attendees'])) {
            // Separate numbers
            $hobby_attendees = explode('-', $validated['hobby_attendees']);

            if (count($hobby_attendees) !== 2) {
                return redirect()->route('manager.hobby.index')->withErrors('Katılımcı sayısını doğru formatta giriniz!');
            }

            // Adjust values
            $hobby_attendees = array_map(static function ($value) {
                return (int) trim($value);
            }, $hobby_attendees);

            // Sort values
            sort($hobby_attendees);

            // List values
            [$small, $big] = $hobby_attendees;

            // Apply the filters
            $query->having('users_count', '>=', $small);
            $query->having('users_count', '<=', $big);
        }

        // if event privacy filtered
        if (in_array($validated['hobby_status'], ['0', '1'], true)) {
            $query->where('hobby_visible', (int) $validated['hobby_status']);
        }

        // Get filtered events
        $hobbies = $query->get();

        return response()->view('admin.hobby.index', ['hobbies' => $hobbies, 'posted' => $validated]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'hobby_title' => 'nullable|string|max:255',
            'hobby_attendees' => 'nullable|string',
            'hobby_status' => 'nullable|string',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.hobby.create', ['config' => $this->config]);
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

        // Handle checkbox
        $data['hobby_visible'] = isset($data['hobby_visible']);

        // Upload the poster of the hobby club
        if ($request->hasFile('hobby_poster')) {
            // Store the file in the variable
            $poster = $request->file('hobby_poster');

            // Create unique name for this file
            $posterName = sprintf('%s.%s', Str::uuid(), $poster->getClientOriginalExtension());

            // Store the file on the disk
            $poster->storePubliclyAs('public/uploads', $posterName);

            // Add filename to the data
            $data['hobby_poster'] = $posterName;
        }

        // Upload the avatar of the responsible person
        if ($request->hasFile('hobby_responsible_avatar')) {
            // Store the file in the variable
            $avatar = $request->file('hobby_responsible_avatar');

            // Create unique name for this file
            $avatarName = sprintf('%s.%s', Str::uuid(), $avatar->getClientOriginalExtension());

            // Store the file on the disk
            $avatar->storePubliclyAs('public/uploads', $avatarName);

            // Add filename to the data
            $data['hobby_responsible_avatar'] = $avatarName;
        }

        // We are all done, let store the variables in the database
        $stored = Hobby::create($data);

        if ($stored->exists) {
            return redirect()->route('manager.hobby.index')->with('success', 'Hobi kulübü başarıyla oluşturulmuştur.');
        }
        return redirect()->back()->withErrors('Hobi kulübü oluştulurken bir hata oluştu.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'hobby_title' => 'required|string|max:255',
            'hobby_abstract' => 'nullable|string|max:255',
            'hobby_responsible' => 'required|string|max:255',
            'hobby_responsible_role' => 'required|string|max:255',
            'hobby_description' => 'required|string',
            'hobby_poster' => sprintf('nullable|dimensions:width=%d,height=%d|mimes:jpeg,png,jpg|max:%d', $this->config['image']['poster']['width'], $this->config['image']['poster']['height'], $this->config['image']['poster']['max_size']),
            'hobby_responsible_avatar' => sprintf('nullable|mimes:jpeg,png,jpg|max:%d', $this->config['image']['avatar']['max_size']),
            'hobby_visible' => 'nullable|string',
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
            'hobby_poster.dimensions' => sprintf('Hobi kulübü görseli %d px yüksekliğinde ve %d px genişliğinde olmalıdır', $this->config['image']['poster']['height'], $this->config['image']['poster']['width']),
            'hobby_poster.max' => sprintf('Hobi kulübü görseli en fazla %d mb olmalıdır', $this->config['image']['poster']['max_size'] / 1048),
            'hobby_poster.mimes' => 'Hobi kulübü görseli için jpeg, png, jpg formatlarını uygun dosyalar yükleyebilirsiniz.',

            'hobby_responsible_avatar.dimensions' => sprintf('Hobi kulübü sorumlusunun görseli %d px yüksekliğinde ve %d px genişliğinde olmalıdır', $this->config['image']['avatar']['height'], $this->config['image']['avatar']['width']),
            'hobby_responsible_avatar.max' => sprintf('Hobi kulübü sorumlusunun görseli en fazla %d mb olmalıdır', $this->config['image']['avatar']['max_size'] / 1048),
            'hobby_responsible_avatar.mimes' => 'Hobi kulübü sorumlusunun görseli için jpeg, png, jpg formatlarını uygun dosyalar yükleyebilirsiniz.',

        ];
    }

    /**
     * Display the specified resource.
     *
     * @param Hobby $hobby
     *
     * @return Response
     */
    public function show(Hobby $hobby): Response
    {
        // Get user list
        $users = $hobby->users()->get();

        return response()->view('admin.hobby.show', ['users' => $users, 'hobby' => $hobby]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hobby $hobby
     *
     * @return Response
     */
    public function edit(Hobby $hobby): Response
    {
        return response()->view('admin.hobby.edit', ['hobby' => $hobby, 'config' => $this->config]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Hobby $hobby
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Hobby $hobby): RedirectResponse
    {
        // Get validated data
        $data = $request->validate($this->rules(), $this->messages());

        // Handle checkbox
        $data['hobby_visible'] = isset($data['hobby_visible']);

        // Upload the poster of the hobby club
        if ($request->hasFile('hobby_poster')) {
            // Store the file in the variable
            $poster = $request->file('hobby_poster');

            // Create unique name for this file
            $posterName = sprintf('%s.%s', Str::uuid(), $poster->getClientOriginalExtension());

            // Store the file on the disk
            $poster->storePubliclyAs('public/uploads', $posterName);

            // Add filename to the data
            $data['hobby_poster'] = $posterName;
        }

        // Upload the avatar of the responsible person
        if ($request->hasFile('hobby_responsible_avatar')) {
            // Store the file in the variable
            $avatar = $request->file('hobby_responsible_avatar');

            // Create unique name for this file
            $avatarName = sprintf('%s.%s', Str::uuid(), $avatar->getClientOriginalExtension());

            // Store the file on the disk
            $avatar->storePubliclyAs('public/uploads', $avatarName);

            // Add filename to the data
            $data['hobby_responsible_avatar'] = $avatarName;
        }

        // We are all done, lets update the hobby
        if ($hobby->update($data)) {
            return redirect()->back()->with('success', 'Hobi kulübü başarıyla düzenlenmiştir.');
        }
        return redirect()->back()->withErrors('Hobi kulübü düzenlenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hobby $hobby
     *
     * @return RedirectResponse
     */
    public function destroy(Hobby $hobby): RedirectResponse
    {
        try {
            $hobby->delete();
            return redirect()->route('manager.hobby.index')->with('success', 'Hobi kulubü başarıyla silinmiştir.');
        } catch (Exception $exception) {
            // Log the error
            activity()->performedOn(new Hobby())->causedBy(auth()->id())->withProperties($hobby->toArray())->log($exception->getMessage());
            return redirect()->back()->withErrors('Gönderi silinirken bir hata oluştu!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function events(int $id): Response
    {
        $hobby = Hobby::findOrFail($id);

        // Get event list
        $events = $hobby->events()->get();

        return response()->view('admin.hobby.events', ['events' => $events, 'hobby' => $hobby]);
    }
}
