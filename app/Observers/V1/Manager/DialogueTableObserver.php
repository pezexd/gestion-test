<?php

namespace App\Observers\V1\Manager;

use App\Models\DialogueTables\DialogueTable;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;

class DialogueTableObserver
{
    use UserDataTrait;
    /**
     * Handle the DialogueTable "created" event.
     *
     * @param  \App\Models\DialogueTables\DialogueTable  $dialogueTable
     * @return void
     */
    public function created(DialogueTable $dialogueTable)
    {
        if (Auth::check()) {
            $dialogueTable->update([
                'user_method_support_id' => $this->getIdUserReview()->methodological_support_id
            ]);
        }
    }
}
