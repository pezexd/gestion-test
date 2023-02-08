<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
            ['role_id' => 1, 'user_id' => 1],
            ['role_id' => 2, 'user_id' => 2],
            // Apoyo metodológico
            ['role_id' => 3, 'user_id' => 3],
            // Apoyo al seguimiento y al monitoreo
            ['role_id' => 4, 'user_id' => 4],
            //Coordinador metodológico
            ['role_id' => 5, 'user_id' => 5],
            //Subdirección
            ['role_id' => 6, 'user_id' => 6],
            //Dirección
            ['role_id' => 7, 'user_id' => 7],
            // Psicosocial
            ['role_id' => 8, 'user_id' => 8],
            //Coordinador de Psicosocial
            ['role_id' => 9, 'user_id' => 9],
            //Coordinador de Supervisión
            ['role_id' => 10, 'user_id' => 10],
            //Apoyo a la Supervisión
            ['role_id' => 11, 'user_id' => 11],
            //secretaria cultural
            ['role_id' => 12, 'user_id' => 12],
            //Gestor
            ['role_id' => 13, 'user_id' => 13],
            //Monitor
            ['role_id' => 14, 'user_id' => 14],
            //Embajador
            ['role_id' => 15, 'user_id' => 15],
            // Instructor
            ['role_id' => 16, 'user_id' => 16],
            // Lider embajador
            ['role_id' => 17, 'user_id' => 17],
            // Lider Instructor
            ['role_id' => 18, 'user_id' => 18],
            //Coordinador de seguimiento
            ['role_id' => 19, 'user_id' => 19],
            //Lider metodologico
            ['role_id' => 20, 'user_id' => 20],
            //Coordinador Administrativo
            ['role_id' => 21, 'user_id' => 21],

        ]);


        // //Gstores culturales
        // for ($i=10; $i<71; $i++) {
        //     DB::table('role_user')->insert([
        //         ['role_id' => 13, 'user_id' =>$i],
        //     ]);
        // }
        // //Apoyos metodológicos
        // for ($i=72; $i<=75 ; $i++) {
        //     DB::table('role_user')->insert([
        //         ['role_id' => 3, 'user_id' =>$i],
        //     ]);
        // }
        // //Psicosocial
        // for ($i=76; $i<=87 ; $i++) {
        //     DB::table('role_user')->insert([
        //         ['role_id' => 8, 'user_id' =>$i],
        //     ]);
        // }
        // for ($i=88; $i<=110 ; $i++) {
        //     DB::table('role_user')->insert([
        //         ['role_id' => 4, 'user_id' =>$i],
        //     ]);
        // }

    }
}
