@extends('layouts.app')

@section('title', 'Dashboard Guru')

@section('content')
<section class="bg-gradient-to-r from-primary-700 to-primary-900 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl lg:text-3xl font-extrabold text-white">Dashboard Guru</h1>
        <p class="text-primary-200 mt-1">Selamat datang, {{ Auth::user()->name }}</p>
    </div>
</section>

<section class="py-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Jadwal Hari Ini --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4 flex items-center gap-2">
                        <i data-feather="calendar" class="w-5 h-5 text-primary-600"></i>
                        Jadwal Mengajar Hari Ini ({{ now()->locale('id')->dayName }})
                    </h2>
                    @if($jadwalHariIni->count())
                    <div class="space-y-3">
                        @foreach($jadwalHariIni as $j)
                        <div class="flex items-center gap-4 bg-gray-50 rounded-xl p-4">
                            <div class="bg-primary-100 text-primary-700 px-3 py-2 rounded-lg text-sm font-bold">
                                {{ \Carbon\Carbon::parse($j->start_time)->format('H:i') }}
                            </div>
                            <div class="flex-1">
                                <div class="font-semibold text-gray-900">{{ $j->subject->name }}</div>
                                <div class="text-sm text-gray-500">Kelas {{ $j->class->name }}</div>
                            </div>
                            <div class="text-sm text-gray-400">
                                {{ \Carbon\Carbon::parse($j->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->end_time)->format('H:i') }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="text-center py-8 text-gray-500">
                        <i data-feather="coffee" class="w-10 h-10 mx-auto mb-2 opacity-50"></i>
                        <p>Tidak ada jadwal mengajar hari ini.</p>
                    </div>
                    @endif
                </div>

                {{-- Jadwal Mingguan --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4">Jadwal Mingguan</h2>
                    @php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; @endphp
                    <div class="space-y-4">
                        @foreach($days as $day)
                        <div>
                            <h3 class="text-sm font-bold text-gray-700 mb-2">{{ $day }}</h3>
                            @if(isset($jadwalSemua[$day]) && $jadwalSemua[$day]->count())
                            <div class="flex flex-wrap gap-2">
                                @foreach($jadwalSemua[$day] as $j)
                                <span class="inline-flex items-center gap-1 bg-primary-50 text-primary-700 text-xs font-medium px-3 py-1.5 rounded-lg">
                                    {{ $j->subject->name }} ({{ $j->class->name }}) — {{ \Carbon\Carbon::parse($j->start_time)->format('H:i') }}
                                </span>
                                @endforeach
                            </div>
                            @else
                            <p class="text-xs text-gray-400">Tidak ada jadwal</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-6">
                {{-- Quick Actions --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4">Aksi Cepat</h2>
                    <div class="space-y-2">
                        <a href="/admin/documents/create" class="flex items-center gap-3 p-3 bg-primary-50 rounded-xl hover:bg-primary-100 transition-colors">
                            <i data-feather="upload-cloud" class="w-5 h-5 text-primary-600"></i>
                            <span class="text-sm font-medium text-primary-700">Upload Materi/Tugas</span>
                        </a>
                        <a href="/admin/achievements/create" class="flex items-center gap-3 p-3 bg-green-50 rounded-xl hover:bg-green-100 transition-colors">
                            <i data-feather="trophy" class="w-5 h-5 text-green-600"></i>
                            <span class="text-sm font-medium text-green-700">Input Prestasi Siswa</span>
                        </a>
                        <a href="/admin/schedules" class="flex items-center gap-3 p-3 bg-amber-50 rounded-xl hover:bg-amber-100 transition-colors">
                            <i data-feather="clock" class="w-5 h-5 text-amber-600"></i>
                            <span class="text-sm font-medium text-amber-700">Lihat Semua Jadwal</span>
                        </a>
                    </div>
                </div>

                {{-- Materi Terbaru --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4">Materi Terbaru</h2>
                    @if($materiTerbaru->count())
                    <div class="space-y-3">
                        @foreach($materiTerbaru as $m)
                        <div class="border rounded-xl p-3">
                            <div class="text-sm font-semibold text-gray-900">{{ $m->title }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ $m->subject?->name }} — Kelas {{ $m->class?->name }}</div>
                            <div class="text-xs text-gray-400 mt-1">{{ $m->created_at->diffForHumans() }}</div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada materi diupload.</p>
                    @endif
                </div>

                {{-- Prestasi Terbaru --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4">Prestasi Siswa</h2>
                    @if($prestasiTerbaru->count())
                    <div class="space-y-3">
                        @foreach($prestasiTerbaru as $p)
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-yellow-100 text-yellow-700 rounded-full flex items-center justify-center flex-shrink-0">
                                <i data-feather="award" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $p->title }}</div>
                                <div class="text-xs text-gray-500">{{ $p->student?->name }} — {{ $p->level }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada prestasi.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
