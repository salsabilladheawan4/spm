<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PengaduanBaruNotification extends Notification
{
    use Queueable;

    protected $pengaduan;

    public function __construct($pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title'   => 'Pengaduan Baru',
            'message' => 'Ada pengaduan baru dari warga',
            'url'     => route('pengaduan.show', $this->pengaduan->pengaduan_id),
            'type'    => 'pengaduan'
        ];
    }
}
