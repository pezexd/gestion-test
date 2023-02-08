<?php

namespace App\Observers\V1\Manager;

use App\Models\MethodologicalInstructionModel;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;

class MethodologicalInstructionModelObserver
{
    use UserDataTrait;
    /**
     * Handle the MethodologicalInstructionModel "created" event.
     *
     * @param  \App\Models\MethodologicalInstructionModel  $methodologicalInstructionModel
     * @return void
     */
    public function created(MethodologicalInstructionModel $methodologicalInstructionModel)
    {
        if (Auth::check()) {
            $methodologicalInstructionModel->update([

                'user_method_support_id' => $this->getIdUserReview()->methodological_support_id

            ]);
        }
    }
}
