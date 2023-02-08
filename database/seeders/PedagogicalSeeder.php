<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PedagogicalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $mytime = Carbon::now();
        //
        DB::table('pedagogicals')->insert(
            [
                'consecutive' => 'FP1',
                // 'user_id' => 1,
                'user_review_manager_cultural_id'=>4,
                // 'monitor_id' => 1,
                'activity_name' => 'Prueba',
                'activity_date' => date('2022/12/13'),
                'cultural_right_id' => 1,
                'nac_id' => 1,
                'expertise_id' => 1,
                'experiential_objective' => 'Reconocer con base en la lectura',
                'lineament_id' => 'DC',
                'orientation_id' => 1,
                'manifestation' => 'Tradiciones y expresamiento',
                'process' => 'La clase empieza con el resultado',
                'product' => 'Ejercicio de la prueba',
                'resources' => 'Libro album',
                'created_by' => 1
            ],
        );
        DB::table('pedagogicals')->insert(
            [
                'consecutive' => 'FP2',
                'user_review_manager_cultural_id'=>4,
                // 'user_id' => 1,
                // 'monitor_id' => 1,
                'activity_name' => 'Prueba',
                'activity_date' => date('2022/11/30'),
                'cultural_right_id' => 1,
                'nac_id' => 1,
                'expertise_id' => 1,
                'experiential_objective' => 'Reconocer con base en la lectura',
                'lineament_id' => 'EF',
                'orientation_id' => 1,
                'manifestation' => 'Tradiciones y expresamiento',
                'process' => 'La clase empieza con el resultado',
                'product' => 'Ejercicio de la prueba',
                'resources' => 'Libro album',
                'created_by' => 1
            ],
        );
    }
}
