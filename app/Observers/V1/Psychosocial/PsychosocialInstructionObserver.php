<?php

namespace App\Observers\V1\Psychosocial;

use App\Models\PsychosocialInstructions\PsychosocialInstruction;
use Illuminate\Support\Facades\Auth;

class PsychosocialInstructionObserver
{
    /**
     * Handle the PsychosocialInstruction "created" event.
     *
     * @param  \App\Models\PsychosocialInstructions\PsychosocialInstruction  $psychosocialInstruction
     * @return void
     */
    public function created(PsychosocialInstruction $psychosocialInstruction)
    {
        if (Auth::check()) {
            $psychosocialInstruction->update([
                'user_psychoso_coordinator_id' => config('roles.coordinador_psicosocial')
            ]);
        }
    }

}
