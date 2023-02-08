<?php

namespace App\Listeners;

use App\Events\Managed;
use App\Events\Notification;
use App\Models\Notification as ModelsNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendManagementNotification implements ShouldQueue
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\Managed  $event
     * @return void
     */
    public function handle(Managed $event)
    {
        ModelsNotification::create(array(
            'sender_id' => $event->sender,
            'receptor_id' => $event->receptor,
            'title' => $event->title,
            'description' => $event->description,
            'read' => 0,
            'trash' => 0,
        ));
    }
}
