@extends('layouts.app')
@php
$albumList = $albums->map(fn ($album) => [
    'judul' => $album->title,
    'kategori' => 'Kegiatan',
    'tanggal' => $album->created_at->format('Y-m-d'),
    'cover' => $album->getFirstMediaUrl('cover') ?: $album->getFirstMediaUrl('photos') ?: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=600',
    'jumlah' => $album->getMedia('photos')->count() ?: 1,
])->toArray();

$kategoriList = ['Semua', 'Kegiatan'];
@endphp

@section('title', 'Galeri')

@section('content')
{{-- Page Header --}}
<section class="bg-gradient-to-r from-primary-700 to-primary-900 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl lg:text-4xl font-extrabold text-white mb-3">Galeri Kegiatan</h1>
        <p class="text-primary-200 max-w-xl mx-auto">Dokumentasi kegiatan dan momen berharga di {{ config('app.sekolah.nama_pendek', 'SDN Contoh') }}</p>
    </div>
</section>

{{-- Albums --}}
<section class="py-12" x-data="{
    kategori: 'Semua',
    lightbox: false,
    currentAlbum: null,
    currentIndex: 0,
    get filteredAlbums() {
        if(this.kategori === 'Semua') return {{ json_encode($albumList) }};
        return {{ json_encode($albumList) }}.filter(a => a.kategori === this.kategori);
    },
    openLightbox(album, index = 0) {
        this.currentAlbum = album;
        this.currentIndex = index;
        this.lightbox = true;
        document.body.style.overflow = 'hidden';
    },
    closeLightbox() {
        this.lightbox = false;
        this.currentAlbum = null;
        this.currentIndex = 0;
        document.body.style.overflow = '';
    },
    next() {
        const max = this.currentAlbum ? this.currentAlbum.jumlah - 1 : 0;
        if(this.currentIndex < max) this.currentIndex++;
    },
    prev() {
        if(this.currentIndex > 0) this.currentIndex--;
    }
}">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Filter --}}
        <div class="flex gap-2 overflow-x-auto pb-4 mb-8 scrollbar-hide flex-wrap">
            @foreach($kategoriList as $kat)
            <button @click="kategori = '{{ $kat }}'"
                :class="kategori === '{{ $kat }}' ? 'bg-primary-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border'"
                class="px-4 py-2 rounded-xl text-sm font-medium transition-all flex-shrink-0">
                {{ $kat }}
            </button>
            @endforeach
        </div>

        {{-- Albums Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="(album, index) in filteredAlbums" :key="album.judul">
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all cursor-pointer" @click="openLightbox(album, 0)">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <img :src="album.cover" :alt="album.judul" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <div class="w-14 h-14 bg-white/90 rounded-full flex items-center justify-center">
                                <i data-feather="maximize-2" class="w-6 h-6 text-gray-800"></i>
                            </div>
                        </div>
                        <div class="absolute top-3 right-3 bg-black/60 text-white text-xs font-medium px-2.5 py-1 rounded-full backdrop-blur-sm">
                            <span x-text="album.jumlah + ' foto'"></span>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="bg-primary-50 text-primary-600 text-xs font-medium px-2.5 py-0.5 rounded" x-text="album.kategori"></span>
                            <span class="text-xs text-gray-400" x-text="new Date(album.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })"></span>
                        </div>
                        <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors" x-text="album.judul"></h3>
                    </div>
                </div>
            </template>
        </div>

        {{-- Empty State --}}
        <div x-show="filteredAlbums.length === 0" class="text-center py-20">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-feather="image" class="w-8 h-8 text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-700">Tidak ada album</h3>
            <p class="text-gray-500 text-sm mt-1">Belum ada album foto untuk kategori ini</p>
        </div>
    </div>

    {{-- Lightbox Modal --}}
    <div x-show="lightbox" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center" @click.self="closeLightbox()" @keyup.escape.window="closeLightbox()">
        {{-- Close Button --}}
        <button @click="closeLightbox()" class="absolute top-5 right-5 w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors z-10">
            <i data-feather="x" class="w-6 h-6"></i>
        </button>

        {{-- Prev Button --}}
        <button @click.stop="prev()" x-show="currentIndex > 0" class="absolute left-5 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors">
            <i data-feather="chevron-left" class="w-6 h-6"></i>
        </button>

        {{-- Next Button --}}
        <button @click.stop="next()" x-show="currentAlbum && currentIndex < currentAlbum.jumlah - 1" class="absolute right-5 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors">
            <i data-feather="chevron-right" class="w-6 h-6"></i>
        </button>

        {{-- Image Container --}}
        <div class="max-w-5xl w-full px-12 text-center">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                <img :src="currentAlbum ? currentAlbum.cover : ''" :alt="currentAlbum ? currentAlbum.judul : ''" class="w-full max-h-[80vh] object-contain">
            </div>
            <div class="mt-4 text-white">
                <h3 class="font-bold text-lg" x-text="currentAlbum ? currentAlbum.judul : ''"></h3>
                <p class="text-gray-400 text-sm mt-1">
                    Foto <span x-text="currentIndex + 1"></span> dari <span x-text="currentAlbum ? currentAlbum.jumlah : 0"></span>
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Reinitialize Feather Icons --}}
<script>
    document.addEventListener('alpine:init', () => {
        window.addEventListener('load', () => feather.replace());
    });
</script>
@endsection
