<?php

namespace App\Observers;

use App\Knowledge;

class KnowledgeObserver
{
    /**
     * Handle the knowledge "creating" event.
     *
     * @param Knowledge $knowledge
     * @return void
     */
    public function creating(Knowledge $knowledge)
    {
        $knowledge->knowledge_edit_by = auth()->id();
    }

}
