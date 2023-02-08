<?php

namespace App\Observers\V1;

use App\Models\Inscriptions\Pec;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PecObserver
{
    use UserDataTrait;
    /**
     * Handle the Pec "created" event.
     *
     * @param  \App\Models\Inscriptions\Pec  $pec
     * @return void
     */
    public function created(Pec $pec)
    {
        if (Auth::check()) {
            $pec->update([
                'user_review_manager_cultural_id' => $this->getIdUserReview()->gestor_id,
                'user_review_instructor_leader_id' => $this->getIdUserReview()->instructor_leader_id
            ]);
        }
    }
}
