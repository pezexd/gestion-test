<?php

namespace App\Providers;

use App\Events\Managed;
use App\Listeners\SendManagementNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\Binnacle;
use App\Models\DialogueTables\DialogueTable;
use App\Models\Inscriptions\Inscription;
use App\Models\Inscriptions\Pec;
use App\Models\ManagerMonitoring;
use App\Models\MethodologicalInstructionModel;
use App\Models\ParentSchools\ParentSchool;
use App\Models\Pedagogical;
use App\Models\PsychopedagogicalLogbooks\PsychopedagogicalLogbook;
use App\Models\PsychosocialInstructions\PsychosocialInstruction;
use App\Observers\V1\BinnacleObserver;
use App\Observers\V1\InscriptionObserver;
use App\Observers\V1\Manager\DialogueTableObserver;
use App\Observers\V1\Manager\ManagerMonitoringObserver;
use App\Observers\V1\Manager\MethodologicalInstructionModelObserver;
use App\Observers\V1\PecObserver;
use App\Observers\V1\PedagogicalObserver;
use App\Observers\V1\Psychosocial\ParentSchoolObserver;
use App\Observers\V1\Psychosocial\PsychopedagogicalLogbookObserver;
use App\Observers\V1\Psychosocial\PsychosocialInstructionObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Managed::class => [
            SendManagementNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // User::observe(UserObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }


    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        //Monitor
        Binnacle::class =>[BinnacleObserver::class],
        Inscription::class =>[InscriptionObserver::class],
        Pec::class =>[PecObserver::class],
        Pedagogical::class =>[PedagogicalObserver::class],
        //Maganer
        DialogueTable::class=>[DialogueTableObserver::class],
        ManagerMonitoring::class=>[ManagerMonitoringObserver::class],
        MethodologicalInstructionModel::class =>[MethodologicalInstructionModelObserver::class],
        //Psychosocial
        ParentSchool::class =>[ParentSchoolObserver::class],
        PsychopedagogicalLogbook::class =>[PsychopedagogicalLogbookObserver::class],
        PsychosocialInstruction::class =>[PsychosocialInstructionObserver::class]

    ];
}
