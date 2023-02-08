<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedagogical;
use App\Repositories\PedagogicalRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class PedagogicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private $pedagogicalRepository;

    function __construct(PedagogicalRepository $pedagogicalRepository)
    {
        $this->pedagogicalRepository = $pedagogicalRepository;
    }
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results =   $this->pedagogicalRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar fichas pedagógicas ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            //Validación
            $request['created_by'] = Auth::id();
            $validator =   $this->pedagogicalRepository->getValidate($request->all(), 'create');
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }
            $result = $this->pedagogicalRepository->create($request->all());
            return $this->createResponse($result, 'La ficha pedagógica fue creada con éxito');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar ficha pedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result =   $this->pedagogicalRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la ficha pedagógica', 404);
            }
            return $this->createResponse($result, 'La ficha pedagógica fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver ficha pedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $request['user_id'] = Auth::id();
            $validator = $this->pedagogicalRepository->getValidate($request->all(), 'update');
            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            $result = $this->pedagogicalRepository->update($request->all(), $id);
            return $this->createResponse($result, 'La ficha pedagógica fue actualizada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar ficha pedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $results =   $this->pedagogicalRepository->delete($id);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar ficha pedagógica ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }

    public function getByRangeActivityDate(Request $request)
    {
        $initDate = $request->get('initDate');
        $lastDate = $request->get('lastDate');

        $pecs =   $this->pedagogicalRepository->getByRangeActivityDate($initDate, $lastDate);

        return response()->json(['items' => $pecs]);
    }
}
