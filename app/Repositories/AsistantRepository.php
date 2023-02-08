<?php

namespace App\Repositories;

use App\Http\Resources\V1\AsistantCollection;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Validation\Rule;
use App\Models\Asistant;
class AsistantRepository
{
    use FunctionGeneralTrait;

    public function getAll()
    {
        return Asistant::orderBy('id', 'DESC')->get();
    }
    public function create($data)
    {
        $asistant = Asistant::create($data);
        // Guardamos en DataModel
        $this->control_data($asistant, 'store');
        return $asistant;
    }

    public function show($id)
    {
        return Asistant::find($id);
    }

    public function update($data, $id)
    {
        $asistant = Asistant::where('id', $id)->first();
        $asistant->update($data);
        // Guardamos en DataModel
        $this->control_data($asistant, 'update');
        return $asistant;
    }

    public function delete($id)
    {
        return Asistant::where('id', $id)->delete();
    }

    public function getValidate($data, $method){

        $validate = [
            'nac_id' => ['bail', 'required'],
            'assistant_name' => ['bail', 'required', 'string'],
            'assistant_document_number' => $method != 'update' ? ['bail', 'required', 'string', Rule::unique(Asistant::class)] : ['bail', 'required', 'string'],
            'assistant_position' => ['bail', 'required', 'string'],
            'assistant_phone' => ['bail', 'required', 'string'],
            'assistant_email' => ['bail', 'required', 'string'],
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'unique' => 'Ya existe un asistente con este :attribute.',
        ];

        $attrs = [
            'nac_id' => 'Nac',
            'assistant_name' => 'Nombre del asistente',
            'assistant_document_number' => 'Numero de documento del asistente',
            'assistant_position' => 'Posición del asistente',
            'assistant_phone' => 'Telefono del asistente',
            'assistant_email' => 'Correo del asistente',
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }

}
