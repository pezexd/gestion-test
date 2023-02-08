<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

trait FunctionGeneralTrait
{

    private function is_filled($data): bool
    {
        $is_fill = true;
        $props = get_object_vars($data);
        foreach ($props as $prop) {
            if ($prop == '') {
                $is_fill = false;
            }
        }
        return $is_fill;
    }

    public function validatorMessage($data, $validate, $messages, $attrs)
    {
        $validator = $this->validator((array) $data, $validate, $messages, $attrs);

        if ($validator->fails()) {
            return $validator;
        }
    }

    function validator($data, $validation, $messages, $attrs): \Illuminate\Validation\Validator
    {
        $validator = Validator::make($data, $validation, $messages, $attrs);
        return $validator;
    }

    public function getDate()
    {
        return  Carbon::now();
    }
    public function control_data($data, $action)
    {
        // Declaramos varibales temporales
        $data_original = $data->getOriginal();
        $data_change = $data->getChanges();
        // Quitamos las fechas
        unset($data_original['created_at'], $data_original['updated_at'], $data_original['deleted_at']);
        unset($data_change['created_at'], $data_change['updated_at'], $data_change['deleted_at']);
        // Guardamos la data en la BD
        $data->control_data()->create([
            'user_id' => Auth::id(),
            'action' => $action,
            'data_original' => $data_original,
            'data_change' => $data_change
        ]);
    }
    //Muestra el valor de la abreviatura que se realizo en selectDefault
    // Se pasa el dato y el nombre de la propieda de la que pertenece
    public function data($data, $type)
    {
        $selects = config('selectsDefault.' . $type);
        $text = '';
        foreach ($selects as $value) {
            if ($value['value'] == $data) {
                $text = $value['label'];
                break;
            }
        }
        return  $text;
    }
    //Muestra concatenado los valores de una relación de uno a muchos

    public function printValueRelations($data)
    {
        $text = '';
        foreach ($data as $value) {
            $text .= $value['name'] . ', ';
        }

        return substr($text, 0, -1);
    }
}
