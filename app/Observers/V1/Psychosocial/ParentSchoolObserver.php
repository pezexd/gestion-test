<?php

namespace App\Observers\V1\Psychosocial;

use App\Models\ParentSchools\ParentSchool;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;

class ParentSchoolObserver
{
    use UserDataTrait;
    /**
     * Handle the ParentSchool "created" event.
     *
     * @param  \App\Models\ParentSchools\ParentSchool  $parentSchool
     * @return void
     */
    public function created(ParentSchool $parentSchool)
    {
        if (Auth::check()) {
            $parentSchool->update([

                'user_psychoso_coordinator_id' => config('roles.coordinador_psicosocial')
            ]);
        }
    }
}
