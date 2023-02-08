<?php

namespace Database\Factories\Inscriptions;

use App\Models\EntityName;
use App\Models\Inscriptions\Beneficiary;
use App\Models\Inscriptions\HealthData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscriptions\HealthData>
 */
class HealthDataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = HealthData::class;
    public function definition()
    {
        return [
            'entity_name_id' =>EntityName::all()->random()->id,
            'health_data_id'=>1,
            'health_data_type'=>'App\Models\Inscriptions\Beneficiary',
            'medical_service'=> $this->faker->randomElement(['C','S']),
            'health_condition'=> $this->faker->randomElement(['B', 'R', 'M'])
        ];
    }
}
