<?php

namespace App\Http\Utilities\Validates;

use Illuminate\Http\Resources\Json\JsonResource;
use Validator;
use App\Traits\FunctionGeneralTrait;

class dropDownListsValidates
{
    use FunctionGeneralTrait;
    public function validates($data,$id =null)
    {
        $validate = [];
        if(!$id){
            $validate = [
                'name' => 'required|max:55|unique:groups',
                'user_id' => 'required|integer',
            ];

        }else{
            $validate = [
                'name' => 'required|max:55|unique:groups,'.$id,
                'user_id' => 'required|integer',
            ];
        }

        $messages = [
            'name.required' => 'El campo :attribute es obligatorio',
            'name.unique' => 'El nombre ingresado ya ha sido asignado.',
            'name.max' => 'El campo :attribute debe tener máximo 55 caracteres',
            'user_id.required' => 'El campo :attribute es obligatorio',
            'user_id.integer' => 'El campo :attribute debe ser un numero entero'
        ];

        $attrs = [
            'name' => 'nombre',
            'user_id' => 'usuario',
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }
}
