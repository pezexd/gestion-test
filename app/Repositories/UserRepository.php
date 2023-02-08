<?php

namespace App\Repositories;

use App\Http\Resources\V1\UserCollection;
use App\Models\User;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    use FunctionGeneralTrait;

    private $model;
    function __construct()
    {
        $this->model = new User();
    }

    function getAll()
    {
        return  new UserCollection($this->model->orderBy('id', 'ASC')->get());

        // orderBy('id', 'DESC')->get()->through(function ($user) {
        //     $repoProfile = new ProfileRepository();
        //     $profile = $repoProfile->findByUserId($user->id);
        //     if ($profile) {
        //         $profile->role;
        //         $user->profile = $profile;
        //     }
        //     $user->roles;
        //     return $user;
        // });
    }

    function create($user)
    {
        $user['password'] = Hash::make($user['password']);
        $new_user = $this->model->create($user);
        // Guardamos en ModelData
        $this->control_data($new_user, 'store');
        return $new_user;
    }

    function findById($id)
    {
        $user =  $this->model->find($id);
        $user->roles;
        $repoProfile = new ProfileRepository();
        $profile = $repoProfile->findByUserId($id);
        if ($profile) {
            $profile->role;
            $user->profile = $profile;
        }
        return $user;
    }

    function update($data, $id)
    {
        $data['password'] = Hash::make($data['password']);
        $user_up = $this->model->findOrFail($id);
        $user_up->update($data);
        // Guardamos en ModelData
        $this->control_data($user_up, 'update');
        return $user_up;
    }

    function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    function noPaginate()
    {
        return $this->model->all()->map(function ($user) {
            $repoProfile = new ProfileRepository();
            $profile = $repoProfile->findByUserId($user->id);
            if ($profile) {
                $profile->role;
                $user->profile = $profile;
            }
            $user->roles;
            return $user;
        });;
    }
    function changePassword($request)
    {
        $user =  $this->model->find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
    }
    function changeStatus($request)
    {
        $user =  $this->model->find($request->id);
        $user->status = $request->status;
        $user->save();
    }
}
