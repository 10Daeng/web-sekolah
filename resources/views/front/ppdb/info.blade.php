@extends('layouts.app')
@php
$jalurList = [
    ['nama' => 'Zonasi', 'icon' => 'map-pin', 'warna' => 'bg-blue-50 border-blue-200 text-blue-700', 'kuota' => '50%', 'syarat' => [
        'Kartu Keluarga (KK) asli',
        'Domisili sesuai zona sekolah',
        'Usia minimal 6 tahun per 1 Juli 2026',
        'Terdaftar di sistem Dapodik'
    ]],
    ['nama' => 'Prestasi', 'icon' => 'award', 'warna' => 'bg-amber-50 border-amber-200 text-amber-700', 'kuota' => '30%', 'syarat' => [
        'Sertifikat/piagam prestasi (minimal tingkat kabupaten)',
        'Kartu Keluarga (KK)',
        'Usia minimal 6 tahun per 1 Juli 2026',
        'Surat rekomendasi dari sekolah asal (jika TK)'
    ]],
    ['nama' => 'Afirmasi', 'icon' => 'heart', 'warna' => 'bg-red-50 border-red-200 text-red-700', 'kuota' => '15%', 'syarat' => [
        'Kartu Keluarga (KK)',
        'Surat keterangan tidak mampu (SKTM)',
        'Kartu PKH/KIP/KKS (jika ada)',
        'Usia minimal 6 tahun per 1 Juli 2026'
    ]],
    ['nama' => 'Mutasi', 'icon' => 'refresh-cw', 'warna' => 'bg-green-50 border-green-200 text-green-700', 'kuota' => '5%', 'syarat' => [
        'Surat pindah tugas orang tua',
        'Surat mutasi dari sekolah asal',
        'Kartu Keluarga (KK) asli',
        'Rapor dari sekolah asal'
    ]],
];

$timeline = [
    ['tanggal' => '1 Mei - 30 Juni 2026', 'label' => 'Pendaftaran Online', 'icon' => 'edit-3', 'aktif' => true],
    ['tanggal' => '1 - 5 Juli 2026', 'label' => 'Verifikasi Berkas', 'icon' => 'check-circle', 'aktif' => false],
    ['tanggal' => '6 - 8 Juli 2026', 'label' => 'Masa Sanggah', 'icon' => 'alert-circle', 'aktif' => false],
    ['tanggal' => '10 Juli 2026', 'label' => 'Pengumuman Hasil', 'icon' => 'volume-2', 'aktif' => false],
    ['tanggal' => '15 - 16 Juli 2026', 'label' => 'Daftar Ulang', 'icon' => 'user-check', 'aktif' => false],
];
@endphp

@section('title', 'Informasi PPDB')

@section('content')
{{-- Page Header --}}
<section class="bg-gradient-to-r from-accent-400 to-accent-600 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <span class="bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">TA 2026/2027</span>
        <h1 class="text-3xl lg:text-4xl font-extrabold text-white mt-3 mb-3">Penerimaan Peserta Didik Baru</h1>
        <p class="text-white/80 max-w-xl mx-auto">{{ config('app.sekolah.nama_pendek', 'SDN Contoh') }} resmi membuka pendaftaran untuk tahun ajaran 2026/2027</p>
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
            <a href="{{ route('ppdb.daftar') }}" class="inline-flex items-center gap-2 bg-white text-primary-700 font-bold px-8 py-3.5 rounded-xl hover:bg-gray-100 transition-colors shadow-lg text-lg">
                Daftar Sekarang
                <i data-feather="arrow-right" class="w-5 h-5"></i>
            </a>
            <a href="{{ route('ppdb.cek-status') }}" class="inline-flex items-center gap-2 bg-primary-700 text-white font-bold px-8 py-3.5 rounded-xl hover:bg-primary-800 transition-colors shadow-lg text-lg">
                Cek Status
                <i data-feather="search" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
</section>

@if(session('registration_success'))
<section class="py-6 bg-green-50 border-b border-green-100">
    <div class="max-w-4xl mx-auto px-4">
        <div class="flex items-start gap-3 bg-white rounded-xl p-4 shadow-sm border border-green-200">
            <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <i data-feather="check-circle" class="w-5 h-5"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-900">Pendaftaran Berhasil!</h3>
                <p class="text-sm text-gray-600 mt-1">Nomor registrasi Anda: <span class="font-mono font-bold text-primary-600 text-lg">{{ session('registration_number') }}</span></p>
                <p class="text-xs text-gray-500 mt-1">Simpan nomor registrasi untuk mengecek status pendaftaran.</p>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Timeline --}}
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-2xl font-extrabold text-gray-900 text-center mb-8">Alur Pendaftaran</h2>
        <div class="relative">
            {{-- Line --}}
            <div class="hidden lg:block absolute top-8 left-0 right-0 h-1 bg-gray-200"></div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach($timeline as $index => $item)
                <div class="relative text-center">
                    <div class="w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-3 {{ $item['aktif'] ? 'bg-primary-600 text-white shadow-lg' : 'bg-gray-200 text-gray-500' }}">
                        <i data-feather="{{ $item['icon'] }}" class="w-6 h-6"></i>
                    </div>
                    <div class="font-bold text-sm text-gray-900">{{ $item['label'] }}</div>
                    <div class="text-xs text-gray-500 mt-1">{{ $item['tanggal'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Jalur PPDB --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4">
        <h2 class="text-2xl font-extrabold text-gray-900 text-center mb-2">Jalur Pendaftaran</h2>
        <p class="text-gray-500 text-center mb-8">Pilih jalur yang sesuai dengan kriteria calon peserta didik</p>

        <div class="space-y-6" x-data="{ expanded: 0 }">
            @foreach($jalurList as $i => $jalur)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border {{ $jalur['warna'] }}">
                <button @click="expanded = (expanded === {{ $i }} ? -1 : {{ $i }})" class="w-full flex items-center justify-between p-5 text-left">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-white shadow-sm">
                            <i data-feather="{{ $jalur['icon'] }}" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">{{ $jalur['nama'] }}</h3>
                            <p class="text-sm opacity-70">Kuota: {{ $jalur['kuota'] }} dari daya tampung</p>
                        </div>
                    </div>
                    <i data-feather="chevron-down" class="w-5 h-5 transition-transform" :class="expanded === {{ $i }} ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="expanded === {{ $i }}" x-transition class="px-5 pb-5 border-t">
                    <h4 class="font-semibold text-sm mb-2 mt-4">Persyaratan:</h4>
                    <ul class="space-y-2">
                        @foreach($jalur['syarat'] as $syarat)
                        <li class="flex items-start gap-2 text-sm">
                            <i data-feather="check-circle" class="w-4 h-4 flex-shrink-0 mt-0.5 text-green-600"></i>
                            <span>{{ $syarat }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Persyaratan Umum --}}
<section class="py-12 bg-white">
    <div class="max-w-5xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-8">
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Persyaratan Umum</h2>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-gray-600">
                        <div class="w-7 h-7 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">1</div>
                        <span>Calon peserta didik berusia minimal 6 (enam) tahun pada tanggal 1 Juli 2026. Pengecualian usia paling rendah 5 tahun 6 bulan bagi yang memiliki potensi kecerdasan dan/atau bakat istimewa.</span>
                    </li>
                    <li class="flex items-start gap-3 text-gray-600">
                        <div class="w-7 h-7 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">2</div>
                        <span>Mengisi formulir pendaftaran online dengan lengkap dan benar.</span>
                    </li>
                    <li class="flex items-start gap-3 text-gray-600">
                        <div class="w-7 h-7 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">3</div>
                        <span>Mengupload dokumen yang dipersyaratkan sesuai jalur pendaftaran.</span>
                    </li>
                    <li class="flex items-start gap-3 text-gray-600">
                        <div class="w-7 h-7 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">4</div>
                        <span>Bersedia mematuhi seluruh ketentuan dan tata tertib yang berlaku di sekolah.</span>
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-gray-900 mb-6">Berkas yang Harus Diupload</h2>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-10 h-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-feather="file-text" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 text-sm">Kartu Keluarga (KK)</div>
                            <div class="text-xs text-gray-500">Scan/foto asli, format JPG/PDF, max 5MB</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-feather="file-text" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 text-sm">Akta Kelahiran</div>
                            <div class="text-xs text-gray-500">Scan/foto asli, format JPG/PDF, max 5MB</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-feather="file-text" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 text-sm">Ijazah/SKL TK</div>
                            <div class="text-xs text-gray-500">Scan/foto asli, format JPG/PDF, max 5MB (jika sudah ada)</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                        <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-feather="image" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900 text-sm">Pas Foto Calon Siswa</div>
                            <div class="text-xs text-gray-500">Background merah/biru, format JPG, max 2MB</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center mt-12">
            <a href="{{ route('ppdb.daftar') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-accent-500 to-accent-600 text-white font-bold px-8 py-4 rounded-xl hover:from-accent-600 hover:to-accent-700 transition-all shadow-lg text-lg">
                Daftar PPDB Sekarang
                <i data-feather="arrow-right" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
</section>
@endsection
