<?php

namespace App\Notifications;

use App\Models\ModelOutlet;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MembershipExpirationReminder extends Notification
{
    use Queueable;

    protected $outlet;
    protected $daysLeft;

    public function __construct(ModelOutlet $outlet, $daysLeft)
    {
        $this->outlet = $outlet;
        $this->daysLeft = $daysLeft;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Digisoft Studio - Membership Akan Berakhir')
            ->greeting('Yth. Pemilik ' . $this->outlet->outlet_name)
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->line('🔔 Pengingat Membership')
            ->line("Membership {$this->outlet->membership->membership_name} Anda akan berakhir dalam {$this->daysLeft} hari.")
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->line('💳 Detail Membership')
            ->line("Tipe: {$this->outlet->membership->membership_name}")
            ->line("Berakhir pada: " . $this->outlet->membership_expires_at->format('d M Y'))
            ->line('Biaya Perpanjangan: Rp ' . number_format($this->outlet->membership->biaya_bulanan, 0, ',', '.'))
            ->action('Perpanjang Sekarang', url('/dashboard/outlet/upgrade-membership'))
            ->line('Perpanjang membership Anda sebelum berakhir untuk menghindari gangguan layanan.')
            ->line('Email ini dikirim secara otomatis.')
            ->salutation('Tim Digisoft Studio');
    }
}
