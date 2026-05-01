@extends('admin.layout')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-extrabold text-gray-900 mb-6">Dashboard Admin</h1>
    
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
        $stats = [
            ['label' => 'Total Pendaftar PPDB', 'value' => \App\Models\Registration::count(), 'color' => 'primary'],
            ['label' => 'Siswa Aktif', 'value' => \App\Models\Student::where('status', 'active')->count(), 'color' => 'success'],
            ['label' => 'Guru & Staff', 'value' => \App\Models\Teacher::count(), 'color' => 'warning'],
            ['label' => 'Berita Publikasi', 'value' => \App\Models\Post::where('status', 'published')->count(), 'color' => 'info'],
        ];
        @endphp
        
        @foreach($stats as $stat)
        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <div class="text-sm text-gray-500">{{ $stat['label'] }}</div>
            <div class="text-3xl font-extrabold text-{{ $stat['color'] }}-600 mt-2">{{ $stat['value'] }}</div>
        </div>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <h2 class="text-lg font-extrabold text-gray-900 mb-4">Pendaftar PPDB Terbaru</h2>
            @php $latest = \App\Models\Registration::latest()->take(5)->get(); @endphp
            @forelse($latest as $r)
            <div class="flex items-center justify-between py-3 border-b last:border-0">
                <div>
                    <div class="text-sm font-medium text-gray-900">{{ $r->name }}</div>
                    <div class="text-xs text-gray-500">{{ $r->registration_number }} — {{ $r->track }}</div>
                </div>
                <span class="text-xs font-medium px-2.5 py-1 rounded-full
                    @if($r->status === 'Lulus') bg-green-100 text-green-700
                    @elseif($r->status === 'Pending') bg-gray-100 text-gray-700
                    @elseif($r->status === 'Diverifikasi') bg-blue-100 text-blue-700
                    @else bg-amber-100 text-amber-700 @endif">
                    {{ $r->status }}
                </span>
            </div>
            @empty
            <p class="text-sm text-gray-500 text-center py-4">Belum ada pendaftar.</p>
            @endforelse
        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <h2 class="text-lg font-extrabold text-gray-900 mb-4">Akses Cepat</h2>
            <div class="space-y-2">
                <a href="/admin/registrations" class="flex items-center gap-3 p-3 bg-primary-50 rounded-xl hover:bg-primary-100 transition-colors">
                    <i data-feather="clipboard" class="w-5 h-5 text-primary-600"></i>
                    <span class="text-sm font-medium text-primary-700">Kelola PPDB</span>
                </a>
                <a href="/admin/posts" class="flex items-center gap-3 p-3 bg-green-50 rounded-xl hover:bg-green-100 transition-colors">
                    <i data-feather="file-text" class="w-5 h-5 text-green-600"></i>
                    <span class="text-sm font-medium text-green-700">Berita & Pengumuman</span>
                </a>
                <a href="/admin/settings" class="flex items-center gap-3 p-3 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                    <i data-feather="settings" class="w-5 h-5 text-amber-600"></i>
                    <span class="text-sm font-medium text-amber-700">Pengaturan Sekolah</span>
                </a>
                <a href="/admin/audit-logs" class="flex items-center gap-3 p-3 bg-purple-50 rounded-xl hover:bg-purple-100 transition-colors">
                    <i data-feather="activity" class="w-5 h-5 text-purple-600"></i>
                    <span class="text-sm font-medium text-purple-700">Audit Log</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
