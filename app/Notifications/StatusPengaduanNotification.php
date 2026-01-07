<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class StatusPengaduanNotification extends Notification
{
    public function __construct(
        public $status,
        public $pengaduanId
    ) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => 'Status Pengaduan Diperbarui',
            'message' => 'Status pengaduan Anda sekarang: ' . strtoupper($this->status),
            'url'     => route('pengaduan.show', $this->pengaduanId),
            'icon'    => 'ti ti-refresh',
            'type'    => 'pengaduan'
        ];
    }
}
