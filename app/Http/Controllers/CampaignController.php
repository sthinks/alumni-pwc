<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\CampaignCategory;
use App\City;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    // Config settings and categories
    private $config;
    private $categories;
    private $cities;

    public function __construct()
    {
        $this->categories = CampaignCategory::all();
        $this->config = Config::get('constants.campaign');
        $this->cities = City::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $campaigns = Campaign::all();
        return response()->view(
            'admin.campaigns.index',
            [
                'campaigns' => $campaigns,
                'categories' => $this->categories,
            ]
        );
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
        $query = Campaign::withCount('users');

        // If campaign title inputted
        if (isset($validated['campaign_company'])) {
            $query->where('campaign_company', 'LIKE', "%{$validated['campaign_company']}%");
        }

        // If campaign code inputted
        if (isset($validated['campaign_code'])) {
            $query->where('campaign_code', 'LIKE', "%{$validated['campaign_code']}%");
        }

        // If number of attendees inputted
        if (isset($validated['campaign_attendees'])) {
            // Separate numbers
            $campaign_attendees = explode('-', $validated['campaign_attendees']);

            if (count($campaign_attendees) !== 2) {
                return redirect()->route('manager.campaigns.index')
                    ->withErrors('Katılımcı sayısını doğru formatta giriniz!');
            }

            // Adjust values
            $campaign_attendees = array_map(static function ($value) {
                return (int) trim($value);
            }, $campaign_attendees);

            // Sort values
            sort($campaign_attendees);

            // List values
            [$small, $big] = $campaign_attendees;

            $query->having('users_count', '>=', $small);
            $query->having('users_count', '<=', $big);
        }

        // If start date inputted for campaign valid date
        if (isset($validated['campaign_deadline_start'])) {
            $query->where('campaign_end_date', '>=', $validated['campaign_deadline_start']);
        }

        // If end date inputted for campaign valid date
        if (isset($validated['campaign_deadline_end'])) {
            $query->where('campaign_end_date', '<=', $validated['campaign_deadline_end']);
        }

        // Campaign status
        // Content status
        if (in_array($validated['campaign_visible'], ['0', '1'], true)) {
            $query->where('campaign_visible', (int) $validated['campaign_visible']);
        }

        // Campaign category
        if ($validated['campaign_category'] !== '-1') {
            $query->where('campaign_category', (int) $validated['campaign_category']);
        }

        $campaigns = $query->get();

        return response()->view('admin.campaigns.index', ['campaigns' => $campaigns, 'posted' => $validated, 'categories' => $this->categories]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'campaign_company' => 'nullable|string|max:255',
            'campaign_code' => 'nullable|string|max:255',
            'campaign_attendees' => 'nullable|string',
            'campaign_category' => 'nullable|integer',
            'campaign_deadline_start' => 'nullable|date_format:Y-m-d',
            'campaign_deadline_end' => 'nullable|date_format:Y-m-d',
            'campaign_visible' => 'nullable|string',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.campaigns.create', ['categories' => $this->categories, 'config' => $this->config, 'cities' => $this->cities]);
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
        // Validate inputs
        $validated = $request->validate($this->rules(), [], $this->attributes());

        // Handle the checkbox
        $validated['campaign_visible'] = isset($validated['campaign_visible']);

        // Get the image
        $image = $request->file('campaign_poster');

        // Assign image name
        $imageName = sprintf('%s.%s', Str::uuid(), $image->extension());

        // Upload the image
        $image->storePubliclyAs('public/uploads', $imageName);

        // Save image name
        $validated['campaign_poster'] = $imageName;

        // Create the campaign on the database
        $campaign = Campaign::create($validated);

        // Check if campaign is recorded
        if ($campaign->exists) {
            return redirect()->route('manager.campaigns.index')->with('success', 'Kampanya başarıyla kayıt edilmiştir.');
        }

        return redirect()->back()->withErrors('Kampanya kayıt edilemedi!');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'campaign_title' => 'required|string|max:255',
            'campaign_company' => 'required|string|max:255',
            'campaign_abstract' => 'nullable|string|max:8192',
            'campaign_text' => 'required|string|max:8192',
            'campaign_poster' => sprintf('nullable|dimensions:width=%d,height=%d|mimes:jpeg,png,jpg|max:%d', $this->config['image']['poster']['width'], $this->config['image']['poster']['height'], $this->config['image']['poster']['max_size']),
            'campaign_code' => 'required|string|max:255',
            'campaign_category' => 'required|integer|exists:campaign_categories,id',
            'campaign_limit' => 'nullable|integer',
            'campaign_end_date' => 'date_format:Y-m-d\TH:i',
            'campaign_visible' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'campaign_title' => 'Ayrıcalık Başlığı',
            'campaign_company' => 'Ayrıcalık Şirketi',
            'campaign_abstract' => 'Ayrıcalık Kısa Açıklama',
            'campaign_text' => 'Ayrıcalık Metni',
            'campaign_poster' => 'Ayrıcalık Görseli',
            'campaign_code' => 'Ayrıcalık Kodu',
            'campaign_category' => 'Ayrıcalık Kategorisi',
            'campaign_limit' => 'Ayrıcalık Limiti',
            'campaign_end_date' => 'Ayrıcalık Bitiş Tarihi',
            'campaign_visible' => 'Ayrıcalık Aktifliği',
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param Campaign $campaign
     *
     * @return Response
     */
    public function show(Campaign $campaign): Response
    {
        // Campaign attendees
        $users = $campaign->users()->get();

        return response()->view('admin.campaigns.show', ['users' => $users, 'campaign' => $campaign]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Campaign $campaign
     *
     * @return Response
     */
    public function edit(Campaign $campaign): Response
    {
        return response()->view('admin.campaigns.edit', ['campaign' => $campaign, 'categories' => $this->categories, 'config' => $this->config, 'cities' => $this->cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Campaign $campaign
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Campaign $campaign): RedirectResponse
    {
        // Validate inputs
        $validated = $request->validate($this->rules(), [], $this->attributes());

        // Handle the checkbox
        $validated['campaign_visible'] = isset($validated['campaign_visible']);

        if ($request->hasFile('campaign_poster')) {
            // Get the image
            $image = $request->file('campaign_poster');

            // Assign image name
            $imageName = sprintf('%s.%s', Str::uuid(), $image->extension());

            // Upload the image
            $image->storePubliclyAs('public/uploads', $imageName);

            // Save image name
            $validated['campaign_poster'] = $imageName;
        }

        // Update the campaign on the database
        if ($campaign->update($validated)) {
            return redirect()->back()->with('success', 'Ayrıcalık başarıyla güncellenmiştir.');
        }
        return redirect()->back()->withErrors('Ayrıcalık güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campaign $campaign
     *
     * @return RedirectResponse
     */
    public function destroy(Campaign $campaign): RedirectResponse
    {
        try {
            $campaign->delete();
            return redirect()->route('manager.campaigns.index')->with('success', 'Ayrıcalık başarıyla silinmiştir.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors('Bir hata oluştu!');
        }
    }
}
