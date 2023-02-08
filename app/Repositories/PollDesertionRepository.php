<?php

namespace App\Repositories;

use App\Http\Resources\V1\PollDesertionCollection;
use App\Http\Resources\V1\PollDesertionResource;
use App\Models\PollDesertion;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\FunctionGeneralTrait;
/**
 * Class PollDesertionRepository.
 */
class PollDesertionRepository
{
    use FunctionGeneralTrait;
    /**
     * @return string
     *  Return the model
     */
    public function getAll()
    {
        $results = PollDesertion::orderBy('id', 'DESC')->get();
        return new PollDesertionCollection($results);
    }

    public function create($request)
    {
        $pollDesertion = PollDesertion::create($request);

        // Guardamos en DataModel
        $this->control_data($pollDesertion, 'store');

        $results = new PollDesertionResource($pollDesertion);
        return $results;
    }

    public function findById($id)
    {
        $pollDesertion = PollDesertion::findOrFail($id);
        $result = new PollDesertionResource($pollDesertion);
        return $result;
    }

    public function update($data, $id)
    {
        $pollDesertion = PollDesertion::findOrFail($id);
        $pollDesertion->update($data);

        // Guardamos en DataModel
        $this->control_data($pollDesertion, 'update');

        $result = new PollDesertionResource($pollDesertion);
        return $result;
    }

    public function delete($id)
    {
        PollDesertion::findOrFail($id)->delete();

        return response()->json(['message' => 'Se ha eliminado correctamente']);
    }

    public function getValidate($data){

        $validate = [
            'user_id' => 'required|exists:users,id,deleted_at,NULL',
            'beneficiary_id' => 'required',
            'date' => 'required|date',
            'nac_id' => 'required',
            'beneficiary_attrition_factors' => 'required',
            //'beneficiary_attrition_factor_other' => 'required|string|max:250',
            'disinterest_apathy' => 'required|integer|between:0,1',
            'disinterest_apathy_explanation' => 'required|string|max:2000',
            'reintegration' => 'required|integer|between:0,1',
            'reintegration_explanation' => 'required|string|max:2000',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'mimes' => ':attribute debe ser pdf,png,jpg,jpeg.',
            'max' => ':attribute es muy grande.',
            'unique' => 'Ya existe un modulo con este :attribute.',
        ];

        $attrs = [
            'user_id' => 'User',
            'beneficiary_id' => 'Beneficiario',
            'date' => 'Fecha',
            'nac_id' => 'Nac',
            'beneficiary_attrition_factors' => 'factores de abandono de beneficiarios',
            'disinterest_apathy' => 'Desinteres apatia',
            'disinterest_apathy_explanation' => 'Desinteres apatia explicacion',
            'reintegration' => 'Reintegracion',
            'reintegration_explanation' => 'Reintegracion explicación',
        ];

        return $this->validator($data, $validate, $messages, $attrs);

    }
}
