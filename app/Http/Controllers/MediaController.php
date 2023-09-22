<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Hobby;
use App\Media;
use App\MediaCategory;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDOException;

class MediaController extends Controller
{
    /**
     * @var mixed Media config settings
     */
    private $config;

    /**
     * @var mixed Gallery config settings
     */
    private $galleryConfig;

    public function __construct()
    {
        $this->config = Config::get('constants.media');
        $this->galleryConfig = Config::get('constants.gallery');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response()->view(
            'admin.media.index',
            [
                'items' => Media::all(),
            ]
        );
    }

    /**
     * Display a listing of gallery.
     *
     * @param Media $media
     *
     * @return Response
     */
    public function gallery(Media $media): Response
    {
        return response()->view(
            'admin.media.gallery',
            [
                'media' => $media,
                'files' => $media->files()->get(),
            ]
        );
    }

    /**
     * Display a listing of gallery.
     *
     * @param Media $media
     * @param $id
     *
     * @return RedirectResponse
     */
    public function galleryDestroy(Media $media, $id): RedirectResponse
    {
        try {
            $file = $media->files()->findOrFail($id);
            $file->delete();
        } catch (Exception $exception) {
            return redirect()->back()->withErrors('Dosya silinirken bir hata oluştu.');
        }
        return redirect()->back()->with('success', 'Dosya başarıyla silinmiştir.');
    }

    /**
     * Show the form for adding new files
     *
     * @param Media $media
     *
     * @return Response
     */
    public function galleryCreate(Media $media): Response
    {
        return response()->view(
            'admin.media.gallery_create',
            [
                'media' => $media,
            ]
        );
    }

    /**
     * Store gallery files
     *
     * @param Request $request
     * @param Media $media
     *
     * @return RedirectResponse
     */
    public function galleryStore(Request $request, Media $media): RedirectResponse
    {
        // Validate data
        $request->validate(
            $this->galleryRules()
        );

        // Upload media galleries
        $files = $request->file('media_gallery');
        if ($files) {
            foreach ($files as $file) {
                // Generate a unique name
                $uniqueName = FileHelper::generateFileName($file->getClientOriginalName(), $file->getClientOriginalExtension());

                // Store the file on the disk
                $file->storePubliclyAs('public/uploads', $uniqueName);
                $media->files()->create(['gallery_url' => $uniqueName, 'gallery_added_by' => auth()->id()]);
            }
        }

        return redirect()->route(
            'manager.medias.gallery',
            $media->id
        )->with('success', 'Dosyalar başarıyla eklenmiştir.');
    }

    /**
     * Get the gallery validation rules that apply to the request.
     *
     * @return array
     */
    public function galleryRules(): array
    {
        return [
            'media_gallery' => 'nullable|array',
            'media_gallery.*' => sprintf('nullable|mimes:%s|max:%d', $this->galleryConfig['file']['extensions'], $this->galleryConfig['file']['max_size']),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view(
            'admin.media.create',
            [
                'config' => $this->config,
                'categories' => MediaCategory::all(),
                'hobbies' => Hobby::all(),
            ]
        );
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
        $mediaData = $request->validate($this->rules());
        $categoryData = $request->validate($this->categoryRules());
        $request->validate($this->galleryRules());
        $hobbyData = $request->validate($this->hobbyRules());
        $hobbyClubs = $hobbyData['media_hobby_clubs'] ?? [];

        // Process the media first
        $mediaData['media_is_visible'] = isset($mediaData['media_is_visible']);
        if ($file = $request->file('media_poster')) {
            // Generate random name
            $uniqueName = sprintf('%s.%s', Str::uuid(), $file->getClientOriginalExtension());

            // Store the file on the disk
            $file->storePubliclyAs('public/uploads', $uniqueName);
            $mediaData['media_poster'] = $uniqueName;
        }
        DB::transaction(function () use ($categoryData, $request, $mediaData, $hobbyClubs) {
            $media = Media::create($mediaData);

            // Make relationship with categories
            if (isset($categoryData['media_category'])) {
                $media->categories()->attach($categoryData['media_category']);
            }

            // make relationship with hobby clubs
            $media->hobbies()->attach($hobbyClubs);

            // Upload media galleries
            $files = $request->file('media_gallery');
            if ($files) {
                foreach ($files as $file) {
                    // Generate a unique name
                    $uniqueName = FileHelper::generateFileName($file->getClientOriginalName(), $file->getClientOriginalExtension());

                    // Store the file on the disk
                    $file->storePubliclyAs('public/uploads', $uniqueName);
                    $media->files()->create(['gallery_url' => $uniqueName, 'gallery_added_by' => auth()->id()]);
                }
            }
        });
        return redirect()->route('manager.medias.index')->with('success', 'Medya galeri başarıyla oluşturulmuştur.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'media_title' => 'required|string|max:255',
            'media_abstract' => 'nullable|string|max:255',
            'media_description' => 'nullable|string|max:8192',
            'media_is_visible' => 'nullable|string',
            'media_embed' => 'nullable|string',
            'media_poster' => sprintf('nullable|dimensions:width=%d,height=%d|mimes:jpeg,png,jpg|max:%d', $this->config['image']['poster']['width'], $this->config['image']['poster']['height'], $this->config['image']['poster']['max_size']),
        ];
    }

    /**
     * Get the gallery validation rules that apply to the request.
     *
     * @return array
     */
    public function categoryRules(): array
    {
        return [
            'media_category' => 'nullable|array',
            'media_category.*' => 'exists:media_categories,id',
        ];
    }

    /**
     * Get the hobby club validation rules that apply to the request.
     *
     * @return array
     */
    public function hobbyRules(): array
    {
        return [
            'media_hobby_clubs' => 'nullable|array',
            'media_hobby_clubs.*' => 'exists:hobbies,id',
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Media $media
     *
     * @return Response
     */
    public function edit(Media $media): Response
    {
        return response()->view('admin.media.edit', [
            'media' => $media,
            'config' => $this->config,
            'categories' => MediaCategory::all(),
            'hobbies' => Hobby::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Media $media
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Media $media): RedirectResponse
    {
        // Get validated data
        $data = $request->validate($this->rules());
        $categories = $request->validate($this->categoryRules());
        $hobbyData = $request->validate($this->hobbyRules());
        $hobbyClubs = $hobbyData['media_hobby_clubs'] ?? [];

        // Process the media first
        $data['media_edit_by'] = auth()->id();
        $data['media_is_visible'] = isset($data['media_is_visible']);
        $file = $request->file('media_poster');
        if ($file) {
            // Generate random name
            $uniqueName = sprintf('%s.%s', Str::uuid(), $file->getClientOriginalExtension());

            // Store the file on the disk
            $file->storePubliclyAs('public/uploads', $uniqueName);
            $data['media_poster'] = $uniqueName;
        }

        DB::transaction(function () use ($media, $categories, $data, $hobbyClubs) {
            // Update media
            $media->update($data);

            // media categories
            if (isset($categories['media_category'])) {
                $media->categories()->sync($categories['media_category']);
            } else {
                $media->categories()->detach();
            }
            $media->hobbies()->sync($hobbyClubs);
        });

        return redirect()->back()
            ->with('success', 'Medya galeri başarıyla güncellenmiştir.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Media $media
     *
     * @return RedirectResponse
     */
    public function destroy(Media $media): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $media->files()->delete();
            $media->delete();
            DB::commit();
            return redirect()->route('manager.medias.index')
                ->with('success', 'Medya başarıya silinmiştir.');
        } catch (PDOException $exception) {
            DB::rollBack();
            return redirect()->route('manager.medias.index')
                ->withErrors('Medya silinirken bir hata oluştu.');
        } catch (Exception $e) {
            return redirect()->route('manager.medias.index')
                ->withErrors('Medya silinirken bir hata oluştu.');
        }
    }
}
