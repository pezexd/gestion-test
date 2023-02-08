<?php

namespace App\Repositories;

use App\Http\Resources\V1\PsychopedagogicalLogBookCollection;
use App\Http\Resources\V1\PsychopedagogicalLogBookResource;
use App\Models\PsychopedagogicalLogbooks\AddedWizards;
use App\Models\PsychopedagogicalLogbooks\AssistanceMonitors;
use App\Models\PsychopedagogicalLogbooks\PsychopedagogicalLogbook;
use App\Utilities\Resources;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ControlChangeData;
use App\Traits\ImageTrait;
use App\Traits\UserDataTrait;
use App\Traits\FunctionGeneralTrait;

class PsychopedagogicalLogBookRepository
{
    use ImageTrait, UserDataTrait, FunctionGeneralTrait;
    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     * Crear los datos de la tabla principal psychopedagogical_logbook y luego sube sus respectivo archivos
     * se cambian las horas de 2:30 pm a 14:30 pm ya que mysql no acepta el horario am-pm
     * se almace en $save cada accion para garantizar de que las accciones estan correctas (true) de lo contrario (false)
     */
    public function create($request)
    {
        try {
            $user_id = $this->getIdUserAuth();
            $psychopedagogical_logbook = new PsychopedagogicalLogbook();
            $psychopedagogical_logbook->date = $request->date;
            $psychopedagogical_logbook->user_id = $user_id;
            $psychopedagogical_logbook->nac_id = $request->nac_id;
            $psychopedagogical_logbook->start_time = $request->start_time; // Carbon::createFromFormat('g:i A', $request->start_time)->format('H:i');
            $psychopedagogical_logbook->final_time = $request->final_time; // Carbon::createFromFormat('g:i A', $request->final_time)->format('H:i');
            $psychopedagogical_logbook->person_served_name = Resources::getUpperString($request->person_served_name);
            $psychopedagogical_logbook->monitor_id = $request->monitor_id;
            $psychopedagogical_logbook->objective = Resources::getUpperString($request->objective);
            $psychopedagogical_logbook->development = Resources::getUpperString($request->development);
            $psychopedagogical_logbook->referrals = Resources::getUpperString($request->referrals);
            $psychopedagogical_logbook->conclusions_reflections_commitments = Resources::getUpperString($request->conclusions_reflections_commitments);
            $psychopedagogical_logbook->alert_reporting_tracking = Resources::getUpperString($request->alert_reporting_tracking);
            $save = $psychopedagogical_logbook->save();

            if ($save) {
                $base_query = PsychopedagogicalLogbook::query()->withTrashed();
                $consecutive = $base_query->count();
                $update = $base_query->find($psychopedagogical_logbook->id);
                $update->consecutive = 'BTP' . $consecutive;
                $save &= $update->save();

                $handle_1 = $this->send_file($request, 'development_activity_image', 'psychopedagogical_logbook', $psychopedagogical_logbook->id);

                $handle_2 = $this->send_file($request, 'evidence_participation_image', 'psychopedagogical_logbook', $psychopedagogical_logbook->id);

                if ($handle_1['response']['success']) {
                    $psychopedagogical_logbook->update(['development_activity_image' => $handle_1['response']['payload']]);
                }

                if ($handle_2['response']['success']) {
                    $psychopedagogical_logbook->update(['evidence_participation_image' => $handle_2['response']['payload']]);
                }

                $save &= $handle_1['response']['success'];
                $save &= $handle_2['response']['success'];
                $save &= $this->saveWizardsAssistance($request, $psychopedagogical_logbook->id);
                // Guardamos en DataModel
                $this->control_data($psychopedagogical_logbook, 'store');
            }
            return  $this->toBoolean($save) ?
                response()->json(['items' => 'Datos almacenado correctamente', 'success' => true,], Response::HTTP_OK) :
                response()->json(['error' => 'Ocurrio un problema en el almacenamiento', 'success' => false,], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Algo salio mal '.$ex->getMessage().' Linea '.$ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param $request
     * @param int $psychopedagogical_logbook_id
     * @return bool
     * Almacenando datos relacionales de Asistentes Agregados y Asistencia Monitores
     */
    private function saveWizardsAssistance($request, int $psychopedagogical_logbook_id): bool
    {
        try {
            $dencodeWizards = json_decode($request->added_wizards, true);
            $dencodeMonitors = json_decode($request->assistance_monitors, true);
            $psychopedagogical_logbook = PsychopedagogicalLogbook::find($psychopedagogical_logbook_id);
            $psychopedagogical_logbook->addedWizards()->createMany($dencodeWizards);
            // registro de monitores manual
            foreach ($dencodeMonitors as $key => $value) {
                $monitor = new AssistanceMonitors();
                $monitor->psychopedagogical_logbook_id = $psychopedagogical_logbook->id;
                $monitor->monitor_id = $value;
                $monitor->save();
                // Guardamos en DataModel
                $this->control_data($monitor, 'store');
            }
            // $psychopedagogical_logbook->assistanceMonitors()->sync($dencodeMonitors);
            return true;
        } catch (Exception $ex) {
            report($ex);
            echo $ex->getMessage();
            throw $ex;
        }
    }

    /**
     * @param $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * actualiza los datos de PsychopedagogicalLogbook y  sus respectivo archivos
     */
    public function update($request, $id)
    {
        try {
            $psychopedagogical_logbook = PsychopedagogicalLogbook::query()->find($id);
            $psychopedagogical_logbook->date = $request->date;
            $psychopedagogical_logbook->nac_id = $request->nac_id;
            $psychopedagogical_logbook->start_time = $request->start_time; // Carbon::createFromFormat('g:i A', $request->start_time)->format('H:i');
            $psychopedagogical_logbook->final_time = $request->final_time; // Carbon::createFromFormat('g:i A', $request->final_time)->format('H:i');
            $psychopedagogical_logbook->person_served_name = Resources::getUpperString($request->person_served_name);
            $psychopedagogical_logbook->monitor_id = $request->monitor_id;
            $psychopedagogical_logbook->objective = Resources::getUpperString($request->objective);
            $psychopedagogical_logbook->development = Resources::getUpperString($request->development);
            $psychopedagogical_logbook->referrals = Resources::getUpperString($request->referrals);
            $psychopedagogical_logbook->conclusions_reflections_commitments = Resources::getUpperString($request->conclusions_reflections_commitments);
            $psychopedagogical_logbook->alert_reporting_tracking = Resources::getUpperString($request->alert_reporting_tracking);

            if ($psychopedagogical_logbook->status == 'REC') {
                $rol_id = $this->getIdRolUserAuth();
                if ($rol_id == config('roles.psicosocial')) {
                    $psychopedagogical_logbook->status = 'ENREV';
                }
            }

            $save = $psychopedagogical_logbook->save();

            if ($save) {
                if ($request->hasFile('development_activity_image')) {
                    $handle_1 = $this->update_file($request, 'development_activity_image', 'psychopedagogical_logbook', $psychopedagogical_logbook->id, $psychopedagogical_logbook->development_activity_image);

                    if ($handle_1['response']['success']) {
                        $psychopedagogical_logbook->update(['development_activity_image' => $handle_1['response']['payload']]);
                    }
                }

                if ($request->hasFile('evidence_participation_image')) {
                    $handle_2 = $this->update_file($request, 'evidence_participation_image', 'psychopedagogical_logbook', $psychopedagogical_logbook->id, $psychopedagogical_logbook->evidence_participation_image);

                    if ($handle_2['response']['success']) {
                        $psychopedagogical_logbook->update(['evidence_participation_image' => $handle_2['response']['payload']]);
                    }
                }

                // Guardamos en DataModel
                $this->control_data($psychopedagogical_logbook, 'update');

                $save &= $handle_1['response']['success'];
                $save &= $handle_2['response']['success'];
                $save &= $this->updateWizardsAssistance($request, $psychopedagogical_logbook->id);
            }
            return  $this->toBoolean($save) ?
                response()->json(['items' => 'Datos actualizados correctamente', 'success' => true,], Response::HTTP_OK) :
                response()->json(['error' => 'Ocurrio un problema en la actualizacion', 'success' => false,], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Algo salio mal '.$ex->getMessage().' Linea '.$ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);

        }

    }

    /**
     * @param $request
     * @param int $psychopedagogical_logbook_id
     * @return bool
     * se eliminan los datos relacionales de Asistentes Agregados y Asistencia Monitores y se crean los nuevos
     */
    private function updateWizardsAssistance($request, int $psychopedagogical_logbook_id): bool
    {
        try {
            // Buscamos el asistente para luego eliminar en DataModel
            $addedWizards = AddedWizards::where('psychopedagogical_logbook_id', '=', $psychopedagogical_logbook_id)->get();
            AssistanceMonitors::query()->where('psychopedagogical_logbook_id', '=', $psychopedagogical_logbook_id)->delete();
            // Eliminamos DataModel
            ControlChangeData::query()->where('data_model_id', '=', $addedWizards->id)->delete();
            $addedWizards->delete();
            return $this->saveWizardsAssistance($request, $psychopedagogical_logbook_id);
        } catch (Exception $ex) {
            report($ex);
            return false;
        }
    }

    /**
     * @param $id
     * @return false|\Illuminate\Http\JsonResponse
     * elimina datos de PsychopedagogicalLogbook (usa SoftDeletes)
     */
    public function delete($id)
    {
        try {
            $psychopedagogical_logbook = PsychopedagogicalLogbook::query()->find($id)->delete();
            if ($psychopedagogical_logbook) {
                return response()->json(['items' => 'Datos eliminados correctamente', 'success' => true], Response::HTTP_OK);
            } else {
                return response()->json(['error' => 'Error eliminando los datos', 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $ex) {
            report($ex);
            return false;
        }
    }

    /**
     * @param $id
     * @return false|\Illuminate\Http\JsonResponse
     * restaura datos eliminados (usa SoftDeletes)
     */
    public function restore($id)
    {
        try {
            $psychopedagogical_logbook = PsychopedagogicalLogbook::query()->onlyTrashed()->find($id)->restore();
            if ($psychopedagogical_logbook) {
                return response()->json(['items' => 'Datos restaurados correctamente', 'success' => true], Response::HTTP_OK);
            } else {
                return response()->json(['error' => 'Error restaurando los datos', 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $ex) {
            report($ex);
            return false;
        }
    }

    /**
     * @param $id
     * @return ParentSchoolResource|\Illuminate\Http\JsonResponse
     * retorna un PsychopedagogicalLogbook por su id y regresa una url validad par los archivos
     * php artisan storage:link necesario para el url
     */
    public function getById($id)
    {
        try {
            $psychopedagogical_logbook = $this->baseQuery()->find($id);
            return new PsychopedagogicalLogBookResource($psychopedagogical_logbook);
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Algo salio mal '.$ex->getMessage().' Linea '.$ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * Base query para reutilizar
     */
    private function baseQuery()
    {

        $rol_id = $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();
        $query = PsychopedagogicalLogbook::query();
        $psychopedagogicalLogbooks = [];
        if ($rol_id == config('roles.psicosocial')) {

            $psychopedagogicalLogbooks =  $query->where('psychopedagogical_logbooks.user_id', $user_id)->orderBy('id', 'DESC')->get();
        }
        // if ($rol_id == config('roles.gestor')) {

        //     $psychopedagogicalLogbooks =  $query->where('psychopedagogical_logbooks.user_id', $user_id)->orderBy('id', 'DESC')->get();
        // }
        if ($rol_id == config('roles.coordinador_psicosocial')) {

            $psychopedagogicalLogbooks =  $query->where('psychopedagogical_logbooks.user_psychoso_coordinator_id', $user_id)->orderBy('id', 'DESC')->get();
        }

        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
            $psychopedagogicalLogbooks =  $query->orderBy('id', 'DESC')->get();
        }

        return $psychopedagogicalLogbooks;
    }

    /**
     * @return PsychopedagogicalLogBookCollection|\Illuminate\Http\JsonResponse
     * retorna todos los datos de ParentSchool con las url de los archivos
     */
    public function getAll()
    {
        try {
            $data = $this->baseQuery();
            return new PsychopedagogicalLogBookCollection($data);
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Error obteniendo los datos' . ' ' . $ex->getMessage() . ' ' . $ex->getLine(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
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
