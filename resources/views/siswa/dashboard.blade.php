@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<section class="bg-gradient-to-r from-primary-700 to-primary-900 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-2xl lg:text-3xl font-extrabold text-white">Dashboard Siswa</h1>
        <p class="text-primary-200 mt-1">Selamat datang, {{ Auth::user()->name }}</p>
    </div>
</section>

<section class="py-8">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Info Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border p-5">
                <div class="text-sm text-gray-500">Kelas</div>
                <div class="text-2xl font-extrabold text-gray-900 mt-1">{{ $student->class?->name ?? '-' }}</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border p-5">
                <div class="text-sm text-gray-500">NISN</div>
                <div class="text-2xl font-extrabold text-gray-900 mt-1">{{ $student->nisn ?? '-' }}</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border p-5">
                <div class="text-sm text-gray-500">Prestasi</div>
                <div class="text-2xl font-extrabold text-primary-600 mt-1">{{ $prestasi->count() }}</div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border p-5">
                <div class="text-sm text-gray-500">Status PPDB</div>
                <div class="text-lg font-extrabold mt-1 {{ $ppdb ? ($ppdb->status === 'Lulus' ? 'text-green-600' : 'text-amber-600') : 'text-gray-400' }}">
                    {{ $ppdb ? $ppdb->status : 'Tidak Terdaftar' }}
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Left Column --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Jadwal Pelajaran --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4 flex items-center gap-2">
                        <i data-feather="calendar" class="w-5 h-5 text-primary-600"></i>
                        Jadwal Pelajaran
                    </h2>
                    @php $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; @endphp
                    <div class="space-y-4">
                        @foreach($days as $day)
                        <div>
                            <h3 class="text-sm font-bold text-gray-700 mb-2">{{ $day }}</h3>
                            @if(isset($jadwal[$day]) && $jadwal[$day]->count())
                            <div class="space-y-2">
                                @foreach($jadwal[$day] as $j)
                                <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-3">
                                    <div class="text-xs font-bold text-primary-700 bg-primary-100 px-2 py-1 rounded">
                                        {{ \Carbon\Carbon::parse($j->start_time)->format('H:i') }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm font-medium text-gray-900">{{ $j->subject->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $j->teacher?->name }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-xs text-gray-400">Tidak ada pelajaran</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Materi & Tugas --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4 flex items-center gap-2">
                        <i data-feather="book-open" class="w-5 h-5 text-primary-600"></i>
                        Materi & Tugas
                    </h2>
                    @if($materi->count())
                    <div class="space-y-3">
                        @foreach($materi as $m)
                        <div class="border rounded-xl p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="text-sm font-semibold text-gray-900">{{ $m->title }}</div>
                                    <div class="text-xs text-gray-500 mt-1">{{ $m->subject?->name }} — {{ $m->teacher?->name }}</div>
                                </div>
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $m->type === 'tugas' ? 'bg-amber-50 text-amber-700' : 'bg-blue-50 text-blue-700' }}">
                                    {{ $m->type === 'tugas' ? 'Tugas' : 'Materi' }}
                                </span>
                            </div>
                            @if($m->description)
                            <p class="text-xs text-gray-500 mt-2">{{ Str::limit($m->description, 100) }}</p>
                            @endif
                            @if($m->deadline)
                            <div class="text-xs text-red-500 mt-2 flex items-center gap-1">
                                <i data-feather="alert-circle" class="w-3 h-3"></i>
                                Deadline: {{ $m->deadline->format('d M Y') }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada materi atau tugas.</p>
                    @endif
                </div>
            </div>

            {{-- Right Column --}}
            <div class="space-y-6">
                {{-- Prestasi --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4">Prestasiku</h2>
                    @if($prestasi->count())
                    <div class="space-y-3">
                        @foreach($prestasi as $p)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-yellow-100 text-yellow-700 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i data-feather="award" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $p->title }}</div>
                                <div class="text-xs text-gray-500">{{ $p->level }} — {{ $p->category }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada prestasi tercatat.</p>
                    @endif
                </div>

                {{-- Quick Links --}}
                <div class="bg-white rounded-2xl shadow-sm border p-6">
                    <h2 class="text-lg font-extrabold text-gray-900 mb-4">Menu Cepat</h2>
                    <div class="space-y-2">
                        <a href="{{ route('front.berita.index') }}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <i data-feather="book-open" class="w-5 h-5 text-primary-600"></i>
                            <span class="text-sm font-medium text-gray-700">Berita Sekolah</span>
                        </a>
                        <a href="{{ route('front.galeri') }}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <i data-feather="image" class="w-5 h-5 text-primary-600"></i>
                            <span class="text-sm font-medium text-gray-700">Galeri Kegiatan</span>
                        </a>
                        <a href="{{ route('front.kalender') }}" class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <i data-feather="calendar" class="w-5 h-5 text-primary-600"></i>
                            <span class="text-sm font-medium text-gray-700">Kalender Akademik</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
