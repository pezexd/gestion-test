<?php

namespace App\Http\Controllers\V1;

use App\Models\BinnacleTerritorie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Repositories\BinnacleTerritorieRepository;

class BinnacleTerritorieController extends Controller
{

    private $binnacleTerritorieRepository;

    function __construct(BinnacleTerritorieRepository $binnacleTerritorie)
    {
        $this->binnacleTerritorieRepository = $binnacleTerritorie;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Gate::authorize('haveaccess');
        try {
            $results = $this->binnacleTerritorieRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar bitácoras' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
        // Gate::authorize('haveaccess');
        try {
            $validator = $this->binnacleTerritorieRepository->getValidate($request->all(), 'create');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->binnacleTerritorieRepository->create($request);

            return $this->createResponse($result, 'Bitácora territorial creada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar bitácora territorial ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
        // Gate::authorize('haveaccess');
        try {
            $result = $this->binnacleTerritorieRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la bitácora territorial', 202);
            }
            return $this->createResponse($result, 'Bitácora territorial encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver bitácora territorial ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
        // Gate::authorize('haveaccess');
        $arr = $request->all();
        try {
            $validator = $this->binnacleTerritorieRepository->getValidate($request->all(), 'update');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->binnacleTerritorieRepository->update($request, $arr, $id);

            return $this->createResponse($result, 'Bitácora editada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar bitácora ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
            $result = $this->binnacleTerritorieRepository->delete($id);

            return $this->createResponse($result, 'Bitácora territorial eliminada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar bitácora territorial ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    // Traemos los roles una vez seleccionado el Nac
    public function getRoles($id){
        // Gate::authorize('haveaccess');
        try {
            $results = $this->binnacleTerritorieRepository->roles($id);
            return $this->createResponse($results, 'Roles encontrados.');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal buscar los roles ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    // Traemos los roles una vez seleccionado el Nac
    public function getUsuarios($id){
        // Gate::authorize('haveaccess');
        try {
            $results = $this->binnacleTerritorieRepository->usuarios($id);
            return $this->createResponse($results, 'Usuarios encontrados.');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal buscar los usuarios ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    // Obtener todos las bitacoras de terrirotio por id de usuario logueado
    public function getAllByUserLogged(Request $request)
    {
        //Gate::authorize('haveaccess');
        try {
            $results = $this->binnacleTerritorieRepository->getAllByUserLogged();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar bitácoras' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

}
