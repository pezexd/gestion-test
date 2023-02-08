<?php

namespace App\Repositories;

use App\Models\Poll;
use App\Http\Resources\V1\PollResource;
use App\Http\Resources\V1\PollCollection;
use App\Models\Neighborhood;
use App\Traits\UserDataTrait;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;



class PollRepository
{
    use UserDataTrait,FunctionGeneralTrait;
    public function getAll()
    {
        $result = Poll::query();
        $polls = [];
        $rol_id =Auth::user()->profile->role->id;
        if($rol_id == config('roles.root') || $rol_id == config('roles.super_root')){
            $polls =  $result->orderBy('id', 'DESC')->get();
        }else{

            $polls= $result->where('user_id',Auth::id())->orderBy('id', 'DESC')->get();
        }

        return  new PollCollection($polls);
    }

    public function create($request)
    {
        $data = $request->all();
        $data['receives_therapy'] =strval($data['receives_therapy']);

        // return 0;
        $poll = Poll::create($data);
        // Guardamos en ModelData
        $this->control_data($poll, 'store');
        //
        if ($request->other_neighborhoods != "" || $request->other_neighborhoods != null) {
           $neighborhood = Neighborhood::where('name','LIKE',"%{$request->other_neighborhoods}%")->first();
           if(!$neighborhood && $poll){
            $neighborhood_new = new Neighborhood;
            $neighborhood_new->name = $request->other_neighborhoods;
            $neighborhood_new->user_id = Auth::id();
            $neighborhood_new->save();
            // Guardamos en ModelData
            $this->control_data($neighborhood_new, 'store');
           }

        }
        $results = new PollResource($poll);
        return $results;
    }

    public function findById($id)
    {
        $poll = Poll::findOrFail($id);
        $result = new PollResource($poll);
        return $result;
    }

    public function update($data, $id)
    {
        $poll = Poll::findOrFail($id);
        $poll->update($data);
        // Guardamos en ModelData
        $this->control_data($poll, 'update');
        $result = new PollRepository($poll);
        return $result;
    }

    public function delete($id)
    {
        $poll = Poll::findOrFail($id);
        $poll->delete();

        return response()->json(['message' => 'Se ha eliminado correctamente']);
    }
    public function getValidate($data){

        $validate = [
            'age'=> 'required|integer',
            'birth_date'=> 'required|date',
            'neighborhood_id'=> 'required',
            'phone'=> 'required',
            'email'=> 'required|email',
            'number_children'=> 'required|integer',
            // 'dependents'=> 'required|integer',
            'victim_armed_conflict'=> 'required',
            'study'=> 'required',
            'medical_service'=> 'required',
            'takes_medication'=> 'required',
            'suffers_disease'=> 'required',
            'disability'=> 'required',
            'assessed_disability'=> 'required',
            'receives_therapy'=> 'required',
            'expertises'=> 'required',
            'artistic_experience'=> 'required',
            'artistic_group'=> 'required',
            'user_id'=> 'required',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'mimes' => ':attribute debe ser pdf,png,jpg,jpeg.',
            'max' => ':attribute es muy grande.',
            'unique' => 'Ya existe un modulo con este :attribute.',
        ];

        $attrs = [
            'age'=> 'Edad',
            'birth_date'=> 'Fecha de cumpleaños',
            'neighborhood_id'=> 'Barrio',
            'phone'=> 'Telefono',
            'email'=> 'Correo',
            'number_children'=> 'Numeros de niños',
            'dependents'=> 'Dependientes',
            'victim_armed_conflict'=> 'Victima del conflicto armado',
            'study'=> 'Estudiante',
            'medical_service'=> 'Servicios medicos',
            'takes_medication'=> 'Toma medicacion',
            'suffers_disease'=> 'Sufre alguna enfermedad',
            'disability'=> 'Discapacidad',
            'assessed_disability'=> 'Discapacidad evaluada',
            'receives_therapy'=> 'Recibe terapia',
            'expertises'=> 'Expertises',
            'artistic_experience'=> 'Experiencia artistica',
            'artistic_group'=> 'Grupo artistico',
            'user_id'=> 'Usuario',
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }
}
