<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\AnnouncementCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    /**
     * @var mixed Config settings
     */
    private $config;

    public function __construct()
    {
        $this->config = Config::get('constants.announcement');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('admin.announcement.index', ['announcements' => Announcement::all(), 'categories' => AnnouncementCategory::all()]);
    }

    /**
     * Display a listing of the resource.
     * Based on the search made
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request): Response
    {
        // Get validated data
        $data = $request->validate($this->searchRules());

        // Start building the query
        $query = Announcement::query();

        // If announcement title filtered
        if (isset($data['announcement_title'])) {
            $query->where('announcement_title', 'LIKE', "%{$data['announcement_title']}%");
        }

        // If announcement start date inputted for created at
        if (isset($data['announcement_start_date'])) {
            $query->whereDate('created_at', '>=', $data['announcement_start_date']);
        }

        // If announcement end date inputted for created at
        if (isset($data['announcement_end_date'])) {
            $query->whereDate('created_at', '<=', $data['announcement_end_date']);
        }

        // Announcement status
        if (in_array($data['announcement_is_visible'], ['0', '1'], true)) {
            $query->where('announcement_is_visible', (int) $data['announcement_is_visible']);
        }

        // Announcement category
        if ($data['announcement_category_id'] !== '-1') {
            $query->where('announcement_category_id', (int) $data['announcement_category_id']);
        }

        // Get all filtered data
        $announcements = $query->get();

        return response()->view('admin.announcement.index', ['announcements' => $announcements, 'posted' => $data, 'categories' => AnnouncementCategory::all()]);
    }

    /**
     * Get the validation rules that apply to the search request.
     *
     * @return array
     */
    public function searchRules(): array
    {
        return [
            'announcement_title' => 'nullable|string|max:255',
            'announcement_start_date' => 'nullable|date_format:Y-m-d',
            'announcement_end_date' => 'nullable|date_format:Y-m-d',
            'announcement_is_visible' => 'nullable|integer',
            'announcement_category_id' => 'nullable|integer',
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('admin.announcement.create', ['categories' => AnnouncementCategory::all(), 'config' => $this->config]);
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
        // Get validated data.
        $data = $request->validate($this->rules(), $this->messages());

        // Handle checkbox of announcement visibility
        $data['announcement_is_visible'] = isset($data['announcement_is_visible']);

        // Store the image on the disk
        if ($request->hasFile('announcement_poster')) {
            // Get file
            $poster = $request->file('announcement_poster');

            // Generate an unique name for this file
            $posterName = sprintf('%s.%s', Str::uuid(), $poster->getClientOriginalExtension());

            // Store the file on the disk
            $poster->storePubliclyAs('public/uploads', $posterName);

            // Save the filename to the model
            $data['announcement_poster'] = $posterName;
        }

        // We are all done, let's save this model to the database
        $created = Announcement::create($data);

        if ($created->exists) {
            return redirect()->route('manager.announcement.index')->with('success', 'Duyuru başarıyla eklenmiştir.');
        }
        return redirect()->back()->withErrors('Duyuru eklenirken bir hata oluştu.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'announcement_title' => 'required|string|max:255',
            'announcement_abstract' => 'nullable|string|max:255',
            'announcement_text' => 'nullable|string|max:8192',
            'announcement_link' => 'nullable|url',
            'announcement_category_id' => 'required|integer|exists:announcement_categories,id',
            'announcement_poster' => sprintf('nullable|dimensions:width=%d,height=%d|mimes:jpeg,png,jpg|max:%d', $this->config['image']['poster']['width'], $this->config['image']['poster']['height'], $this->config['image']['poster']['max_size']),
            'announcement_is_visible' => 'nullable|string',
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
            'announcement_poster.dimensions' => sprintf('Duyuru görseli %d px yüksekliğinde ve %d px genişliğinde olmalıdır', $this->config['image']['poster']['height'], $this->config['image']['poster']['width']),
            'announcement_poster.max' => sprintf('Duyuru görseli en fazla %d mb olmalıdır', $this->config['image']['poster']['max_size'] / 1024),
            'announcement_poster.mimes' => 'Duyuru görseli için jpeg, png, jpg formatlarını uygun dosyalar yükleyebilirsiniz.',
            'announcement_category_id.exists' => 'Duyuru kategorisi bulunamadı',
            'announcement_link.url' => 'Girilen link biçimi geçersizdir. Örneğin, https://pwc.com.tr',
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Announcement $announcement
     *
     * @return Response
     */
    public function edit(Announcement $announcement): Response
    {
        return response()->view('admin.announcement.edit', ['announcement' => $announcement, 'categories' => AnnouncementCategory::all(), 'config' => $this->config]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Announcement $announcement
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        // Get validated data
        $data = $request->validate($this->rules(), $this->messages());

        // Handle checkbox of announcement visibility
        $data['announcement_is_visible'] = isset($data['announcement_is_visible']);

        // Store the image on the disk
        if ($request->hasFile('announcement_poster')) {
            // Get file
            $poster = $request->file('announcement_poster');

            // Generate an unique name for this file
            $posterName = sprintf('%s.%s', Str::uuid(), $poster->getClientOriginalExtension());

            // Store the file on the disk
            $poster->storePubliclyAs('public/uploads', $posterName);

            // Save the filename to the model
            $data['announcement_poster'] = $posterName;
        }

        // We are all done, let's update this instance
        if ($announcement->update($data)) {
            return redirect()->back()->with('success', 'Duyuru başarıyla düzenlenmiştir.');
        }
        return redirect()->back()->withErrors('Duyuru güncellenirken bir hata oluştu.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Announcement $announcement
     *
     * @return RedirectResponse
     */
    public function destroy(Announcement $announcement): RedirectResponse
    {
        try {
            $announcement->delete();
            return redirect()->route('manager.announcement.index')->with('success', 'Duyuru başarıyla silinmiştir.');
        } catch (Exception $exception) {
            activity()->performedOn(new Announcement())->causedBy(auth()->id())->withProperties($announcement->toArray())->log($exception->getMessage());
            return redirect()->back()->withErrors('Duyuru silinirken bir hata oluştu.');
        }
    }
}
