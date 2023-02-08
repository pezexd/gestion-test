<?php

namespace App\Http\Responses;

use App\Http\Resources\V1\UserResource;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        return response()->json([
            'message' => 'User created!',
            'user'=>new UserResource(auth()->user()),

        ]);
    }
}
