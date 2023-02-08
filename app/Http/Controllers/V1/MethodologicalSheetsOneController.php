<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\MethodologicalSheetsOneRepository;
use Illuminate\Http\Request;

class MethodologicalSheetsOneController extends Controller
{
    private $repository;
    function __construct(MethodologicalSheetsOneRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $results = $this->repository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar las fichas metodológicas de planeación '.$ex->getMessage() .' linea '. $ex->getCode());
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
        try {

            $result = $this->repository->create($request->all());

            return $this->createResponse($result, 'Perfil creado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar la ficha metodológica de planeación '.$ex->getMessage() .' linea '. $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $result = $this->repository->show($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la ficha metodológica de planeación', 202);
            }
            return $this->createResponse($result, 'Perfil encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver la ficha metodológica de planeación '.$ex->getMessage() .' linea '. $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        try {
            $data = $request->all();

            $result = $this->repository->update($data, $id);

            return $this->createResponse($result, 'Ficha metodológica de planeación editado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar la Ficha metodológica de planeación '.$ex->getMessage() .' linea '. $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = $this->repository->delete($id);

            return $this->createResponse($result, 'Ficha metodológica de planeación eliminada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar el perfil '.$ex->getMessage() .' linea '. $ex->getCode());
        }
    }
}
