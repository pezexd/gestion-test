<?php

namespace App\Http\Controllers\v1;

use App\Http\Utilities\Validates\dropDownListsValidates;
use App\Repositories\ExpertiseRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ExpertiseController extends Controller
{

    private $expertiseRepository;
    private $dropDownListsValidates;

    function __construct(ExpertiseRepository $expertiseRepository, dropDownListsValidates $validate)
    {
        $this->expertiseRepository = $expertiseRepository;
        $this->dropDownListsValidates = $validate;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Muestra todos los datos de las profesiones
     *
     * Este método retorna todos los datos del modelo Expertise
     *
     * @access public
     * @param
     * @return Expertise
     * @author Jean Pool R
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->expertiseRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar profesión ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Insertar profesión
     *
     * Este método inserta y crea datos que proviene del modelo
     * Expertise, actualmente no requiere de una autorización,
     * En su primera versión solo creamos la data, sin necesidad de autorización
     *
     * @access public
     * @param string $name name of the Expertise
     * @param number $user_id id of the creator user
     * @return ExpertiseInsert
     * @author Jean Pool R
     * @version V1
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $validator =$this->dropDownListsValidates->validates($data);
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->expertiseRepository->create($data);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar la profesión ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Consultar profesión por id
     *
     * Este método muestra una profesión, filtrando por su id en el modelo
     * Expertise, actualmente no requiere de una autorización,
     * En su primera versión solo visualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the expertise / url param
     * @return ExpertiseShowById
     * @author Jean Pool R
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->expertiseRepository->findById($id);

            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la profesión', 404);
            }
            return $this->createResponse($result, 'La profesión fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver la profesión ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar profesión
     *
     * Este método actualiza la profesión, filtrando por su id en el modelo
     * Expertise, actualmente no requiere de una autorización,
     * En su primera versión solo actualizamos la data, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the expertise / url param
     * @param string $name name of the expertise
     * @param number $user_id id of the creator user
     * @return ExpertiseUpdateById
     * @author Jean Pool R
     * @version V1
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $data =$request->all();
            $data['user_id'] =Auth::id();
            $validator = $this->dropDownListsValidates->validates($data);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()
                ], 422);
            }
            $results = $this->expertiseRepository->update($data, $id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar la profesión ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Eliminar profesión
     *
     * Este método elimina la profesión, filtrando por su id en el modelo
     * Expertise, actualmente no requiere de una autorización,
     * En su primera versión solo eliminamos la data de manera lógica, sin necesidad de autorización
     *
     * @access public
     * @param number $id of the expertise / url param
     * @return ExpertiseDeleteById
     * @author Jean Pool R
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->expertiseRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar la profesión ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
