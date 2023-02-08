<?php

namespace App\Observers\V1;

use App\Models\Binnacle;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;

class BinnacleObserver
{
    use UserDataTrait;
    /**
     * Handle the Binnacle "created" event.
     *
     * @param  \App\Models\Binnacle  $binnacle
     * @return void
     */
    public function created(Binnacle $binnacle)
    {
        if (Auth::check()) {
            $binnacle->update([

                'user_review_manager_cultural_id' => $this->getIdUserReview()->gestor_id,
                'user_review_support_follow_id' => $this->getIdUserReview()->support_tracing_monitoring_id,
                'user_review_instructor_leader_id' => $this->getIdUserReview()->instructor_leader_id,
                'user_method_support_id' => $this->getIdUserReview()->methodological_support_id
            ]);
        }
    }
}
