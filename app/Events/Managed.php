<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Managed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The management instace.
     *
     * @return void
     */
    public $receptor;
    public $sender;
    public $title;
    public $description;
    public $notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($receptor, $sender, $title, $description)
    {
        $this->receptor = $receptor;
        $this->sender = $sender;
        $this->title = $title;
        $this->description = $description;
    }
}
