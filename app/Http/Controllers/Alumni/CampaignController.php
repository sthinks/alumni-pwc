<?php

namespace App\Http\Controllers\Alumni;

use App\Campaign;
use App\CampaignCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CampaignController extends Controller
{
    /**
     * How many items will be displayed per page
     */
    private const PAGINATE = 8;

    private $categories;

    public function __construct()
    {
        $this->categories = CampaignCategory::get(['id', 'name']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        // get active campaigns
        $campaigns = Campaign::active()->future()->orderBy('created_at', 'desc')->paginate(self::PAGINATE);

        // add mini_description
        $campaigns->map(function ($campaign) {
            $campaign->mini_description = Str::words(strip_tags(html_entity_decode($campaign->campaign_text)), 50);
            $campaign->already_joined = $campaign->users->contains(auth()->id());
            $campaign->campaign_last_apply_date = $campaign->campaign_end_date->translatedFormat("d F Y");
            if ($campaign->already_joined) {
                $campaign->campaign_join_at = $campaign->users(auth()->id())->first()->pivot->created_at->translatedFormat("d F Y");
            }
            return $campaign;
        });

        return response()->view('alumni.campaign.index', [
            'campaigns' => $campaigns,
            'categories' => $this->categories
        ]);
    }

    /**
     * Display a listing of the according to the search request.
     *
     * @return Response|RedirectResponse
     * @throws ValidationException
     */
    public function filter(Request $request)
    {
        // get validated data
        $get_data = Validator::make($request->only('category'), $this->rules());

        // if validation fails redirect to campaign index
        if ($get_data->fails()) {
            return redirect()->route('campaign.index');
        }
        $data = $get_data->validated();
        $categories = $data['category'];
        $categories = array_map('intval', $categories);
        // Campaign
        $campaigns = Campaign::active()
            ->future()
            ->whereIn('campaign_category', $categories)
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE);
        // add mini_description
        $campaigns->map(function ($campaign) {
            $campaign->mini_description = Str::words(strip_tags(html_entity_decode($campaign->campaign_text)), 50);
            $campaign->already_joined = $campaign->users->contains(auth()->id());
            $campaign->campaign_last_apply_date = $campaign->campaign_end_date->translatedFormat("d F Y H:i:s");
            if ($campaign->already_joined) {
                $campaign->campaign_join_at = $campaign->users(auth()->id())->first()->pivot->created_at->translatedFormat("d F Y H:i:s");
            }
            return $campaign;
        });
        return response()->view('alumni.campaign.index', [
            'campaigns' => $campaigns,
            'posted' => $data,
            'categories' => $this->categories
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
            'category' => "required|array",
            'category.*' => "integer|exists:campaign_categories,id"
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param string $id
     * @return Response|RedirectResponse
     */
    public function join(string $id)
    {
        // check if campaign exists and active
        $campaign = Campaign::active()->where('campaign_seo_url', $id)->firstOrFail();

        // check if campaign has expired
        if ($campaign->campaign_end_date->lt(now())) {
            return redirect()->back()->withErrors('Ayrıcalığın katılım süresi dolmuştur.');
        }

        // check if user is already joined
        if (!$campaign->users->contains(auth()->user()->id)) {
            $campaign->users()->attach(auth()->user()->id);
        } else {
            return redirect()->back()->withErrors('Bu ayrıcalığa zaten katıldınız.');
        }

        // redirect to campaign
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     * @return Response|RedirectResponse
     */
    public function show(string $id)
    {
        // check if campaign exists and active
        $campaign = Campaign::active()->where('campaign_seo_url', $id);

        // if campaign not found
        if ($campaign->count() === 0) {
            return redirect()->route('campaign.index')->withErrors('Ayrıcalık bulunamadı.');
        }

        $campaign = $campaign->first();

        $campaign->campaign_last_apply_date = $campaign->campaign_end_date->translatedFormat("d F Y");
        $campaign->already_joined = $campaign->users->contains(auth()->id());

        if ($campaign->already_joined) {
            $campaign->campaign_join_at = $campaign->users(auth()->id())->first()->pivot->created_at->translatedFormat("d F Y");
        }

        // check if campaign has expired
        if ($campaign->campaign_end_date->lt(now())) {
            return redirect()->route('campaign.index')->withErrors('Ayrıcalık sonra ermiştir.');
        }

        // retrieve other last campaigns
        $others = Campaign::active()->future()->where('id', '!=', $campaign->id)->orderBy('created_at', 'desc')->limit(2)->get();
        $others->map(function ($other) {
            $other->campaign_last_apply_date = $other->campaign_end_date->translatedFormat("d F Y");
            return $other;
        });

        // check if user is already joined
        $already_joined = $campaign->users->contains(auth()->id());

        // check if expired
        $expired = $campaign->campaign_end_date->lt(now());


        return response()->view('alumni.campaign.show', [
            'campaign' => $campaign,
            'others' => $others,
            'already_joined' => $already_joined,
            'expired' => $expired,
        ]);
    }
}
