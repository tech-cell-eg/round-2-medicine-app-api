<?php

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $body;
    public $user;

    public function __construct($user, $title, $body)
    {
        $this->user = $user;
        $this->title = $title;
        $this->body = $body;
    }

    public function broadcastOn()
    {
        return ['notifications-channel'];
    }

    public function broadcastAs()
    {
        return 'notification-event';
    }
}
