@component('mail::message')
# Pendaftar PPDB Baru

Seorang calon siswa baru telah melakukan pendaftaran PPDB:

@component('mail::panel')
**Nomor Registrasi:** {{ $registration->registration_number }}  
**Nama:** {{ $registration->name }}  
**NISN:** {{ $registration->nisn }}  
**Jalur:** {{ $registration->track }}  
**Tanggal Daftar:** {{ $registration->created_at->format('d M Y H:i') }}
@endcomponent

Silakan login ke panel admin untuk memverifikasi berkas pendaftar:

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Lihat Detail Pendaftar
@endcomponent

Terima kasih.

**Sistem Informasi Sekolah Terpadu (SIST)**
@endcomponent
