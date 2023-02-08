<?php

namespace App\Http\Controllers\v1;

use App\Http\Utilities\Validates\dropDownListsValidates;
use App\Repositories\EntityNameRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntityNameController extends Controller
{

    private $dropDownListsValidates;
    private $entityNameRepository;

    function __construct(EntityNameRepository $entityNameRepository,dropDownListsValidates $validate)
    {
        $this->entityNameRepository = $entityNameRepository;
        $this->dropDownListsValidates = $validate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Muestra todos los datos de las entidades
     *
     * Este método retorna todos los datos del modelo EntityName
     *
     * @access public
     * @param
     * @return entityName
     * @author Jean Pool R
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->entityNameRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar entidades ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Insertar entidad
     *
     * Este método inserta y crea datos que proviene del modelo
     * EntityName, actualmente no requiere de una autorización,
     * En su primera versión solo creamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the entity
     * @param number $user_id id of the creator user
     * @return EntityNameInsert
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
            $results = $this->entityNameRepository->create($data);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardado entidad ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Consultar entidad por id
     *
     * Este método muestra una entidad, filtrando por su id en el modelo
     * EntityName, actualmente no requiere de una autorización,
     * En su primera versión solo visualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the entity name/ url param
     * @return EntityNameShowById
     * @author Jean Pool R
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->entityNameRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la entidad', 404);
            }
            return $this->createResponse($result, 'La entidad fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver la entidad ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar entidad
     *
     * Este método actualiza la entidad, filtrando por su id en el modelo
     * EntityName, actualmente no requiere de una autorización,
     * En su primera versión solo actualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the entity name/ url param
     * @param string $name name of the entity name
     * @param number $user_id id of the creator user
     * @return EntityNameUpdateById
     * @author Jean Pool R
     * @version V1
     */
    public function update(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $validator = $this->dropDownListsValidates->validates($data);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $results = $this->entityNameRepository->update($data);
            //$results = $this->entityNameRepository->update($data,$id);

        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar la entidad ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Eliminar entidad
     *
     * Este método elimina la entidad, filtrando por su id en el modelo
     * EntityName, actualmente no requiere de una autorización,
     * En su primera versión solo eliminamos la data de manera lógica, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the entity / url param
     * @return EntityNameDeleteById
     * @author Jean Pool R
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->entityNameRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar la entidad ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
