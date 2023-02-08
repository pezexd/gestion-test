<?php

namespace App\Observers\V1;

use App\Models\Pedagogical;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;

class PedagogicalObserver
{
    use UserDataTrait;
    /**
     * Handle the Pedagogical "created" event.
     *
     * @param  \App\Models\Pedagogical  $pedagogical
     * @return void
     */
    public function created(Pedagogical $pedagogical)
    {
        if (Auth::check()) {
            $pedagogical->update([
                'user_review_manager_cultural_id' => $this->getIdUserReview()->gestor_id,
                'user_review_instructor_leader_id' => $this->getIdUserReview()->instructor_leader_id
            ]);
        }
    }
}
