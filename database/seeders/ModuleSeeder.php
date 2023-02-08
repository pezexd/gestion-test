<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    protected $modules = [
        ['Configuración', 'setting', 1, 'SettingsIcon'],
        ['Dashboard', 'dashboard', 0, ''],
        ['Informes', 'reports', 1, 'LayersIcon'],
        ['Listas desplegables', 'drop-down-lists', 1, 'ListIcon'],
        ['Caracterización', 'characterizations', 1, 'LayersIcon'],
        ['Monitores', 'monitors', 1, 'UsersIcon'],
        ['Gestores', 'managers', 1, 'UsersIcon'],
        ['Psicosocial', 'psicosocials', 1, 'UsersIcon'],
        ['Apoyo a la supervisión', 'supervisory_supports', 1, 'UsersIcon'],
        ['Coordinador de supervisión', 'coordinator_supervisors', 1, 'UsersIcon'],
        ['Instructores #1', 'instructors', 1, 'UsersIcon'],
        ['Subdirección', 'subdireccion', 1, 'UsersIcon'],
        ['Coordinación de seguimiento', 'coordinadores', 1, 'UsersIcon'],
        // ['Coordinador psicosocial', 'coordinador_psicosocials', 1, 'UsersIcon'],
        //Nuevos formularios
        // ['Ensamble cultural', 'culturalEnsembles', 1, 'UsersIcon'],
        // ['Circulación cultural', 'culturalCirculations', 1, 'UsersIcon'], //CIRCULACIÓN CULTURA
        // ['Semillero cultural', 'culturalSeedbeds', 1, 'UsersIcon'], //SEMILLERO CULTURAL
        // ['Show culural', 'culturalShows', 1, 'UsersIcon'], //SHOW CULTURAL
        // ['Acompañamiento metodológico', 'methodologicalAccompaniments', 1, 'UsersIcon'], // ACOMPAÑAMIENTO METODOLÓGICO
        // ['Fortalecimiento metodológico', 'methodologicalStrengthenings', 1, 'UsersIcon'], // FORTALECIMIENTO METODOLÓGICO
        // ['Seguimiento metodológico', 'methodologicalMonitorings', 1, 'UsersIcon'], //SEGUIMIENTO METODOLÓGICO
        // ['Fortalecimiento al seguimiento', 'strengtheningOfMonitorings', 1, 'UsersIcon'], // FORTALECIMINETO AL SEGUIMIENTO
        // ['Informe de seguimiento', 'monitoringReports', 1, 'UsersIcon'], //INFORMES DE SEGUIMIENTO
        // ['Fortalecimiento a la supervisión de monitores e instructore', 'strengtheningSupervisionMonitorsInstructors', 1, 'UsersIcon'], //FORTALECIMIENTO A LA SUPERVISIÓN MONITORES E INSTRUCTORES
        // ['Fortalecimiento a al supervisión de gestores', 'strengtheningSupervisionManagers', 1, 'UsersIcon'] //FORTALECIMIENTO A LA SUPERVISIÓN GESTORES

    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->modules as $key => $value) {
            DB::table('modules')->insert([
                [
                    'name' => $value[0],
                    'slug' => $value[1],
                    'icon' => $value[3],
                    'available' => 1,
                    'position' => $key + 1,
                    'hasItems' => $value[2]
                ],
            ]);
        }
    }
}
