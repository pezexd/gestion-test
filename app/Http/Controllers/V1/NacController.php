<?php

namespace App\Http\Controllers\v1;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\Validates\dropDownListsValidates;
use App\Models\Nac;
use App\Repositories\NacRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NacController extends Controller
{
    private $nacRepository;
    private $dropDownListsValidates;

    function __construct(NacRepository $nacRepository, dropDownListsValidates $validate)
    {
        $this->nacRepository = $nacRepository;
        $this->dropDownListsValidates = $validate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Muestra todos los datos de las ubicaciones
     *
     * Este método retorna todos los datos del modelo Nac
     *
     * @access public
     * @param
     * @return Nac
     * @author Jean Pool R
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->nacRepository->getAll();
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar nacs ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Insertar ubicación
     *
     * Este método inserta y crea datos que proviene del modelo
     * Nac, actualmente no requiere de una autorización,
     * En su primera versión solo creamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the nacs
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
            $results = $this->nacRepository->create($data);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al guardar nac ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Consultar ubicación por id
     *
     * Este método muestra una ubicación, filtrando por su id en el modelo
     * Nac, actualmente no requiere de una autorización,
     * En su primera versión solo visualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the nacs / url param
     * @return NacShowById
     * @author Jean Pool R
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->nacRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró el nac', 404);
            }
            return $this->createResponse($result, 'El nac fue encontrado');
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al ver nac ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar ubicación
     *
     * Este método actualiza la ubicación, filtrando por su id en el modelo
     * Nac, actualmente no requiere de una autorización,
     * En su primera versión solo actualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the nacs / url param
     * @param string $name name of the nacs
     * @param number $user_id id of the creator user
     * @return NacUpdateById
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
            $results = $this->nacRepository->update($data, $id);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al actualizar nac ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Eliminar ubicación
     *
     * Este método elimina la ubicación, filtrando por su id en el modelo
     * Nac, actualmente no requiere de una autorización,
     * En su primera versión solo eliminamos la data de manera lógica, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the nacs / url param
     * @return NacDeleteById
     * @author Jean Pool R
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->nacRepository->delete($id);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al eliminar nac ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
