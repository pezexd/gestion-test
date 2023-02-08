<?php

namespace Database\Seeders;

use App\Models\Nac;
use App\Models\Neighborhood;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pecs')->insert([
            [
                'consecutive' => 'PEC100',
                'nac_id' => Nac::all()->random()->id,
                'user_review_manager_cultural_id' => 4,
                'neighborhood_id' => Neighborhood::all()->random()->id,
                'place' => "aqui lugar",
                'place_address' => "aqui direccion",
                'activity_date' => "2022-12-15",
                'start_time' => Carbon::parse(now())->format('H:i:s'),
                'final_hour' => Carbon::parse(now())->format('H:i:s'),
                'place_type' => "F",
                'place_description' => "aqui descripcion",
                'place_image1' => "testing user super admin",
                'place_image2' => "Test user super admin",
                'created_by' => 1
            ]
        ]);
    }
}
