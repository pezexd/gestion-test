<?php

namespace Database\Factories\Inscriptions;

use App\Models\Inscriptions\Beneficiary;
use App\Models\Inscriptions\BeneficiaryPec;
use App\Models\Inscriptions\Pec;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inscriptions\BeneficiaryPec>
 */
class BeneficiaryPecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = BeneficiaryPec::class;
    public function definition()
    {
        return [
           'beneficiary_id'=>Beneficiary::all()->random()->id,
           'pec_id'=>Pec::all()->random()->id,

        ];
    }
}
