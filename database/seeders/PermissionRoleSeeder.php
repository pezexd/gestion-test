<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dashboard = Permission::latest('id')->first()->id;
        //Monitor
        $permissionsAssignMonitor = [
            'inscriptions',
            'pecs',
            'binnacles',
            'pollDesertions',
            'pedagogicals',
            'groups'
        ];

        //Monitor
        foreach ($permissionsAssignMonitor as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.destroy')->get();

            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.monitor'),
                    'permission_id' => $value->id

                ]);
            }
        }
        //Gestor->monitor

        $permissionsAssignMonitorManager = [
            'pecs',
            'pedagogicals'
        ];
        foreach ($permissionsAssignMonitorManager as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.create')->where('slug', '!=', $value . '.destroy')
                ->get();

            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.gestor'),
                    'permission_id' => $value->id

                ]);
            }
        }
        $permissionsAssignManager = [

            'dialoguetables',
            'methodologicalInstructions',
            'managermonitorings',
            'binnacleManagers',
            'binnacles',
        ];

        foreach ($permissionsAssignManager as $value) {
            $permissions = Permission::select('id', 'name')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.destroy')->get();

            foreach ($permissions  as  $value) {
                PermissionRole::create([
                    'role_id' => config('roles.gestor'),
                    'permission_id' => $value->id
                ]);
            }
        }

        //Instructores

        $rolInstructorPermissionsAssign = [
            'groups',
            'pecs',
            'inscriptions',
            'methodologicalsheetsone',
            'methodologicalsheettwo',
        ];


        foreach ($rolInstructorPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.destroy')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.instructor'),
                    'permission_id' => $value->id

                ]);
            }
        }

        PermissionRole::create([
            'role_id' => config('roles.instructor'),
            'permission_id' => 340 // Menú de instructores
        ]);
        // Lider de instructores
        $rolInstructorLeaderPermissionsAssign = [
            'pecs',
            'methodologicalsheetsone',
            'methodologicalsheettwo',
        ];
        PermissionRole::create([
            'role_id' => config('roles.lider_instructor'),
            'permission_id' => 340 // Menú de instructores
        ]);

        foreach ($rolInstructorLeaderPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')
                ->where('slug', '!=', $value . '.destroy')
                ->where('slug', '!=', $value . '.create')
                ->where('slug', '!=', $value . '.store')
                ->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.lider_instructor'),
                    'permission_id' => $value->id

                ]);
            }
        }
        //PsicoSocial

        $rolPsicoPermissionsAssign = [
            'psychosocialinstructions',
            'parentschools',
            'psychopedagogicallogs',


        ];

        foreach ($rolPsicoPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.destroy')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.psicosocial'),
                    'permission_id' => $value->id

                ]);
            }
        }

        //Apoyo y seguimiento->monitor

        $permissionsAssignMonitorSupport = [
            'inscriptions',
            'binnacles',

        ];

        foreach ($permissionsAssignMonitorSupport as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.create')->where('slug', '!=', $value . '.destroy')
                ->get();

            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.apoyo_al_seguimiento_monitoreo'),
                    'permission_id' => $value->id

                ]);
            }
        }

        //Apoyo metodologico
        $permissionsAssignManager = [
            'dialoguetables',
            'methodologicalInstructions',
            'managermonitorings',
            'binnacleManagers'
        ];

        foreach ($permissionsAssignManager as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.create')->where('slug', '!=', $value . '.destroy')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.apoyo_metodologico'),
                    'permission_id' => $value->id

                ]);
            }
        }

        //array_push($rolPsicoPermissionsAssign, 'binnacle_territories');
        //Coordinador psicosocial

        foreach ($rolPsicoPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.create')->where('slug', '!=', $value . '.destroy')->get();
            foreach ($permissions  as  $value) {
                PermissionRole::create([
                    'role_id' => config('roles.coordinador_psicosocial'),
                    'permission_id' => $value->id

                ]);
            }
        }
        //Coordinador psicosocial ->opción de menú
        /* PermissionRole::create([
            'role_id' => config('roles.coordinador_psicosocial'),
            'permission_id' => 9

        ]); */

        //Lider instructor
        $rolAmbassadorInstructorPermissionsAssign = [
            'culturalShows',
        ];

        foreach ($rolAmbassadorInstructorPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.create')->where('slug', '!=', $value . '.destroy')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.lider_instructor'),
                    'permission_id' => $value->id

                ]);
            }
        }

        //Coordinador de seguimiento (SEGUIMIENTO, METODOLOGICO, ADMINISTRATIVO, PSICOSOCIAL)
        $rolCoordinatorsPermissionsAssign = [
            'coordinadores',
        ];

        foreach ($rolCoordinatorsPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->where('slug', '!=', $value . '.create')->where('slug', '!=', $value . '.destroy')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_seguimiento'),
                    'permission_id' => $value->id
                ]);

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_supervision'),
                    'permission_id' => $value->id
                ]);

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_metodologico'),
                    'permission_id' => $value->id
                ]);

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_administrativo'),
                    'permission_id' => $value->id
                ]);

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_psicosocial'),
                    'permission_id' => $value->id
                ]);
            }
        }

        //Dasboard
        $roles = Role::select('id')->get();
        foreach ($roles as  $value) {
            PermissionRole::create([
                'role_id' => $value->id,
                'permission_id' => $dashboard
            ]);
        }

        //Asignación de modulos a roles.

        $modules = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; //Permisos

        //Monitor
        PermissionRole::create([
            'role_id' => config('roles.monitor'),
            'permission_id' => $modules[0]
        ]);

        //Gestores
        PermissionRole::create([
            'role_id' => config('roles.gestor'),
            'permission_id' => $modules[1]
        ]);
        //Monitor
        PermissionRole::create([
            'role_id' => config('roles.gestor'),
            'permission_id' => $modules[0]
        ]);

        /*--------------------------------------------------------*/
        //Psicosocial
        PermissionRole::create([
            'role_id' => config('roles.psicosocial'),
            'permission_id' => $modules[2]
        ]);


        /*--------------------------------------------------------*/
        //Coodinador psicosocial
        PermissionRole::create([
            'role_id' => config('roles.coordinador_psicosocial'),
            'permission_id' => $modules[2]
        ]);

        /*--------------------------------------------------------*/
        //Apoyo de seguimiento
        //Monitores
        PermissionRole::create([
            'role_id' => config('roles.apoyo_al_seguimiento_monitoreo'),
            'permission_id' => $modules[0]
        ]);

        /*--------------------------------------------------------*/
        //Instructor
        //Monitores
        PermissionRole::create([
            'role_id' => config('roles.instructor'),
            'permission_id' => $modules[0]
        ]);

        /*--------------------------------------------------------*/
        //Lider de instructores
        //Monitores
        PermissionRole::create([
            'role_id' => config('roles.lider_instructor'),
            'permission_id' => $modules[0]
        ]);

        /*--------------------------------------------------------*/
        //Embajador
        //Monitores
        PermissionRole::create([
            'role_id' => config('roles.embajador'),
            'permission_id' => $modules[0]
        ]);
        //Lider embajador
        PermissionRole::create([
            'role_id' => config('roles.lider_embajador'),
            'permission_id' => $modules[0]
        ]);

        /*--------------------------------------------------------*/
        //Lider de embajador
        //Monitores
        // PermissionRole::create([
        //     'role_id' => config('roles.lider_embajador'),
        //     'permission_id' => $modules[0]
        // ]);

        /*--------------------------------------------------------*/
        //Apoyo metodologico

        PermissionRole::create([
            'role_id' => config('roles.apoyo_metodologico'),
            'permission_id' => $modules[1]
        ]);

        /*--------------------------------------------------------*/
        //Coordinador metodológico
        /* PermissionRole::create([
            'role_id' => config('roles.coordinador_metodologico'),
            'permission_id' => $modules[0]
        ]);

        PermissionRole::create([
            'role_id' => config('roles.coordinador_metodologico'),
            'permission_id' => $modules[1]
        ]); */

        /*--------------------------------------------------------*/
        //Coordinador de supervisión
        PermissionRole::create([
            'role_id' => config('roles.coordinador_supervision'),
            'permission_id' => $modules[8]
        ]);
        $rolCoordinatorSupervisorsPermissionsAssign = [
            'binnacle_territories', 'monthly_monitoring_reports'
        ];
        /*--------------------------------------------------------*/
        //Apoyo de supervisión
        PermissionRole::create([
            'role_id' => config('roles.apoyo_supervision'),
            'permission_id' => $modules[9]
        ]);
        $rolSupportSupervisorsPermissionsAssign = [
            'supervision_reports', 'phone_reports', 'supervision_products'
        ];
        // Coordinador de supervisión
        foreach ($rolCoordinatorSupervisorsPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_supervision'),
                    'permission_id' => $value->id

                ]);
            }
        }
        //Apoyo se supervisión
        foreach ($rolSupportSupervisorsPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.apoyo_supervision'),
                    'permission_id' => $value->id

                ]);
            }
        }
        // //Admin
        $rolAdminPermissionsAssign = [
            'psychosocialinstructions',
            'psychopedagogicallogs',
            'inscriptions',
            'methodologicalInstructions',
            'pecs',
            'binnacles',
            'binnacleManagers',

            'pollDesertions',
            'pedagogicals',
            'managermonitorings',
            'dialoguetables',
            'reports',
            'culturalEnsembles',
            'culturalCirculations', //CIRCULACIÓN CULTURA
            'culturalSeedbeds', //SEMILLERO CULTURAL
            'supervisoryReports',
            'strengtheningTerritories',
            'strengtheningSuperMonIns',
            'strengtheningSupervisionMans',
            'strengtheningOfMonitorings',
            'monitoringReports',
            'methodologicalMonitorings',
            'methodologicalAccompaniments',
            'methodologicalStrengthenings',
            'culturalShows',
            'groups'
        ];

        foreach ($rolAdminPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.root'),
                    'permission_id' => $value->id

                ]);
            }
        }

        $roles_permission_send = [2, 3, 6, 4, 9, 13, 17, 18,]; //id de todos los roles que revisan
        foreach ($roles_permission_send as $value) {
            PermissionRole::create([
                'role_id' =>  $value,
                'permission_id' => $modules[6]
            ]);
        }

        foreach ($modules as $value) {
            if ($value != 4 && $value != 6 && $value != 8) {
                PermissionRole::create([
                    'role_id' => config('roles.root'),
                    'permission_id' => $value

                ]);
            }
        }

        // Permisos de los nuevos formularios
        $permissionNewInstructors = [14, 15, 16];

        foreach ($permissionNewInstructors as $value) {
            PermissionRole::create([
                'role_id' => config('roles.instructor'),
                'permission_id' => $value
            ]);

            PermissionRole::create([
                'role_id' => config('roles.apoyo_al_seguimiento_monitoreo'),
                'permission_id' => $value
            ]);

            PermissionRole::create([
                'role_id' => config('roles.lider_instructor'),
                'permission_id' => $value
            ]);
        }

        //SHOW CULTURAL
        PermissionRole::create([
            'role_id' => 2,
            'permission_id' => 17
        ]);

        PermissionRole::create([
            'role_id' => 3,
            'permission_id' => 17
        ]);

        PermissionRole::create([
            'role_id' => 8,
            'permission_id' => 17
        ]);

        //APOYO METODOLÓGICO
        PermissionRole::create([
            'role_id' => config('roles.apoyo_metodologico'),
            'permission_id' => 17

        ]);
        PermissionRole::create([
            'role_id' => config('roles.apoyo_metodologico'),
            'permission_id' => 19

        ]);

        //LIDER METODOLÓGICO

        PermissionRole::create([
            'role_id' => config('roles.lider_metodológico'),
            'permission_id' => 20

        ]);

        // APOYO AL SEGUIMIENTO Y MONITOREO

        PermissionRole::create([
            'role_id' => config('roles.apoyo_al_seguimiento_monitoreo'),
            'permission_id' => 21

        ]);
        PermissionRole::create([
            'role_id' => config('roles.apoyo_al_seguimiento_monitoreo'),
            'permission_id' => 22

        ]);

        //APOYO A LA SUPERVISIÓN

        PermissionRole::create([
            'role_id' => config('roles.coordinador_supervision'),
            'permission_id' => 23

        ]);
        PermissionRole::create([
            'role_id' => config('roles.apoyo_supervision'),
            'permission_id' => 24

        ]);

        PermissionRole::create([
            'role_id' => config('roles.coordinador_supervision'),
            'permission_id' => 23

        ]);
        PermissionRole::create([
            'role_id' => config('roles.apoyo_supervision'),
            'permission_id' => 24
        ]);



        $rolFormInstructionsPermissionsAssign = [
            'culturalEnsembles',
            'culturalCirculations', //CIRCULACIÓN CULTURA
            'culturalSeedbeds', //SEMILLERO CULTURAL
        ];

        foreach ($rolFormInstructionsPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.instructor'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.apoyo_al_seguimiento_monitoreo'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.lider_instructor'),
                    'permission_id' => $value->id

                ]);
            }
        }


        $rolFormAmbassadorssPermissionsAssign = [
            'culturalShows',
        ];


        foreach ($rolFormAmbassadorssPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.embajador'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.lider_embajador'),
                    'permission_id' => $value->id

                ]);
            }
        }


        $rolFormMethodologicalSupportPermissionsAssign = [
            'methodologicalAccompaniments',
            'methodologicalStrengthenings'
        ];

        foreach ($rolFormMethodologicalSupportPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.apoyo_metodologico'),
                    'permission_id' => $value->id

                ]);
            }
        }


        $rolFormMethodologicalLeaderPermissionsAssign = [
            'methodologicalMonitorings'
        ];

        foreach ($rolFormMethodologicalLeaderPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {
                PermissionRole::create([
                    'role_id' => config('roles.lider_metodológico'),
                    'permission_id' => $value->id

                ]);
            }
        }


        $rolFormSupportAssuranceMonitoringPermissionsAssign = [
            'strengtheningOfMonitorings',
            'monitoringReports'
        ];

        foreach ($rolFormSupportAssuranceMonitoringPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.apoyo_al_seguimiento_monitoreo'),
                    'permission_id' => $value->id

                ]);
            }
        }

        $rolFormSupervisorySupportPermissionsAssign = [
            'strengtheningSuperMonIns',
            'strengtheningSupervisionMans'
        ];

        foreach ($rolFormSupervisorySupportPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_supervision'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.apoyo_supervision'),
                    'permission_id' => $value->id

                ]);
            }
        }

        $rolFormNewCoordinatorPermissionsAssign = [
            'strengtheningTerritories'

        ];

        foreach ($rolFormNewCoordinatorPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_metodologico'),
                    'permission_id' => $value->id

                ]);

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_administrativo'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.coordinador_psicosocial'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.coordinador_supervision'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.subdireccion'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.direccion'),
                    'permission_id' => $value->id

                ]);
            }
        }

        $rolFormSupervisoryReportsPermissionsAssign = [
            'supervisoryReports'
        ];

        foreach ($rolFormSupervisoryReportsPermissionsAssign as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.coordinador_supervision'),
                    'permission_id' => $value->id

                ]);
                PermissionRole::create([
                    'role_id' => config('roles.direccion'),
                    'permission_id' => $value->id

                ]);
            }
        }

        //Permisos de encuesta
        $permissions = Permission::whereIn('id', [109, 110])->select('id')->get();
        $rolePolls = Role::all()->except([1, 2, 12]);
        foreach ($permissions as $value) {
            foreach ($rolePolls  as  $rol) {
                PermissionRole::create([
                    'role_id' =>  $rol->id,
                    'permission_id' => $value->id

                ]);
            }
        }


        foreach ($rolePolls  as  $rol) {
            PermissionRole::create([
                'role_id' =>  $rol->id,
                'permission_id' => $modules[3]

            ]);
        }

        $secretaryCulturalPermissions = ['reports'];


        foreach ($secretaryCulturalPermissions as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {

                PermissionRole::create([
                    'role_id' => config('roles.secretaria_cultura'),
                    'permission_id' => $value->id

                ]);
            }
        }

        $rolSubdirection = [
            'reportsTerritories',
            'subdireccion'
        ];

        foreach ($rolSubdirection as $value) {
            $permissions = Permission::select('id')->where('slug', 'LIKE', '%' . $value . '%')->get();
            foreach ($permissions  as  $value) {
                PermissionRole::create([
                    'role_id' => config('roles.subdireccion'),
                    'permission_id' => $value->id
                ]);
            }
        }
    }
}
