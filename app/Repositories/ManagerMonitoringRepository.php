<?php

namespace App\Repositories;

use App\Models\ManagerMonitoring;
use App\Http\Resources\V1\ManagerMonitoringCollection;
use App\Http\Resources\V1\ManagerMonitoringResource;
use App\Traits\UserDataTrait;
use App\Traits\FunctionGeneralTrait;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class ManagerMonitoringRepository
{
    use UserDataTrait, FunctionGeneralTrait;
    private $model;
    function __construct()
    {
        $this->model = new ManagerMonitoring();
    }
    public function getAll()
    {

        $rol_id =$this->getIdRolUserAuth();
        $user_id =$this->getIdUserAuth();
        $query = $this->model->query();
        $managerMonitorings =[];

        if($rol_id == config('roles.gestor')){

            $managerMonitorings =  $query->where('user_id',$user_id)->orderBy('id', 'DESC')->get();
        }
        if($rol_id == config('roles.apoyo_metodologico')){

            $managerMonitorings =  $query->where('user_method_support_id',$user_id)->orderBy('id', 'DESC')->get();
        }

        if($rol_id == config('roles.root')|| $rol_id == config('roles.super_root')){
            $managerMonitorings =  $query->orderBy('id', 'DESC')->get();
        }

        // $results = new ManagerMonitoringCollection(ManagerMonitoring::orderBy('id', 'DESC')->get());
        return new ManagerMonitoringCollection($managerMonitorings);
    }
    public function create($request)
    {
        $managerMonitoring = $this->model->create($request);
        // Guardamos en DataModel
        $this->control_data($managerMonitoring, 'store');
        $results = new ManagerMonitoringResource($managerMonitoring);
        return $results;
    }

    public function findById($id)
    {
        $managerMonitoring = $this->model->findOrFail($id);
        $result = new ManagerMonitoringResource($managerMonitoring);
        return $result;
    }

    public function update($data, $id)
    {
        $managerMonitoring = $this->model->findOrFail($id);
        $rol_id  =  $this->getIdRolUserAuth();
        if ($rol_id == config('roles.gestor')) {
            $data['status']= 'ENREV';
        }
        $managerMonitoring->update($data);
        // Guardamos en DataModel
        $this->control_data($managerMonitoring, 'update');
        $rol_id = $this->getIdRolUserAuth();
        if ($managerMonitoring->status == 'REC') {
            if ($rol_id == config('roles.gestor')) {
                $managerMonitoring->update([
                    'status' => 'ENREV'
                ]);
            }
        }
        $result = new ManagerMonitoringResource($managerMonitoring);
        return $result;
    }

    public function delete($id)
    {
        $managerMonitoring = $this->model->findOrFail($id);
        $managerMonitoring->delete();

        return response()->json(['message' => 'Se ha eliminado correctamente']);
    }

    public function getValidate($data) {

        $validate = [
            'user_id' => 'required',
            'monitor_id' => 'required',
            'activity_date' => 'required',
            'start_time' => 'required',
            'final_hour' => 'required|after:start_time',
            'target_tracking' => 'required',
            'nac_id' => 'required',
            'cultural_process' => 'required',
            'cultural_guidelines' => 'required',
            'cultural_communication' => 'required',
            'difficulty_cultural_process' => 'required',
            'proposal_improvement' => 'required',
            'consecutive' => 'required',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
        ];

        $attrs = [
            'user_id' => 'Usuario',
            'monitor_id' => 'Monitor',
            'activity_date' => 'Fecha actividad',
            'start_time' => 'Fecha inicio',
            'final_hour' => 'Fecha final',
            'target_tracking' => 'Seguimiento de objetivo',
            'nac_id' => 'Nac',
            'cultural_process' => 'Proceso cultural',
            'cultural_guidelines' => 'Directrices culturales',
            'cultural_communication' => 'Comunicación cultural',
            'difficulty_cultural_process' => 'Dificultad proceso cultural',
            'proposal_improvement' => 'Propuesta para mejorar',
            'consecutive' => 'Consecutivo',
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }

}
