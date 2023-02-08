<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Repositories\AccessRepository;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    private $accessRepository;

    function __construct(AccessRepository $accessRepository)
    {
        $this->accessRepository = $accessRepository;
    }

    /**
     * get access modules
     * @return \Illuminate\Http\Response
     */
    function getAccess()
    {
        try {
            $results = $this->accessRepository->getAccessMenu();
            return $this->createResponse($results, 'Se encontraron resultados');
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     *
     */

    function userHaveAccess(Request $request)
    {
        try {
            $result = $request->user()->havePermission($request->permission);
            return $result;
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    /**
     *
     */

     function getPermissions(Request $request)
     {
        try {
            $results = $this->accessRepository->getPermissions();
            return $this->createResponse($results, 'Se encontraron resultados');
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
     }
    /**
     *
     */

     function getButtonBooleanCreates(Request $request)
     {
        try {
            $results = $this->accessRepository->getButtonBooleanCreates();
            return $this->createResponse($results, 'Se encontraron resultados');
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
     }
}
