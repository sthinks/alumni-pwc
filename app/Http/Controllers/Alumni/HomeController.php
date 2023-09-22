<?php

namespace App\Http\Controllers\Alumni;

use App\Announcement;
use App\Helpers\StrHelper;
use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    protected $avatar;

    public function __construct()
    {
        $this->avatar = url(Config::get('constants.alumni.avatar'));
    }

    /**
     * Display home page
     *
     * @return Response
     */
    public function index(): Response
    {
        $user = auth()->user();

        // announcements
        $news = Announcement::active()
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        // adjust values
        $news->map(function ($item) {
            $item->created = $item->created_at->format('d.m.Y');
            $item->mini_description = Str::words(strip_tags(html_entity_decode($item->announcement_text)), 10, '...');
            $item->link = route('announcement.show', $item->announcement_seo_url);
            $item->category_name = $item->category->name;
            $item->first_sentence = StrHelper::getFirstSentence(strip_tags(html_entity_decode($item->announcement_text)));
            $item->cover_photo = route('storage.images', $item->announcement_poster);
            return $item;
        });

        // get sliders
        $sliders = Slider::active()->orderBy('slider_order', 'asc')->get();

        return response()->view('alumni.home', [
            'news' => $news,
            'sliders' => $sliders,
            'user' => $user,
        ]);
    }
}
