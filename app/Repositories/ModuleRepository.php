<?php

namespace App\Repositories;

use App\Http\Resources\V1\ModuleCollection;
use App\Models\Module;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Validation\Rule;

class ModuleRepository
{
    use FunctionGeneralTrait;
    private $model;
    private $safeModulesId = [1];
    function __construct()
    {
        $this->model = new Module();
    }

    function getAll()
    {
        // $results = new EntityNameCollection(EntityName::latest()->get());
        // return $results;
        return new ModuleCollection($this->model->orderBy('id', 'DESC')->get());
    }

    public function create($data)
    {
        $module = $this->model->create($data);
        // Guardamos en ModelData
        $this->control_data($module, 'store');
        return $module;
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($data, $id)
    {
        $module = $this->model->findOrFail($id);
        $module->update($data);
        $this->control_data($module, 'update');
        return $module;
    }

    public function delete($id)
    {
        $isSafe = in_array($id, $this->safeModulesId);
        if (!$isSafe) {
            return $this->model->where('id', $id)->delete();
        }
        return [];
    }

    public function getValidate($data, $method) {

        $validate = [
            'name' => 'required|string|max:255|'.$method != 'update' ? Rule::unique(Module::class) : 'unique:modules,id,'.$data->module,
            'slug' => 'required|string|'.$method != 'update' ? Rule::unique(Module::class) : 'unique:modules,id,'.$data->module,
            'description' => 'required|string'
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'mimes' => ':attribute debe ser pdf,png,jpg,jpeg.',
            'max' => ':attribute es muy grande.',
            'unique' => 'Ya existe un modulo con este :attribute.',
        ];

        $attrs = [
            'name' => 'Nombre',
            'slug' => 'Slug',
            'description' => 'Descripcion'
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }

}
