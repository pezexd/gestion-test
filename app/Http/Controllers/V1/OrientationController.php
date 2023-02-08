<?php

namespace App\Http\Controllers\v1;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Utilities\Validates\dropDownListsValidates;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrientationRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrientationController extends Controller
{
    private $orientationRepository;
    private $dropDownListsValidates;

    function __construct(OrientationRepository $orientationRepository, dropDownListsValidates $validate)
    {
        $this->orientationRepository = $orientationRepository;
        $this->dropDownListsValidates = $validate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Muestra todos los datos de las orientaciones
     *
     * Este método retorna todos los datos del modelo Orientation
     *
     * @access public
     * @param
     * @return Orientation
     * @author Jean Pool R
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->orientationRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar orientaciones ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Insertar orientación
     *
     * Este método inserta y crea datos que proviene del modelo
     * Orientation, actualmente no requiere de una autorización,
     * En su primera versión solo creamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the orientation
     * @param number $user_id id of the creator user
     * @return OrientationInsert
     * @author Jean Pool R
     * @version V1
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $validator = $this->dropDownListsValidates->validates($data);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->orientationRepository->create($data);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar orientación ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Consultar orientación por id
     *
     * Este método muestra una orientación, filtrando por su id en el modelo
     * Orientation, actualmente no requiere de una autorización,
     * En su primera versión solo visualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the orientation / url param
     * @return OrientationShowById
     * @author Jean Pool R
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->orientationRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la orientación', 404);
            }
            return $this->createResponse($result, 'La orientación fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver orientación ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar orientación
     *
     * Este método actualiza la orientación, filtrando por su id en el modelo
     * Orientation, actualmente no requiere de una autorización,
     * En su primera versión solo actualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the orientation / url param
     * @param string $name name of the orientation
     * @param number $user_id id of the creator user
     * @return OrientationUpdateById
     * @author Jean Pool R
     * @version V1
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $validator = $this->dropDownListsValidates->validates($data);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->orientationRepository->update($data, $id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar orientación ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Eliminar orientación
     *
     * Este método elimina la orientación, filtrando por su id en el modelo
     * Orientation, actualmente no requiere de una autorización,
     * En su primera versión solo eliminamos la data de manera lógica, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the orientation / url param
     * @return OrientationDeleteById
     * @author Jean Pool R
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->orientationRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar orientación ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
