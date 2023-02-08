<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => 'Monitores',
            'slug' => 'monitors',
            'description' => 'Menú de monitores',
            'controller' => 'none'
        ]); //1

        DB::table('permissions')->insert([
            'name' => 'Gestores',
            'slug' => 'managers',
            'description' => 'Menú de gestores',
            'controller' => 'none'
        ]); //2

        DB::table('permissions')->insert([
            'name' => 'Psicosocial',
            'slug' => 'psicosocials',
            'description' => 'Psicosocial',
            'controller' => 'none'
        ]); //3
        DB::table('permissions')->insert([
            'name' => 'Caracterización',
            'slug' => 'characterizations',
            'description' => 'Caracterización',
            'controller' => 'none'
        ]); //4
        DB::table('permissions')->insert([
            'name' => 'Listas desplegables',
            'slug' => 'drop-down-lists',
            'description' => 'Listas desplegables',
            'controller' => 'none'
        ]); //5

        DB::table('permissions')->insert([
            'name' => 'Reportes',
            'slug' => 'reports',
            'description' => 'Reportes',
            'controller' => 'none'
        ]); //6

        DB::table('permissions')->insert([
            'name' => 'Envio del nuevo estado del formulario',
            'slug' => 'send_management',
            'description' => 'Envio del nuevo estado',
            'controller' => 'none'
        ]); //7

        DB::table('permissions')->insert([
            'name' => 'Ver listado de reportes',
            'slug' => 'reports.index',
            'description' => 'User can index view report',
            'controller' => 'none'
        ]); //8
        DB::table('permissions')->insert([
            'name' => 'Coordinador de supervisión',
            'slug' => 'coordinator_supervisors',
            'description' => 'User can index view coordinator supervisor',
            'controller' => 'none'
        ]); //9

        DB::table('permissions')->insert([
            'name' => 'Apoyo a la supervisión',
            'slug' => 'supervisory_supports',
            'description' => 'User can index view supervisory support',
            'controller' => 'none'
        ]); //10

        DB::table('permissions')->insert([
            'name' => 'Listar cambios del modelo',
            'slug' => 'changeDataModels.index',
            'description' => 'User can index view control change model',
            'controller' => 'none'
        ]); //11
        DB::table('permissions')->insert([
            'name' => 'Ver cambios del modelo',
            'slug' => 'changeDataModels.show',
            'description' => 'User can show view control change model',
            'controller' => 'none'
        ]); //12
        DB::table('permissions')->insert([
            'name' => 'Eliminar cambios del modelo',
            'slug' => 'changeDataModels.destroy',
            'description' => 'User can destroy view control change model',
            'controller' => 'none'
        ]); //13

        // Permisos de formularios nuevos

        //14-24
        DB::table('permissions')->insert([
            'name' => 'Ensamble cultural',
            'slug' => 'culturalEnsembles',
            'description' => 'Ensamble cultural',
            'controller' => 'none'
        ]); //4,18

        //CIRCULACIÓN CULTURAL
        DB::table('permissions')->insert([
            'name' => 'Circulación cultural',
            'slug' => 'culturalCirculations',
            'description' => 'Ensamble cultural',
            'controller' => 'none'
        ]); //4,18

        //SEMILLERO CULTURAL
        DB::table('permissions')->insert([
            'name' => 'Semillero cultural',
            'slug' => 'culturalSeedbeds',
            'description' => 'Ensamble cultural',
            'controller' => 'none'
        ]); //4,18

        //SHOW CULTURAL
        DB::table('permissions')->insert([
            'name' => 'Show culural',
            'slug' => 'culturalShows',
            'description' => 'Show culural',
            'controller' => 'none'
        ]); //4,18

        // ACOMPAÑAMIENTO METODOLÓGICO
        DB::table('permissions')->insert([
            'name' => 'Acompañamiento metodológico',
            'slug' =>  'methodologicalAccompaniments',
            'description' => 'Acompañamiento metodológico',
            'controller' => 'none'
        ]); //5

        // FORTALECIMIENTO METODOLÓGICO
        DB::table('permissions')->insert([
            'name' => 'Fortalecimiento metodológico',
            'slug' => 'methodologicalStrengthenings',
            'description' => 'Fortalecimiento metodológico',
            'controller' => 'none'
        ]); //5

        //SEGUIMIENTO METODOLÓGICO
        DB::table('permissions')->insert([
            'name' => 'Seguimiento metodológico',
            'slug' => 'methodologicalMonitorings',
            'description' => 'Seguimiento metodológico',
            'controller' => 'none'
        ]); //5

        // FORTALECIMIENTO AL SEGUIMIENTO
        DB::table('permissions')->insert([
            'name' =>  'Fortalecimiento al seguimiento',
            'slug' => 'strengtheningOfMonitorings',
            'description' => 'Fortalecimiento al seguimiento',
            'controller' => 'none'
        ]); //19

        //INFORMES DE SEGUIMIENTO
        DB::table('permissions')->insert([
            'name' =>  'Informe de seguimiento',
            'slug' => 'monitoringReports',
            'description' => 'Informe de seguimiento',
            'controller' => 'none'
        ]); //19

        //FORTALECIMIENTO A LA SUPERVISIÓN MONITORES E INSTRUCTORES
        DB::table('permissions')->insert([
            'name' => 'Fortalecimiento ala supervisión de monitores e instructores',
            'slug' => 'strengtheningSupervisionMonitorsInstructors',
            'description' => 'Fortalecimiento ala supervisión de monitores e instructores',
            'controller' => 'none'
        ]); //10

        //FORTALECIMIENTO A LA SUPERVISIÓN GESTORES
        DB::table('permissions')->insert([
            'name' => 'Fortalecimiento a al supervisión de gestores',
            'slug' => 'strengtheningSupervisionManagers',
            'description' => 'Fortalecimiento a al supervisión de gestores',
            'controller' => 'none'
        ]); //10

        //Super administrador
        $this->setPermissions('permissions', 'Permisos');
        $this->setPermissions('roles', 'Roles');
        $this->setPermissions('users', 'Usuarios');
        $this->setPermissions('modules', 'Modulos');
        $this->setPermissions('entities', 'Entidades');
        $this->setPermissions('neighborhoods', 'Barrios');
        $this->setPermissions('expertises', 'Experiencias');
        $this->setPermissions('orientations', 'Orientaciones');
        $this->setPermissions('nacs', 'Nacs');
        //Monitor
        $this->setPermissions('pecs', 'Pec');
        $this->setPermissions('pedagogicals', 'Ficha pedagógica');
        $this->setPermissions('inscriptions', 'Inscripción');
        $this->setPermissions('polls', 'Encuesta');
        $this->setPermissions('pollDesertions', 'Encuesta de deserción');
        $this->setPermissions('methodologicalsheetsone', 'Ficha Metodológica de Planeación');
        //Monitor
        $this->setPermissions('binnacles', 'Bitácoras Jornada Pacto');
        //Gestor
        $this->setPermissions('dialoguetables', 'Mesa de diálogo');
        $this->setPermissions('methodologicalInstructions', 'Instrucción Metodológica');
        $this->setPermissions('managermonitorings', 'Seguimiento gestor cultural');
        $this->setPermissions('binnacleManagers', 'Bitácoras Jornada Pacto Gestor');

        //Psicosocial
        $this->setPermissions('psychosocialinstructions', 'Instrucción Psicosocial');
        $this->setPermissions('parentschools', 'Escuela de padre');
        $this->setPermissions('psychopedagogicallogs', 'Bitácora Psicopedagógica');
        $this->setPermissions('cultural-rights', 'Derechos culturales');
        $this->setPermissions('supervision_reports', 'Acta supervisión de territorio');
        $this->setPermissions('phone_reports', 'Informe de seguimiento telefónico');
        $this->setPermissions('supervision_products', 'Informe supervisión productos');
        $this->setPermissions('binnacle_territories', 'Bitácora de territorio');
        $this->setPermissions('monthly_monitoring_reports', 'Informe mensual de supervisión');
        $this->setPermissions('assistants', 'Asistentes');

        $this->setPermissions('culturalEnsembles', 'Ensamble cultural');
        $this->setPermissions('culturalCirculations', 'Circulación cultural'); //CIRCULACIÓN CULTURA
        $this->setPermissions('culturalSeedbeds', 'Semillero cultural'); //SEMILLERO CULTURAL
        $this->setPermissions('culturalShows', 'Show culural'); //SHOW CULTURAL
        $this->setPermissions('methodologicalAccompaniments', 'Acompañamiento metodológico'); // ACOMPAÑAMIENTO METODOLÓGICO
        $this->setPermissions('methodologicalStrengthenings', 'Fortalecimiento metodológico'); // FORTALECIMIENTO METODOLÓGICO
        $this->setPermissions('methodologicalMonitorings', 'Seguimiento metodológico'); //SEGUIMIENTO METODOLÓGICO
        $this->setPermissions('strengtheningOfMonitorings', 'Fortalecimiento al seguimiento'); // FORTALECIMINETO AL SEGUIMIENTO
        $this->setPermissions('monitoringReports', 'Informe de seguimiento'); //INFORMES DE SEGUIMIENTO
        $this->setPermissions('strengtheningSuperMonIns', 'Fortalecimiento ala supervisión de monitores e instructores'); //FORTALECIMIENTO A LA SUPERVISIÓN MONITORES E INSTRUCTORES
        $this->setPermissions('strengtheningSupervisionMans', 'Fortalecimiento a al supervisión de gestores'); //FORTALECIMIENTO A LA SUPERVISIÓN GESTORES
        $this->setPermissions('strengtheningTerritories', 'Fortalecimiento a territorios'); //FORTALECIMIENTO A TERRITORIOS
        $this->setPermissions('supervisoryReports', 'Informe de supervisión'); //INFORME DE SUPERVISIÓN
        $this->setPermissions('items', 'Item menú');
        $this->setPermissions('groups', 'Grupos'); //Grupos

        //Instructor
        DB::table('permissions')->insert([
            'name' => 'Instructores',
            'slug' => 'instructors',
            'description' => 'Instructores',
            'controller' => 'none'
        ]); //140

        //No poner nada bajo de esto.
        DB::table('permissions')->insert([
            'name' => 'Configuración',
            'slug' => 'setting',
            'description' => 'User can show configuración',
            'controller' => 'none'
        ]); //142

        DB::table('permissions')->insert([
            'name' => 'Dashboard',
            'slug' => 'dashboard',
            'description' => 'User can show dashboard',
            'controller' => 'none'
        ]); //143

        // SUBDIRECCION
        DB::table('permissions')->insert([
            'name' => 'Subdirección',
            'slug' => 'subdireccion',
            'description' => 'Subdirección',
            'controller' => 'none'
        ]);

        DB::table('permissions')->insert([
            'name' => 'Reporte de vista de territorio',
            'slug' => 'reportsTerritories',
            'description' => 'Reporte de vista de territorio para la Subdirección',
            'controller' => 'none'
        ]);
        // Subdireccion
        $this->setPermissions('reportsTerritories', 'Reporte de subdirección');

        DB::table('permissions')->insert([
            'name' => 'Bitacora vista de territorio de coordinadores',
            'slug' => 'coordinadores',
            'description' => 'Bitacora vista de territorio de coordinadores para Coordinadores',
            'controller' => 'none'
        ]);
        $this->setPermissions('coordinadores', 'Bitácora territorio coordinador de seguimiento');
    }

    public function setPermissions($prefix, $nameRoute)
    {
        $actionRoute = [
            'index',
            'store',
            'create',
            'edit',
            'show',
            'destroy',
            'update'
        ];
        foreach ($actionRoute as $action) {
            DB::table('permissions')->insert([
                'name' => $action . ' ' . $nameRoute,
                'slug' => $prefix . '.' . $action,
                'description' => 'User can ' . $action . ' ' . $nameRoute,
                'controller' => rtrim($prefix, 's')
            ]);
        }
    }
}
