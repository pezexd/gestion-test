<?php

use App\Http\Controllers\V1\ModuleController;
use App\Http\Controllers\V1\ModuleItemController;
use App\Http\Controllers\V1\PermissionController;
use App\Http\Controllers\V1\PermissionRoleController;
use App\Http\Controllers\V1\RoleController;
use App\Http\Controllers\V1\RoleUserController;
use App\Http\Controllers\V1\UserController;
use App\Http\Controllers\V1\EntityNameController;
use App\Http\Controllers\V1\CulturalRightController;
use App\Http\Controllers\V1\ExpertiseController;
use App\Http\Controllers\V1\NeighborhoodController;
use App\Http\Controllers\V1\OrientationController;
use App\Http\Controllers\V1\AccessController;
use App\Http\Controllers\V1\AsistantController;
use App\Http\Controllers\V1\BinnacleController;
use App\Http\Controllers\V1\BinnacleManagerController;
use App\Http\Controllers\V1\MonthlyMonitoringReportsController;
use App\Http\Controllers\v1\DialogueTableController;
use App\Http\Controllers\V1\GeneralController;
use App\Http\Controllers\V1\Monitors\PecController;
use App\Http\Controllers\V1\NacController;
use App\Http\Controllers\V1\PedagogicalController;
use App\Http\Controllers\V1\PsychopedagogicalLogBookController;
use App\Http\Controllers\V1\ManagerMonitoringController;
use App\Http\Controllers\V1\MethodologicalInstructionController;
use App\Http\Controllers\V1\ManagementController;
use App\Http\Controllers\V1\Monitors\InscriptionController;
use App\Http\Controllers\V1\PollController;
use App\Http\Controllers\V1\PollDesertionController;
use App\Http\Controllers\V1\ProfileController;
use App\Http\Controllers\V1\MethodologicalSheetsOneController;
use App\Http\Controllers\V1\psychosocial\ParentSchoolController;
use App\Http\Controllers\V1\psychosocial\PsychosocialInstructionController;
use App\Http\Controllers\V1\ReportController;
use App\Http\Controllers\V1\PDFController as PDFController_V1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\BinnacleTerritorieController;
use App\Http\Controllers\V1\CulturalCirculationController;
use App\Http\Controllers\V1\CulturalEmsembleController;
use App\Http\Controllers\V1\CulturalSeedbedController;
use App\Http\Controllers\V1\CulturalShowController;
use App\Http\Controllers\V1\GroupController;
use App\Http\Controllers\V1\MethodologicalAccompanimentController;
use App\Http\Controllers\V1\MethodologicalMonitoringController;
use App\Http\Controllers\V1\MethodologicalStrengtheningController;
use App\Http\Controllers\V1\NotificationController;
use App\Http\Controllers\V1\StrengtheningOfMonitoringController;
use App\Http\Controllers\V1\StrengtheningSupervisionManagerController;
use App\Http\Controllers\V1\StrengtheningSupervisionMonitorsInstructorsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'verified'])->prefix('v1')->group(function () {
    Route::get('get-access', [AccessController::class, 'getAccess']);
    Route::post('have-access', [AccessController::class, 'userHaveAccess']);
    Route::get('get-permissions', [AccessController::class, 'getPermissions']);
    Route::get('get-button-boolean-creates', [AccessController::class, 'getButtonBooleanCreates']);

    Route::apiResources([
        'users' => UserController::class,
        'roles' => RoleController::class,
        'permissions' => PermissionController::class,
        'items' => ModuleItemController::class,
        'modules' => ModuleController::class,
        'roleUser' => RoleUserController::class,
        'permissionRole' => PermissionRoleController::class,
        'entitynames' => EntityNameController::class,
        'culturalrights' => CulturalRightController::class,
        'expertises' => ExpertiseController::class,
        'neighborhoods' => NeighborhoodController::class,
        'orientations' => OrientationController::class,
        'nacs' => NacController::class,
        'pedagogicals' => PedagogicalController::class,
        'managermonitorings' => ManagerMonitoringController::class,
        'polls' => PollController::class,
        'assistants' => AsistantController::class,
        'pollDesertions' => PollDesertionController::class,
        //parentschool => para actualizar un registro se debe usar el metodo POST con key PUT al final ya que solicita un form-data, igua para restore
        //parentschool ejemplo => 0.0.0.0:8000/api/v1/parentschool/2?_method=PUT 0.0.0.0:8000/api/v1/parentschool/1/restore?_method=PUT
        'parentschools' => ParentSchoolController::class,
        'profiles' => ProfileController::class,
        'methodologicalsheetsone' => MethodologicalSheetsOneController::class,
        // 'psychopedagogicallogs' => PsychopedagogicalLogBookController::class
        
        //Rutas de nuevos formularios
        'culturalEnsembles' => CulturalEmsembleController::class, //ENSAMBLE CULTURAL
        'culturalCirculations' => CulturalCirculationController::class, //CIRCULACIÓN CULTURA
        'culturalSeedbeds' => CulturalSeedbedController::class, //SEMILLERO CULTURAL
        'culturalShows' => CulturalShowController::class, //SHOW CULTURAL
        'methodologicalAccompaniments' => MethodologicalAccompanimentController::class, // ACOMPAÑAMIENTO METODOLÓGICO
        'methodologicalStrengthenings' => MethodologicalStrengtheningController::class, // FORTALECIMIENTO METODOLÓGICO
        'methodologicalMonitorings' => MethodologicalMonitoringController::class, //SEGUIMIENTO METODOLÓGICO
        'strengtheningOfMonitorings' => StrengtheningOfMonitoringController::class, // FORTALECIMINETO AL SEGUIMIENTO
        'monitoringReports' => MonthlyMonitoringReportsController::class, //INFORMES DE SEGUIMIENTO
        'strengtheningSuperMonIns' => StrengtheningSupervisionMonitorsInstructorsController::class, //FORTALECIMIENTO A LA SUPERVISIÓN MONITORES E INSTRUCTORES
        'strengtheningSupervisionMans' => StrengtheningSupervisionManagerController::class,  //FORTALECIMIENTO A LA SUPERVISIÓN GESTORES
        // 'strengtheningTerritories'=>StrengtheningTerritoryController::class, //FORTALECIMIENTO A TERRITORIOS
        // 'supervisoryReports'=>SupervisoryReportController::class, //INFORME DE SUPERVISIÓN
        'groups'=>GroupController::class
    ]);

    // Bitacora de visita territorio
    Route::apiResource('binnacle_territories', 'App\Http\Controllers\V1\BinnacleTerritorieController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('binnacle_territories/{id}', [BinnacleTerritorieController::class, 'update'])->name('binnacle_territories.update');
    Route::get('getAllByUserLogged', [BinnacleTerritorieController::class, 'getAllByUserLogged'])->name('binnacle_territories.getAllByUserLogged');
    Route::get('getRole/{id}', [BinnacleTerritorieController::class, 'getRoles'])->name('binnacle_territories.getRoles');
    Route::get('getUser/{id}', [BinnacleTerritorieController::class, 'getUsuarios'])->name('binnacle_territories.getUsuarios');

    Route::get('notifications', [NotificationController::class, 'get'])->name('notification.get');
    Route::get('notifications/authenticated', [NotificationController::class, 'getByAuthenticated'])->name('notification.authenticated');
    Route::put('notifications/markAsRead/{id}', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');
    Route::put('notifications/trash/{id}', [NotificationController::class, 'trash'])->name('notification.trash');

    //Bitacora monitor
    Route::apiResource('binnacles', 'App\Http\Controllers\V1\BinnacleController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('binnacles/{id}', [BinnacleController::class, 'update'])->name('binnacles.update');
    
    //Bitacora gestor
    Route::apiResource('binnacleManagers', 'App\Http\Controllers\V1\BinnacleManagerController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('binnacleManagers/{id}', [BinnacleManagerController::class, 'update'])->name('binnacleManagers.update');

    //Informe mensual
    Route::apiResource('monthly_monitoring_reports', 'App\Http\Controllers\V1\MonthlyMonitoringReportsController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('monthly_monitoring_reports/{id}', [MonthlyMonitoringReportsController::class, 'update'])->name('monthly_monitoring_reports.update');
    
    Route::get('get-data-selects', [GeneralController::class, 'getDataSelects']);
    Route::get('getChangeDataModels', [GeneralController::class, 'getChangeDataModels'])->name('changeDataModels.index');
    Route::get('getChangeDataModels/{id}', [GeneralController::class, 'getChangeDataModels'])->name('changeDataModels.show');
    Route::delete('destroyChangeDataModel/{id}', [GeneralController::class, 'destroyChangeDataModel'])->name('changeDataModels.destroy');
    Route::get('getGroupBeneficiaries/{id?}/', [GeneralController::class, 'getGroupBeneficiaries'])->name('getGroupBeneficiaries')->where(['id' => '[0-9]+']);

    Route::put('parentschools/{parentschool}/restore', [ParentSchoolController::class, 'restore'])->name('restoreParentSchool');
    // referencia Bitácora Psicopedagógica
    Route::apiResource('psychopedagogicallogs', 'App\Http\Controllers\V1\PsychopedagogicalLogBookController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('psychopedagogicallogs/{psychopedagogicallog}', [PsychopedagogicalLogBookController::class, 'update'])->name('psychopedagogicallogs.update');
    Route::put('psychopedagogicallogs/{psychopedagogicalog}/restore', [PsychopedagogicalLogBookController::class, 'restore'])->name('restorePsychopedagogicalLogBook');
    //references/monitors retorna lo monitores para parentschool
    Route::get('references/monitors', [ParentSchoolController::class, 'getMonitor'])->name('getMonitorParentSchool');
    //PEC
    Route::apiResource('pecs', 'App\Http\Controllers\V1\Monitors\PecController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('pecs/{pec}', [PecController::class, 'update'])->name('pecs.update');
    //Inscriptions
    Route::apiResource('inscriptions', 'App\Http\Controllers\V1\Monitors\InscriptionController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('inscriptions/{inscription}', [InscriptionController::class, 'update'])->name('inscriptions.update');

    Route::get('pecs/consecutive/generate', [PecController::class, 'getConsecutive']);
    Route::post('pecs/query/byRangeActvityDate', [PecController::class, 'getByRangeActivityDate']);

    // METHODOLOGICALINSTRUCTION
    Route::apiResource('methodologicalInstructions', 'App\Http\Controllers\V1\MethodologicalInstructionController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('methodologicalInstructions/{methodologicalInstruction}', [MethodologicalInstructionController::class, 'update'])->name('methodologicalInstructions.update');

    // DIALOGUETABLES
    Route::apiResource('dialoguetables', 'App\Http\Controllers\V1\DialogueTableController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('dialoguetables/{dialoguetable}', [DialogueTableController::class, 'update'])->name('dialoguetables.update');

    // USER
    Route::get('usersNoPaginate', [UserController::class, 'noPaginate']);

    // PROFILES
    Route::get('findByGestorId/{id}', [ProfileController::class, 'findByGestorId']);

    Route::get('config-clear', function () {
        Artisan::call('config:clear');
        echo '<a href=' . url('dashboard') . '>Se ha limpiado la configuración, volver al sistema.</a>';
    });
    Route::get('rollback', function () {
        Artisan::call('c:a');
        echo '<a href=' . url('dashboard') . '>Se ha limpiado la configuración, volver al sistema.</a>';
    });

    Route::get('get-data-selects', [GeneralController::class, 'getDataSelects']);
    Route::put('parentschools/{parentschool}/restore', [ParentSchoolController::class, 'restore'])->name('restoreParentSchool');
    //references/monitors retorna lo monitores para parentschool
    Route::get('references/monitors', [ParentSchoolController::class, 'getMonitor'])->name('getMonitorParentSchool');

    Route::get('psychosocialinstructions/consecutive/generate', [PsychosocialInstructionController::class, 'getConsecutive'])->name('getConsecutive');
    Route::apiResource('psychosocialinstructions', 'App\Http\Controllers\V1\psychosocial\PsychosocialInstructionController')->only(['index', 'store', 'show', 'destroy']);
    Route::post('psychosocialinstructions/{psychosocialinstruction}', [PsychosocialInstructionController::class, 'update'])->name('psychosocialinstructions.update');
    Route::post('pedagogicals/byRangeActvityDate', [PedagogicalController::class, 'getByRangeActivityDate']);
    Route::get('consecutive/generate/{table}/{abreviature}', [GeneralController::class, 'getConsecutive'])->name('getConsecutiveGenerate');
    Route::prefix('exports')->group(function () {
        Route::post('excel/{type_excel?}', [ReportController::class, 'exportExcel'])->name('exportExcel');
        Route::prefix('pdf')->group(function () {
            Route::post('parentschools/{type_pdf?}', [PDFController_V1::class, 'formateParentSchools']);
            Route::post('psychopedagogicallogs/{type_pdf?}', [PDFController_V1::class, 'formatePsychoPedagogicallogs']);
            Route::post('inscripcions/{type_pdf?}', [PDFController_V1::class, 'formatoInsformateInscriptionBeneficiaries']);
        });
    });

    Route::post('management', [ManagementController::class, 'send_management'])->name('send_management');
    Route::post('users/changePassword', [UserController::class, 'changePassword'])->name('users.changePassword');
    Route::post('users/changeStatus', [UserController::class, 'changeStatus'])->name('users.changeStatus');
    Route::get('getCountDataForm', [GeneralController::class, 'getDataForm'])->name('getDataForm');
    Route::get('getPollOnly', [GeneralController::class, 'getPollOnly'])->name('getPollOnly');
    Route::get('getGroups', [GroupController::class, 'getGroups'])->name('getGroups');
});
//Ruta de prueba

Route::get('get-data', [GeneralController::class, 'getData']);
Route::get('prueba', [BinnacleTerritorieController::class, 'index']);
