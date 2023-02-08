<?php

namespace App\Repositories;

use App\Http\Resources\V1\MonthlyMonitoringReportsCollection;
use App\Models\MonthlyMonitoringReports;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Traits\UserDataTrait;
use App\Traits\FunctionGeneralTrait;

class MonthlyMonitoringReportsRepository
{
    use ImageTrait, UserDataTrait, FunctionGeneralTrait;
    private $model;

    function __construct()
    {
        $this->model = new MonthlyMonitoringReports();
    }

    public function getAll()
    {
        $reports = $this->model->orderBy('id', 'DESC')->get();
        return new MonthlyMonitoringReportsCollection($reports);
    }

    public function create(Request $request)
    {
        $report = $this->model;
        $report->consecutive = $request->consecutive;
        $report->date = $request->date;

        $save = $report->save();

        if ($save) {
            $handle_1 = $this->send_file($request, 'file', 'monthly_monitoring_reports', $report->id);
            $report->update(['file' => $handle_1['response']['payload']]);
            $save &= $handle_1['response']['success'];
        }

        // Guardamos en DataModel
        $this->control_data($report, 'store');

        return $report;
    }

    public function update(Request $request, $data, $id)
    {

        $report = $this->model->find($id);
        $report->consecutive = $request->consecutive;
        $report->date = $request->date;

        if ($request->hasFile('file')) {
            $handle_1 = $this->update_file($request, 'file', 'monthly_monitoring_reports', $report->id, $report->file);

            $report->update(['file' => $handle_1['response']['payload']]);
        }

        $report->save();

        // Guardamos en DataModel
        $this->control_data($report, 'update');

        return $report;
    }

    public function findById($id)
    {
        $find = $this->model->find($id);
        return $find;
    }

    public function delete($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    function getValidate($data, $method)
    {
        $validate = [
            'consecutive' => 'bail|required',
            'date' => 'bail|required',
            'file' => $method != 'update' ? 'bail|required|max:' . (500 * 1049000) : 'bail',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
        ];

        $attrs = [
            'consecutive' => 'Consecutivo',
            'date' => 'Fecha',
            'file' => 'Documento',
        ];

        return $this->validator($data, $validate, $messages, $attrs);
    }
}
