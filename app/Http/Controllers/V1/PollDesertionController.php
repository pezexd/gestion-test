<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\PollDesertion;
use App\Repositories\PollDesertionRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PollDesertionController extends Controller
{

    private $pollDesertionRepository;
    function __construct(PollDesertionRepository $pollDesertionRepository)
    {
        $this->pollDesertionRepository = $pollDesertionRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('haveaccess');
        try {
            $results = $this->pollDesertionRepository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar encuestas de deserción ' . $ex->getMessage() . ' linea ' . $ex->getCode());
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
            $request['user_id'] = Auth::id();
            $validator = $this->pollDesertionRepository->getValidate($request->all());

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            return DB::transaction(function () use ($request) {
                $results = $this->pollDesertionRepository->create($request->all());
                return response()->json(['message' => 'Encuesta creada exitosamente', 'response' => true]);
            }, 2);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al guardar encuesta de deserción ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PollDesertion  $pollDesertion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Gate::authorize('haveaccess');
        try {
            $result = $this->pollDesertionRepository->findById($id);
            if (empty($result)) {
                return $this->createResponse($result, 'No se encontró la encuesta de deserción', 404);
            }
            return $this->createResponse($result, 'La encuesta de deserción fue encontrada');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al ver encuesta de deserción ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PollDesertion  $pollDesertion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('haveaccess');
        try {
            $request['user_id'] = Auth::id();
            $validator = $this->pollDesertionRepository->getValidate($request->all());

            if ($validator->fails()) {
                return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            }

            return DB::transaction(function () use ($request, $id) {
                $results = $this->pollDesertionRepository->update($request->all(), $id);
                return response()->json(['message' => 'Encuesta actualizada exitosamente', 'response' => true]);
            }, 2);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al actualizar encuesta de deserción ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PollDesertion  $pollDesertion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('haveaccess');
        try {
            $request['id'] = $id;
            $v = Validator::make($request, [
                'id' => 'required|exists:polls_desertion,id,deleted_at,NULL',
            ]);
            if ($v->fails()) {
                return $this->createResponse($v->errors(), 'Falló la validación', 400);
            }

            return DB::transaction(function () use ($id) {
                $results = $this->pollDesertionRepository->delete($id);
                return  $results;
            }, 2);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar encuesta de deserción ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
