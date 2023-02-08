<?php

namespace Database\Factories\Inscriptions;

use App\Models\Inscriptions\Pec;
use App\Models\Nac;
use App\Models\Neighborhood;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pec::class;
    public function definition()
    {
        return [
            'consecutive' => 'PEC' . $this->faker->unique()->numberBetween(1, 50),
            'nac_id' => Nac::all()->random()->id,
            'user_review_manager_cultural_id'=>4,
            'neighborhood_id' => Neighborhood::all()->random()->id,
            'place' => $this->faker->text($maxNbChars = 10),
            'place_address' => $this->faker->text($maxNbChars = 10),
            'activity_date' => $this->faker->dateTimeBetween('-4 months', "now"),
            'start_time' => Carbon::parse(now())->format('H:i:s'),
            'final_hour' => Carbon::parse(now())->format('H:i:s'),
            'place_type' => $this->faker->randomElement(['F', 'P', 'SC', 'CEC', 'O']),
            'place_description' => $this->faker->text($maxNbChars = 20),
            'place_image1' => $this->faker->imageUrl($width = 400, $height = 400),
            'place_image2' => $this->faker->imageUrl($width = 400, $height = 400),
            'created_by' => $this->faker->numberBetween(1, 5)
        ];
    }
}
