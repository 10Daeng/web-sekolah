@extends('layouts.app')
@section('title', 'Profil Sekolah')
@section('content')

{{-- Page Header --}}
<section class="bg-gradient-to-r from-primary-700 to-primary-900 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-3xl lg:text-4xl font-extrabold text-white mb-3">Profil Sekolah</h1>
        <p class="text-primary-200 max-w-xl mx-auto">Mengenal lebih dekat {{ config('app.sekolah.nama', 'sekolah kami') }}</p>
    </div>
</section>

{{-- Quick Nav --}}
<section class="bg-white border-b sticky top-16 z-40" x-data="{ activeSection: 'sejarah' }">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex gap-1 overflow-x-auto py-2 scrollbar-hide">
            @php $sections = ['sejarah' => 'Sejarah', 'visimisi' => 'Visi & Misi', 'fasilitas' => 'Fasilitas', 'struktur' => 'Struktur Organisasi', 'guru' => 'Guru & Staff', 'kontak' => 'Kontak']; @endphp
            @foreach($sections as $key => $label)
            <a href="#{{ $key }}" @click="activeSection = '{{ $key }}'"
               class="flex-shrink-0 px-4 py-3 text-sm font-medium rounded-t-lg transition-colors"
               :class="activeSection === '{{ $key }}' ? 'text-primary-700 border-b-2 border-primary-600' : 'text-gray-500 hover:text-gray-700'">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Sejarah --}}
<section id="sejarah" class="py-16 bg-white" x-intersect:enter="activeSection = 'sejarah'" x-intersect:leave.threshold.60="if(activeSection === 'sejarah') activeSection = ''">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Sejarah</span>
                <h2 class="text-3xl font-extrabold text-gray-900 mt-2 mb-4">Sejarah Singkat</h2>
                <div class="w-16 h-1 bg-primary-600 rounded-full mb-6"></div>
                <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-3">
                    <p>{{ config('app.sekolah.nama', 'SDN Contoh') }} didirikan pada tahun {{ config('app.sekolah.tahun_berdiri', '1985') }} berdasarkan Surat Keputusan <strong>Menteri Pendidikan dan Kebudayaan</strong>. Sekolah ini berdiri di atas tanah seluas <strong>2.500 m²</strong> dengan status kepemilikan <strong>Pemerintah Daerah</strong>.</p>
                    <p>Sejak awal berdirinya, sekolah ini telah mengalami berbagai perkembangan, baik dari segi infrastruktur, kurikulum, maupun kualitas sumber daya manusia. Berawal dari hanya <strong>3 ruang kelas</strong> dan <strong>5 tenaga pendidik</strong>, kini sekolah telah berkembang menjadi salah satu sekolah unggulan di wilayah ini.</p>
                    <p>Pada tahun 2020, sekolah mendapatkan <strong>akreditasi A</strong> dari Badan Akreditasi Nasional, yang membuktikan komitmen kami dalam menjaga dan meningkatkan mutu pendidikan secara berkelanjutan.</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=400" alt="Gedung Sekolah" class="rounded-xl w-full h-48 object-cover">
                <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=400" alt="Kegiatan Belajar" class="rounded-xl w-full h-48 object-cover mt-6">
                <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400" alt="Upacara" class="rounded-xl w-full h-48 object-cover">
                <img src="https://images.unsplash.com/photo-1523050854058-8df90910e8f0?w=400" alt="Kegiatan" class="rounded-xl w-full h-48 object-cover mt-6">
            </div>
        </div>
    </div>
</section>

{{-- Visi Misi --}}
<section id="visimisi" class="py-16 bg-gray-50" x-intersect:enter="activeSection = 'visimisi'" x-intersect:leave.threshold.60="if(activeSection === 'visimisi') activeSection = ''">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Arah & Tujuan</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Visi & Misi</h2>
            <div class="w-16 h-1 bg-primary-600 rounded-full mx-auto mt-4"></div>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            {{-- Visi --}}
            <div class="bg-gradient-to-br from-primary-600 to-primary-800 text-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center"><i data-feather="target" class="w-6 h-6"></i></div>
                    <h3 class="text-2xl font-bold">Visi</h3>
                </div>
                <p class="text-lg leading-relaxed font-medium">
                    "Terwujudnya peserta didik yang unggul dalam prestasi, mandiri, berkarakter, dan berwawasan lingkungan berdasarkan iman dan takwa."
                </p>
            </div>
            {{-- Misi --}}
            <div class="bg-white rounded-2xl p-8 shadow-sm border">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-primary-100 text-primary-700 rounded-xl flex items-center justify-center"><i data-feather="list" class="w-6 h-6"></i></div>
                    <h3 class="text-2xl font-bold text-gray-900">Misi</h3>
                </div>
                <ol class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-3">
                        <span class="bg-primary-100 text-primary-700 rounded-full w-7 h-7 flex items-center justify-center flex-shrink-0 text-sm font-bold">1</span>
                        <span>Melaksanakan pembelajaran yang aktif, inovatif, kreatif, efektif, dan menyenangkan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-primary-100 text-primary-700 rounded-full w-7 h-7 flex items-center justify-center flex-shrink-0 text-sm font-bold">2</span>
                        <span>Mengembangkan bakat dan minat peserta didik melalui kegiatan ekstrakurikuler.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-primary-100 text-primary-700 rounded-full w-7 h-7 flex items-center justify-center flex-shrink-0 text-sm font-bold">3</span>
                        <span>Menanamkan nilai-nilai karakter dan budi pekerti luhur.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-primary-100 text-primary-700 rounded-full w-7 h-7 flex items-center justify-center flex-shrink-0 text-sm font-bold">4</span>
                        <span>Mewujudkan lingkungan sekolah yang bersih, hijau, dan nyaman.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="bg-primary-100 text-primary-700 rounded-full w-7 h-7 flex items-center justify-center flex-shrink-0 text-sm font-bold">5</span>
                        <span>Meningkatkan kualitas tenaga pendidik secara berkelanjutan.</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

{{-- Fasilitas --}}
<section id="fasilitas" class="py-16 bg-white" x-intersect:enter="activeSection = 'fasilitas'" x-intersect:leave.threshold.60="if(activeSection === 'fasilitas') activeSection = ''">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Sarana & Prasarana</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Fasilitas Sekolah</h2>
            <div class="w-16 h-1 bg-primary-600 rounded-full mx-auto mt-4"></div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php $fasilitasList = [
                ['nama' => 'Ruang Kelas Nyaman', 'icon' => 'layout', 'deskripsi' => '12 ruang kelas ber-AC dengan pencahayaan optimal dan meja-kursi ergonomis.', 'gambar' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=400'],
                ['nama' => 'Perpustakaan', 'icon' => 'book-open', 'deskripsi' => 'Koleksi 5.000+ buku dengan sistem digital dan ruang baca yang nyaman.', 'gambar' => 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=400'],
                ['nama' => 'Lab Komputer', 'icon' => 'monitor', 'deskripsi' => '30 unit komputer dengan akses internet dan software pembelajaran terbaru.', 'gambar' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=400'],
                ['nama' => 'Lapangan Olahraga', 'icon' => 'target', 'deskripsi' => 'Lapangan basket, futsal, dan area senam dengan peralatan olahraga lengkap.', 'gambar' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=400'],
                ['nama' => 'Musholla', 'icon' => 'sun', 'deskripsi' => 'Tempat ibadah yang bersih dan nyaman untuk kegiatan keagamaan dan sholat berjamaah.', 'gambar' => 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=400'],
                ['nama' => 'UKS', 'icon' => 'heart', 'deskripsi' => 'Unit Kesehatan Sekolah dengan peralatan P3K lengkap dan tenaga medis siaga.', 'gambar' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?w=400'],
            ]; @endphp
            @foreach($fasilitasList as $fasilitas)
            <div class="group bg-gray-50 rounded-2xl overflow-hidden hover:shadow-lg transition-all">
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $fasilitas['gambar'] }}" alt="{{ $fasilitas['nama'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center"><i data-feather="{{ $fasilitas['icon'] }}" class="w-4 h-4"></i></div>
                        <h3 class="font-bold text-gray-900">{{ $fasilitas['nama'] }}</h3>
                    </div>
                    <p class="text-sm text-gray-600">{{ $fasilitas['deskripsi'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Struktur Organisasi --}}
<section id="struktur" class="py-16 bg-gray-50" x-intersect:enter="activeSection = 'struktur'" x-intersect:leave.threshold.60="if(activeSection === 'struktur') activeSection = ''">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Organisasi</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Struktur Organisasi</h2>
            <div class="w-16 h-1 bg-primary-600 rounded-full mx-auto mt-4"></div>
        </div>
        <div class="flex flex-col items-center gap-4">
            {{-- Kepala Sekolah --}}
            <div class="bg-white border-2 border-primary-500 rounded-xl px-8 py-4 text-center shadow-sm">
                <div class="font-bold text-gray-900">{{ config('app.sekolah.kepala_sekolah', 'Bapak Ahmad Syahid, S.Pd., M.Pd.') }}</div>
                <div class="text-sm text-primary-600 font-medium">Kepala Sekolah</div>
            </div>
            <div class="w-0.5 h-8 bg-primary-300"></div>
            {{-- Wakil --}}
            <div class="grid sm:grid-cols-3 gap-4 w-full max-w-3xl">
                <div class="bg-white border rounded-xl px-6 py-3 text-center shadow-sm">
                    <div class="font-bold text-gray-900">Ibu Nurhayati, S.Pd.</div>
                    <div class="text-sm text-gray-500">Waka Kurikulum</div>
                </div>
                <div class="bg-white border rounded-xl px-6 py-3 text-center shadow-sm">
                    <div class="font-bold text-gray-900">Bapak Rudi Hartono, S.Pd.</div>
                    <div class="text-sm text-gray-500">Waka Kesiswaan</div>
                </div>
                <div class="bg-white border rounded-xl px-6 py-3 text-center shadow-sm">
                    <div class="font-bold text-gray-900">Ibu Siti Aminah, S.Pd.</div>
                    <div class="text-sm text-gray-500">Waka Sarpras</div>
                </div>
            </div>
            <div class="w-0.5 h-8 bg-primary-300"></div>
            {{-- Guru --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 w-full max-w-4xl">
                <div class="bg-white border rounded-xl px-5 py-2 text-center shadow-sm"><div class="font-medium text-gray-800 text-sm">Guru Kelas 1</div></div>
                <div class="bg-white border rounded-xl px-5 py-2 text-center shadow-sm"><div class="font-medium text-gray-800 text-sm">Guru Kelas 2</div></div>
                <div class="bg-white border rounded-xl px-5 py-2 text-center shadow-sm"><div class="font-medium text-gray-800 text-sm">Guru Kelas 3</div></div>
                <div class="bg-white border rounded-xl px-5 py-2 text-center shadow-sm"><div class="font-medium text-gray-800 text-sm">Guru Kelas 4</div></div>
                <div class="bg-white border rounded-xl px-5 py-2 text-center shadow-sm"><div class="font-medium text-gray-800 text-sm">Guru Kelas 5</div></div>
                <div class="bg-white border rounded-xl px-5 py-2 text-center shadow-sm"><div class="font-medium text-gray-800 text-sm">Guru Kelas 6</div></div>
                <div class="bg-white border rounded-xl px-5 py-2 text-center shadow-sm"><div class="font-medium text-gray-800 text-sm">Guru PAI</div></div>
                <div class="bg-white border rounded-xl px-5 py-2 text-center shadow-sm"><div class="font-medium text-gray-800 text-sm">Guru PJOK</div></div>
            </div>
        </div>
    </div>
</section>

{{-- Guru & Staff --}}
<section id="guru" class="py-16 bg-white" x-intersect:enter="activeSection = 'guru'" x-intersect:leave.threshold.60="if(activeSection === 'guru') activeSection = ''">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">SDM</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Guru & Tenaga Kependidikan</h2>
            <div class="w-16 h-1 bg-primary-600 rounded-full mx-auto mt-4"></div>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php $guruList = [
                ['nama' => 'Ahmad Syahid, S.Pd., M.Pd.', 'jabatan' => 'Kepala Sekolah', 'foto' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300'],
                ['nama' => 'Nurhayati, S.Pd.', 'jabatan' => 'Waka Kurikulum', 'foto' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=300'],
                ['nama' => 'Rudi Hartono, S.Pd.', 'jabatan' => 'Waka Kesiswaan', 'foto' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300'],
                ['nama' => 'Siti Aminah, S.Pd.', 'jabatan' => 'Waka Sarpras', 'foto' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=300'],
                ['nama' => 'Dewi Sartika, S.Pd.', 'jabatan' => 'Guru Kelas 1', 'foto' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=300'],
                ['nama' => 'Bambang S, S.Pd.', 'jabatan' => 'Guru Kelas 2', 'foto' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300'],
                ['nama' => 'Ratna Dewi, S.Pd.', 'jabatan' => 'Guru Kelas 3', 'foto' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=300'],
                ['nama' => 'Agus Wijaya, S.Pd.', 'jabatan' => 'Guru PJOK', 'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300'],
            ]; @endphp
            @foreach($guruList as $guru)
            <div class="bg-gray-50 rounded-2xl overflow-hidden hover:shadow-lg transition-shadow group">
                <div class="aspect-square overflow-hidden">
                    <img src="{{ $guru['foto'] }}" alt="{{ $guru['nama'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-4 text-center">
                    <h4 class="font-bold text-gray-900 text-sm">{{ $guru['nama'] }}</h4>
                    <p class="text-xs text-primary-600 mt-0.5">{{ $guru['jabatan'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Kontak --}}
<section id="kontak" class="py-16 bg-gray-50" x-intersect:enter="activeSection = 'kontak'" x-intersect:leave.threshold.60="if(activeSection === 'kontak') activeSection = ''">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Hubungi Kami</span>
            <h2 class="text-3xl font-extrabold text-gray-900 mt-2">Kontak & Lokasi</h2>
            <div class="w-16 h-1 bg-primary-600 rounded-full mx-auto mt-4"></div>
        </div>
        <div class="grid lg:grid-cols-2 gap-8">
            <div class="space-y-6">
                <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center flex-shrink-0"><i data-feather="map-pin" class="w-6 h-6"></i></div>
                    <div><h4 class="font-bold text-gray-900">Alamat</h4><p class="text-gray-600 text-sm mt-1">{{ config('app.sekolah.alamat', 'Jl. Pendidikan No. 1, Jakarta Selatan 12345') }}</p></div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center flex-shrink-0"><i data-feather="phone" class="w-6 h-6"></i></div>
                    <div><h4 class="font-bold text-gray-900">Telepon</h4><p class="text-gray-600 text-sm mt-1">{{ config('app.sekolah.telp', '(021) 1234-5678') }}</p></div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center flex-shrink-0"><i data-feather="mail" class="w-6 h-6"></i></div>
                    <div><h4 class="font-bold text-gray-900">Email</h4><p class="text-gray-600 text-sm mt-1">{{ config('app.sekolah.email', 'info@sekolah.sch.id') }}</p></div>
                </div>
                <div class="flex items-start gap-4 p-4 bg-white rounded-xl shadow-sm">
                    <div class="w-12 h-12 bg-primary-100 text-primary-600 rounded-xl flex items-center justify-center flex-shrink-0"><i data-feather="clock" class="w-6 h-6"></i></div>
                    <div><h4 class="font-bold text-gray-900">Jam Operasional</h4><p class="text-gray-600 text-sm mt-1">Senin - Jumat: 07:00 - 16:00 WIB<br>Sabtu: 07:00 - 12:00 WIB</p></div>
                </div>
            </div>
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm h-80 lg:h-auto">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966!2d106.8!3d-6.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

{{-- Reinitialize Feather Icons after Alpine changes --}}
<script>
    document.addEventListener('alpine:init', () => {
        feather.replace();
    });
</script>
@endsection
