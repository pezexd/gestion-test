<?php

namespace Database\Factories\Inscriptions;

use App\Models\Inscriptions\Attendant;
use App\Models\Inscriptions\Beneficiary;
use App\Models\Nac;
use App\Models\Neighborhood;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscriptions\Attendant>
 */
class AttendantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Attendant::class;

    public function definition()
    {
        return [
            // 'nac_id'=>Nac::all()->random()->id,
            // 'neighborhood_id'=>Neighborhood::all()->random()->id,
            // 'user_id'=>3,
            'beneficiary_id'=>1,
            'full_name'=>$this->faker->firstName().' '.$this->faker->lastName(),
            'relationship'=>$this->faker->randomElement(['P', 'M','PA','MA','T', 'PR', 'H', 'A', 'O']),
            // 'institution_entity_referred'=>$this->faker->text($maxNbChars = 50),
            // 'accept' =>1,
            // 'linkage_project'=>$this->faker->randomElement(['PMIE', 'PMEPUB', 'PMEPRI', 'PMGCP', 'PMMCP', 'PMR']),
            // 'participant_type'=>$this->faker->randomElement(['C', 'NC']),
            'type_document'=>$this->faker->randomElement(['RC', 'TI', 'CC']),
            'document_number'=>mt_rand(1,1000000000),
            // 'neighborhood_new'=>'',
            'zone'=>$this->faker->randomElement(['U', 'R']),
            // 'stratum'=>$this->faker->randomElement([1, 2,3,4,5,6]),
            'phone'=>$this->faker->phoneNumber($maxNbChars = 10),
            'email'=>$this->faker->unique()->safeEmail(),
            // 'file'=>$this->faker->imageUrl($width=400, $height=400),
            ];
    }
}
