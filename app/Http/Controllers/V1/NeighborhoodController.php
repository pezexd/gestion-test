<?php

namespace App\Http\Controllers\v1;

use App\Http\Utilities\Validates\dropDownListsValidates;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\NeighborhoodRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NeighborhoodController extends Controller
{
    private $neighborhoodRepository;
    private $dropDownListsValidates;

    function __construct(NeighborhoodRepository $neighborhoodRepository, dropDownListsValidates $validate)
    {
        $this->neighborhoodRepository = $neighborhoodRepository;
        $this->dropDownListsValidates = $validate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Muestra todos los datos de los barrios
     *
     * Este método retorna todos los datos del modelo Neighborhood
     *
     * @access public
     * @param
     * @return Neighborhood
     * @author Jean Pool R
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->neighborhoodRepository->getAll();
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar barrio ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results->toArray($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Insertar barrio
     *
     * Este método inserta y crea datos que proviene del modelo
     * Neighborhood, actualmente no requiere de una autorización,
     * En su primera versión solo creamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the neighborhood
     * @param number $user_id id of the creator user
     * @return NacInsert
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
            $results = $this->neighborhoodRepository->create($data);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar barrio ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Consultar barrio por id
     *
     * Este método muestra un barrio, filtrando por su id en el modelo
     * Neighborhood, actualmente no requiere de una autorización,
     * En su primera versión solo visualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the neighborhood / url param
     * @return NeighborhoodShowById
     * @author Jean Pool R
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->neighborhoodRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el barrio', 404);
            }
            return $this->createResponse($result, 'El barrio fue encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver barrio ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar barrio
     *
     * Este método actualiza el barrio, filtrando por su id en el modelo
     * Neighborhood, actualmente no requiere de una autorización,
     * En su primera versión solo actualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the neighborhood / url param
     * @param string $name name of the neighborhood
     * @param number $user_id id of the creator user
     * @return NeighborhoodUpdateById
     * @author Jean Pool R
     * @version V1
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $validateor = $this->dropDownListsValidates->validates($data);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->neighborhoodRepository->update($data, $id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver barrio ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Eliminar barrio
     *
     * Este método elimina la barrio, filtrando por su id en el modelo
     * Neighborhood, actualmente no requiere de una autorización,
     * En su primera versión solo eliminamos la data de manera lógica, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the neighborhood / url param
     * @return NeighborhoodDeleteById
     * @author Jean Pool R
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->neighborhoodRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar barrio ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
