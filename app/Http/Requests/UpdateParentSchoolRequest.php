<?php

namespace App\Http\Requests;

use App\Models\Nac;
use App\Models\ParentSchools\ParentSchool;
use App\Models\User;
use App\Utilities\Resources;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateParentSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'parent_school_id' => $this->route('parentschool'),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'parent_school_id' => ['bail','required','numeric',Rule::exists(ParentSchool::class,'id,deleted_at,NULL')],
            'date' => ['bail','required'],
            'monitor_id' => ['bail','required','numeric',Rule::exists(User::class,'id')],
            'start_time' => ['bail','required'],
            'final_time' => ['bail','required','after:start_time'],
            'place_attention' => ['bail','required','string','min:3','max:255'],
            'contact' => ['bail','required','string','min:3','max:255'],
            'objective' => ['bail','required','string','min:3','max:2000'],
            'development' => ['bail','required','string','min:3','max:2000'],
            'conclusions' => ['bail','required','string','min:3','max:2000'],
            'development_activity_image' => ['bail', 'file', 'mimes:application/pdf,pdf,png,webp,jpg,jpeg', 'max:'.(500 * 1049000)],
            'evidence_participation_image' => ['bail', 'file', 'mimes:application/pdf,pdf,png,webp,jpg,jpeg', 'max:'.(500 * 1049000)],

            'added_wizards' => ['bail','string'],
            'added_wizards.*.assistant_name' => ['bail','required','string','min:3','max:255'],
            'added_wizards.*.assistant_document_number' => ['bail','required','numeric','','max:99999999999'],
            'added_wizards.*.assistant_position' => ['bail','required','string','min:3','max:255'],
            'added_wizards.*.nac_id' => ['bail','required','numeric',Rule::exists(Nac::class,'id')],
            'added_wizards.*.assistant_phone' => ['bail','required','numeric','string','max:9999999999'],

            'assistance_monitors' => ['bail','string'],
            'assistance_monitors.*.monitor_id' =>[ 'bail','required','numeric',Rule::exists(User::class,'id')]
        ];
    }
    public function messages(){
        return [
            'final_time.after' => 'La :attribute debe ser posterior a la HORA INICIO'
        ];
    }
    public function attributes()
    {
        return [
            'parent_school_id' => 'ESCUELA DE PADRES',
            'monitor_id' => 'MONITOR',
            'date' => 'FECHA',
            'start_time' => 'HORA INICIO',
            'final_time' => 'HORA FINAL',
            'place_attention' => 'LUGAR ATENCIÓN',
            'contact' => 'CONTACTO',
            'objective' => 'OBJETIVO',
            'development' => 'DESARROLLO',
            'conclusions' => 'CONCLUSIONES',
            'development_activity_image' => 'FOTO DEL DESARROLLO',
            'evidence_participation_image' => 'EVIDENCIA DE PARTICIPACIÓN',

            'added_wizards.*.assistant_name' => 'ASISTENTES AGREGADOS - NOMBRE',
            'added_wizards.*.assistant_document_number' => 'ASISTENTES AGREGADOS - NUMERO DE CÉDULA',
            'added_wizards.*.assistant_position' => 'ASISTENTES AGREGADOS - CARGO',
            'added_wizards.*.nac_id' => 'ASISTENTES AGREGADOS - NAC',
            'added_wizards.*.assistant_phone' => 'ASISTENTES AGREGADOS - TELÉFONO',
            'added_wizards.*.assistant_email' => 'ASISTENTES AGREGADOS - EMAIL',

            'assistance_monitors.*.monitor_id' => 'ASISTENCIA MONITORES - MONITOR',
            'assistance_monitors.*.monitor_fullname' => 'ASISTENCIA MONITORES - NOMBRE COMPLETO',
            'assistance_monitors.*.document_number' => 'ASISTENCIA MONITORES - NUMERO DE CÉDULA'

        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => $validator->errors()->first()   ,
            'success' => false,
        ], 422));
    }
}
