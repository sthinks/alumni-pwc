<?php

namespace App\Helpers;

class IframeGenerator
{
    /**
     * This function generate iframe for vimeo videos
     *
     * @param $link
     * @param int $width
     * @param int $height
     *
     * @return string
     */
    public static function vimeo($link): string
    {
        $id = (int) substr(parse_url(trim($link), PHP_URL_PATH), 1);
        return sprintf(
            '<div class="media_video_responsive"><iframe class="iframe_video_responsive" src="https://player.vimeo.com/video/%d?h=4afedae5c6&byline=0&portrait=0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe></div>',
            $id,
        );
    }
}
