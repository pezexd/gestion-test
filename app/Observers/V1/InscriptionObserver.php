<?php

namespace App\Observers\V1;

use App\Models\Inscriptions\Inscription;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InscriptionObserver
{
    use UserDataTrait;
    /**
     * Handle the Inscription "created" event.
     *
     * @param  \App\Models\Inscriptions\Inscription  $inscription
     * @return void
     */
    public function created(Inscription $inscription)
    {
        if (Auth::check()) {
            $inscription->update([
                'user_review_support_follow_id' => $this->getIdUserReview()->support_tracing_monitoring_id,
                // 'user_review_instructor_leader_id' => $this->getIdUserReview()->instructor_leader_id

            ]);
        }
    }
}
