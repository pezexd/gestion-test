<?php

namespace Database\Factories;

use App\Models\EntityName;
use App\Models\Neighborhood;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Poll>
 */
class PollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [


            'gender'=> $this->faker->randomElement(['M','F','LGBTIQ+','O']),
            'age'=>$this->faker->randomElement([18, 20, 24, 19, 32, 50]),
            'birth_date'=>$this->faker->date(),
            'marital_state'=> $this->faker->randomElement(['S','C','UL','D','V']),
            'stratum'=> $this->faker->randomElement(['1','2','3','4','6']),
            'neighborhood_id'=>Neighborhood::all()->random()->id,
            'phone'=>$this->faker->phoneNumber($maxNbChars = 10),
            'email'=>$this->faker->unique()->safeEmail(),
            'number_children'=>$this->faker->randomElement(['18', '20', '24', '19', '32', '50']),
            'dependents'=>$this->faker->randomElement(['18', '20', '24', '19', '32', '50']),
            'relationship_head_household'=> $this->faker->randomElement(['E','H','JH','F']),
            'ethnicity'=> $this->faker->randomElement(['AFRO','IND','ROM','PAL','RAI','N']),
            'victim_armed_conflict'=> 1,
            'single_registry_victims'=>$this->faker->text(5),
            'study'=> 1,
            'educational_level'=> $this->faker->randomElement(['N','PREE','PRI','BAC','TEC','TECN','PRE','POS']),
            'medical_service'=> $this->faker->randomElement(['S','C']),
            'entity_name_id'=>EntityName::all()->random()->id,
            'health_condition'=> $this->faker->randomElement(['B','R','M']),
            'takes_medication'=> 1,
            'suffers_disease'=> 1,
            'type_disease'=> $this->faker->randomElement(['I','M','R','C','S','N','E']),
            'other_disease_type'=>$this->faker->text(5),
            'disability'=>1,
            'disability_type'=> $this->faker->randomElement(['F','V','A','C','M','MUL','N']),
            'assessed_disability'=>1,
            'receives_therapy'=>1,
            'expertises'=>$this->faker->text(5),
            'artistic_experience'=>$this->faker->text(5),
            'artistic_group'=>1,
            'artistic_group_name'=>$this->faker->text(5),
            'role_artistic_group'=>$this->faker->text(5),
        ];
    }
}
