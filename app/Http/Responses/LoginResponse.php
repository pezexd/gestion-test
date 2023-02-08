<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use App\Models\AccessLogin;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        $user = Auth::user();
        $user->roles;
        $user->profile;

        $access = new AccessLogin();
        $access->user_id = $user->id;
        $access->date = date("Y-m-d");
        $access->time = date('H:i:s');
        $access->active = 1;
        $access->save();

        return response()->json([
            'message' => 'User login!',
            'user' => $user,
        ]);
    }
}
