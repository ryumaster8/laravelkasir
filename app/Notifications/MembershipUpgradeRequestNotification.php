<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MembershipUpgradeRequestNotification extends Notification
{
    use Queueable;

    protected $request;
    protected $bankAccount;

    public function __construct($request, $bankAccount)
    {
        $this->request = $request;
        $this->bankAccount = $bankAccount;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Digisoft Studio - Konfirmasi Upgrade Membership')
            ->greeting("Yth. {$this->request->outlet->outlet_name},")
            ->line('Terima kasih telah mengajukan permintaan upgrade membership di Digisoft Studio.')
            ->line('Berikut adalah detail permintaan upgrade Anda:')
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->line('🔹 Detail Pembaruan Membership')
            ->line("Paket Saat Ini: {$this->request->currentMembership->membership_name}")
            ->line("Paket Yang Dipilih: {$this->request->requestedMembership->membership_name}")
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->line('💰 Informasi Pembayaran')
            ->line('Biaya Upgrade: Rp ' . number_format($this->request->change_fee, 0, ',', '.'))
            ->line('Biaya Bulanan: Rp ' . number_format($this->request->monthly_fee, 0, ',', '.'))
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->line('🏦 Informasi Rekening')
            ->line($this->bankAccount->getFormattedAccountAttribute())
            ->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━')
            ->action('Konfirmasi Pembayaran', url('/payment-confirmation/' . $this->request->request_id))
            ->line('Silakan lakukan pembayaran dan konfirmasi melalui tombol di atas.')
            ->line('Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi tim support kami.')
            ->salutation('Hormat kami,')
            ->salutation('Tim Digisoft Studio')
            ->theme('default'); // Only use theme, remove style method
    }
}
