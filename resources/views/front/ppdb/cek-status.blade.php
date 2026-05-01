@extends('layouts.app')

@section('title', 'Cek Status PPDB')

@section('content')
<section class="bg-gradient-to-r from-accent-400 to-accent-600 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl lg:text-4xl font-extrabold text-white mb-3">Cek Status Pendaftaran</h1>
        <p class="text-white/80 max-w-xl mx-auto">Masukkan nomor registrasi, NISN, atau NIK untuk melihat status PPDB</p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-sm border p-8">
            <form method="POST" action="{{ route('ppdb.cek-status.post') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nomor Registrasi / NISN / NIK</label>
                    <input type="text" name="nomor" required
                           class="w-full px-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-colors text-sm"
                           placeholder="Contoh: PPDB-2026-ABC123">
                    @error('nomor')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-primary-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-primary-700 transition-colors shadow-md">
                    Cek Status
                </button>
            </form>
        </div>

        @if(session('registration'))
        @php $r = session('registration'); @endphp
        <div class="mt-6 bg-white rounded-2xl shadow-sm border p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center">
                    <i data-feather="file-text" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Hasil Pencarian</h3>
                    <p class="text-sm text-gray-500">No. Registrasi: <span class="font-mono font-medium">{{ $r->registration_number }}</span></p>
                </div>
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Nama</span>
                    <span class="font-medium text-gray-900">{{ $r->name }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Jalur</span>
                    <span class="font-medium text-gray-900">{{ $r->track }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Status</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if($r->status === 'Lulus') bg-green-100 text-green-700
                        @elseif($r->status === 'Tidak Lulus') bg-red-100 text-red-700
                        @elseif($r->status === 'Diverifikasi') bg-blue-100 text-blue-700
                        @elseif($r->status === 'Cadangan') bg-amber-100 text-amber-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ $r->status }}
                    </span>
                </div>
                @if($r->notes)
                <div class="pt-2">
                    <span class="text-gray-500">Catatan:</span>
                    <p class="text-gray-700 mt-1">{{ $r->notes }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
