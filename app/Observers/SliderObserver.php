<?php

namespace App\Observers;

use App\Slider;

class SliderObserver
{
    /**
     * Handle the slider "creating" event.
     *
     * @param Slider $slider
     * @return void
     */
    public function creating(Slider $slider)
    {
        $slider->slider_edit_by = auth()->id();
    }
}
