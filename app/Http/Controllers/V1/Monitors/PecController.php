<?php

namespace App\Http\Controllers\V1\Monitors;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary_Pec;
use App\Models\Inscriptions\Pec;
use App\Models\Nac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Repositories\PecRepository;
use Faker\Core\Number;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PecController extends Controller
{
    private $pecRepository;
    function __construct(PecRepository $pecRepository)
    {
        $this->pecRepository = $pecRepository;
    }

    //método para llamar a todos los registros de la tabla pec
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->pecRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar Pec ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    //método para buscar un registro po su id
    public function show(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->pecRepository->findById($request->pec);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró pec', 404);
            }
            return $this->createResponse($result, 'La pec fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver Pec ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    //metodo para recibir los datos del formulario
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        $data =  $request->all();
        try {
            $validator = $this->pecRepository->getValidate($data, 'create');
            // Corregir el campo "place_descripcion" por "place_description"

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $request['user_id'] = Auth::id();
            return  $this->pecRepository->create($request);
            // return response()->json(['message' => 'Pec Creado']);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardado de Pec ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
    //recibe los datos que llegan del formulario editar
    public function update(Request $request)
    {
        Gate::authorize('haveaccess');

        try {
            $validador = $this->pecRepository->getValidate($request->all(), 'update');

            if ($validador->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validador->errors()
                ], 422);
            }
            return $this->pecRepository->update($request, $request->pec);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar Pec ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
    //recibe el registro por su id para eliminar
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        $result = $this->pecRepository->delete($id);
        return $result;
    }

    public function getConsecutive()
    {
        return 'PEC' . Pec::orderBy('id', 'DESC')->first()->id + 1;
    }

    public function getByRangeActivityDate(Request $request)
    {
        $initDate = $request->get('initDate');
        $lastDate = $request->get('lastDate');

        $results = $this->pecRepository->getByRangeActivityDate($initDate, $lastDate);
        return response()->json(['items' => $results]);
    }
}
