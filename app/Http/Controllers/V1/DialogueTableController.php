<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\DialogueTables\DialogueTable;
use App\Repositories\DialogueTableRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DialogueTableController extends Controller
{

    private $dialogueTableRepository;
    function __construct(DialogueTableRepository $dialogueTableRepository)
    {
        $this->dialogueTableRepository = $dialogueTableRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Muestra todos los datos de los informes mesa de diálogo
     *
     * Este método retorna todos los datos del modelo DialogueTable
     *
     * @access public
     * @return DialogueTable
     * @author Jorge Lavao
     * @version V1
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->dialogueTableRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar la mesa de díalogo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Registro de un informe mesa de diálogo
     *
     * Este método inserta y crea datos que proviene del modelo
     * DialogueTable
     *
     * @access public
     * @author Jorge Lavao
     * @version V1
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $request['user_id'] = Auth::id();
            $validator = $this->dialogueTableRepository->getValidate($request->all(), 'create');
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->dialogueTableRepository->create($request);
            return  $this->createResponse($results, 'Se ha creado exitosamente');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar la mesa de díalogo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Consultar informe mesa de diálogo por id
     *
     * @access public
     * @param number $id of the DialogueTable / url param
     * @return DialogueTable
     * @author Jorge Lavao
     * @version V1
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->dialogueTableRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró mesa de díalogo', 404);
            }
            return $this->createResponse($result, 'La mesa de díalogo fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver la mesa de díalogo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
     * Actualizar informe mesa de diálogo
     *
     * Este método actualiza el informe mesa de diálogo, filtrando por su id en el modelo
     * DialogueTable
     *
     * @access public
     * @param number $id of the DialogueTable / url param
     * @return DialogueTable
     * @author Jorge Lavao
     * @version V1
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $validator = $this->dialogueTableRepository->getValidate($request->all(), 'update');
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $results = $this->dialogueTableRepository->update($request, $id);
            return  $this->createResponse($results, 'Se ha actualizado exitosamente');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar la mesa de díalogo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Eliminar informe mesa de diálogo
     *
     * Este método elimina el informe mesa de diálogo, filtrando por su id en el modelo
     * DialogueTable
     *
     * @access public
     * @param number $id of the dialogueTable / url param
     * @author Jorge Lavao
     * @version V1
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->dialogueTableRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar la mesa de díalogo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
}
