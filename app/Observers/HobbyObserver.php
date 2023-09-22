<?php

namespace App\Observers;

use App\Hobby;

class HobbyObserver
{
    /**
     * Handle the hobby "creating" event.
     *
     * @param Hobby $hobby
     * @return void
     */
    public function creating(Hobby $hobby)
    {
        $hobby->hobby_edit_by = auth()->id();
    }
}
