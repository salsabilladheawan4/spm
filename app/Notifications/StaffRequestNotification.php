<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StaffRequestNotification extends Notification
{
    use Queueable;

    public function __construct(public $message, public $url) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => 'Permohonan Staff',
            'message' => $this->message,
            'url'     => $this->url,
            'icon'    => 'ti ti-user-plus',
            'type'    => 'user'
        ];
    }
}
