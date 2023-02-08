<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Repositories\ManagementRepository;
use Illuminate\Support\Facades\Gate;

class ManagementController extends Controller
{
    private $management_repository;
    function __construct(ManagementRepository $management_repository)
    {
        $this->management_repository = $management_repository;
    }

    public function send_management(Request $request)
    {
        Gate::authorize('haveaccess');
        DB::beginTransaction();

        try {
            // $validator = $this->management_repository->getValidate($request->all());

            // if ($validator->fails()) {
            //     return  $this->createErrorResponse([], $validator->errors()->first(), 422);
            // }

            $res = $this->management_repository->send_management($request, $request->table, $request->id);
            DB::commit();
            return $res;
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al hacer la gestión!' . $ex->getMessage() . ' ' . $ex->getLine(),
            ], Response::HTTP_FORBIDDEN);
        }
    }
}
