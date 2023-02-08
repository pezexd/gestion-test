<?php

namespace App\Observers\V1\Manager;

use App\Models\ManagerMonitoring;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;

class ManagerMonitoringObserver
{
    use UserDataTrait;
    /**
     * Handle the ManagerMonitoring "created" event.
     *
     * @param  \App\Models\ManagerMonitoring  $managerMonitoring
     * @return void
     */
    public function created(ManagerMonitoring $managerMonitoring)
    {
        if (Auth::check()) {
            $managerMonitoring->update([

                'user_method_support_id' => $this->getIdUserReview()->methodological_support_id

            ]);
        }
    }

}
