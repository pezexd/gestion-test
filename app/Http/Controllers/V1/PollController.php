<?php

namespace App\Http\Controllers\V1;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Utilities\Validates\pollsListValidates;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PollRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PollController extends Controller
{
    private $pollRepository;
    function __construct(PollRepository $pollRepository)
    {
        $this->pollRepository = $pollRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Muestra todos los datos de las encuestas de la tabla 'polls'
     *
     *
     * Este metodo retorna todos los datos del modelo Encuesta llamado Poll
     * @access public
     * @param NoRequiereParametros
     * @return poll
     * @author Steven Manyoma
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->pollRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar encuestas ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * Guardar encuesta
     *
     * En este metodo se crea una nueva encuesta y nueva instancia del modelo Poll
     * @access public
     * @return pollInsert
     * @author Steven Manyoma
     * @version V1

     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $request['user_id'] = Auth::id();
            $validator = $this->pollRepository->getValidate($request->all());
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->pollRepository->create($request);
            return response()->json(['message' => 'Encuesta creada exitosamente', 'response' => true]);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar encuesta ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * Consulta y muestra la encuesta por el id
     *
     * Este metodo muestra todos los datos almacenados de la encuesta con determinado Id
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->pollRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la encuesta', 404);
            }
            return $this->createResponse($result, 'La encuesta fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver encuesta ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Actualizar datos de encuesta
     *
     * Este metodo actualiza  la encuesta
     *
     * @access public
     * @param number $id of the poll / url param
     * @return PollUpdateById
     * @author Steven Manyoma
     * @version V1
     *
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $request['user_id'] = Auth::id();
            $validator = $this->pollRepository->getValidate($request->all());
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $result = $this->pollRepository->update($request->all(), $id);
            return $this->createResponse($result, 'Se actualizo correctamente');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar encuesta ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Eliminar encuesta
     *
     *Este metodo elimina una encuesta seleccionada filtrada por su id en el modelo Poll
     *@access public
     *@param number $id of the poll / url param
     *@return Poll
     *@author Steven Manyoma Rosero
     *@version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->pollRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar encuesta ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
