@extends('layouts.app')
@php
$kategoriList = ['Semua', 'Berita', 'Pengumuman', 'Prestasi', 'Kegiatan', 'Keagamaan'];
$semuaBerita = $posts->toArray();
@endphp

@section('title', 'Berita & Pengumuman')

@section('content')
{{-- Page Header --}}
<section class="bg-gradient-to-r from-primary-700 to-primary-900 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl lg:text-4xl font-extrabold text-white mb-3">Berita & Pengumuman</h1>
        <p class="text-primary-200 max-w-xl mx-auto">Informasi terbaru seputar kegiatan, prestasi, dan pengumuman sekolah</p>
    </div>
</section>

{{-- Content --}}
<section class="py-12" x-data="{
    search: '',
    kategori: 'Semua',
    get filteredData() {
        return {{ json_encode($semuaBerita) }}.filter(b => {
            const matchSearch = !this.search || b.judul.toLowerCase().includes(this.search.toLowerCase()) || b.excerpt.toLowerCase().includes(this.search.toLowerCase());
            const matchKategori = this.kategori === 'Semua' || b.kategori === this.kategori;
            return matchSearch && matchKategori;
        });
    }
}">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Search Bar --}}
        <div class="bg-white rounded-2xl shadow-sm p-4 mb-8 border">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1">
                    <i data-feather="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                    <input type="text" x-model="search" placeholder="Cari berita..." class="w-full pl-10 pr-4 py-3 bg-gray-50 border rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-sm">
                </div>
                <div class="flex gap-2 overflow-x-auto pb-1 scrollbar-hide">
                    @foreach($kategoriList as $kat)
                    <button @click="kategori = '{{ $kat }}'"
                        :class="kategori === '{{ $kat }}' ? 'bg-primary-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                        class="flex-shrink-0 px-4 py-2.5 rounded-xl text-sm font-medium transition-colors">
                        {{ $kat }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Grid Berita --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="berita in filteredData" :key="berita.judul">
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all group">
                    <div class="aspect-video overflow-hidden">
                        <img :src="berita.gambar" :alt="berita.judul" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                                  :class="{
                                      'bg-blue-50 text-blue-600': berita.kategori === 'Berita',
                                      'bg-amber-50 text-amber-600': berita.kategori === 'Pengumuman',
                                      'bg-green-50 text-green-600': berita.kategori === 'Prestasi',
                                      'bg-purple-50 text-purple-600': berita.kategori === 'Kegiatan',
                                      'bg-teal-50 text-teal-600': berita.kategori === 'Keagamaan',
                                  }"
                                  x-text="berita.kategori"></span>
                            <span class="text-xs text-gray-400" x-text="new Date(berita.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })"></span>
                        </div>
                        <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors line-clamp-2 mb-2" x-text="berita.judul"></h3>
                        <p class="text-sm text-gray-500 line-clamp-3" x-text="berita.excerpt"></p>
                        <div class="mt-4 pt-4 border-t">
                            <a :href="'/berita/' + berita.slug" class="text-primary-600 font-medium text-sm flex items-center gap-1 hover:text-primary-700">
                                Baca Selengkapnya
                                <i data-feather="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </template>
        </div>

        {{-- Empty State --}}
        <div x-show="filteredData.length === 0" class="text-center py-20">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-feather="inbox" class="w-8 h-8 text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-700">Tidak ada berita ditemukan</h3>
            <p class="text-gray-500 text-sm mt-1">Coba ubah kata kunci atau kategori pencarian</p>
        </div>

        {{-- Pagination --}}
        <div x-show="filteredData.length > 0" class="mt-10 flex items-center justify-center gap-2">
            <span class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium">1</span>
            <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200 cursor-pointer">2</span>
            <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200 cursor-pointer">3</span>
            <span class="px-2 text-gray-400">...</span>
            <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200 cursor-pointer">6</span>
            <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium hover:bg-gray-200 cursor-pointer flex items-center gap-1">
                Next <i data-feather="chevron-right" class="w-3 h-3"></i>
            </span>
        </div>
    </div>
</section>
@endsection
