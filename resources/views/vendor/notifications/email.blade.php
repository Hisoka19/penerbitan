@component('mail::message')
<div style="text-align:center; margin-bottom:24px;">
    <img src="{{ asset('images/Logo.png') }}" alt="Logo" style="height:64px; margin-bottom:16px;">
</div>

# Verifikasi Email Anda

Terima kasih telah mendaftar di {{ config('app.name') }}!

Silakan klik tombol di bawah ini untuk memverifikasi alamat email Anda dan mengaktifkan akun:

@component('mail::button', ['url' => $actionUrl])
Verifikasi Email
@endcomponent

Jika Anda tidak membuat akun, abaikan email ini.

Salam,
{{ config('app.name') }}
@endcomponent

<style>
body {
    font-family: 'Inter', Arial, sans-serif;
    background: #f9fafb;
}
.mail-header {
    color: #5271FF;
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 16px;
}
.mail-content {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(82,113,255,0.08);
}
.mail-footer {
    color: #888;
    font-size: 12px;
    margin-top: 32px;
}
</style>
