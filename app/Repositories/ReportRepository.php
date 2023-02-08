<?php

namespace App\Repositories;


use App\Exports\V1\AttendantsExport;
use App\Exports\V1\BeneficiariesExport;
use App\Exports\V1\DialogueTablesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\V1\VariablesExport;
use App\Exports\V1\LoginAccessExport;
use App\Exports\V1\ParentSchoolsExport;
use App\Exports\V1\PecsExport;
use App\Exports\V1\PedagogicalsExport;
use App\Exports\V1\PollDesertionsExport;
use App\Exports\V1\PollsExport;
use App\Exports\V1\UsersExport;
use App\Models\AccessLogin;
use App\Models\DialogueTables\DialogueTable;
use App\Models\Inscriptions\Pec;
use App\Models\Pedagogical;
use App\Models\Poll;
use App\Models\PollDesertion;
use App\Models\User;

class ReportRepository
{

    function controlReport($request)
    {
        switch ($request->type_excel) {
            case 'pecs':
                return $this->exportPecs($request);
                break;
            case 'variables':
                return $this->exportVariable($request);
                break;
            case 'sesion':
                return $this->exportLoginAccess($request);
                break;
            case 'users':
                return  $this->exportUsers($request);
                break;
            case 'polls':
                return $this->exportPolls($request);
                break;
            case 'pollDesertions':
                return $this->exportPollDesertions($request);
                break;
            case 'pedagogicals':
                return  $this->exportPedagogicals($request);
                break;
            case 'beneficiaries':
                return $this->exportBeneficiaries($request);
                break;
            case 'attendats':
                return $this->exportAttendats($request);
                break;
            case 'parentschools':
                return $this->exportParentschools($request);
                break;
            case 'dialogueTables':
                return $this->exportDialogueTables($request);
                break;
            default:
                return 0;
                break;
        }
    }
    public function exportPecs($request)
    {
        try {

            if (!$request->data) {
                return Excel::download(new PecsExport($request), "$request->type_excel.xlsx");
            }
            $query =  Pec::query();
            $pecs = Pec::get();
            if ($request->status) {
                $pecs =   $query->orWhere('status', $request->status)->get();
            }
            if ($request->nac_id) {
                $pecs =   $query->where('nac_id', $request->nac_id)->get();
            }
            if ($request->date_start) {
                $pecs =  $query->where('activity_date', $request->date_start)->get();
            }
            if ($request->date_start && $request->date_end) {
                $pecs =  $query->where('activity_date', '>=', $request->date_start)->where('activity_date', '<=', $request->date_end)->get();
            }
            if ($request->nac_id && $request->date_start && $request->date_end) {
                $pecs =   $query->where('nac_id', $request->nac_id)->where('activity_date', '>=', $request->date_start)->where('activity_date', '>=', $request->date_end)->get();
            }

            return  $pecs->count();
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }

    public function exportVariable($request)
    {
        try {
            if (!$request->data) {
                return Excel::download(new VariablesExport, "$request->type_excel.xlsx");
            }
            return 0;
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }

    public function exportLoginAccess($request)
    {
        try {
            if (!$request->data) {
                return Excel::download(new LoginAccessExport($request), "$request->type_excel.xlsx");
            }
            $query = AccessLogin::query();
            $accessLogins = AccessLogin::get();

            if ($request->date_start) {
                $accessLogins =  $query->where('date', $request->date_start)->get();
            }
            if ($request->date_start && $request->date_end) {
                $accessLogins =  $query->where('date', '>=', $request->date_start)->where('date', '<=', $request->date_end)->get();
            }
            return  $accessLogins->count();
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Error obteniendo el dato'. $ex->getMessage().', buscar en linea de codigo '.$ex->getLine() . $ex->getMessage(), 'success' => false], 404);
        }
    }
    public function exportUsers($request)
    {
        try {
            if (!$request->data) {
                return Excel::download(new UsersExport($request), "$request->type_excel.xlsx");
            }
            return User::count();
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }
    public function exportPolls($request)
    {
        try {
            if (!$request->data) {
                return Excel::download(new PollsExport($request), "$request->type_excel.xlsx");
            }
            $query = Poll::query();
            $polls = Poll::get();
            if ($request->status) {
                $polls =   $query->orWhere('status', $request->status)->get();
            }
            if ($request->date_start) {
                $polls =  $query->where('activity_date', $request->date_start)->get();
            }
            if ($request->date_start && $request->date_end) {
                $polls =  $query->where('activity_date', '>=', $request->date_start)->where('activity_date', '<=', $request->date_end)->get();
            }
            if ($request->date_start && $request->date_end  &&  $request->status) {
                $polls =   $query->where('status', $request->status)->where('activity_date', '>=', $request->date_start)->where('activity_date', '>=', $request->date_end)->get();
            }
            return $polls->count();
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }
    public function exportPollDesertions($request)
    {
        try {
            if (!$request->data) {
                return Excel::download(new PollDesertionsExport($request), "$request->type_excel.xlsx");
            }
            $query =  PollDesertion::query();
            $pollDesertions = PollDesertion::get();
            if ($request->status) {
                $pollDesertions =   $query->orWhere('status', $request->status)->get();
            }
            if ($request->nac_id) {
                $pollDesertions =   $query->where('nac_id', $request->nac_id)->get();
            }
            if ($request->date_start) {
                $pollDesertions =  $query->where('date', $request->date_start)->get();
            }
            if ($request->date_start && $request->date_end) {
                $pollDesertions =  $query->where('date', '>=', $request->date_start)->where('date', '<=', $request->date_end)->get();
            }
            if ($request->nac_id && $request->date_start && $request->date_end) {
                $pollDesertions =   $query->where('nac_id', $request->nac_id)->where('date', '>=', $request->date_start)->where('activity_date', '>=', $request->date_end)->get();
            }
            return  $pollDesertions->count();
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }
    public function exportPedagogicals($request)
    {
        try {
            if (!$request->data) {
                return Excel::download(new PedagogicalsExport($request), "$request->type_excel.xlsx");
            }
            $query =  Pedagogical::query();
            $pedagogicals = Pedagogical::get();
            if ($request->status) {
                $pedagogicals =   $query->orWhere('status', $request->status)->get();
            }
            if ($request->nac_id) {
                $pedagogicals =   $query->where('nac_id', $request->nac_id)->get();
            }
            if ($request->date_start) {
                $pedagogicals =  $query->where('activity_date', $request->date_start)->get();
            }
            if ($request->date_start && $request->date_end) {
                $pedagogicals =  $query->where('activity_date', '>=', $request->date_start)->where('activity_date', '<=', $request->date_end)->get();
            }
            if ($request->nac_id && $request->date_start && $request->date_end) {
                $pedagogicals =   $query->where('nac_id', $request->nac_id)->where('activity_date', '>=', $request->date_start)->where('activity_date', '>=', $request->date_end)->get();
            }
            return  $pedagogicals->count();
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['error' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }

    public function exportBeneficiaries($request)
    {
        try {
            if (!$request->data) {
                return Excel::download(new BeneficiariesExport($request), "$request->type_excel.xlsx");
            }
            return 0;
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }

    public function exportAttendats($request)
    {
        try {

            if (!$request->data) {
                return Excel::download(new AttendantsExport($request), "$request->type_excel.xlsx");
            }
            return 0;
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }
    public function exportParentschools($request)
    {
        try {

            if (!$request->data) {
                return Excel::download(new ParentSchoolsExport($request), "$request->type_excel.xlsx");
            }
            return 0;
        } catch (\Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Error obteniendo el dato ' . $ex->getMessage().', buscar en linea de codigo '.$ex->getLine(), 'success' => false], 404);
        }
    }
    public function exportDialogueTables($request)
    {
        if (!$request->data) {
            return Excel::download(new DialogueTablesExport($request), "$request->type_excel.xlsx");
        }
        $query =  DialogueTable::query();
        $dialogueTables = DialogueTable::get();
        if ($request->status) {
            $dialogueTables =   $query->orWhere('status', $request->status)->get();
        }
        if ($request->nac_id) {
            $dialogueTables =   $query->where('nac_id', $request->nac_id)->get();
        }
        if ($request->date_start) {
            $dialogueTables =  $query->where('activity_date', $request->date_start)->get();
        }
        if ($request->date_start && $request->date_end) {
            $dialogueTables =  $query->where('activity_date', '>=', $request->date_start)->where('activity_date', '<=', $request->date_end)->get();
        }
        if ($request->nac_id && $request->date_start && $request->date_end) {
            $dialogueTables =   $query->where('nac_id', $request->nac_id)->where('activity_date', '>=', $request->date_start)->where('activity_date', '>=', $request->date_end)->get();
        }
        return $dialogueTables->count();
    }
}
