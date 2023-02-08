<?php

namespace App\Repositories;

use App\Models\ModuleItem;
use App\Http\Resources\V1\ModuleItemCollection;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Validation\Rule;

class ModuleItemRepository
{
    use FunctionGeneralTrait;
    private $model;
    private $safeModulesId = [1];
    function __construct()
    {
        $this->model = new ModuleItem();
    }

    function getAll()
    {
        // $this->model->with('module');
        return new ModuleItemCollection($this->model->with('module')->get());
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    public function update($data, $id)
    {
        return $this->model->where('id', $id)->update($data);
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
            'name' => 'required|string|max:255|'. $method != 'update' ? Rule::unique(ModuleItem::class) : 'unique:module_items,id,'.$data->item,
            'route' => 'required|string|'. $method != 'update' ? Rule::unique(ModuleItem::class) : 'unique:module_items,id,'.$data->item,
            'description' => 'required|string',
            'available' => 'required',
            'module_id' => 'required'
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'mimes' => ':attribute debe ser pdf,png,jpg,jpeg.',
            'max' => ':attribute es muy grande.',
            'unique' => 'Ya existe un modulo con este :attribute.',
        ];

        $attrs = [
            'name' => 'Nombre',
            'route' => 'Ruta',
            'description' => 'Descripción',
            'available' => 'Disponible',
            'module_id' => 'Modulo'
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }

}
