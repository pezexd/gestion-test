<?php

namespace App\Observers\V1\Psychosocial;

use App\Models\PsychopedagogicalLogbooks\PsychopedagogicalLogbook;
use Illuminate\Support\Facades\Auth;

class PsychopedagogicalLogbookObserver
{
    /**
     * Handle the PsychopedagogicalLogbook "created" event.
     *
     * @param  \App\Models\PsychopedagogicalLogbooks\PsychopedagogicalLogbook  $psychopedagogicalLogbook
     * @return void
     */
    public function created(PsychopedagogicalLogbook $psychopedagogicalLogbook)
    {
        if (Auth::check()) {
            $psychopedagogicalLogbook->update([

                'user_psychoso_coordinator_id' => config('roles.coordinador_psicosocial')
            ]);
        }
    }

}
