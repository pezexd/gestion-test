<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            // Super - root
            [
                'name' => 'Super admin',
                'email' => '5676797567',
                'password' => Hash::make('root')
            ],
            // Root
            [
                'name' => 'Admin',
                'email' => '5465468786',
                'password' => Hash::make('admin')
            ],
            // Apoyo metodológico
            [
                'name' => 'Apoyo metodológico 1',
                'email' => '657568857',
                'password' => Hash::make('apoyometo1')
            ],
            // Apoyo al seguimiento y al monitoreo
            [
                'name' => 'Apoyo al seguimiento y al monitoreo 1',
                'email' => '8567567567',
                'password' => Hash::make('apoyomeseg1')
            ],
            // Coordinador metodológico
            [
                'name' => 'Coordinador metodológico',
                'email' => '546541787',
                'password' => Hash::make('coordinadormetodológico1')
            ],
            // Subdirección
            [
                'name' => 'Subdirección',
                'email' => '514541787',
                'password' => Hash::make('direccion1')
            ],
            // Dirección
            [
                'name' => 'Dirección',
                'email' => '546541788',
                'password' => Hash::make('cdireccion1')
            ],
            // Psicosocial
            [
                'name' => 'Psicosocial 1',
                'email' => '2312312312',
                'password' => Hash::make('sico1')
            ],
            // Coordinador psicosocial
            [
                'name' => 'Coordinador psicosocial',
                'email' => '514541720',
                'password' => Hash::make('coordinadorpsicosocial1')
            ],
            // Coordinador de Supervisión
            [
                'name' => 'Coordinador de Supervisión',
                'email' => '546541710',
                'password' => Hash::make('coordinadorsupervision1')
            ],
            // Apoyo de supervisión
            [
                'name' => 'Apoyo a la Supervisión',
                'email' => '546541712',
                'password' => Hash::make('apoyosupervision1')
            ],
            // Secretaria cultural
            [
                'name' => 'Secretaria cultural',
                'email' => '512511720',
                'password' => Hash::make('secretariacultural1')
            ],
            // Gestor
            [
                'name' => 'Gestor 1',
                'email' => '12123123',
                'password' => Hash::make('gestor1')
            ],
            // Monitor
            [
                'name' => 'Monitor 1',
                'email' => '213123132',
                'password' => Hash::make('monitor1')
            ],
            // Embajador
            [
                'name' => 'Embajador 1',
                'email' => '6745648456',
                'password' => Hash::make('ambassador1')
            ],
            // Instructor
            [
                'name' => 'Instructor1',
                'email' => '78543434',
                'password' => Hash::make('instructor1')
            ],
            // Lider Embajador
            [
                'name' => 'Lider Embajador 1',
                'email' => '89789756',
                'password' => Hash::make('leaderambassador1')
            ],
            // Lider Instructor
            [
                'name' => 'Lider Instructor1',
                'email' => '78565256',
                'password' => Hash::make('leaderinstructor1')
            ],
            // Coordinador de seguimiento
            [
                'name' => 'Coordinador de seguimiento ',
                'email' => '541541786',
                'password' => Hash::make('coordinadorseguimiento1')
            ],

            // Lider Metodológico
            [
                'name' => 'Lider Metodológico',
                'email' => '541501786',
                'password' => Hash::make('lidermetodológico1')
            ],

            // Coordinador Administrativo
            [
                'name' => 'Coordinador Administrativo',
                'email' => '541501788',
                'password' => Hash::make('lidermetodológico1')
            ],
        ]);


        //Gstores culturales
        // $route_culture_managers = database_path('/seeders/json/users/culture_managers.json');
        // $culture_managers = file_get_contents($route_culture_managers);
        // $data_culture_managers = json_decode($culture_managers);

        // foreach ($data_culture_managers as $obj) {
        //     DB::table('users')->insert(array(
        //         'name' => $obj->name,
        //         "email" => str_shuffle(str_replace(' ', '', substr(strtolower($obj->name), 1, 8))) . '@gestion.com',
        //         "password" => Hash::make('123456789')
        //     ));
        // }
        // //Apoyos metodológicos
        // $route_methodological_supports = database_path('/seeders/json/users/methodological_supports.json');
        // $methodological_supports = file_get_contents($route_methodological_supports);
        // $data_methodological_supports = json_decode($methodological_supports);

        // foreach ($data_methodological_supports as $obj) {
        //     DB::table('users')->insert(array(
        //         'name' => $obj->name,
        //         "email" => str_shuffle(str_replace(' ', '', substr(strtolower($obj->name), 1, 8))) . '@gestion.com',
        //         "password" => Hash::make('123456789')
        //     ));
        // }

        // //Psicosocial
        // $route_psychosocials = database_path('/seeders/json/users/psychosocials.json');
        // $psychosocials = file_get_contents($route_psychosocials);
        // $data_psychosocials = json_decode($psychosocials);

        // foreach ($data_psychosocials as $obj) {
        //     DB::table('users')->insert(array(
        //         'name' => $obj->name,
        //         "email" => str_shuffle(str_replace(' ', '', substr(strtolower($obj->name), 1, 8))) . '@gestion.com',
        //         "password" => Hash::make('123456789')
        //     ));
        // }

        // // Apoyo al seguimiento de monitores
        // $route_support_tracing_monitores = database_path('/seeders/json/users/support_tracing_monitores.json');
        // $support_tracing_monitores = file_get_contents($route_support_tracing_monitores);
        // $data_support_tracing_monitores = json_decode($support_tracing_monitores);

        // foreach ($data_support_tracing_monitores as $obj) {
        //     DB::table('users')->insert(array(
        //         'name' => $obj->name,
        //         "email" => str_shuffle(str_replace(' ', '', substr(strtolower($obj->name), 1, 8))) . '@gestion.com',
        //         "password" => Hash::make('123456789')
        //     ));
        // }
    }
}
