<?php

namespace App\Http\Requests;

use App\Models\Nac;
use App\Models\User;
use App\Utilities\Resources;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ParentSchoolRequest extends FormRequest
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

    public function withValidator($validator){
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                $roles = User::query()->whereHas('roles',function (Builder $query){
                    $query->whereIn('slug', ['monitor_cultural','embajador','instructor', 'root', 'super.root']);
                })->orWhere('id', $this->monitor_id)->exists();
                if(!$roles){
                    $validator->errors()->add(null, 'Error de validacion, solo se permiten monitores con los roles de monitor,embajador,instructor' );
                }
                //cli_set_process_title;
            });
        }
    }

    public function prepareForValidation()
    {
        $this->merge([
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

            'date' => ['bail','required'],
            'monitor_id' => ['bail','required','numeric',Rule::exists(User::class,'id')],
            'start_time' => ['bail','required'],
            'final_time' => ['bail','required','after:start_time'],
            'place_attention' => ['bail','required','string','min:3','max:255'],
            'contact' => ['bail','required','string','min:3','max:255'],
            'objective' => ['bail','required','string','min:3'],
            'development' => ['bail','required','string','min:3'],
            'conclusions' => ['bail','required','string','min:3'],
            'development_activity_image' => ['bail', 'required', 'file', 'mimes:application/pdf,pdf,png,webp,jpg,jpeg', 'max:'.(500 * 1049000)],
            'evidence_participation_image' => ['bail', 'required', 'file', 'mimes:application/pdf,pdf,png,webp,jpg,jpeg', 'max:'.(500 * 1049000)],

            'added_wizards' => ['bail','string'],
            'added_wizards.*.assistant_name' => ['bail','required','string','min:3','max:255'],
            'added_wizards.*.assistant_document_number' => ['bail','required','numeric','','max:99999999999'],
            'added_wizards.*.assistant_position' => ['bail','required','string','min:3','max:255'],
            'added_wizards.*.nac_id' => ['bail','required','numeric',Rule::exists(Nac::class,'id')],
            'added_wizards.*.assistant_phone' => ['bail','required','numeric','string','max:9999999999'],

            'assistance_monitors' => [ 'bail','string'],
            'assistance_monitors.*.monitor_id' =>[ 'bail','required','numeric',Rule::exists(User::class,'id')],

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
            'monitor_id' => 'MONITOR',
            'date' => 'FECHA',
            'start_time' => 'HORA INICIO',
            'final_time' => 'HORA FINAL',
            'place_attention' => 'LUGAR ATENCION',
            'contact' => 'CONTACTO',
            'objective' => 'OBJETIVO',
            'development' => 'DESARROLLO',
            'conclusions' => 'CONCLUSIONES',
            'development_activity_image' => 'FOTO DEL DESARROLLO',
            'evidence_participation_image' => 'EVIDENCIA DE PARTICIPACIÓN',

            'added_wizards.*.assistant_name' => 'ASISTENTES AGREGADOS - NOMBRE',
            'added_wizards.*.assistant_document_number' => 'ASISTENTES AGREGADOS - NUMERO DE CEDULA',
            'added_wizards.*.assistant_position' => 'ASISTENTES AGREGADOS - CARGO',
            'added_wizards.*.nac_id' => 'ASISTENTES AGREGADOS - NAC',
            'added_wizards.*.assistant_phone' => 'ASISTENTES AGREGADOS - TELEFONO',
            //'added_wizards.*.assistant_email' => 'ASISTENTES AGREGADOS - EMAIL',

            'assistance_monitors.*.monitor_id' => 'ASISTENCIA MONITORES - MONITOR',
            'assistance_monitors.*.monitor_fullname' => 'ASISTENCIA MONITORES - NOMBRE COMPLETO',
            'assistance_monitors.*.document_number' => 'ASISTENCIA MONITORES - NUMERO DE CEDULA'

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
