<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Utilities\Validates\dropDownListsValidates;
use App\Repositories\GroupRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{

    private $groupRepository;
    private $dropDownListsValidates;

    function __construct(groupRepository $groupRepository, dropDownListsValidates $validate)
    {
        $this->groupRepository = $groupRepository;
        $this->dropDownListsValidates = $validate;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/

    /**
     * Muestra todos los grupos de la base de datos (groups)
     *
     * Este método retorna todos grupos
     *
     * @access public
     * @param NoRequiereParametros
     * @return Group
     * @author Jefri Martínez
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->groupRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar grupos' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Insertar grupo
     *
     * Este método inserta y crea datos que proviene del modelo
     * Group, actualmente no requiere de una autorización,
     * En su primera versión solo creamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the group
     * @return $results
     * @author Jefri Martínez
     * @version V1
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();

            $validator = $this->dropDownListsValidates->validates($data, null);

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->groupRepository->create($data);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar grupo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Consultar grupo por id
     *
     * Este método muestra un grupo, filtrando por su id en el modelo
     * Group, actualmente no requiere de una autorización,
     * En su primera versión solo visualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the group / url param
     * @return GroupShowById
     * @author Jefri Martínez
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->groupRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el grupo', 404);
            }
            return $this->createResponse($result, 'El grupo fue encontrado');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver el grupo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar grupo
     *
     * Este método actualiza un grupo, filtrando por su id en el modelo
     * Group, actualmente no requiere de una autorización,
     * En su primera versión solo actualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the group
     * @author Jefri Martínez
     * @version V1
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $validator = $this->dropDownListsValidates->validates($data, $id);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->groupRepository->update($data, $id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar el grupo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Eliminar grupo
     *
     * Este método elimina un grupo, filtrando por su id en el modelo
     * Group, actualmente no requiere de una autorización,
     * En su primera versión solo eliminamos la data de manera lógica, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the group / url param
     * @return  $results
     * @author Jefri Martínez
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->groupRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar el grupo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }


    public function getGroups()
    {
        try {
            $results = $this->groupRepository->getGroups();
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al cargar los grupos ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
