<?php

namespace App\Traits;

use App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\Auth;

trait UserDataTrait
{

    /**
     * Devuelve el rol del perfil asociaddo al usuario
     *
     */
    public function getIdRolUserAuth()
    {
        $user_id = Auth::user()->profile->role->id;
        return $user_id;
    }

    /**
     * Devuelve el rol del perfil asociaddo al usuario
     *
     */
    public function getIdUserAuth()
    {
        $user_id = Auth::user()->id;
        return $user_id;
    }

    public function getIdUserReview()
    {
        $user_id =Auth::user()->id;
        $profile = Profile::where('user_id',$user_id)->select('id','gestor_id','psychosocial_id','methodological_support_id','support_tracing_monitoring_id','ambassador_leader_id','instructor_leader_id')->first();
        return  $profile;
    }


}
