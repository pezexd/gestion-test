<?php

namespace App\Repositories;

use App\Events\Managed;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ImageTrait;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class ManagementRepository
{
    use ImageTrait;
    use FunctionGeneralTrait;
    //recibe un registro por su id para actualizar
    function send_management($request, $table, $id)
    {
        $manager = Auth::id();
        $query = DB::table($table)->where('id', $id);

        if ($table == 'inscriptions') {
            if ($request->status == 'REC') {
                $query->update(['status' => $request->status, 'reject_message' => $request->reject_message]);
            }
            if ($request->status == 'APRO') {
                if ($request->hasFile('file_1')) {
                    $file_1 = $this->send_file($request, 'file_1', $table, $id);
                    $query->update(['apro_file1' => $file_1['response']['payload']]);
                }

                if ($request->hasFile('file_2')) {
                    $file_2 = $this->send_file($request, 'file_2', $table, $id);
                    $query->update(['apro_file2' => $file_2['response']['payload']]);
                }

                $query->update(['status' => $request->status, 'reject_message' => NULL]);
            }
        } else {
            if ($request->status == 'REC') {
                $query->update(['status' => $request->status, 'reject_message' => $request->reject_message]);
            } else {
                $query->where('id', $id)->update(['status' => $request->status, 'reject_message' => NULL]);
            }
        }

        $data = $query->get()->first();

        $created_by = isset($data->created_by) ? $data->created_by : $data->user_id;
        $notification_title = $request->status == 'REC' ? 'Rechazado' : ($request->status == 'APRO' ? 'Aprobado' : 'Revisado');
        $notification_description = $request->status == 'REC' ? "En $table tu registro fue rechazado." : ($request->status == 'APRO' ? "En $table tu registro fue aprobado." : "En $table tu registro fue revisado.");

        Managed::dispatchIf(
            isset($data),
            $created_by,
            $manager,
            $notification_title,
            $notification_description,
        );

        return response()->json(['message' => 'La gestión fue exitosa!', 'success' => true]);
    }

    //método para validar campos
    function getValidate($data)
    {
        $validate = [
            'status' => 'required',
            'reject_message' => 'status' == 'REC' ? 'required' : '',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
        ];

        $attrs = [
            'status' => 'required',
            'reject_message' => 'status' == 'REC' ? 'required' : '',
        ];

        return $this->validator($data, $validate, $messages, $attrs);
    }
}
