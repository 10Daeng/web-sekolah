@extends('layouts.app')
@php
$eventList = [];
$grouped = $events->groupBy(fn ($event) => $event->start_date->format('F Y'));
foreach ($grouped as $bulan => $items) {
    $eventList[] = [
        'bulan' => $bulan,
        'events' => $items->map(fn ($event) => [
            'tanggal' => $event->end_date
                ? $event->start_date->format('j') . '-' . $event->end_date->format('j') . ' ' . $event->start_date->format('M')
                : $event->start_date->format('j M'),
            'event' => $event->title,
            'jenis' => $event->type,
        ])->toArray(),
    ];
}

$tipeWarna = [
    'akademik' => 'bg-blue-50 border-blue-400 text-blue-700',
    'ujian' => 'bg-amber-50 border-amber-400 text-amber-700',
    'kegiatan' => 'bg-green-50 border-green-400 text-green-700',
    'perayaan' => 'bg-purple-50 border-purple-400 text-purple-700',
    'keagamaan' => 'bg-teal-50 border-teal-400 text-teal-700',
    'libur' => 'bg-red-50 border-red-400 text-red-700',
    'rapat' => 'bg-gray-50 border-gray-400 text-gray-700',
    'ppdb' => 'bg-pink-50 border-pink-400 text-pink-700',
    'lainnya' => 'bg-gray-50 border-gray-400 text-gray-700',
];
@endphp

@section('title', 'Kalender Akademik')

@section('content')
{{-- Page Header --}}
<section class="bg-gradient-to-r from-primary-700 to-primary-900 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl lg:text-4xl font-extrabold text-white mb-3">Kalender Akademik</h1>
        <p class="text-primary-200 max-w-xl mx-auto">Jadwal kegiatan dan agenda penting tahun ajaran 2025/2026</p>
    </div>
</section>

{{-- Legend --}}
<section class="bg-white border-b py-4">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap gap-3 items-center text-xs">
            <span class="text-gray-500 mr-2">Keterangan:</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-blue-400"></span> Akademik</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-amber-400"></span> Ujian</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-green-400"></span> Kegiatan</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-purple-400"></span> Perayaan</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-teal-400"></span> Keagamaan</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-red-400"></span> Libur</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-gray-400"></span> Rapat</span>
            <span class="flex items-center gap-1.5"><span class="w-3 h-3 rounded bg-pink-400"></span> PPDB</span>
        </div>
    </div>
</section>

{{-- Calendar List --}}
<section class="py-12">
    <div class="max-w-4xl mx-auto px-4" x-data="{ activeBulan: null }">
        @foreach($eventList as $bln)
        <div class="mb-6" x-data="{ expanded: {{ $loop->first ? 'true' : 'false' }} }">
            {{-- Month Header --}}
            <button @click="expanded = !expanded" class="w-full flex items-center justify-between bg-white rounded-2xl p-5 shadow-sm border hover:shadow-md transition-shadow">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center">
                        <i data-feather="calendar" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-xl font-extrabold text-gray-900">{{ $bln['bulan'] }}</h3>
                    <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-1 rounded-full">{{ count($bln['events']) }} agenda</span>
                </div>
                <i data-feather="chevron-down" class="w-5 h-5 text-gray-400 transition-transform" :class="expanded ? 'rotate-180' : ''"></i>
            </button>

            {{-- Events --}}
            <div x-show="expanded" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="mt-3 space-y-2.5">
                @foreach($bln['events'] as $event)
                <div class="flex items-start gap-4 bg-white rounded-xl p-4 border-l-4 ml-4 {{ $tipeWarna[$event['jenis']] ?? 'bg-gray-50 border-gray-300' }}">
                    <div class="flex-shrink-0 w-24 text-center">
                        <div class="font-bold text-gray-900 text-sm">{{ $event['tanggal'] }}</div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 font-medium">{{ $event['event'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        {{-- Download Button --}}
        <div class="text-center mt-12">
            <button class="inline-flex items-center gap-2 bg-primary-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-primary-700 transition-colors shadow-md">
                <i data-feather="download" class="w-5 h-5"></i>
                Download Kalender PDF
            </button>
        </div>
    </div>
</section>
@endsection
