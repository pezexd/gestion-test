<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Utilities\Resources;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdatePsychosocialInstructionRequest extends FormRequest
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
            'start_time' => Resources::getUpperString($this->start_time),
            'final_time' => Resources::getUpperString($this->final_time)
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

            'activity_date' => ['bail','required','date_format:Y-m-d'],
            'nac_id' => ['bail','required'],
            'start_time' => ['bail','required'],
            'final_hour' => ['bail','required','after:start_time'],
            'objective_day' => ['bail','required','string','min:3'],
            'themes_day' => ['bail','required','string','min:3'],
            'development_activity_image' => ['bail', 'max:'.(500 * 1049000)],
            'evidence_participation_image' => ['bail', 'max:'.(500 * 1049000)],

            // 'added_wizards' => ['bail','array'],
            'added_wizards.*.assistant_name' => ['bail','required','string','min:3','max:255'],
            'added_wizards.*.assistant_document_number' => ['bail','required','numeric','','max:99999999999'],
            'added_wizards.*.assistant_position' => ['bail','required','string','min:3','max:255'],
            'added_wizards.*.nac_id' => ['bail','required','numeric',Rule::exists(Nac::class,'id')],
            'added_wizards.*.assistant_phone' => ['bail','required','numeric','string','max:9999999999'],

            // 'assistance_monitors' => [ 'bail','array'],
            'assistance_monitors.*.monitor_id' =>[ 'bail','required','numeric',Rule::exists(User::class,'id')],

        ];
    }
    public function messages(){
        return [
            'start_time.date_format' => 'La :attribute no corresponde al formato HH:MM AM-PM',
            'final_time.date_format' => 'La :attribute no corresponde al formato HH:MM AM-PM',
            'final_time.after' => 'La :attribute debe ser posterior a la HORA INICIO'
        ];
    }
    public function attributes()
    {
        return [
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
