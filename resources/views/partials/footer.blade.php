<footer class="bg-gray-900 text-gray-300 mt-auto">
    {{-- Main Footer --}}
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Column 1: About --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                        {{ config('app.sekolah.logo_initials', 'S') }}
                    </div>
                    <div>
                        <h3 class="font-bold text-white">{{ config('app.sekolah.nama_pendek', 'SDN CONTOH') }}</h3>
                        <p class="text-xs text-gray-400">{{ config('app.sekolah.tagline', 'Unggul, Mandiri, Berprestasi') }}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed">
                    {{ config('app.sekolah.deskripsi_singkat', 'Sekolah yang berkomitmen mencetak generasi unggul melalui pendidikan berkualitas dan berkarakter.') }}
                </p>
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <h4 class="font-semibold text-white mb-4">Menu Cepat</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('profil') }}" class="hover:text-white transition-colors">Profil Sekolah</a></li>
                    <li><a href="{{ route('berita.index') }}" class="hover:text-white transition-colors">Berita & Pengumuman</a></li>
                    <li><a href="{{ route('galeri') }}" class="hover:text-white transition-colors">Galeri Kegiatan</a></li>
                    <li><a href="{{ route('kalender') }}" class="hover:text-white transition-colors">Kalender Akademik</a></li>
                    <li><a href="{{ route('ppdb.index') }}" class="hover:text-white transition-colors">Info PPDB</a></li>
                </ul>
            </div>

            {{-- Column 3: Contact --}}
            <div>
                <h4 class="font-semibold text-white mb-4">Hubungi Kami</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start gap-2.5">
                        <i data-feather="map-pin" class="w-4 h-4 mt-0.5 flex-shrink-0 text-primary-400"></i>
                        <span>{{ config('app.sekolah.alamat', 'Jl. Pendidikan No. 1, Jakarta Selatan 12345') }}</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-feather="phone" class="w-4 h-4 flex-shrink-0 text-primary-400"></i>
                        <span>{{ config('app.sekolah.telp', '(021) 1234-5678') }}</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-feather="mail" class="w-4 h-4 flex-shrink-0 text-primary-400"></i>
                        <span>{{ config('app.sekolah.email', 'info@sekolah.sch.id') }}</span>
                    </li>
                </ul>
            </div>

            {{-- Column 4: Social Media --}}
            <div>
                <h4 class="font-semibold text-white mb-4">Ikuti Kami</h4>
                <div class="flex gap-3 mb-4">
                    <a href="{{ config('app.sekolah.social.facebook', '#') }}" target="_blank" rel="noopener" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                        <i data-feather="facebook" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ config('app.sekolah.social.instagram', '#') }}" target="_blank" rel="noopener" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                        <i data-feather="instagram" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ config('app.sekolah.social.youtube', '#') }}" target="_blank" rel="noopener" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                        <i data-feather="youtube" class="w-4 h-4"></i>
                    </a>
                </div>
                <p class="text-xs text-gray-500">
                    Jam operasional: Senin - Jumat, 07:00 - 16:00 WIB
                </p>
            </div>
        </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 py-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.sekolah.nama', 'Sekolah') }}. Hak Cipta Dilindungi.
        </div>
    </div>
</footer>
