@component('mail::message')
# Status PPDB Diperbarui

Halo **{{ $registration->name }}**,

Status pendaftaran PPDB Anda telah diperbarui:

@component('mail::panel')
**Nomor Registrasi:** {{ $registration->registration_number }}  
**Nama:** {{ $registration->name }}  
**Jalur:** {{ $registration->track }}  
**Status Sebelumnya:** {{ $previousStatus }}  
**Status Sekarang:** {{ $registration->status }}
@endcomponent

@if($registration->notes)
**Catatan dari Panitia:**
{{ $registration->notes }}
@endif

Anda dapat memeriksa status pendaftaran kapan saja melalui link berikut:

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Cek Status PPDB
@endcomponent

Terima kasih telah mendaftar di **{{ config('app.sekolah.nama') }}**.

Salam hormat,<br>
Tim PPDB {{ config('app.sekolah.nama_pendek') }}
@endcomponent
