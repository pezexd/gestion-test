<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PollDesertion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('polls_desertion')->insert([
            [
                'user_id' => 1,
                'consecutive' => 'ED1',
                'beneficiary_id' => 1,
                'date' => Carbon::now(),
                'nac_id' => 1,
                'beneficiary_attrition_factors' => 1,
                'beneficiary_attrition_factor_other' => '',
                'disinterest_apathy' => 1,
                'disinterest_apathy_explanation' => 'Explicación',
                'reintegration' => 1,
                'reintegration_explanation' => 'Explicación',
                'user_id' => 1,
            ],
        ]);
    }
}
