<?php

namespace App\Http\Controllers\Alumni;

use App\Helpers\IframeGenerator;
use App\Http\Controllers\Controller;
use App\Knowledge;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class KnowledgeController extends Controller
{
    /**
     * How many items will be displayed per page
     */
    private const PAGINATE = 6;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $knowledge = Knowledge::active()->orderBy('created_at', 'DESC')->paginate(self::PAGINATE);
        $knowledge->map(function ($knowledge) {
            $knowledge->mini_description = Str::words(strip_tags(html_entity_decode($knowledge->knowledge_text)), 10);
            return $knowledge;
        });

        $knowledge_featured = Knowledge::active()->featured()->orderBy('created_at', 'DESC')->limit(4)->get();
        $knowledge_featured->map(function ($knowledge) {
            $knowledge->mini_description = Str::words(strip_tags(html_entity_decode($knowledge->knowledge_text)), 10);
            return $knowledge;
        });

        return response()->view('alumni.knowledge.index', [
            'knowledge' => $knowledge,
            'knowledge_featured' => $knowledge_featured,
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
        // get intented knowledge as long as it exists and active
        $knowledge = Knowledge::active()->where('knowledge_seo_url', $seo_url)->firstOrFail();

        // add property for images, videos and documents
        [$images, $videos, $documents] = $this->getFiles($knowledge);
        $knowledge->images = $images;
        $knowledge->videos = $videos;
        $knowledge->documents = $documents;

        // get suggestions of latest knowledge
        $others = Knowledge::active()->where('knowledge_seo_url', '!=', $seo_url)->orderBy('id', 'desc')->limit(2)->get();

        // add mini description property to the knowledge
        $others->map(function ($other) {
            $other->mini_description = Str::words(strip_tags($other->knowledge_text), 10);
            return $other;
        });

        return response()->view('alumni.knowledge.show', [
            'knowledge' => $knowledge,
            'others' => $others,
        ]);
    }

    /**
     * Get files belonging to the media
     *
     * @param Knowledge $knowledge
     *
     * @return array
     */
    public function getFiles(Knowledge $knowledge): array
    {
        $image = [];
        $video = array_filter(explode(',', $knowledge->knowledge_embed));
        $document = [];
        $files = $knowledge->files()->get();
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

    /**
     * Check if file is video
     *
     * @param string $file
     *
     * @return bool
     */
    private function checkIfVideo(string $file): bool
    {
        $allowed_extensions = ['mp4', 'webm', 'ogg', 'ogv', 'mov', 'avi', 'flv'];
        $extension = $this->getExtension($file);
        return $this->checkIfFileHasWantedExtension($extension, $allowed_extensions);
    }
}
