<?php

namespace App\Http\Controllers\v1;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Utilities\Validates\dropDownListsValidates;
use App\Repositories\CulturalRightRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class CulturalRightController extends Controller
{

    private $culturalRightRepository;
    private $dropDownListsValidates;

    function __construct(CulturalRightRepository $culturalRightRepository, dropDownListsValidates $validate)
    {
        $this->culturalRightRepository = $culturalRightRepository;
        $this->dropDownListsValidates = $validate;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/

    /**
     * Muestra todos los datos de derecho cultural de la base de datos (cultural_rights)
     *
     * Este método retorna todos los datos del modelo derecho cultural
     *
     * @access public
     * @param NoRequiereParametros
     * @return culturalRight
     * @author Jean Pool R
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->culturalRightRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar derechos culturales ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Insertar derecho cultural
     *
     * Este método inserta y crea datos que proviene del modelo
     * CulturalRight, actualmente no requiere de una autorización,
     * En su primera versión solo creamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the cultural right
     * @param number $user_id id of the creator user
     * @return culturalRightInsert
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
            $results = $this->culturalRightRepository->create($data);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar derechos culturales ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Consultar derecho cultural por id
     *
     * Este método muestra un derecho cultural, filtrando por su id en el modelo
     * CulturalRight, actualmente no requiere de una autorización,
     * En su primera versión solo visualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the cultural right / url param
     * @return culturalRightShowById
     * @author Jean Pool R
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->culturalRightRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el derecho cultural', 404);
            }
            return $this->createResponse($result, 'El derecho cultural fue encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver el derecho cultural ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar derecho cultural
     *
     * Este método actualiza un derecho cultural, filtrando por su id en el modelo
     * CulturalRight, actualmente no requiere de una autorización,
     * En su primera versión solo actualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the cultural right
     * @param number $user_id id of the creator user
     * @author Jean Pool R
     * @version V1
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $data['user_id'] = Auth::id();
            $validator = $this->dropDownListsValidates->validates($data);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->culturalRightRepository->update($data, $id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar el derecho cultural ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Eliminar derecho cultural
     *
     * Este método elimina un derecho cultural, filtrando por su id en el modelo
     * CulturalRight, actualmente no requiere de una autorización,
     * En su primera versión solo eliminamos la data de manera lógica, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the cultural right / url param
     * @return culturalRightDeleteById
     * @author Jean Pool R
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->culturalRightRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar el derecho cultural ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
