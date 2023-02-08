<?php


namespace Database\Factories\Inscriptions;
use App\Models\Inscriptions\Inscription;
use Illuminate\Database\Eloquent\Factories\Factory;


class InscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Inscription::class;
    public function definition()
    {
        return [
            'consecutive'=>'F1',
            'created_by'=>3,
            'user_review_support_follow_id'=>4,
            'beneficiary_id'=>1,
            'status'=>'ENREV'
          ];
    }
}
