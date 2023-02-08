<?php

namespace App\Traits;

use App\Models\RoleUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
trait UserTrait
{

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id');
    }

    public function havePermission($permission)
    {
        $isTrue = false;

        if (!empty($this->roles)) {
            foreach ($this->roles as $role) {

                if ($role['full-access'] == 'yes') {
                    $isTrue = true;
                    break;
                }
            }
        }
        if (count($this->roles)) {
            foreach ($this->roles as $rol) {
                if (count($rol->permissions)) {
                    foreach ($rol->permissions as $perm) {
                        if ($perm->slug == $permission) {
                            $isTrue = true;
                            break;
                        }
                    }
                }
            }
        }
        return $isTrue;
    }

    /*
     * Valida si el usuario logueado tiene un rol administrador y retorna un boolean
     *
     */
    public function isAdmin()
    {

        $isAdmin = false;

        foreach (Auth::user()->roles as $key => $value) {
            if ($value['full-access'] == 'yes' || $value->id == 2) {
                $isAdmin = true;
            }
        }

        return $isAdmin;
    }

    public static function getUsersByRol($array_roles)
    {

        return RoleUser::whereIn('role_id', $array_roles)->get();
    }



    public static function getEmailsUsersByRol($array_roles)
    {
        $users = self::getUsersByRol($array_roles);
        $emails = [];

        foreach ($users as $key => $value) {

            $emails[] = $value->users->email;
        }

        return $emails;
    }
}
