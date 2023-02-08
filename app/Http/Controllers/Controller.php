<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function createResponse($data = [],  $message = '', $status = 200, $success = true):JsonResponse
    {
        return response()->json([
            'items' => $data,
            'message' => $message,
            'success' => $success
        ], $status);
    }

    function createErrorResponse($data = [], $error = '', $status = 404):JsonResponse
    {
        return response()->json([
            'items' => $data,
            'error' => $error
        ], $status);
    }
}
