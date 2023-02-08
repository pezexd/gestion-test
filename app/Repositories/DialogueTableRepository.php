<?php

namespace App\Repositories;

use App\Http\Resources\V1\DialogueTableCollection;
use App\Http\Resources\V1\DialogueTableResource;
use App\Models\Asistant;
use Illuminate\Http\Request;
use App\Models\DialogueTables\AsistantDialogueTable;
use App\Models\DialogueTables\DialogueTable;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ImageTrait;
use App\Traits\UserDataTrait;
use App\Traits\FunctionGeneralTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class DialogueTableRepository
{
    use ImageTrait, UserDataTrait, FunctionGeneralTrait;
    private $model;

    function __construct()
    {
        $this->model = new DialogueTable();
    }

    public function getAll()
    {
        $rol_id  =  $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();
        $query   =   $this->model->query();

        $dialogueTables = [];
        if ($rol_id == config('roles.gestor')) {
            $dialogueTables =  $query->orderBy('id', 'DESC')->where('user_id', $user_id)->get();
        }
        if ($rol_id == config('roles.apoyo_metodologico')) {
            $dialogueTables =  $query->orderBy('id', 'DESC')->where('user_method_support_id', $user_id)->get();
        }

        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
            $dialogueTables =  $query->orderBy('id', 'DESC')->get();
        }

        $results = new DialogueTableCollection($dialogueTables);
        return $results;
    }
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $dialogueTable = DialogueTable::create($request->all());

            $assistants = json_decode($request->asistents, true);

            foreach ($assistants as $key => $value) {
                $assistent = new Asistant();
                $assistent->assistant_name = $value['assistant_name'];
                $assistent->assistant_document_number = $value['assistant_document_number'];
                $assistent->assistant_position = $value['assistant_position'];
                $assistent->nac_id = $value['nac_id'];
                $assistent->assistant_phone = $value['assistant_phone'];
                if ($value['assistant_email'] ?? NULL) {
                    $assistent->assistant_email = $value['assistant_email'];
                } else {
                    $assistent->assistant_email = NULL;
                }
                $assistent->save();

                // Guardamos en DataModel
                $this->control_data($assistent, 'store');

                $assistentDialogueTable = new AsistantDialogueTable();
                $assistentDialogueTable->dialogue_table_id = $dialogueTable->id;
                $assistentDialogueTable->assistant_id = $assistent->id;
                $assistentDialogueTable->save();

                // Guardamos en DataModel
                // $this->control_data($assistentDialogueTable, 'store');
            }

            if ($request->hasFile('place_image1')) {
                $handle_1 = (new DialogueTableRepository)->send_file($request, 'place_image1', 'dialogue_tables', $dialogueTable->id);
                if ($handle_1['response']['success']) {
                    $dialogueTable->update(['place_image1' => $handle_1['response']['payload']]);
                }
            }

            if ($request->hasFile('place_image2')) {
                $handle_2 = (new DialogueTableRepository)->send_file($request, 'place_image2', 'dialogue_tables', $dialogueTable->id);
                if ($handle_2['response']['success']) {
                    $dialogueTable->update(['place_image2' => $handle_2['response']['payload']]);
                }
            }

            // Guardamos en DataModel
            $this->control_data($dialogueTable, 'store');

            $result = new DialogueTableResource($dialogueTable);
            DB::commit();
            return $result;
        } catch (Exception $ex) {

            report($ex);
            DB::rollBack();
            return response()->json(['error' => 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($id)
    {
        $dialogueTable = DialogueTable::findOrFail($id);
        $result = new DialogueTableResource($dialogueTable);
        return $result;
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $dialogueTable = DialogueTable::findOrFail($id);
            $rol_id  =  $this->getIdRolUserAuth();
            if ($rol_id == config('roles.gestor')) {
                $request['status']= 'ENREV';
            }
            $dialogueTable->update($request->all());

            $url_1 = $dialogueTable->value('place_image1');
            $url_2 = $dialogueTable->value('place_image2');

            if ($request->hasFile('place_image1')) {
                $handle_1 = (new DialogueTableRepository)->update_file($request, 'place_image1', 'dialogue_tables', $dialogueTable->id, $url_1);

                if ($handle_1['response']['success']) {
                    $dialogueTable->update(['place_image1' => $handle_1['response']['payload']]);
                }
            }

            if ($request->hasFile('place_image2')) {
                $handle_2 = (new DialogueTableRepository)->update_file($request, 'place_image2', 'dialogue_tables', $dialogueTable->id, $url_2);

                if ($handle_2['response']['success']) {
                    $dialogueTable->update(['place_image2' => $handle_2['response']['payload']]);
                }
            }

            // Guardamos en DataModel
            $this->control_data($dialogueTable, 'update');

            $assistants = json_decode($request->asistents, true);

            AsistantDialogueTable::query()->where('dialogue_table_id', '=', $dialogueTable->id)->delete();
            foreach ($assistants as $value) {

                $assistent = Asistant::where('assistant_document_number', $value['assistant_document_number'])->first();

                if (!$assistent) {

                    $assistentNew = new Asistant();
                    $assistentNew->assistant_name = $value['assistant_name'];
                    $assistentNew->assistant_document_number = $value['assistant_document_number'];
                    $assistentNew->assistant_position = $value['assistant_position'];
                    $assistentNew->nac_id = $value['nac_id'];
                    $assistentNew->assistant_phone = $value['assistant_phone'];
                    $assistentNew->assistant_email = $value['assistant_email'];
                    $assistentNew->save();

                    // Guardamos en DataModel
                    $this->control_data($assistentNew, 'store');

                    $assistentDialogueTable = new AsistantDialogueTable();
                    $assistentDialogueTable->dialogue_table_id = $dialogueTable->id;
                    $assistentDialogueTable->assistant_id = $assistentNew->id;
                    $assistentDialogueTable->save();

                    // Guardamos en DataModel
                    // $this->control_data($assistentDialogueTable, 'store');

                } else {
                    $assistentDialogueTable = new AsistantDialogueTable();
                    $assistentDialogueTable->dialogue_table_id = $dialogueTable->id;
                    $assistentDialogueTable->assistant_id =  $assistent->id;
                    $assistentDialogueTable->save();

                    // Guardamos en DataModel
                    // $this->control_data($assistentDialogueTable, 'store');
                }
            }
            if ($dialogueTable->status == 'REC') {
                $rol_id = $this->getIdRolUserAuth();
                if ($rol_id == config('roles.gestor')) {
                    $dialogueTable->update([
                        'status' => 'ENREV'
                    ]);
                }
            }
            $result = new DialogueTableResource($dialogueTable);
            DB::commit();
            return  $result;
        } catch (Exception $ex) {
            report($ex);
            DB::rollBack();
            return response()->json(['error' => 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        $dialogueTable = DialogueTable::findOrFail($id);
        $dialogueTable->delete();

        return response()->json(['items' => 'Se ha eliminado correctamente']);
    }

    public function getValidate($data, $method)
    {
        $validate = [
            'activity_date' => 'required',
            'start_time' => 'required',
            'final_hour' => 'required|after:start_time',
            'nac_id' => 'required',
            'target_workday' => 'required',
            'theme' => 'required',
            'schedule_day' => 'required',
            'workday_description' => 'required',
            'achievements_difficulties' => 'required',
            'alerts' => 'required',
            'asistents' => 'required',
            'place_image1' => $method != 'update' ? 'required|mimes:application/pdf,pdf,png,webp,jpg,jpeg|max:' . (500 * 1049000) : 'bail',
            'place_image2' => $method != 'update' ? 'required|mimes:application/pdf,pdf,png,webp,jpg,jpeg|max:' . (500 * 1049000) : 'bail',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'unique' => 'Ya existe un asistente con este :attribute.',
        ];

        $attrs = [
            'activity_date' => 'Fecha de actividad',
            'start_time' => 'Hora inicio',
            'final_hour' => 'Hora final',
            'nac_id' => 'Nac',
            'target_workday' => 'Objetivo de jornada',
            'theme' => 'Tema',
            'schedule_day' => 'Horario día',
            'workday_description' => 'Descripcion dia de trabajo',
            'achievements_difficulties' => 'Logros o dificultades',
            'alerts' => 'Alertas',
            'asistents' => 'Asistentes',
            'place_image1' => 'Imagen lugar 1',
            'place_image2' => 'Imagen lugar 2',
        ];

        return $this->validator($data, $validate, $messages, $attrs);
    }
}
