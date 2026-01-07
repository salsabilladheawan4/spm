<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PenilaianBaruNotification extends Notification
{
    use Queueable;

    protected $penilaian;

    public function __construct($penilaian)
    {
        $this->penilaian = $penilaian;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title'   => 'Penilaian Layanan Baru',
            'message' => 'Ada penilaian baru dengan rating ' . $this->penilaian->rating,
            'url'     => route('penilaian.index'),
            'type'    => 'penilaian'
        ];
    }
}
