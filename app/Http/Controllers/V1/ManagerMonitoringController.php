<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManagerMonitoring;
use App\Repositories\ManagerMonitoringRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ManagerMonitoringController extends Controller
{
    private $managerMonitoringRepository;
    function __construct(ManagerMonitoringRepository $managerMonitoringRepository)
    {
        $this->managerMonitoringRepository = $managerMonitoringRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->managerMonitoringRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar el seguimientos del gestor cultural ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        try {

            $request['monitor_id'] = $request->user_id;
            unset($request['user_id']);
            $request['user_id'] =  Auth::id();

            $validator = $this->managerMonitoringRepository->getValidate($request->all());

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->managerMonitoringRepository->create($request->all());
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar el seguimientos del gestor cultural ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->managerMonitoringRepository->findById($id);

            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el seguimiento del gestor cultural', 404);
            }
            return $this->createResponse($result, 'El seguimiento del gestor cultural fue encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver el seguimientos del gestor cultural ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $request['monitor_id'] = $request->user_id;
            unset($request['user_id']);
            $request['user_id'] =  Auth::id();

            $validator = $this->managerMonitoringRepository->getValidate($request->all());

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $results = $this->managerMonitoringRepository->update($request->all(), $id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar el seguimientos del gestor cultural ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->managerMonitoringRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar el seguimientos del gestor cultural ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
