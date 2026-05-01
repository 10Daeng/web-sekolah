@extends('admin.layout')

@section('title', 'Pengaturan Sekolah')
@section('page_title', 'Pengaturan Sekolah')

@section('content')
@php
$tabs = ['identitas' => 'Identitas Sekolah', 'kontak' => 'Kontak & Lokasi', 'logo' => 'Logo & Branding', 'akademik' => 'Akademik', 'sosmed' => 'Sosial Media'];
$activeTab = request('tab', 'identitas');
$s = $settings ?? collect();
$val = fn($key, $default = '') => $s->get($key, $defaults[$key] ?? $default);
@endphp

<div class="max-w-4xl mx-auto">
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-center gap-3">
        <i data-feather="check-circle" class="w-5 h-5 text-green-600"></i>
        <span class="text-green-700 font-medium">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Tabs --}}
    <div class="flex gap-1 bg-white rounded-xl p-1 shadow-sm border mb-6 overflow-x-auto">
        @foreach($tabs as $key => $label)
        <a href="?tab={{ $key }}" class="flex-1 px-4 py-2.5 rounded-lg text-sm font-medium transition-all whitespace-nowrap text-center {{ $activeTab === $key ? 'bg-primary-600 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border p-6 space-y-5">
        @csrf
        @method('PUT')
        <input type="hidden" name="tab" value="{{ $activeTab }}">

        @if($activeTab === 'identitas')
        <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Identitas Sekolah</h3>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Sekolah</label>
                <input type="text" name="nama" value="{{ $val('nama') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Pendek</label>
                <input type="text" name="nama_pendek" value="{{ $val('nama_pendek') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tagline</label>
            <input type="text" name="tagline" value="{{ $val('tagline') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
        </div>
        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">NPSN</label>
                <input type="text" name="npsn" value="{{ $val('npsn') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Akreditasi</label>
                <select name="akreditasi" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                    <option value="A" {{ $val('akreditasi') === 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $val('akreditasi') === 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $val('akreditasi') === 'C' ? 'selected' : '' }}>C</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun Berdiri</label>
                <input type="number" name="tahun_berdiri" value="{{ $val('tahun_berdiri') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kepala Sekolah</label>
            <input type="text" name="kepala_sekolah" value="{{ $val('kepala_sekolah') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
        </div>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visi</label>
                <textarea name="visi" rows="3" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm resize-none">{{ $val('visi') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Misi</label>
                <textarea name="misi" rows="5" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm resize-none">{{ $val('misi') }}</textarea>
            </div>
        </div>
        @endif

        @if($activeTab === 'kontak')
        <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Kontak & Lokasi</h3>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon</label>
                <input type="text" name="telp" value="{{ $val('telp') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ $val('email') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Lengkap</label>
            <textarea name="alamat" rows="2" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm resize-none">{{ $val('alamat') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Singkat</label>
            <input type="text" name="alamat_singkat" value="{{ $val('alamat_singkat') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
        </div>
        @endif

        @if($activeTab === 'logo')
        <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Logo & Branding</h3>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Upload Logo</label>
            <input type="file" name="logo_file" accept="image/*" class="text-sm file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            @if($val('logo'))
            <div class="mt-3">
                <img src="{{ $val('logo') }}" alt="Current Logo" class="w-20 h-20 object-contain border rounded-lg">
            </div>
            @endif
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Inisial Logo</label>
            <input type="text" name="logo_initials" value="{{ $val('logo_initials', 'S') }}" maxlength="1" class="w-16 px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm text-center text-lg font-bold">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Upload Favicon</label>
            <input type="file" name="favicon_file" accept="image/*" class="text-sm file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
        </div>
        @endif

        @if($activeTab === 'akademik')
        <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Pengaturan Akademik</h3>
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun Ajaran Aktif</label>
                <input type="text" name="tahun_ajaran_aktif" value="{{ $val('tahun_ajaran_aktif', '2026/2027') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Semester Aktif</label>
                <select name="semester_aktif" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
                    <option value="1" {{ $val('semester_aktif') === '1' ? 'selected' : '' }}>Semester 1 (Ganjil)</option>
                    <option value="2" {{ $val('semester_aktif') === '2' ? 'selected' : '' }}>Semester 2 (Genap)</option>
                </select>
            </div>
        </div>
        <div class="grid sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Siswa</label>
                <input type="number" name="statistik.siswa" value="{{ $val('statistik.siswa', 650) }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Guru</label>
                <input type="number" name="statistik.guru" value="{{ $val('statistik.guru', 35) }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jumlah Prestasi</label>
                <input type="number" name="statistik.prestasi" value="{{ $val('statistik.prestasi', 120) }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
            </div>
        </div>
        @endif

        @if($activeTab === 'sosmed')
        <h3 class="text-lg font-extrabold text-gray-900 pb-4 border-b">Social Media</h3>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Facebook</label>
            <input type="url" name="social.facebook" value="{{ $val('social.facebook') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instagram</label>
            <input type="url" name="social.instagram" value="{{ $val('social.instagram') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">YouTube</label>
            <input type="url" name="social.youtube" value="{{ $val('social.youtube') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1.5">TikTok</label>
            <input type="url" name="social.tiktok" value="{{ $val('social.tiktok') }}" class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 outline-none text-sm">
        </div>
        @endif

        <div class="flex items-center justify-end gap-3 pt-4 border-t">
            <button type="submit" class="px-8 py-3 bg-primary-600 text-white font-bold rounded-xl hover:bg-primary-700 transition-colors shadow-md text-sm">
                Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
