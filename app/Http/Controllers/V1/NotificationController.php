<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    private $repository;
    function __construct(NotificationRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        // Gate::authorize('haveaccess');
        try {
            $results = $this->repository->getAll();
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al listar' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function getByAuthenticated(Request $request)
    {
        try {
            $request['user_id'] = Auth::id();
            $results = $this->repository->getByAuthenticated($request);
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al listar' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function markAsRead(Request $request, $id)
    {
        try {
            $request['user_id'] = Auth::id();
            $results = $this->repository->markAsRead($request, $id);
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al marcar como leída' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function trash(Request $request, $id)
    {
        try {
            $request['user_id'] = Auth::id();
            $results = $this->repository->trash($request, $id);
            return $results->toArray($request);
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal al borrar' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
