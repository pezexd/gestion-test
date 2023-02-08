<?php

namespace Database\Seeders;

use App\Models\Nac;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profiles = [
            // Super
            [
                'contractor_full_name' => 'Jefri Martínezs',
                'document_number' => '5676797567',
                'user_id' => 1,
                'nac_id' => 1,
                'role_id' => 1
            ],
            //Root
            [
                'contractor_full_name' => 'Alejandro',
                'document_number' => '5465468786',
                'user_id' => 2,
                'nac_id' => 1,
                'role_id' => 2
            ],
            // Apoyo metodológico
            [
                'contractor_full_name' => 'Julian Perez',
                'document_number' => '657568857',
                'user_id' => 3,
                'nac_id' => 1,
                'role_id' => 3
            ],
            // Apoyo al seguimiento y al monitoreo
            [
                'contractor_full_name' => 'Luisa Hoyos',
                'document_number' => '8567567567',
                'user_id' => 4,
                'nac_id' => 2,
                'role_id' => 4
            ],
            // Coordinador metodológico
            [
                'contractor_full_name' => 'Carlos Bermudez',
                'document_number' => '546541787',
                'user_id' => 5,
                'nac_id' => 2,
                'role_id' => 5
            ],
            // Subdirección
            [
                'contractor_full_name' => 'Jaiver Balanta',
                'document_number' => '514541787',
                'user_id' => 6,
                'nac_id' => 3,
                'role_id' => 6
            ],
            // Dirección
            [
                'contractor_full_name' => 'Sara Hurtado',
                'document_number' => '546541788',
                'user_id' => 7,
                'nac_id' => 3,
                'role_id' => 7
            ],
            // Psicosocial
            [
                'contractor_full_name' => 'Alejandro Ortega',
                'document_number' => '2312312312',
                'user_id' => 8,
                'nac_id' => 3,
                'role_id' => 8,
            ],
            // Coordinador Psicosocial
            [
                'contractor_full_name' => 'Jose Carlos',
                'document_number' => '514541720',
                'user_id' => 9,
                'nac_id' => 1,
                'role_id' => 9
            ],
            // Coordinador de supervisión
            [
                'contractor_full_name' => 'Adriana Álvarez',
                'document_number' => '546541710',
                'user_id' => 10,
                'nac_id' => 4,
                'role_id' => 10
            ],
            // Apoyo de supervisión
            [
                'contractor_full_name' => 'Steven Hurtado',
                'document_number' => '546541712',
                'user_id' => 11,
                'nac_id' => 4,
                'role_id' => 11
            ],
            // Secreatria cultural
            [
                'contractor_full_name' => 'Steven Hurtado',
                'document_number' => '512511720',
                'user_id' => 12,
                'nac_id' => 4,
                'role_id' => 11
            ],
            // Gestor
            [
                'contractor_full_name' => 'Alejandro Murillo',
                'document_number' => '12123123',
                'user_id' => 13,
                'nac_id' => 2,
                'role_id' => 13,
                'psychosocial_id' => 8,
                'methodological_support_id' => 3
            ],
            // Monitor
            [
                'contractor_full_name' => 'Pedro Mendez',
                'document_number' => '213123132',
                'user_id' => 14,
                'nac_id' => 2,
                'role_id' => 14,
                'psychosocial_id' => 8,
                'gestor_id' => 13,
                'support_tracing_monitoring_id' => 4 //Apoyo al seguimiento
            ],
            // Embajador
            [
                'contractor_full_name' => 'Luz Dary Melo',
                'document_number' => '6745648456',
                'user_id' => 15,
                'nac_id' => 3,
                'role_id' => 15,
                'ambassador_leader_id' => 17
            ],
            // Instructor
            [
                'contractor_full_name' => 'Camila Martinez',
                'document_number' => '78543434',
                'user_id' => 16,
                'nac_id' => 4,
                'instructor_leader_id' => 18,
                'role_id' => 16
            ],
            // Lider Embajador
            [
                'contractor_full_name' => 'Luis Benavidez',
                'document_number' => '89789756',
                'user_id' => 17,
                'nac_id' => 1,
                'role_id' => 17
            ],
            // Lider Instructor
            [
                'contractor_full_name' => 'Jimmy Rodriguez',
                'document_number' => '78565256',
                'user_id' => 18,
                'nac_id' => 3,
                'role_id' => 18
            ],
            // Coordinador de seguimiento
            [
                'contractor_full_name' => 'Jhon Karlos',
                'document_number' => '541541786',
                'user_id' => 19,
                'nac_id' => 1,
                'role_id' => 19
            ],
            //Lider metodológico
            [
                'contractor_full_name' => 'Yina Calderón',
                'document_number' => '541501786',
                'user_id' => 20,
                'nac_id' => 1,
                'role_id' => 20
            ],
            // Coordinador de administrativo
            [
                'contractor_full_name' => 'Josué Hurtado',
                'document_number' => '541501788',
                'user_id' => 21,
                'nac_id' => 1,
                'role_id' => 21
            ],

        ];

        foreach ($profiles as $profile) {
            DB::table('profiles')->insert($profile);
        }
    }
}
