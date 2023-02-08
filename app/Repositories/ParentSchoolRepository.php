<?php

namespace App\Repositories;

use App\Http\Resources\V1\ParentSchoolCollection;
use App\Http\Resources\V1\ParentSchoolMonitorsCollection;
use App\Http\Resources\V1\ParentSchoolMonitorsResource;
use App\Http\Resources\V1\ParentSchoolResource;
use App\Models\Asistant;
use App\Models\ParentSchools\AddedWizards;
use App\Models\ParentSchools\AssistanceMonitors;
use App\Models\ParentSchools\ParentSchool;
use App\Models\User;
use App\Utilities\Resources;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\ImageTrait;
use App\Traits\FunctionGeneralTrait;
use App\Models\ControlChangeData;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\Auth;

class ParentSchoolRepository
{
    use ImageTrait, FunctionGeneralTrait,UserDataTrait;

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     * Crear los datos de la tabla principal ParentSchool y luego sube sus respectivo archivos
     * se cambian las horas de 2:30 pm a 14:30 pm ya que mysql no acepta el horario am-pm
     * se almace en $save cada accion para garantizar de que las accciones estan correctas (true) de lo contrario (false)
     */
    public function createParentSchool($request)
    {
        DB::beginTransaction();
        try {
            $parent_school = new ParentSchool();
            $parent_school->created_by = Auth::id();
            $parent_school->date = $request->date;
            $parent_school->monitor_id = $request->monitor_id;
            $parent_school->consecutive = $request->consecutive;
            $parent_school->start_time = $request->start_time;
            $parent_school->final_time = $request->final_time;
            $parent_school->place_attention = Resources::getUpperString($request->place_attention);
            $parent_school->contact = Resources::getUpperString($request->contact);
            $parent_school->objective = Resources::getUpperString($request->objective);
            $parent_school->development = Resources::getUpperString($request->development);
            $parent_school->conclusions = Resources::getUpperString($request->conclusions);
            $save = $parent_school->save();
            if ($save) {
                if ($request->hasFile('development_activity_image')) {
                    $handle_1 = $this->send_file($request, 'development_activity_image', 'parent_schools', $parent_school->id);
                    if ($handle_1['response']['success']) {
                        $parent_school->update(['development_activity_image' => $handle_1['response']['payload']]);
                    }
                }
                if ($request->hasFile('evidence_participation_image')) {
                    $handle_2 = $this->send_file($request, 'evidence_participation_image', 'parent_schools', $parent_school->id);
                    if ($handle_2['response']['success']) {
                        $parent_school->update(['evidence_participation_image' => $handle_2['response']['payload']]);
                    }
                }
                // $save &= $this->loadFiles($request,$parent_school->id,'development_activity_image');
                // $save &= $this->loadFiles($request,$parent_school->id,'evidence_participation_image');

                // Guardamos en DataModel
                $this->control_data($parent_school, 'store');

                $save_wizards = $this->saveWizardsAssistance($request, $parent_school->id);
                $save &= $save_wizards['bool'];
            }
            // Response::HTTP_ACCEPTED es el codigo 202
            DB::commit();

            if ($this->toBoolean($save)) {
                return response()->json(['items' => 'Datos almacenado correctamente', 'success' => true,]);
            } else {
                return response()->json(['error' => 'Ocurrió un problema en el almacenamiento', 'success' => false,], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $ex) {
            report($ex);
            DB::rollBack();
            return response()->json(['error' => 'Algo salio mal' . $ex->getMessage() . ' Linea ' . $ex->getLine(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param $request
     * @param int $parent_school_id
     * Almacenando datos relacionales de Asistentes Agregados y Asistencia Monitores
     */
    private function saveWizardsAssistance($request, int $parent_school_id)
    {
        DB::beginTransaction();
        try {

            $parent_school = ParentSchool::query()->find($parent_school_id);
            // guardar info para added_wizards
            $added_wizards = json_decode($request->added_wizards, true);


            if (count($added_wizards) > 0) {

                foreach ($added_wizards as $value) {
                    $added_wizard = new AddedWizards();
                    $added_wizard->parent_school_id = $parent_school->id;
                    $assistant  = Asistant::where('assistant_document_number', $value['assistant_document_number'])->first();
                    if (!$assistant) {
                        $newAssistant =  new Asistant();
                        $newAssistant->assistant_name = $value['assistant_name'];
                        $newAssistant->assistant_document_number = $value['assistant_document_number'];
                        $newAssistant->assistant_position = $value['assistant_position'];
                        $newAssistant->nac_id = $value['nac_id'];
                        $newAssistant->assistant_phone = $value['assistant_phone'];
                        if (isset($value['assistant_email'])) {
                            if ($value['assistant_email'] != NULL || $value['assistant_email'] != '') {
                                $newAssistant->assistant_email = $value['assistant_email'];
                            }
                        }
                        $newAssistant->save();
                        $this->control_data($newAssistant, 'store');
                        $added_wizard->assistant_id =  $newAssistant->id;
                        $added_wizard->save();
                        $this->control_data($added_wizard, 'store');
                    } else {
                        $added_wizard->assistant_id =  $assistant->id;
                        $added_wizard->save();
                        $this->control_data($added_wizard, 'store');
                    }

                    // Guardamos en ModelData

                }
            }
            // guardar info para added_wizards
            $asis_monitors = json_decode($request->assistance_monitors, true);
            if (count($asis_monitors) > 0) {
                foreach ($asis_monitors as $key => $value) {
                    $asis_monitor = new AssistanceMonitors();
                    $asis_monitor->parent_school_id = $parent_school->id;
                    $asis_monitor->monitor_id = $value;
                    $asis_monitor->save();
                }
            }
            DB::commit();
            return ['bool' => true, 'message' => 'Asistentes guardados...'];
        } catch (Exception $ex) {
            // echo $ex->getMessage();
            report($ex);
            DB::rollBack();
            return ['bool' => false, 'error' => $ex->getMessage()];
        }
    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * actualiza los datos de ParentSchool y  sus respectivo archivos
     */
    public function updateParentSchool($request, $id)
    {
        DB::beginTransaction();
        try {

            $parent_school = ParentSchool::query()->find($id);
            // if ($parent_school->status == 'REC'){
            //     $parent_school->status = 'ENREV';
            // }
            $parent_school->date = $request->date;
            $parent_school->monitor_id = $request->monitor_id;
            $parent_school->start_time = $request->start_time;
            $parent_school->final_time = $request->final_time;
            $parent_school->place_attention = Resources::getUpperString($request->place_attention);
            $parent_school->contact = Resources::getUpperString($request->contact);
            $parent_school->objective = Resources::getUpperString($request->objective);
            $parent_school->development = Resources::getUpperString($request->development);
            $parent_school->conclusions = Resources::getUpperString($request->conclusions);

            if ($parent_school->status == 'REC') {
                $rol_id = $this->getIdRolUserAuth();
                if ($rol_id == config('roles.psicosocial')) {
                    $parent_school->status = 'ENREV';
                }
            }

            $save = $parent_school->save();

            $url_1 = $parent_school->value('development_activity_image');
            $url_2 = $parent_school->value('evidence_participation_image');

            if ($save) {
                if ($request->hasFile('development_activity_image')) {
                    $handle_1 = $this->update_file($request, 'development_activity_image', 'parent_schools', $parent_school->id, $url_1);

                    if ($handle_1['response']['success']) {
                        $parent_school->update(['development_activity_image' => $handle_1['response']['payload']]);
                    }
                }

                if ($request->hasFile('evidence_participation_image')) {
                    $handle_2 = $this->update_file($request, 'evidence_participation_image', 'parent_schools', $parent_school->id, $url_2);

                    if ($handle_2['response']['success']) {
                        $parent_school->update(['evidence_participation_image' => $handle_2['response']['payload']]);
                    }
                }
                // $save &= $this->updateFiles($request,$parent_school->id,'development_activity_image');
                // $save &= $this->updateFiles($request,$parent_school->id,'evidence_participation_image');
                $update_wizards = $this->updateWizardsAssistance($request, $parent_school->id);
                $save &= $update_wizards['bool'];

                // Guardamos en DataModel

            }
            /*if ($this->toBoolean($save)) {
                return response()->json(['message' => 'Datos actualizados correctamente', 'success' => true,]);
            } else {
                $msg = $update_wizards['message'];

                if (strpos($msg, 'Data too long')) {
                    if (strpos($msg, 'assistant_phone')) {
                        return response()->json(['message' => 'El numero de teléfono para un asistente debe contener un máximo de 11 caracteres.', 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {
                    return response()->json(['message' => $msg, 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
                // response()->json(['message' => $update_wizards['message'], 'success' => false,], Response::HTTP_INTERNAL_SERVER_ERROR);
            }*/

            DB::commit();
            return response()->json(['items' => 'Se ha guardado correctamente', 'success' => true]);
        } catch (\Exception $ex) {
            return 0;
            report($ex);
            DB::rollBack();
            return response()->json(['error' => 'Algo salio mal ' . $ex->getMessage() . 'Linea ' . $ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param $request
     * @param int $parent_school_id
     * @return bool
     * se eliminan los datos relacionales de Asistentes Agregados y Asistencia Monitores y se crean los nuevos
     */
    private function updateWizardsAssistance($request, int $parent_school_id)
    {
        DB::beginTransaction();
        try {
            // Traemos los asistentes
            $addedWizards = AddedWizards::where('parent_school_id', '=', $parent_school_id)->get();
            foreach ($addedWizards as $key => $value) {
                ControlChangeData::query()->where('data_model_id', '=', $value->id)->where('data_model_type', $value->getMorphClass())->delete();

                $value->delete();
            }

            $assistantMonitors = AssistanceMonitors::query()->where('parent_school_id', '=', $parent_school_id)->get();
            foreach ($assistantMonitors  as $key => $value) {
                ControlChangeData::query()->where('data_model_id', '=', $value->id)->where('data_model_type', $value->getMorphClass())->delete();
                $value->delete();
            }

            // Elimnamos de data model
            //
            // Finalmente tambien eliminamos el asistente


            DB::commit();
            return $this->saveWizardsAssistance($request, $parent_school_id);
        } catch (Exception $exception) {
            report($exception);
            DB::rollBack();
            return ['bool' => false, 'message' => '???'];
        }
    }

    /**
     * @param $id
     * @return false|\Illuminate\Http\JsonResponse
     * elimina datos de ParentSchool (usa SoftDeletes)
     */
    public function deleteParentSchool($id)
    {
        try {
            $parent_school = ParentSchool::query()->find($id)->delete();
            if ($parent_school) {
                return response()->json(['message' => 'Datos eliminados correctamente', 'success' => true]);
            } else {
                return response()->json(['message' => 'Error eliminando los datos', 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * @param $id
     * @return false|\Illuminate\Http\JsonResponse
     * restaura datos eliminados (usa SoftDeletes)
     */
    public function restoreParentSchool($id)
    {
        try {
            $parent_school = ParentSchool::query()->onlyTrashed()->find($id)->restore();
            if ($parent_school) {
                return response()->json(['items' => 'Datos restaurados correctamente', 'success' => true]);
            } else {
                return response()->json(['error' => 'Error restaurando los datos', 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $exception) {
            report($exception);
            return false;
        }
    }

    /**
     * @param $id
     * @return ParentSchoolResource|\Illuminate\Http\JsonResponse
     * retorna un ParentSchool por su id y regresa una url validad par los archivos
     * php artisan storage:link necesario para el url
     */
    public function getParentSchoolById($id)
    {
        try {
            $parent_school = $this->baseQuery()->find($id);
            return  $parent_school;
            // return new ParentSchoolResource($parent_school);
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Algo salio mal' . $ex->getMessage() . ' Linea ' . $ex->getLine(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * Base query para reutilizar
     */
    private function baseQuery()
    {
        return ParentSchool::query()
        ->with([
            'monitor:id,name,profile_photo_path,email',
            'addedWizards.assistant:id,assistant_name,assistant_document_number,assistant_position,assistant_phone,assistant_email',
            'addedWizards.assistant.nac:id,name',
            'assistanceMonitors',
            'assistanceMonitors.monitor:id,name,profile_photo_path,email'
        ]);
    }
    //,nac
    /**
     * @return ParentSchoolCollection|\Illuminate\Http\JsonResponse
     * retorna todos los datos de ParentSchool con las url de los archivos
     */
    public function getAll()
    {
        try {
            $user_id = Auth::id();
            $rol_id = Auth::user()->profile->role->id;
            $query = ParentSchool::query();
            $results = [];

            if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
                $results = $query->orderBy('id', 'DESC')->get();
            }
            if ($rol_id == config('roles.psicosocial')) {
                $results = $query->orderBy('id', 'DESC')->where('created_by', $user_id)->get();
            }
            if ($rol_id == config('roles.coordinador_psicosocial')) {
                $results = $query->orderBy('id', 'DESC')->where('user_psychoso_coordinator_id', $user_id)->get();
            }

            // return $data;
            return $results;
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Algo salio mal' . $ex . ' Linea ' . $ex->getLine(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @return
     * retorna un listado de monitores
     */
    public function getMonitors()
    {
        try {
            $monitors = User::query()->whereHas('roles', function (Builder $query) {
                $query->whereIn('slug', ['monitor', 'embajador', 'instructor']);
            })->select(['id', 'name'])->orderBy('id', 'DESC')->get();
            return  new ParentSchoolMonitorsCollection($monitors);
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Algo salio mal' . $ex->getMessage() . ' Linea ' . $ex->getLine(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Convert to boolean
     *
     * @param $booleable
     * @return boolean
     */
    private function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
