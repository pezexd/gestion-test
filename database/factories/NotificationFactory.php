<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Notification::class;
    public function definition()
    {
        return [
            'sender_id'=> 1,
            'receptor_id'=> 2,
            'title'=> $this->faker->title(),
            'description'=> $this->faker->text($maxNbChars = 25),
            'read'=> 0,
            'trash'=> 0,
        ];
    }
}
