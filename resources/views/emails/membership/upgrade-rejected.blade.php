@component('mail::message')
# Permintaan Upgrade Membership Ditolak

Dear {{ $outlet->outlet_name }},

Mohon maaf, permintaan upgrade membership Anda ke {{ $requestedMembership->membership_name }} tidak dapat kami setujui saat ini.

**Detail:**
- Membership Saat Ini: {{ $outlet->membership->membership_name }}
- Membership Yang Diminta: {{ $requestedMembership->membership_name }}
- Tanggal Penolakan: {{ now()->format('d/m/Y H:i') }}

Silakan hubungi tim support kami untuk informasi lebih lanjut.

Terima kasih atas pengertiannya.

Salam,<br>
{{ config('app.name') }}
@endcomponent
