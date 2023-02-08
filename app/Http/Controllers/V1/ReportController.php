<?php

namespace App\Http\Controllers\V1;

use App\Exports\DialogueTableAssistantExportMultipleSheets;
use App\Exports\V1\DialogueTableExport;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\DialogueTableCollection;
use App\Models\DialogueTables\DialogueTable;
use App\Models\Inscriptions\Pec;
use Illuminate\Http\Request;
use App\Repositories\ReportRepository;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Stmt\Return_;

class ReportController extends Controller
{
    use FunctionGeneralTrait;
    private $reportRepository;
    private $date;
    function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
        $this->date = $this->getDate()->format('d_m_Y');
    }
    public function exportExcel(Request $request)
    {
        try {

            $response = $this->reportRepository->controlReport($request);

            if ($response instanceof \Exception) {
                return $this->createErrorResponse([], 'Algo salio mal ' . $response->getMessage() . ' linea ' . $response->getCode());
            } else {
                if (!$request->type) {
                    return $response;
                }
                return response()->json(['count' => $response]);
            }
        } catch (\Exception $ex) {
            return $this->createErrorResponse([], 'Algo salio mal ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
