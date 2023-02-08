<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Models\User;
use App\Models\UserReviewForm;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Support\Facades\DB;

class ProfileRepository
{
    use FunctionGeneralTrait;

    private $model;
    function __construct()
    {
        $this->model = new Profile();
    }

    public function getAll()
    {
        return $this->model->paginate(10);
    }

    public function create($profile)
    {
        $repoUser = new UserRepository();
        $role = DB::table('roles')->where('slug', '=', $profile['role_id'])->get();
        $user = $repoUser->findById($profile['user_id']);
        $profile['role_id'] = $role[0]->id;
        $user->roles()->attach($role[0]->id);
        $new_profile = $this->model->create($profile);
        // Guardamos en ModelData
        $this->control_data($new_profile, 'store');

        return $new_profile;
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findByUserId($userId)
    {
        return $this->model->where('user_id', $userId)->first();
    }

    public function update($data, $id)
    {
        $repoUser = new UserRepository();
        $user = $repoUser->findById($data['user_id']);
        $role = DB::table('roles')->where('slug', '=', $data['role_id'])->get();
        $data['role_id'] = $role[0]->id;
        $user->roles()->sync($role[0]->id);
        $profile = $this->model->find($id);
        $profile->update($data);
        // Guardamos en ModelData
        $this->control_data($profile, 'update');
        return $profile;
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function findByGestorId($gestorId)
    {
        return $this->model->where('gestor_id', '=', $gestorId)->get();
    }
}
