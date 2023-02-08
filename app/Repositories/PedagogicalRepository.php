<?php

namespace App\Repositories;

use App\Http\Resources\V1\PedagogicalCollection;
use App\Http\Resources\V1\PedagogicalResource;
use App\Models\Pedagogical;
use App\Traits\UserDataTrait;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class PedagogicalRepository
{
    use UserDataTrait, FunctionGeneralTrait;
    private $model;
    function __construct()
    {
        $this->model = new Pedagogical();
    }
    public function getAll()
    {
        $rol_id = $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();
        $pedagogicals = [];

        if ($rol_id == config('roles.gestor')) {

            $pedagogicals = Pedagogical::orderBy('id', 'DESC')->where('user_review_manager_cultural_id', $user_id)->get();
        }
        if ($rol_id == config('roles.lider_instructor')) {

            $pedagogicals = Pedagogical::orderBy('id', 'DESC')->where('user_review_instructor_leader_id', $user_id)->get();
        }

        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {

            $pedagogicals = Pedagogical::orderBy('id', 'DESC')->get();
        }
        if ($rol_id == config('roles.monitor')  || $rol_id == config('roles.instructor')) {

            $pedagogicals = Pedagogical::where('created_by', $user_id)
                ->orderBy('id', 'DESC')->get();
        }
        return new PedagogicalCollection($pedagogicals);
    }
    public function create($request)
    {
        $pedagogicals = $this->model->create($request);

        // Guardamos en DataModel
        $this->control_data($pedagogicals, 'store');

        return  new PedagogicalResource($pedagogicals);
    }
    public function findById($id)
    {
        $pedagogicals = $this->model->findOrFail($id);
        $result = new PedagogicalResource($pedagogicals);
        return $result;
    }

    public function update($data, $id)
    {
        $pedagogical = $this->model->findOrFail($id);

        if ($pedagogical->status == 'REC') {
            $pedagogical->update(['status' => 'ENREV']);
        }

        $pedagogical->update($data);
        if ($pedagogical->status == 'REC') {
            $rol_id = $this->getIdRolUserAuth();
            if ($rol_id == config('roles.monitor') || $rol_id == config('roles.instructor')) {
                $pedagogical->update([
                    'status' => 'ENREV'
                ]);
            }
        }
        // Guardamos en ModelData
        $this->control_data($pedagogical, 'update');

        $result = new PedagogicalRepository($pedagogical);
        return $result;
    }

    public function delete($id)
    {
        $pedagogicals = $this->model->findOrFail($id);
        $pedagogicals->delete();

        return response()->json(['items' => 'Se ha eliminado correctamente']);
    }

    public function getValidate($data, $method)
    {

        $validate = [
            'consecutive' => 'required',
            'cultural_right_id' => 'required',
            'nac_id' => 'required',
            'activity_date' => $method != 'update' ? ['bail','required',Rule::unique('pedagogicals', 'activity_date')] : ['bail','required'],
            'activity_name' => 'required|string|max:190',
            'expertise_id' => 'required|integer',
            'experiential_objective' => 'required|string|max:2000',
            'lineament_id' => 'required',
            'orientation_id' => 'required',
            'manifestation' => 'required|string|max:2000',
            'process' => 'required|string|max:2000',
            'product' => 'required|string|max:2000',
            'resources' => 'required|string|max:2000',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'mimes' => ':attribute debe ser pdf,png,jpg,jpeg.',
            'max' => ':attribute es muy grande.',
            'unique' => 'Ya existe un registro con este :attribute.',
        ];

        $attrs = [
            'consecutive' => 'Consecutivo',
            'cultural_right_id' => 'Derecho cultural',
            'nac_id' => 'Nac',
            'activity_date' => 'Fecha de actividad',
            'activity_name' => 'Nombre de la actividad',
            'expertise_id' => 'Expertise',
            'experiential_objective' => 'Objetivo experimental',
            'lineament_id' => 'Lineamento',
            'orientation_id' => 'Orientacion',
            'manifestation' => 'Manifestacion',
            'process' => 'Procesos',
            'product' => 'Productos',
            'resources' => 'Recursos',
        ];

        return $this->validator($data, $validate, $messages, $attrs);
    }

    public function getByRangeActivityDate($initDate, $lastDate)
    {

        /* $carbono = Carbon::parse(now());
        $day = $firtsDays < 9 ? "09" : $firtsDays;
        $month = $carbono->month;
        $year = $carbono->year;
        $firtDay = $year . "/" . $month . "/01";
        $lastDay = $year . "/" . $month . "/" . $day; */
        $rol_id = $this->getIdRolUserAuth();
        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root') || $rol_id == config('roles.gestor') || $rol_id == config('roles.apoyo_al_seguimiento_monitoreo') || $rol_id == config('roles.lider_instructor') || $rol_id == config('roles.lider_embajador')) {
            return  $this->model
                ->orderBy('activity_date')
                ->get();
        }

        return $this->model
            // whereBetween('activity_date', [$initDate, $lastDate])
            ->where('created_by', '=', Auth::id())
            ->orderBy('activity_date')
            ->get();
        //return DB::table('pecs')->where('activity_date', '>=', $firtDay)->where('activity_date', '<=', $lastDay)->get();
    }
}
