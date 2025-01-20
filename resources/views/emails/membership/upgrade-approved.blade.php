@component('mail::message')
# Permintaan Upgrade Membership Disetujui

Dear {{ $outlet->outlet_name }},

Permintaan upgrade membership Anda telah disetujui.

**Detail Perubahan:**
- Membership Lama: {{ $oldMembership->membership_name }}
- Membership Baru: {{ $newMembership->membership_name }}
- Tanggal Persetujuan: {{ now()->format('d/m/Y H:i') }}

Anda sekarang dapat menikmati semua fitur dari membership baru Anda.

Terima kasih telah menggunakan layanan kami.

Salam,<br>
{{ config('app.name') }}
@endcomponent
