<?php

namespace Database\Factories\PsychosocialInstructions;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Nac;
use App\Models\User;
use App\Models\PsychosocialInstructions\PsychosocialInstruction;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nac>
 */
class PsychosocialInstructionFactory extends Factory
{
    protected $model = PsychosocialInstruction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
    	static $number = 1;

        return [
            'consecutive' => 'IP' . $number++,
            'activity_date' => fake()->dateTimeBetween('+0 days', '+2 years'),
            'start_time' => fake()->time(),
            'final_hour' => fake()->time(),
            'nac_id' => Nac::inRandomOrder()->value('id'),
            'objective_day' => fake()->paragraph(),
            'themes_day' => fake()->paragraph(),
            'development_activity_image' => fake()->imageUrl(),
            'evidence_participation_image' => fake()->imageUrl(),
            'user_id' => User::inRandomOrder()->value('id')
        ];
    }
}
