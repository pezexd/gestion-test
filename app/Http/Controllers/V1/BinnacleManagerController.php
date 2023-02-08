<?php

namespace App\Http\Controllers\V1;

use App\Models\Binnacle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BinnacleManagerRepository;
use Illuminate\Support\Facades\Gate;

class BinnacleManagerController extends Controller
{
    private $binnacleManagerRepository;

    function __construct(BinnacleManagerRepository $binnacleManagerRepository)
    {
        $this->binnacleManagerRepository = $binnacleManagerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Muestra todos los datos de las bitácoras
     *
     * Este método retorna todos los datos del modelo Binnacle
     *
     * @access public
     * @return Binnnacle
     * @author Gabriel Murillo
     * @version V1
     */
    public function index(Request $request)
    {

        Gate::authorize('haveaccess');
        try {
            $results = $this->binnacleManagerRepository->getAll();
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

    /**
     * Registro de una Bitácora
     *
     * Este método inserta y crea datos que proviene del modelo
     * Binnacle, actualmente no requiere de una autorización,
     * En su primera versión solo creamos la data, sin necesidad de autorización
     *
     * @access public
     * @author Gabriel Murillo
     * @version V1
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $validator = $this->binnacleManagerRepository->getValidate($request->all(), $request->created_from, 'create');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $result = $this->binnacleManagerRepository->create($request);

            return $this->createResponse($result, 'Bitácora creada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar bitácora ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Consultar bitácora por id
     *
     * Este método muestra una bitácora, filtrando por su id en el modelo
     * Binnacle, actualmente no requiere de una autorización,
     * En su primera versión solo visualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the binnacle / url param
     * @return Binnacle
     * @author Gabriel Murillo
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->binnacleManagerRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró bitácora', 202);
            }
            return $this->createResponse($result, 'Bitácora encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver bitácora ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar bitácora
     *
     * Este método actualiza la bitácora, filtrando por su id en el modelo
     * Binnacle, actualmente no requiere de una autorización,
     * En su primera versión solo actualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the binnalce / url param
     * @return Binnacle
     * @author Gabriel Murillo
     * @version V1
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        $arr = $request->all();
        try {
            $validator = $this->binnacleManagerRepository->getValidate($request->all(), $request->updated_from, 'update');

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->binnacleManagerRepository->update($request, $arr, $id);

            return $this->createResponse($result, 'Bitácora editada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar bitácora ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Eliminar bitácora
     *
     * Este método elimina la bitácora, filtrando por su id en el modelo
     * Binnacle, actualmente no requiere de una autorización,
     * En su primera versión solo eliminamos la data de manera lógica, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the binnacle / url param
     * @author Jean Pool R
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->binnacleManagerRepository->delete($id);

            return $this->createResponse($result, 'Bitácora eliminada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar bitácora ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
