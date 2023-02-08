<?php

namespace App\Repositories;

use App\Models\MethodologicalSheetsOne;
use App\Traits\FunctionGeneralTrait;

class MethodologicalSheetsOneRepository
{
    use FunctionGeneralTrait;

    private $model;
    private $safeRolesID = [1, 2];
    function __construct()
    {
        $this->model = new MethodologicalSheetsOne();
    }

    function getAll()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        $mso = $this->model->create($data);
        // Guardamos en DataModel
        $this->control_data($mso, 'store');
        return $mso;
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function update($data, $id)
    {
        $mso = $this->model->findOrFail($id);
        $mso->update($data);
        // Guardamos en ModelData
        $this->control_data($mso, 'update');
        return $mso;
    }

    public function delete($id)
    {
        $isSafe = in_array($id, $this->safeRolesID);
        if (!$isSafe) {
            return $this->model->where('id', $id)->delete();
        }
        return [];
    }
}
