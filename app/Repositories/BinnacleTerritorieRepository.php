<?php

namespace App\Repositories;

use App\Http\Resources\V1\BinnacleTerritorieCollection;
use App\Models\BinnacleTerritorie;
use App\Models\Nac;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\ImageTrait;
use App\Traits\UserDataTrait;
use App\Traits\FunctionGeneralTrait;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Auth;

class BinnacleTerritorieRepository
{
    use ImageTrait, UserDataTrait, FunctionGeneralTrait;
    private $model;

    function __construct()
    {
        $this->model = new BinnacleTerritorie();
    }

    public function getAll()
    {
        $binnacles = $this->model->orderBy('id', 'DESC')->get();
        return new BinnacleTerritorieCollection($binnacles);
    }

    public function getAllByUserLogged()
    {
        $binnacles = $this->model->where('created_by', '=', Auth::id())->orderBy('id', 'DESC')->get();
        return new BinnacleTerritorieCollection($binnacles);
    }

    public function create(Request $request)
    {
        $binnacleTerritorie = $this->model;
        $binnacleTerritorie->consecutive = $request->consecutive;
        $binnacleTerritorie->nac_id = $request->nac_id;
        $binnacleTerritorie->role_id = $request->role_id;
        $binnacleTerritorie->user_id = $request->user_id;
        $binnacleTerritorie->created_by = Auth::id();
        $binnacleTerritorie->activity_date = $request->activity_date;
        $binnacleTerritorie->start_time = $request->start_time;
        $binnacleTerritorie->start_time = $request->start_time;
        $binnacleTerritorie->final_hour = $request->final_hour;
        $binnacleTerritorie->final_hour = $request->final_hour;
        $binnacleTerritorie->place = $request->place;
        $binnacleTerritorie->strategic_objectives_area = $request->strategic_objectives_area;
        $binnacleTerritorie->purpose_visit = $request->purpose_visit;
        $binnacleTerritorie->topics_covered = $request->topics_covered;
        $binnacleTerritorie->participants_perception = $request->participants_perception;
        $binnacleTerritorie->problems_identified = $request->problems_identified;
        $binnacleTerritorie->recommendations_actions = $request->recommendations_actions;
        $binnacleTerritorie->comments_analysis = $request->comments_analysis;
        $save = $binnacleTerritorie->save();

        if ($save) {
            $handle_1 = $this->send_file($request, 'development_activity_image', 'binnacle_territories', $binnacleTerritorie->id);
            $binnacleTerritorie->update(['development_activity_image' => $handle_1['response']['payload']]);
            $save &= $handle_1['response']['success'];

            $handle_2 = $this->send_file($request, 'evidence_participation_image', 'binnacle_territories', $binnacleTerritorie->id);
            $binnacleTerritorie->update(['evidence_participation_image' => $handle_2['response']['payload']]);
            $save &= $handle_2['response']['success'];
        }

        // Guardamos en DataModel
        $this->control_data($binnacleTerritorie, 'store');

        return $binnacleTerritorie;
    }

    public function update(Request $request, $data, $id)
    {

        $binnacleTerritorie = $this->model->find($id);

        $binnacleTerritorie->consecutive = $request->consecutive;
        $binnacleTerritorie->nac_id = $request->nac_id;
        $binnacleTerritorie->role_id = $request->role_id;
        $binnacleTerritorie->user_id = $request->user_id;
        $binnacleTerritorie->activity_date = $request->activity_date;
        // $binnacleTerritorie->reviewed_by = $request->reviewed_by;
        $binnacleTerritorie->start_time = $request->start_time;
        $binnacleTerritorie->start_time = $request->start_time;
        $binnacleTerritorie->final_hour = $request->final_hour;
        $binnacleTerritorie->final_hour = $request->final_hour;
        $binnacleTerritorie->place = $request->place;
        $binnacleTerritorie->strategic_objectives_area = $request->strategic_objectives_area;
        $binnacleTerritorie->purpose_visit = $request->purpose_visit;
        $binnacleTerritorie->topics_covered = $request->topics_covered;
        $binnacleTerritorie->participants_perception = $request->participants_perception;
        $binnacleTerritorie->problems_identified = $request->problems_identified;
        $binnacleTerritorie->recommendations_actions = $request->recommendations_actions;
        $binnacleTerritorie->comments_analysis = $request->comments_analysis;

        if ($request->hasFile('development_activity_image')) {
            $handle_1 = $this->update_file($request, 'development_activity_image', 'binnacle_territories', $binnacleTerritorie->id, $binnacleTerritorie->development_activity_image);

            $binnacleTerritorie->update(['development_activity_image' => $handle_1['response']['payload']]);

            // $save &= $handle_1['response']['success'];
        }
        if ($request->hasFile('evidence_participation_image')) {
            $handle_2 = $this->update_file($request, 'evidence_participation_image', 'binnacle_territories', $binnacleTerritorie->id, $binnacleTerritorie->evidence_participation_image);

            $binnacleTerritorie->update(['evidence_participation_image' => $handle_2['response']['payload']]);

            // $save &= $handle_2['response']['success'];
        }
        if ($request->status == 'REC') {
            $binnacleTerritorie->status = 'ENREV';
        }

        $binnacleTerritorie->save();

        // Guardamos en DataModel
        $this->control_data($binnacleTerritorie, 'update');

        return $binnacleTerritorie;
    }

    public function findById($id)
    {
        $find = $this->model->find($id);
        return $find;
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }


    function getValidate($data, $method)
    {

        $validate = [
            'consecutive' => 'bail|required',
            'nac_id' => 'bail|required',
            'role_id' => 'bail|required',
            'user_id' => 'bail|required',
            'activity_date' => 'bail|required',
            'start_time' => 'bail|required',
            'final_hour' => 'bail|required',
            'place' => 'bail|required',
            'strategic_objectives_area' => 'bail|required',
            'purpose_visit' => 'bail|required',
            'topics_covered' => 'bail|required',
            'participants_perception' => 'bail|required',
            'problems_identified' => 'bail|required',
            'recommendations_actions' => 'bail|required',
            'comments_analysis' => 'bail|required',
            'development_activity_image' => $method != 'update' ? 'bail|required|mimes:application/pdf,pdf,png,webp,jpg,jpeg|max:' . (500 * 1049000) : 'bail',
            'evidence_participation_image' => $method != 'update' ? 'bail|required|mimes:application/pdf,pdf,png,webp,jpg,jpeg|max:' . (500 * 1049000) : 'bail',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'unique' => 'Ya existe un asistente con este :attribute.',
        ];

        $attrs = [
            'consecutive' => 'Consecutivo',
            'nac_id' => 'Nac',
            'role_id' => 'Rol',
            'user_id' => 'Usuario',
            'activity_date' => 'Fecha de actividad',
            'start_time' => 'Hora inicio',
            'final_hour' => 'Hora final',
            'place' => 'Lugar',
            'strategic_objectives_area' => 'Objetivos estratégicos del área',
            'purpose_visit' => 'Objetivos estratégicos del área',
            'topics_covered' => 'Temáticas abordadas',
            'participants_perception' => 'Percepción de los participantes frente a las actividades desarrolladas por el área',
            'problems_identified' => 'Dificultades o problemáticas identificadas',
            'recommendations_actions' => 'Recomendaciones y acciones de mejora propuestas por los participantes',
            'comments_analysis' => 'Percepciones/Comentarios/Análisis frente al avance del proceso',
            'development_activity_image' => 'Desarrollo de la visita territorial',
            'evidence_participation_image' => 'Evidencia de participación',
        ];

        return $this->validator($data, $validate, $messages, $attrs);
    }

    public function roles($id)
    {
        if ($id == 0) return null;
        $nac = Nac::find($id);
        $profile = Profile::where('nac_id', $nac->id)->get();

        $rolesId = [];
        foreach ($profile as $key => $value) {
            array_push($rolesId, $value->id);
        }

        $roles = [];
        foreach ($rolesId as $key => $value) {
            $roles_query = Role::where('id', '=', $value)
                ->whereIn('slug', ['monitor_cultural', 'gestores_culturales', 'embajador', 'instructor', 'psicosocial'])
                ->select(['id as value', 'name as label'])->orderBy('id', 'DESC')->get();
            foreach ($roles_query as $role_key => $role) {
                array_push($roles, $role);
            }
        }

        return $roles;
    }

    public function usuarios($id)
    {
        if ($id == 0) return null;
        $rol = Role::find($id);
        $profile = Profile::where('role_id', $rol->id)->get();

        $usuariosId = [];
        foreach ($profile as $key => $value) {
            array_push($usuariosId, $value->user_id);
        }

        $usuarios = [];
        foreach ($usuariosId as $key => $user_id) {
            $users_query = Profile::where('user_id', $user_id)->select(['user_id as value', 'contractor_full_name as label'])->orderBy('id', 'DESC')->get();

            foreach ($users_query as $user_key => $user) {
                array_push($usuarios, $user);
            }
        }

        return $usuarios;
    }
}
