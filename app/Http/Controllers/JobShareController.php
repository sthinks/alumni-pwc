<?php

namespace App\Http\Controllers;

use App\City;
use App\JobShare;
use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobShareController extends Controller
{
    /**
     * @var User Alumni user
     */
    private $alumni;

    public function __construct()
    {
        $this->alumni = User::alumni()->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('admin.shared-jobs.index', [
            'jobs' => JobShare::all(),
            'cities' => City::all(),
            'users' => $this->alumni,
        ]);
    }

    public function search(Request $request): Response
    {
        // get validated data
        $filtered = $request->validate($this->rules());

        // start building query
        $query = JobShare::query();

        // if position filtered
        if (isset($filtered['position'])) {
            $query->where('position', 'like', "%{$filtered['position']}%");
        }

        // if company filtered
        if (isset($filtered['company'])) {
            $query->where('company', 'like', "%{$filtered['company']}%");
        }

        // if city filtered
        if (isset($filtered['job_location']) && $filtered['job_location'] !== '-1') {
            $query->where('location', $filtered['job_location']);
        }

        // if dates are filtered
        if (isset($filtered['start'])) {
            $query->whereDate('date', '>=', $filtered['start']);
        }
        if (isset($filtered['end'])) {
            $query->whereDate('date', '<=', $filtered['end']);
        }

        // if owner filtered
        if (isset($filtered['owner']) && $filtered['owner'] !== '-1') {
            $query->where('user_id', $filtered['owner']);
        }

        // get filtered shared jobs
        $jobs = $query->get();

        return response()->view('admin.shared-jobs.index', [
            'jobs' => $jobs,
            'cities' => City::all(),
            'users' => $this->alumni,
            'posted' => $filtered,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'job_location' => 'nullable|integer',
            'start' => 'nullable|date_format:Y-m-d',
            'end' => 'nullable|date_format:Y-m-d',
            'owner' => 'nullable|integer',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param JobShare $jobShare
     *
     * @return Response
     */
    public function show(JobShare $jobShare): Response
    {
        return response()->view('admin.shared-jobs.show', [
            'job' => $jobShare,
            'owner' => $jobShare->user()->first(),
            'location' => optional($jobShare->location()->first())->city,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JobShare $jobShare
     *
     * @return RedirectResponse
     */
    public function destroy(JobShare $jobShare): RedirectResponse
    {
        try {
            $jobShare->delete();
            return redirect()->route('manager.shared.index')->with('success', 'İlan başarıyla silinmiştir.');
        } catch (Exception $exception) {
            return redirect()->back()->withErrors('İlan silinirken bir hata oluştu.');
        }
    }
}
