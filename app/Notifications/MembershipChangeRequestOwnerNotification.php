<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MembershipChangeRequestOwnerNotification extends Notification
{
    use Queueable;

    protected $request;
    protected $outlet;

    public function __construct($request, $outlet)
    {
        $this->request = $request;
        $this->outlet = $outlet;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Digisoft Studio - Notifikasi Permintaan Perubahan Membership')
            ->greeting('Yth. Owner Digisoft Studio,')
            ->line('Terdapat permintaan perubahan membership baru dari:')
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->line('🏪 Detail Outlet')
            ->line("Nama Outlet: {$this->outlet->outlet_name}")
            ->line("Email: {$this->outlet->email}")
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->line('🔄 Detail Perubahan')
            ->line("Tipe: " . ucfirst($this->request->change_type))
            ->line("Dari: {$this->request->currentMembership->membership_name}")
            ->line("Ke: {$this->request->requestedMembership->membership_name}")
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->line('💰 Informasi Biaya')
            ->line('Biaya Perubahan: Rp ' . number_format($this->request->change_fee, 0, ',', '.'))
            ->line('Biaya Bulanan Baru: Rp ' . number_format($this->request->monthly_fee, 0, ',', '.'))
            ->action('Lihat Detail', url('/owner/membership/change-requests'))
            ->line('Email ini dikirim secara otomatis, tidak perlu dibalas.')
            ->salutation('Sistem Notifikasi Digisoft Studio');
    }
}
