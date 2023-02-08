<?php

namespace App\Repositories;

use App\Http\Resources\V1\MethodologicalInstructionCollection;
use App\Models\MethodologicalInstructionModel;
use App\Http\Resources\V1\MethodologicalInstructionResource;
use Illuminate\Support\Facades\DB;
use App\Traits\ImageTrait;
use App\Traits\UserDataTrait;
use App\Traits\FunctionGeneralTrait;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class MethodologicalInstructionRepository
{
    use ImageTrait, UserDataTrait, FunctionGeneralTrait;
    private $methodological_instruction;
    function __construct()
    {
        $this->methodological_instruction = new MethodologicalInstructionModel();
    }

    function getAll()
    {
        $rol_id = $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();
        $query = $this->methodological_instruction->query();
        $methodological_instructions = [];

        if ($rol_id == config('roles.gestor')) {
            $methodological_instructions =  $query->orderBy('id', 'DESC')->where('created_by', $user_id)->get();
        }
        if ($rol_id == config('roles.apoyo_metodologico')) {
            $methodological_instructions =  $query->orderBy('id', 'DESC')->where('user_method_support_id', $user_id)->get();
        }

        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
            $methodological_instructions =  $query->orderBy('id', 'DESC')->get();
        }

        return new MethodologicalInstructionCollection($methodological_instructions);
    }

    function create(Request $request)
    {


        try {
            $this->buildModel($request);
            $assistants = json_decode($request->assistants_id, true);
            $this->methodological_instruction->save();
            $this->methodological_instruction->assistants()->attach($assistants);

            if ($request->hasFile('place_file1')) {
                $handle_1 = $this->send_file($request, 'place_file1', 'methodological_instruction', $this->methodological_instruction->id);

                if ($handle_1['response']['success']) {
                    $this->methodological_instruction->update(['place_file1' => $handle_1['response']['payload']]);
                }
            }
            if ($request->hasFile('place_file2')) {
                $handle_2 = $this->send_file($request, 'place_file2', 'methodological_instruction', $this->methodological_instruction->id);

                if ($handle_2['response']['success']) {
                    $this->methodological_instruction->update(['place_file2' => $handle_2['response']['payload']]);
                }
            }

            // Guardamos en ModelData
            $this->control_data($this->methodological_instruction, 'store');

            $result = new MethodologicalInstructionResource($this->methodological_instruction);
            return response()->json(['items' => 'Se ha guardado correctamente', 'success' => true]);
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Algo salio mal '.$ex->getMessage().'Linea '.$ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    function findById($id)
    {
        $mi = $this->methodological_instruction->find($id);
        $mi->assistants;
        return new MethodologicalInstructionResource($mi);
    }

    function update(Request $request, $id)
    {
        try {
            $rol_id = $this->getIdRolUserAuth();
            $user_id = $this->getIdUserAuth();
            if ($rol_id == config('roles.gestor')) {

                $request['status']= 'ENREV';
            }
            $res = $this->buildModel($request, $id);
            $assistants = json_decode($request->assistants_id, true);
            $res->update($request->except(['place_file1', 'place_file2']));
            $res->assistants()->sync($assistants);

            if ($request->hasFile('place_file1')) {
                $handle_1 = $this->update_file($request, 'place_file1', 'methodological_instruction', $res->id, $res->place_file1);

                if ($handle_1['response']['success']) {
                    $res->update(['place_file1' => $handle_1['response']['payload']]);
                }
            }

            if ($request->hasFile('place_file2')) {
                $handle_2 = $this->update_file($request, 'place_file2', 'methodological_instruction', $res->id, $res->place_file2);

                if ($handle_2['response']['success']) {
                    $res->update(['place_file2' => $handle_2['response']['payload']]);
                }
            }

            if ($res->status == 'REC') {
                $rol_id = $this->getIdRolUserAuth();
                if ($rol_id == config('roles.gestor')) {
                    $res->update([
                        'status' => 'ENREV'
                    ]);
                }
            }
            // Guardamos en ModelData
            $this->control_data($res, 'update');

            $result = new MethodologicalInstructionResource($res);
            return response()->json(['items' => 'Se ha guardado correctamente', 'success' => true]);
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Algo salio mal ' . $ex->getMessage() . 'Linea ' . $ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    function delete($id)
    {
        return $this->methodological_instruction->where('id', $id)->delete();
    }

    private function buildModel(Request $request, $id = null)
    {
        if ($id) {
            $res = $this->methodological_instruction->find($id);
            return $res;
        }
        $this->methodological_instruction->place = $request->place;
        $this->methodological_instruction->activity_date = $request->activity_date;
        $this->methodological_instruction->start_time = $request->start_time;
        $this->methodological_instruction->final_hour = $request->final_hour;
        $this->methodological_instruction->expertise_id = $request->expertise_id;
        $this->methodological_instruction->nac_id = $request->nac_id;
        $this->methodological_instruction->created_by = $request->created_by;
        $this->methodological_instruction->consecutive = $request->consecutive;
        $this->methodological_instruction->goals_met = $request->goals_met;
        $this->methodological_instruction->explanation = $request->explanation;
        $this->methodological_instruction->pedagogical_comments = $request->pedagogical_comments;
        $this->methodological_instruction->technical_practical_comments = $request->technical_practical_comments;
        $this->methodological_instruction->methodological_comments = $request->methodological_comments;
        $this->methodological_instruction->others_observations = $request->others_observations;
        return null;
    }

    public function getValidate($data, $method)
    {

        $validate = [
            'place' => 'required|string|max:190',
            'activity_date' => 'required',
            'start_time' => 'required',
            'final_hour' => 'required|after:start_time',
            'expertise_id' => 'required',
            'nac_id' => 'required',
            'goals_met' => 'required',
            'pedagogical_comments' => 'required',
            'technical_practical_comments' => 'required',
            'methodological_comments' => 'required',
            'others_observations' => 'required',
            'place_file1' => $method != 'update' ? 'required|mimes:application/pdf,pdf,png,webp,jpg,jpeg|max:' . (500 * 1049000) : 'bail',
            'place_file2' => $method != 'update' ? 'required|mimes:application/pdf,pdf,png,webp,jpg,jpeg|max:' . (500 * 1049000) : 'bail',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'mimes' => ':attribute debe ser pdf,png,jpg,jpeg.',
            'max' => ':attribute es muy grande.'
        ];

        $attrs = [
            'place' => 'Lugar',
            'activity_date' => 'Fecha actividad',
            'start_time' => 'Fecha inicio',
            'final_hour' => 'Fecha final',
            'expertise_id' => 'Experticia',
            'nac_id' => 'Nac',
            'goals_met' => 'Objetivo',
            'pedagogical_comments' => 'Comentarios pedagógicos',
            'technical_practical_comments' => 'Comentarios técnicos',
            'methodological_comments' => 'comentarios metodológicos',
            'others_observations' => 'Otras observaciones',
            'place_file1' => 'Archivo lugar 1',
            'place_file2' => 'Archivo lugar 2',
        ];

        return $this->validator($data, $validate, $messages, $attrs);
    }
}
