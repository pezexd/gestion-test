<?php

namespace App\Utilities;

use App\Models\Asistant;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Resources
{
    CONST PAGINATE_DEFAULT = 10;
    /**
     * @param $value
     * @return string
     * Retorna una string en mayusculas
     */
    public static function getUpperString($value)
    {
        return Str::upper(strip_tags(trim($value)));
        //return mb_convert_case($value, MB_CASE_UPPER, 'UTF-8')
    }

    public static function isImagen($contentType){
        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/jpg','jpeg','gif','png','jpg'];
        return in_array($contentType, $allowedMimeTypes) ;
    }
    public static function validator($data){
        return Validator::make($data, [
            'nac_id' => ['bail','required'],
            'assistant_name' => ['bail','required', 'string'],
            'assistant_document_number' => ['bail','required', 'string', Rule::unique(Asistant::class)],
            'assistant_position' => ['bail','required', 'string'],
            'assistant_phone' => ['bail','required', 'string'],
            // 'assistant_email' => ['bail','required', 'string'],
        ]);
    }


}
