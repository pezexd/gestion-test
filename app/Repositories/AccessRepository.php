<?php

namespace App\Repositories;

use App\Models\Binnacle;
use App\Models\Inscriptions\Inscription;
use App\Models\Inscriptions\Pec;
use App\Models\Module;
use App\Models\Pedagogical;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AccessRepository
{
    private $module;
    private $permission;
    function __construct()
    {
        $this->module = new Module();
        $this->permission = new Permission();
    }

    public function getUserRoles()
    {
        return Auth::user()->roles;
    }

    public function getMenuBySlug($slug)
    {
        return $this->module->where('slug', 'like', $slug)
            ->where('available', 1)
            ->first();
    }

    public function getAccessMenu()
    {
        foreach ($this->getUserRoles() as $key => $value) {
            // retorna todos los menus si tiene full access
            if ($value['full-access'] === 'yes') {
                return $this->module->where('available', 1)
                    ->with('items:name,route,module_id,icon')->get();
            }

            if (!empty($value->permissions)) {
                $menu = [];
                foreach ($value->permissions as $clave => $valor) {

                    $result = $this->getMenuBySlug($valor->slug);
                    if (!empty($result)) {
                        $menu[] = $result;
                    }
                }

                foreach ($value->permissions as $clave => $valor) {
                    foreach ($menu as $puesto => $dato) {
                        foreach ($dato->items as $key => $value) {
                            if ($value->route === $valor->slug) {
                                $submenu[] = $value;
                                $dato->items = $submenu;
                            }
                        }
                    }
                }
                return $menu;
            }
        }
        return false;
    }
    public function getPermissions()
    {
        // return $roles->permissions->where('slug', 'LIKE','%.index%')->get();
        foreach ($this->getUserRoles() as $key => $value) {
            // retorna todos los menus si tiene full access
            if ($value['full-access'] === 'yes') {
                return $this->permission->where('slug', 'LIKE', '%.index%')->select('slug','name')->get();
                //
            }

            if (!empty($value->permissions)) {

                return $value->permission_menus;
            }
        }
        return false;
    }
    public function getButtonBooleanCreates()
    {
        $data = [
            'pecs' =>Pec::count(),
            'pools'=>Inscription::count(),
            'pedagogicals'=>Pedagogical::count(),
            'binnacles'=>Binnacle::count()
        ];

        return $data;

    }
}
