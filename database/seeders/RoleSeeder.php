<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'Super Administrador',
                'slug' => 'super.root',
                'description' => 'El todo poderoso',
                'full-access' => 'yes',
                'public' => 0,
            ],
            [
                'name' => 'Administrador',
                'slug' => 'root',
                'description' => 'Acceso a funciones básicas',
                'full-access' => 'no',
                'public' => 1,
            ],
            /* ROLES SYSTEM */
            [
                'name' => 'Apoyo Metodológico',
                'slug' => 'apoyo_metodologico',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Apoyo al Seguimiento y Monitoreo',
                'slug' => 'apoyo_seguimiento_monitoreo',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Coordinador Metodológico',
                'slug' => 'coordinador_metodologico',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Subdirección',
                'slug' => 'subdireccion',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Dirección',
                'slug' => 'direccion',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Apoyo Psicosocial',
                'slug' => 'psicosocial',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Coordinador Psicosocial',
                'slug' => 'coordinador_psicosocial',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Coordinador de Supervisión',
                'slug' => 'coordinador_supervision',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Apoyo a la Supervisión',
                'slug' => 'apoyo_supervision',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Secretaria de Cultura',
                'slug' => 'secretaria_cultura',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Gestores Culturales',
                'slug' => 'gestores_culturales',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Monitor Cultural',
                'slug' => 'monitor_cultural',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Embajador',
                'slug' => 'embajador',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Instructor',
                'slug' => 'instructor',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            // Ayudante
            [
                'name' => 'Líder Embajadores',
                'slug' => 'lider_embajador',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Líder Instructores',
                'slug' => 'lider_instructor',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Coordinador de Seguimiento',
                'slug' => 'coordinador_seguimiento',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Lider metodológico',
                'slug' => 'lider_metodológico',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ],
            [
                'name' => 'Coordinador Administrativo',
                'slug' => 'coordinador_administrativo',
                'description' => 'Acceso a formularios',
                'full-access' => 'no',
                'public' => 1,
            ]

        ]);
    }
}
