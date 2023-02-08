<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleItemSeeder extends Seeder
{
    protected $settings = [
        ['Módulos', 'modules.index', 'albumsIcon'],
        ['Módulo item', 'items.index', 'albumsIcon'],
        ['Permisos', 'permissions.index', 'appsIcon'],
        ['Roles', 'roles.index', 'cogIcon'],
        ['Usuarios', 'users.index', 'accessibilityIcon'],
        ['Control de cambios en data', 'changeDataModels.index', 'accessibilityIcon'],

    ];

    protected $reports = [
        ['Reportes', 'reports.index', 'MinusIcon'],
    ];

    protected $characterizations = [
        ['Encuesta', 'polls.index', 'MinusIcon'],
    ];

    protected $drop_down_lists = [
        ['Asistentes', 'assistants.index', 'MinusIcon'],
        ['Derechos culturales', 'cultural-rights.index', 'MinusIcon'],
        ['Entidades', 'entities.index', 'MinusIcon'],
        ['Experticias', 'expertises.index', 'MinusIcon'],
        ['Nacs', 'nacs.index', 'MinusIcon'],
        ['Barrios', 'neighborhoods.index', 'MinusIcon'],
        ['Orientaciones', 'orientations.index', 'MinusIcon'],

    ];

    protected $monitors = [
        ['Grupos', 'groups.index', 'MinusIcon'],
        ['Inscripción', 'inscriptions.index', 'MinusIcon'],
        ['Pec', 'pecs.index', 'MinusIcon'],
        ['Ficha pedagógica', 'pedagogicals.index', 'MinusIcon'],
        ['Bitácora Jornada Pacto', 'binnacles.index', 'MinusIcon'],
        ['Encuesta de deserción', 'pollDesertions.index', 'MinusIcon'],
        ['Bitácora show cultural', 'culturalShows.index', 'MinusIcon'],
    ];

    protected $inscructors = [
        ['Ficha metodológica de planeación', 'methodologicalsheetsone.index', 'MinusIcon'],
        ['Ficha metodológica de evaluaión', 'methodologicalsheetstwo.index', 'MinusIcon'],
        ['Bitácora emsamble cultural', 'culturalEnsembles.index', 'MinusIcon'],
        ['Bitácora circulación cultural', 'culturalCirculations.index', 'MinusIcon'], //CIRCULACIÓN CULTURAL
        ['Semillero cultural', 'culturalSeedbeds.index', 'MinusIcon'], //SEMILLERO CULTURAL
    ];
    protected $managers = [
        ['Mesa de dialogo', 'dialoguetables.index', 'MinusIcon'],
        ['Instrucción Metodológica', 'methodologicalInstructions.index', 'MinusIcon'],
        ['Seguimiento gestor cultural', 'managermonitorings.index', 'MinusIcon'],
        ['Activación cultural', 'binnacleManagers.index', 'MinusIcon'],
    ];

    protected $psychosocials = [
        ['Instrucción Psicosocial', 'psychosocialinstructions.index', 'MinusIcon'],
        ['Escuela de Padres', 'parentschools.index', 'MinusIcon'],
        ['Bitácora Psicopedagógica', 'psychopedagogicallogs.index', 'MinusIcon'],


    ];
    protected $supervisory_supports = [
        ['Acta supervisión de territorio', 'supervision_reports.index', 'MinusIcon'],
        ['Informe seguimiento telefónico', 'phone_reports.index', 'MinusIcon'],
        ['Informe supervisión productos', 'supervision_products.index', 'MinusIcon'],
        ['Fortalecimiento a la supervisión monitores e instructores', 'strengtheningSuperMonIns.index', 'MinusIcon'],
        ['Fortalecimiento a la supervisión gestores', 'strengtheningSupervisionMans.index', 'MinusIcon'],
    ];
    protected $coordinator_supervisors = [
        ['Bitacora de territorio', 'binnacle_territories.index', 'MinusIcon'],
        ['Informe mensual de supervisión', 'monthly_monitoring_reports.index', 'MinusIcon'],
    ];

    protected $subdirection = [
        ['Informe de territorio', 'reportsTerritories.index', 'MinusIcon'],
    ];

    protected $coordinador_seguimiento = [
        ['Bitacora de territorio coordinador', 'coordinadores.index', 'MinusIcon'],
    ];


    // ['Show culural', 'culturalShows', 1, 'UsersIcon'], //SHOW CULTURAL
    // ['Acompañamiento metodológico', 'methodologicalAccompaniments', 1, 'UsersIcon'], // ACOMPAÑAMIENTO METODOLÓGICO
    // ['Fortalecimiento metodológico', 'methodologicalStrengthenings', 1, 'UsersIcon'], // FORTALECIMIENTO METODOLÓGICO
    // ['Seguimiento metodológico', 'methodologicalMonitorings', 1, 'UsersIcon'], //SEGUIMIENTO METODOLÓGICO
    // ['Fortalecimiento al seguimiento', 'strengtheningOfMonitorings', 1, 'UsersIcon'], // FORTALECIMINETO AL SEGUIMIENTO
    // ['Informe de seguimiento', 'monitoringReports', 1, 'UsersIcon'], //INFORMES DE SEGUIMIENTO
    // ['Fortalecimiento a la supervisión de monitores e instructore', 'strengtheningSupervisionMonitorsInstructors', 1, 'UsersIcon'], //FORTALECIMIENTO A LA SUPERVISIÓN MONITORES E INSTRUCTORES
    // ['Fortalecimiento a al supervisión de gestores', 'strengtheningSupervisionManagers', 1, 'UsersIcon'] //FORTALECIMIENTO A LA SUPERVISIÓN GESTORES

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Configuración
        foreach ($this->settings as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 1
                ],
            ]);
        }

        //Reportes
        foreach ($this->reports as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 3
                ],
            ]);
        }
        //Listas desplegables
        foreach ($this->drop_down_lists as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 4
                ],
            ]);
        }
        //Caracterización
        foreach ($this->characterizations as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 5
                ],
            ]);
        }
        //Monitor
        foreach ($this->monitors as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 6
                ],
            ]);
        }
        //Gestor
        foreach ($this->managers as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 7
                ],
            ]);
        }
        //Listas desplegables
        foreach ($this->psychosocials as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 8
                ],
            ]);
        }
        //Apoyo de supervisión
        foreach ($this->supervisory_supports as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 9
                ],
            ]);
        }

        //Coordinador de supervisor
        foreach ($this->coordinator_supervisors as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 10
                ],
            ]);
        }

        //Instructor
        foreach ($this->inscructors as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 11
                ],
            ]);
        }

        //Subdirección
        foreach ($this->subdirection as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 12
                ],
            ]);
        }

        //Subdirección
        foreach ($this->coordinador_seguimiento as $value) {
            DB::table('module_items')->insert([
                [
                    'name' => $value[0],
                    'route' => $value[1],
                    'icon' => $value[2],
                    'available' => 1,
                    'module_id' => 13
                ],
            ]);
        }
    }
}
