@extends('layouts.app')

@section('title', 'Beranda')

@section('hero')
{{-- Hero Carousel --}}
<div x-data="{ activeSlide: 0, slides: {{ json_encode($highlightBerita) }}, interval: null }" x-init="interval = setInterval(() => { activeSlide = (activeSlide + 1) % slides.length }, 5000)" class="relative overflow-hidden">
    <template x-for="(slide, index) in slides" :key="index">
        <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 transform scale-105" x-transition:enter-end="opacity-100 transform scale-100" class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-primary-900/90 via-primary-900/70 to-transparent z-10"></div>
            <img :src="slide.gambar" :alt="slide.judul" class="w-full h-[500px] lg:h-[600px] object-cover">
            <div class="absolute inset-0 z-20 flex items-center">
                <div class="max-w-7xl mx-auto px-4 w-full">
                    <div class="max-w-2xl text-white">
                        <span x-text="slide.kategori" class="inline-block bg-accent-500 text-gray-900 text-xs font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-wider"></span>
                        <h1 x-text="slide.judul" class="text-3xl lg:text-5xl font-extrabold leading-tight mb-4 drop-shadow-lg"></h1>
                        <p x-text="slide.excerpt" class="text-gray-200 text-base lg:text-lg mb-6 line-clamp-2"></p>
                        <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 bg-white text-primary-800 font-semibold px-6 py-3 rounded-xl hover:bg-gray-100 transition-colors shadow-lg">
                            Baca Selengkapnya
                            <i data-feather="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </template>

    {{-- Dots Navigation --}}
    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex gap-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="activeSlide = index; clearInterval(interval)"
                :class="activeSlide === index ? 'bg-white w-8' : 'bg-white/50 w-3'"
                class="h-3 rounded-full transition-all duration-300"></button>
        </template>
    </div>

    {{-- Arrows --}}
    <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length; clearInterval(interval)" class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-12 h-12 bg-white/20 backdrop-blur rounded-full flex items-center justify-center hover:bg-white/40 transition-colors text-white">
        <i data-feather="chevron-left" class="w-6 h-6"></i>
    </button>
    <button @click="activeSlide = (activeSlide + 1) % slides.length; clearInterval(interval)" class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-12 h-12 bg-white/20 backdrop-blur rounded-full flex items-center justify-center hover:bg-white/40 transition-colors text-white">
        <i data-feather="chevron-right" class="w-6 h-6"></i>
    </button>
</div>
@endsection

@section('content')
<div class="bg-white">
    {{-- Stats Counter --}}
    <section class="py-10 bg-gradient-to-r from-primary-700 to-primary-900">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-white text-center">
                <div class="p-4" x-data="{ count: 0 }" x-init="let target = {{ $statistik['siswa'] }}; let step = target / 50; let timer = setInterval(() => { count += step; if (count >= target) { count = target; clearInterval(timer) } }, 30)">
                    <div class="text-4xl font-extrabold"><span x-text="Math.floor(count)"></span>+</div>
                    <div class="text-sm mt-1 text-primary-200">Siswa Aktif</div>
                </div>
                <div class="p-4" x-data="{ count: 0 }" x-init="let target = {{ $statistik['guru'] }}; let step = target / 50; let timer = setInterval(() => { count += step; if (count >= target) { count = target; clearInterval(timer) } }, 30)">
                    <div class="text-4xl font-extrabold"><span x-text="Math.floor(count)"></span>+</div>
                    <div class="text-sm mt-1 text-primary-200">Tenaga Pendidik</div>
                </div>
                <div class="p-4" x-data="{ count: 0 }" x-init="let target = {{ $statistik['prestasi'] }}; let step = target / 50; let timer = setInterval(() => { count += step; if (count >= target) { count = target; clearInterval(timer) } }, 30)">
                    <div class="text-4xl font-extrabold"><span x-text="Math.floor(count)"></span>+</div>
                    <div class="text-sm mt-1 text-primary-200">Prestasi</div>
                </div>
                <div class="p-4" x-data="{ count: 0 }" x-init="let target = {{ $statistik['tahun'] }}; let step = target / 50; let timer = setInterval(() => { count += step; if (count >= target) { count = target; clearInterval(timer) } }, 30)">
                    <div class="text-4xl font-extrabold"><span x-text="Math.floor(count)"></span></div>
                    <div class="text-sm mt-1 text-primary-200">Berdiri Sejak</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Sambutan Kepala Sekolah --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-10 items-center">
                <div class="lg:col-span-1">
                    <div class="relative mx-auto w-56 h-56 rounded-2xl overflow-hidden shadow-xl">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400" alt="Kepala Sekolah" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Sambutan Kepala Sekolah</h2>
                    <div class="w-16 h-1 bg-primary-600 rounded-full mb-6"></div>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Assalamu'alaikum Warahmatullahi Wabarakatuh. Selamat datang di website resmi {{ config('app.sekolah.nama', 'SDN Contoh') }}. Kami berkomitmen untuk memberikan pendidikan berkualitas yang membentuk karakter, kreativitas, dan kompetensi siswa.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Melalui website ini, kami berusaha memberikan informasi yang transparan dan aksesibel bagi seluruh warga sekolah dan masyarakat. Semoga keberadaan website ini dapat bermanfaat dan menjadi sarana komunikasi yang efektif.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-2">Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>
                    <div class="mt-4 font-semibold text-gray-900">{{ config('app.sekolah.kepala_sekolah', 'Bapak Ahmad Syahid, S.Pd., M.Pd.') }}</div>
                    <div class="text-sm text-gray-500">Kepala Sekolah</div>
                </div>
            </div>
        </div>
    </section>

    {{-- PPDB Call-to-Action --}}
    <section class="py-12 bg-gradient-to-r from-accent-400 to-accent-500">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                <div>
                    <span class="bg-white/20 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">PPDB 2026/2027</span>
                    <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-900 mt-3">Pendaftaran Peserta Didik Baru Telah Dibuka!</h2>
                    <p class="text-gray-800 mt-2 max-w-xl">Daftarkan putra-putri Anda sekarang juga. Tersedia jalur Zonasi, Prestasi, Afirmasi, dan Mutasi.</p>
                </div>
                <div class="flex gap-3 flex-shrink-0">
                    <a href="{{ route('ppdb.index') }}" class="bg-white text-primary-700 font-semibold px-6 py-3 rounded-xl hover:bg-gray-100 transition-colors shadow-md">
                        Info PPDB
                    </a>
                    <a href="{{ route('ppdb.daftar') }}" class="bg-gray-900 text-white font-semibold px-6 py-3 rounded-xl hover:bg-gray-800 transition-colors shadow-md">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Jalur PPDB --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Jalur Pendaftaran</span>
                <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Pilih Jalur PPDB Sesuai Kriteria</h2>
                <div class="w-16 h-1 bg-primary-600 rounded-full mx-auto mt-4"></div>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($jalurPPDB as $jalur)
                <div class="border rounded-2xl p-6 hover:shadow-lg transition-shadow {{ $jalur['warna'] }}">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 bg-white shadow-sm">
                        <i data-feather="{{ $jalur['icon'] }}" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">{{ $jalur['nama'] }}</h3>
                    <p class="text-sm opacity-80 leading-relaxed">{{ $jalur['deskripsi'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Berita Terbaru --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Berita & Kegiatan</span>
                    <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Informasi Terbaru</h2>
                    <div class="w-16 h-1 bg-primary-600 rounded-full mt-4"></div>
                </div>
                <a href="{{ route('berita.index') }}" class="hidden sm:flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                    Lihat Semua
                    <i data-feather="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($beritaList as $berita)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group">
                    <div class="aspect-video bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center">
                        <i data-feather="book-open" class="w-10 h-10 text-white opacity-50"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-xs font-medium text-primary-600 bg-primary-50 px-2 py-0.5 rounded">{{ $berita['kategori'] }}</span>
                            <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($berita['tanggal'])->format('d M Y') }}</span>
                        </div>
                        <h3 class="font-bold text-gray-900 group-hover:text-primary-600 transition-colors line-clamp-2">{{ $berita['judul'] }}</h3>
                        <p class="text-sm text-gray-500 mt-2 line-clamp-2">{{ $berita['excerpt'] }}</p>
                    </div>
                </article>
                @endforeach
            </div>
            <div class="text-center mt-8 sm:hidden">
                <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 text-primary-600 font-semibold">
                    Lihat Semua Berita
                    <i data-feather="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- Galeri Preview --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Galeri Kegiatan</span>
                    <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Dokumentasi Aktivitas Sekolah</h2>
                    <div class="w-16 h-1 bg-primary-600 rounded-full mt-4"></div>
                </div>
                <a href="{{ route('galeri') }}" class="hidden sm:flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                    Lihat Semua Galeri
                    <i data-feather="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($galeriPreview as $foto)
                <a href="{{ route('galeri') }}" class="group relative rounded-xl overflow-hidden aspect-square">
                    <img src="{{ $foto['gambar'] }}" alt="{{ $foto['judul'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3">
                        <span class="text-white text-xs font-medium">{{ $foto['judul'] }}</span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Kalender Mini --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Kalender Akademik</span>
                    <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Agenda Mendatang</h2>
                    <div class="w-16 h-1 bg-primary-600 rounded-full mt-4"></div>
                </div>
                <a href="{{ route('kalender') }}" class="hidden sm:flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                    Kalender Lengkap
                    <i data-feather="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            <div class="grid lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-6 shadow-sm">
                    <div x-data="miniCalendar()" class="text-center">
                        <div class="flex items-center justify-between mb-6">
                            <button @click="prevMonth" class="p-2 hover:bg-gray-100 rounded-lg transition-colors"><i data-feather="chevron-left" class="w-5 h-5"></i></button>
                            <h3 class="font-bold text-lg text-gray-900" x-text="monthName + ' ' + year"></h3>
                            <button @click="nextMonth" class="p-2 hover:bg-gray-100 rounded-lg transition-colors"><i data-feather="chevron-right" class="w-5 h-5"></i></button>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-sm mb-2">
                            <template x-for="d in ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab']">
                                <div class="font-semibold text-gray-400 py-1" x-text="d"></div>
                            </template>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-sm">
                            <template x-for="day in days" :key="day.date">
                                <div :class="{
                                    'bg-primary-600 text-white rounded-full font-bold': day.isToday,
                                    'text-gray-400': !day.isCurrentMonth,
                                    'text-gray-700': day.isCurrentMonth && !day.isToday,
                                    'cursor-pointer hover:bg-primary-50': true
                                }" class="py-2 rounded-full transition-colors" x-text="day.day"></div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    @foreach($events as $event)
                    <div class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-sm border-l-4 border-primary-500">
                        <div class="bg-primary-50 text-primary-700 p-3 rounded-lg flex-shrink-0">
                            <i data-feather="calendar" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ $event['event'] }}</div>
                            <div class="text-sm text-gray-500">{{ $event['tanggal'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Testimoni / Keunggulan --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-10">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Mengapa Memilih Kami</span>
                <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Keunggulan {{ config('app.sekolah.nama_pendek', 'SDN Contoh') }}</h2>
                <div class="w-16 h-1 bg-primary-600 rounded-full mx-auto mt-4"></div>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center text-white mb-4"><i data-feather="book" class="w-6 h-6"></i></div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Kurikulum Merdeka</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Menerapkan Kurikulum Merdeka yang berfokus pada pengembangan kompetensi dan karakter siswa sesuai Profil Pelajar Pancasila.</p>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center text-white mb-4"><i data-feather="monitor" class="w-6 h-6"></i></div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Fasilitas Digital</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Dilengkapi laboratorium komputer, akses internet, dan perangkat pembelajaran digital untuk mendukung literasi teknologi.</p>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center text-white mb-4"><i data-feather="heart" class="w-6 h-6"></i></div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Pendidikan Karakter</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Program pembiasaan dan ekstrakurikuler yang membentuk karakter islami, disiplin, mandiri, dan bertanggung jawab.</p>
                </div>
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl p-6 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center text-white mb-4"><i data-feather="award" class="w-6 h-6"></i></div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Berprestasi</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Ratusan prestasi telah diraih di tingkat kecamatan, kabupaten, provinsi, hingga nasional di berbagai bidang.</p>
                </div>
                <div class="bg-gradient-to-br from-rose-50 to-rose-100 rounded-2xl p-6 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-rose-600 rounded-xl flex items-center justify-center text-white mb-4"><i data-feather="users" class="w-6 h-6"></i></div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Guru Profesional</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Tenaga pendidik bersertifikasi dengan kompetensi unggul dan terus mengikuti pelatihan peningkatan mutu.</p>
                </div>
                <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-2xl p-6 hover:shadow-md transition-shadow">
                    <div class="w-12 h-12 bg-teal-600 rounded-xl flex items-center justify-center text-white mb-4"><i data-feather="shield" class="w-6 h-6"></i></div>
                    <h3 class="font-bold text-lg text-gray-900 mb-2">Lingkungan Aman</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">Lingkungan sekolah yang aman, bersih, dan nyaman dengan pengawasan CCTV dan program anti-bullying.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    function miniCalendar() {
        return {
            date: new Date(),
            get monthName() { return this.date.toLocaleString('id-ID', { month: 'long' }); },
            get year() { return this.date.getFullYear(); },
            get days() {
                const year = this.date.getFullYear();
                const month = this.date.getMonth();
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const startOffset = firstDay.getDay();
                const today = new Date();
                let days = [];
                for (let i = 0; i < startOffset; i++) {
                    const d = new Date(year, month, -i);
                    days.unshift({ day: d.getDate(), isCurrentMonth: false, date: d.toDateString(), isToday: false });
                }
                for (let i = 1; i <= lastDay.getDate(); i++) {
                    const d = new Date(year, month, i);
                    days.push({ day: i, isCurrentMonth: true, date: d.toDateString(), isToday: d.toDateString() === today.toDateString() });
                }
                const remaining = 7 - (days.length % 7);
                if (remaining < 7) {
                    for (let i = 1; i <= remaining; i++) {
                        const d = new Date(year, month + 1, i);
                        days.push({ day: d.getDate(), isCurrentMonth: false, date: d.toDateString(), isToday: false });
                    }
                }
                return days;
            },
            prevMonth() { this.date = new Date(this.date.getFullYear(), this.date.getMonth() - 1, 1); },
            nextMonth() { this.date = new Date(this.date.getFullYear(), this.date.getMonth() + 1, 1); }
        }
    }
</script>
@endpush
