<?php

namespace App\Http\Controllers\Alumni;

use App\Helpers\IframeGenerator;
use App\Http\Controllers\Controller;
use App\Media;
use App\MediaCategory;
use Illuminate\Http\Response;

class MediaController extends Controller
{
    /**
     * How many items will be displayed per page
     */
    private const PAGINATE = 8;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        // get related category
        $media = MediaCategory::whereSlug('hatirli-sohbetler')
            ->firstOrFail()
            ->media()
            ->active()
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE);
        // adjust date values
        $media->map(function ($item) {
            $item->creation_date = $item->created_at->translatedFormat('d F Y');
            $item->poster = route('storage.images', $item->media_poster);
            $item->detail_link = route('media.show', $item->media_seo_url);
            return $item;
        });

        return response()->view('alumni.media.index', [
            'media' => $media,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $seo_url
     *
     * @return Response
     */
    public function show($seo_url): Response
    {
        $media = Media::active()->where('media_seo_url', $seo_url)->firstOrFail();

        // add property for images, videos and documents
        [$images, $videos, $documents] = $this->getFiles($media);
        $media->images = $images;
        $media->videos = $videos;
        $media->documents = $documents;
        $media->poster = route('storage.images', $media->media_poster);

        return response()->view('alumni.media.show', [
            'media' => $media,
        ]);
    }

    /**
     * Get files belonging to the media
     *
     * @param Media $media
     *
     * @return array
     */
    public function getFiles(Media $media): array
    {
        $image = [];
        $video = array_filter(explode(',', $media->media_embed));
        $document = [];
        $files = $media->files()->get();
        foreach ($files as $file) {
            if ($this->checkIfImage($file->gallery_url)) {
                $image[] = route('storage.images', $file->gallery_url);
            } elseif ($this->checkIfDocument($file->gallery_url)) {
                $document[] = route('storage.images', $file->gallery_url);
            }
        }
        $video = array_map(function ($video_link) {
            return IframeGenerator::vimeo($video_link);
        }, $video);
        return [$image, $video, $document];
    }

    /**
     * Check if file is image
     *
     * @param string $file
     *
     * @return bool
     */
    private function checkIfImage(string $file): bool
    {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = $this->getExtension($file);
        return $this->checkIfFileHasWantedExtension($extension, $allowed_extensions);
    }

    /**
     * Get file extension
     *
     * @param string $file
     *
     * @return string
     */
    private function getExtension(string $file): string
    {
        $extension = explode('.', $file);
        $extension = end($extension);
        return strtolower($extension);
    }

    /**
     * Check if file has wanted extensions
     *
     * @param string $extension
     * @param array $allowed_extensions
     *
     * @return bool
     */
    private function checkIfFileHasWantedExtension(string $extension, array $allowed_extensions): bool
    {
        if (in_array($extension, $allowed_extensions)) {
            return true;
        }
        return false;
    }

    /**
     * Check if file is document
     *
     * @param string $file
     *
     * @return bool
     */
    private function checkIfDocument(string $file): bool
    {
        $allowed_extensions = ['pdf', 'xlsx', 'docx', 'doc', 'ppt', 'pptx', 'txt', 'rtf', 'csv'];
        $extension = $this->getExtension($file);
        return $this->checkIfFileHasWantedExtension($extension, $allowed_extensions);
    }
}
