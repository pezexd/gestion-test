<?php

namespace Database\Factories\Inscriptions;

use App\Models\EntityName;
use App\Models\Inscriptions\Beneficiary;
use App\Models\Inscriptions\SociodemographicCharacterization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscriptions\SociodemographicCharacterization>
 */
class SociodemographicCharacterizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SociodemographicCharacterization::class;
    public function definition()
    {
        return [
            // 'entity_name_id' => EntityName::all()->random()->id,
            'socio_demo_id'=>1,
            'socio_demo_type'=>'App\Models\Inscriptions\Beneficiary',
            'age' => 18,
            'gender' =>  $this->faker->randomElement(['M', 'F', 'LGBTIQ+', 'O']),
            'decision_study' => $this->faker->randomElement(['1', '0']),
            'educational_level' => $this->faker->randomElement(['N', 'PREE', 'PRI', 'BAC', 'TEC', 'TECN', 'PRE', 'POS']),
            'decision_disability' => $this->faker->randomElement(['1', '0']),
            'disability_type' => $this->faker->randomElement(['F', 'V', 'A', 'C', 'MEN', 'MUL', 'N']),
            'ethnicity' => $this->faker->randomElement(['AFRO', 'IND', 'ROM', 'PAL', 'RAI', 'N']),
            'condition' => $this->faker->randomElement(['D','MCH','OH','NA'])
        ];
    }
}
