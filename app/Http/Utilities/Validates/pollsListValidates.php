<?php

namespace App\Http\Utilities\Validates;

use Illuminate\Http\Resources\Json\JsonResource;
use Validator;

class pollsListValidates
{

    public static function validates($data)
    {
        $validator = Validator::make($data,
            [
                'genders'=>'required',
                'age'=>'required|integer',
                'birth_date'=>'required',
                'marital_status'=>'required',
                'stratums'=>'required|integer',
                'phone'=>'required|integer',
                'email'=>'required',
                'number_children'=>'required|integer',
                'dependents' =>'required',
                'relationship_head_household'=>'required',
                'ethnicities'=>'required',
                'victim_armed_conflict'=>'required',
                'study'=>'required',
                'educational_levels' => 'required',
                'medical_services'=>'required',
                'entity_names'=>'required',
                'health_conditions'=>'required',
                'takes_medication'=>'required',
                'suffers_disease'=>'required',
                'disability'=>'required',
                'expertises'=>'required',
                'artistic_experience'=>'required',
                'artistic_group'=>'required',
            ]
            ,[
                'genders.required' => 'El campo genders es obligatorio',
                'age.required' => 'El campo age es obligatorio',
                'birth_date.required' => 'El campo birth_date es obligatorio',
                'marital_status.required' => 'El campo marital_satus es obligatorio',
                'stratums.required' => 'El campo stratums es obligatorio',
                'phone.required' => 'El campo phone es obligatorio',
                'email.required' => 'El campo email es obligatorio',
                'number_children.required' => 'El campo number_children es obligatorio',
                'dependents.required' => 'El campo dependents es obligatorio',
                'relationship_head_household' => 'El campo name es obligatorio',
                'ethnicities.required' => 'El campo ethnicities es obligatorio',
                'victim_armed_conflict.required' => 'El campo victim_armed_conflict es obligatorio',
                'study.required' => 'El campo study es obligatorio',
                'educational_levels.required' => 'El campo educational_levels es obligatorio',
                'medical_services.required' => 'El campo medical_service es obligatorio',
                'entity_names.required' => 'El campo entity_names es obligatorio',
                'health_conditions.required' => 'El campo health_conditions es obligatorio',
                'suffers_disease.required' => 'El campo suffers_disease es obligatorio',
                'disability.required' => 'El campo disability es obligatorio',
                'takes_medication.required' => 'El campo takes_medication es obligatorio',
                'expertises.required' => 'El campo expertises es obligatorio',
                'artistic_experience.required' => 'El campo artistic_experience es obligatorio',
                'artistic_group.required' => 'El campo artistic_group es obligatorio',
            ]);
       return $validator;

    }
}
?>
