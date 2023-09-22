<?php

namespace App\Http\Controllers\Alumni;

use App\City;
use App\Http\Controllers\Controller;
use App\JobOffer;
use App\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class JobController extends Controller
{
    /**
     * items to be displayed per page
     */
    private const PAGINATE = 4;

    private $cities;

    public function __construct()
    {
        $this->cities = City::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $user = $request->user();
        // Get all the jobs
        $jobs = JobOffer::active()->orderBy('created_at', 'desc')->paginate(self::PAGINATE);
        return response()->view('alumni.job.index', [
            'jobs' => $jobs,
            'cities' => $this->cities,
            'skills' => Skill::all(),
            'user_skills' => Arr::flatten($user->skills()->get(['skill_id'])->makeHidden('pivot')->toArray())
        ]);
    }

    /**
     * Display a listing of the filtered resource.
     *
     * @return RedirectResponse|Response
     *
     * @throws ValidationException
     */
    public function filter(Request $request)
    {
        $user = $request->user();
        // Validated data
        $input = $request->only(['order', 'company', 'position', 'city', 'level', 'experience']);
        $validated = Validator::make($input, $this->rules(), [], $this->attributes());

        // if validation fails
        if ($validated->fails()) {
            return redirect()->back()->withErrors($validated->errors());
        }

        // get validated data
        $data = $validated->validated();

        $jobs = JobOffer::active();

        // filter by company name
        if (isset($data['company'])) {
            // if job company name is visible then find it, if not then not include it
            $jobs = $jobs->where('job_company_visible', true)->where('job_company', 'like', '%' . $data['company'] . '%');
        }

        // filter by position name
        if (isset($data['position'])) {
            $jobs = $jobs->where('job_position', 'like', '%' . $data['position'] . '%');
        }

        // filter by city name
        if (isset($data['city'])) {
            $jobs = $jobs->where('job_location', $data['city']);
        }

        // filter by level
        if (isset($data['level'])) {
            $jobs = $jobs->where('job_position_level', 'LIKE', '%' . $data['level'] . '%');
        }

        // filter by experience
        if (isset($data['experience'])) {
            $jobs = $jobs->where('job_experience', $data['experience']);
        }

        // order by
        if (isset($data['order'])) {
            switch ($data['order']) {
                case 1:
                    $jobs = $jobs->orderBy('job_valid_till', 'DESC');
                    break;
                case 2:
                    $jobs = $jobs->orderBy('created_at', 'ASC');
                    break;
                case 3:
                    $jobs = $jobs->orderBy('created_at', 'DESC');
                    break;
            }
        }

        // get filtered data
        $jobs = $jobs->paginate(self::PAGINATE);

        return response()->view('alumni.job.index', [
            'jobs' => $jobs,
            'cities' => $this->cities,
            'posted' => $data,
            'skills' => Skill::all(),
            'user_skills' => Arr::flatten($user->skills()->get(['skill_id'])->makeHidden('pivot')->toArray())
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
            'order' => 'nullable|integer',
            'company' => 'nullable|string',
            'position' => 'nullable|string',
            'city' => 'nullable|integer',
            'level' => 'nullable|string',
            'experience' => 'nullable|integer',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'order' => 'Sıralama',
            'company' => 'Şirket Adı',
            'position' => 'Pozisyon Adı',
            'city' => 'Adres / Lokasyon',
            'level' => 'Pozisyon Seviyesi',
            'experience' => 'Deneyim',
        ];
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
        // get intented job
        $job = JobOffer::active()->where('job_seo_url', $id)->first();

        if (! $job) {
            return redirect()->route('jobs.index')->withErrors('İş İlanı bulunamadı.');
        }

        // check if alreay applied
        $applied = $job->users->contains(auth()->id());

        // check if job is expired
        $expired = $job->job_valid_till->lt(now());

        return response()->view('alumni.job.show', [
            'job' => $job,
            'applied' => $applied,
            'expired' => $expired,
            'cities' => $this->cities,
            'skills' => Skill::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function join(string $id): RedirectResponse
    {
        // get intented job
        $job = JobOffer::active()->where('job_seo_url', $id)->firstOrFail();

        // check if job offer has expired
        if ($job->job_valid_till->lt(now())) {
            return redirect()->back()->withErrors('Bu ilanının geçerlilik süresi süresi dolmuştur.');
        }

        // check if user is already applied
        if (! $job->users->contains(auth()->id())) {
            $job->users()->attach(auth()->id());
        }

        // redirect to job offer
        return redirect()->route('jobs.show', $id);
    }
}
