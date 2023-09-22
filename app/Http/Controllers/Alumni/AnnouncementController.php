<?php

namespace App\Http\Controllers\Alumni;

use App\Announcement;
use App\AnnouncementCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AnnouncementController extends Controller
{
    /**
     * How many items will be displayed per page
     */
    private const PAGINATE = 8;

    // content per page
    private $categories;

    public function __construct()
    {
        $this->categories = AnnouncementCategory::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $announcements = Announcement::active()->orderBy('created_at', 'desc')->paginate(self::PAGINATE);

        $announcements->map(function ($announcement) {
            $announcement->mini_description = Str::words(strip_tags(html_entity_decode($announcement->announcement_text)), 20);
            return $announcement;
        });

        return response()->view('alumni.announcement.index', [
            'categories' => $this->categories,
            'announcement' => $announcements,
        ]);
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
        // get the intented announcement
        $announcement = Announcement::active()->where('announcement_seo_url', $id)->firstOrFail();

        // get other announcements to suggest
        $suggestions = Announcement::active()->where('id', '!=', $announcement->id)->orderBy('created_at', 'desc')->take(2)->get();

        // check if redirect is needed
        if ($announcement->announcement_link) {
            return redirect($announcement->announcement_link);
        }

        $suggestions->map(function ($suggestion) {
            $suggestion->mini_description = Str::words(strip_tags($suggestion->announcement_text), 20);
            return $suggestion;
        });

        return response()->view('alumni.announcement.show', [
            'announcement' => $announcement,
            'suggestions' => $suggestions,
        ]);
    }

    /**
     * Display a listing of the according to the search request.
     *
     * @return Response|RedirectResponse
     *
     * @throws ValidationException
     */
    public function filter(Request $request)
    {
        // validate inputs
        $get_data = Validator::make($request->only('category'), $this->rules());

        // if validation fails redirect to campaign index
        if ($get_data->fails()) {
            return redirect()->route('announcement.index');
        }

        // get validated data and intented categories
        $data = $get_data->validated();
        $categories = $data['category'];
        $categories = array_map('intval', $categories);

        // Filtered announcement
        $announcement = Announcement::active()->whereIn('announcement_category_id', $categories)->orderBy('created_at', 'desc')->paginate(self::PAGINATE);

        $announcement->map(function ($one) {
            $one->mini_description = Str::words(strip_tags(html_entity_decode($one->announcement_text)), 20);
            return $one;
        });

        return response()->view('alumni.announcement.index', [
            'announcement' => $announcement,
            'posted' => $data,
            'categories' => $this->categories,
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
            'category' => 'required|array',
            'category.*' => 'integer|exists:announcement_categories,id',
        ];
    }
}
