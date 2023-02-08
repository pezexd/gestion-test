<?php

namespace App\Http\Controllers\V1;

use App\Models\MonthlyMonitoringReports;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Repositories\MonthlyMonitoringReportsRepository;

class MonthlyMonitoringReportsController extends Controller
{

    private $monthly_monitoring_repository;

    function __construct(MonthlyMonitoringReportsRepository $monthly_monitoring)
    {
        $this->monthly_monitoring_repository = $monthly_monitoring;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Gate::authorize('haveaccess');
        try {
            $results = $this->monthly_monitoring_repository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar Reportes' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Gate::authorize('haveaccess');
        try {
            $validator = $this->monthly_monitoring_repository->getValidate($request->all(), 'create');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->monthly_monitoring_repository->create($request);

            return $this->createResponse($result, 'Reporte creado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar el informe' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BinnacleTerritorie  $binnacleTerritorie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Gate::authorize('haveaccess');
        try {
            $result = $this->monthly_monitoring_repository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el informe', 202);
            }
            return $this->createResponse($result, 'Reporte encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver el informe' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BinnacleTerritorie  $binnacleTerritorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Gate::authorize('haveaccess');
        $arr = $request->all();
        try {
            $validator = $this->monthly_monitoring_repository->getValidate($request->all(), 'update');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->monthly_monitoring_repository->update($request, $arr, $id);

            return $this->createResponse($result, 'Reporte editado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar el informe' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BinnacleTerritorie  $binnacleTerritorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->monthly_monitoring_repository->delete($id);

            return $this->createResponse($result, 'Reporte eliminado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar el informe' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
