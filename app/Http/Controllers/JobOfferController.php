<?php

namespace App\Http\Controllers;

use App\City;
use App\JobOffer;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;

class JobOfferController extends Controller
{
    /**
     * @var mixed Config settings
     */
    private $config;

    public function __construct()
    {
        $this->config = Config::get('constants.jobs');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $jobs = JobOffer::withCount('users')->get();
        $cities = City::all();
        return response()->view('admin.jobs.index', ['jobs' => $jobs, 'cities' => $cities]);
    }

    /**
     * Display a listing of the resource.
     * Based on the search made
     *
     * @return Response|RedirectResponse
     */
    public function search(Request $request)
    {
        // Get validated data
        $validated = $request->validate($this->searchRules());

        // Start building the query
        $query = JobOffer::withCount('users');

        // If campaign title inputted
        if (isset($validated['job_title'])) {
            $query->where('job_title', 'LIKE', "%{$validated['job_title']}%");
        }

        // If campaign code inputted
        if (isset($validated['job_company'])) {
            $query->where('job_company', 'LIKE', "%{$validated['job_company']}%");
        }

        // If number of attendees inputted
        if (isset($validated['job_attendees'])) {
            // Separate numbers
            $job_attendees = explode('-', $validated['job_attendees']);

            if (count($job_attendees) !== 2) {
                return redirect()->route('manager.jobs.index')->withErrors('Başvuran sayısını doğru formatta giriniz!');
            }

            // Adjust values
            $job_attendees = array_map(function ($value) {
                return (int) trim($value);
            }, $job_attendees);

            // Sort values
            sort($job_attendees);

            // List values
            [$small, $big] = $job_attendees;

            $query->having('users_count', '>=', $small);
            $query->having('users_count', '<=', $big);
        }

        // If start date inputted for campaign valid date
        if (isset($validated['job_deadline_start'])) {
            $query->whereDate('job_valid_till', '>=', $validated['job_deadline_start']);
        }

        // If end date inputted for campaign valid date
        if (isset($validated['job_deadline_end'])) {
            $query->whereDate('job_valid_till', '<=', $validated['job_deadline_end']);
        }

        // Campaign status
        // Content status
        if (in_array($validated['job_visible'], ['0', '1'], true)) {
            $query->where('job_visible', (int) $validated['job_visible']);
        }

        if ($validated['job_location'] !== '-1') {
            $query->where('job_location', (int) $validated['job_location']);
        }

        $jobs = $query->get();

        $cities = City::all();

        return response()->view('admin.jobs.index', ['jobs' => $jobs, 'posted' => $validated, 'cities' => $cities]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'job_title' => 'nullable|string|max:255',
            'job_company' => 'nullable|string|max:255',
            'job_attendees' => 'nullable|string',
            'job_location' => 'nullable|integer',
            'job_deadline_start' => 'nullable|date_format:Y-m-d',
            'job_deadline_end' => 'nullable|date_format:Y-m-d',
            'job_visible' => 'nullable|string',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        $cities = City::all();
        $users = User::approved()->get();
        return response()->view('admin.jobs.create', ['cities' => $cities, 'users' => $users, 'config' => $this->config]);
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
        $validated = $request->validate($this->rules());

        // The job inserted by the admin
        $validated['job_owner_id'] = $validated['job_owner_id'] ?? auth()->id();

        // Handle checkbox for job visibility
        $validated['job_visible'] = isset($validated['job_visible']);

        // Handle checkbox for company name visibility
        $validated['job_company_visible'] = isset($validated['job_company_visible']);

        // Store the record on the database
        $jobSaved = JobOffer::create($validated);

        // Check if it is stored
        if ($jobSaved->exists) {
            return redirect()->route('manager.jobs.index')->with('success', 'İş ilanı başarıyla oluşturulmuştur.');
        }
        return redirect()->back()->withErrors('İş ilanı oluşturulken bir hata oluştu!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'job_abstract' => 'nullable|string|max:255',
            'job_company' => 'required|string|max:255',
            'job_company_visible' => 'nullable|string',
            'job_title' => 'required|string|max:255',
            'job_position' => 'required|string|max:255',
            'job_location' => 'required|integer|exists:cities,id',
            'job_position_level' => 'required|string|max:255',
            'job_experience' => 'required|integer',
            'job_apply_link' => 'required|string|max:255',
            'job_description' => 'required|string|max:8192',
            'job_visible' => 'nullable|string',
            'job_valid_till' => 'date_format:Y-m-d\TH:i',
            'job_owner_id' => 'nullable|integer|exists:users,id',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param JobOffer $jobOffer
     *
     * @return Response
     */
    public function show(JobOffer $jobOffer): Response
    {
        // Campaign attendees
        $users = $jobOffer->users()->get();

        return response()->view('admin.jobs.show', ['users' => $users, 'job' => $jobOffer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param JobOffer $jobOffer
     *
     * @return Response
     */
    public function edit(JobOffer $jobOffer): Response
    {
        $cities = City::all();
        $users = User::approved()->get();
        return response()->view('admin.jobs.edit', ['job' => $jobOffer, 'users' => $users, 'cities' => $cities, 'config' => $this->config]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param JobOffer $jobOffer
     *
     * @return RedirectResponse
     */
    public function update(Request $request, JobOffer $jobOffer): RedirectResponse
    {
        // Get validated data
        $validated = $request->validate($this->rules());

        // Handle checkbox for job visibility
        $validated['job_visible'] = isset($validated['job_visible']);

        // Handle checkbox for company name visibility
        $validated['job_company_visible'] = isset($validated['job_company_visible']);

        // Job owner
        $validated['job_owner_id'] = $validated['job_owner_id'] ?? auth()->id();

        // Update the record
        $jobOffer->update($validated);

        return redirect()->back()->with('success', 'İş ilanı başarıyla güncellenmiştir.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JobOffer $jobOffer
     *
     * @return RedirectResponse
     */
    public function destroy(JobOffer $jobOffer): RedirectResponse
    {
        try {
            $jobOffer->delete();
            return redirect()->route('manager.jobs.index')->with('success', 'İlan başarıyla silinmiştir.');
        } catch (Exception $exception) {
            // Log the error
            activity()->performedOn(new JobOffer())->causedBy(auth()->id())->withProperties($jobOffer->toArray())->log($exception->getMessage());
            return redirect()->back()->withErrors('İlan silinirken bir hata oluştu');
        }
    }
}
