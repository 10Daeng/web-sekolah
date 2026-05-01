<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Album;
use App\Models\AcademicCalendar;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Achievement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $highlightBerita = Post::published()
            ->latest('published_at')
            ->take(3)
            ->get()
            ->map(fn ($post) => [
                'judul' => $post->title,
                'excerpt' => $post->excerpt ?? strip_tags(substr($post->content, 0, 150)),
                'tanggal' => $post->published_at?->format('Y-m-d'),
                'kategori' => $post->category,
                'gambar' => $post->getFirstMediaUrl('featured_image') ?: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800',
                'slug' => $post->slug,
            ])
            ->toArray();

        // Fallback dummy if no posts in DB yet
        if (empty($highlightBerita)) {
            $highlightBerita = [
                ['judul' => 'Prestasi Gemilang! Siswa SDN Contoh Raih Juara 1 OSN Tingkat Provinsi', 'excerpt' => 'Dua siswa berhasil mengharumkan nama sekolah dalam ajang Olimpiade Sains Nasional tingkat provinsi tahun 2025...', 'tanggal' => '2026-04-28', 'kategori' => 'Prestasi', 'gambar' => 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800', 'slug' => null],
                ['judul' => 'Penerimaan Peserta Didik Baru Tahun Ajaran 2026/2027 Telah Dibuka', 'excerpt' => 'PPDB jalur zonasi, prestasi, afirmasi, dan mutasi resmi dibuka mulai 1 Mei - 30 Juni 2026...', 'tanggal' => '2026-05-01', 'kategori' => 'Pengumuman', 'gambar' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=800', 'slug' => null],
                ['judul' => 'Kegiatan Outing Class: Belajar di Luar Kelas yang Menyenangkan', 'excerpt' => 'Seluruh siswa mengikuti pembelajaran di museum dan kebun raya sebagai bagian dari program belajar kontekstual...', 'tanggal' => '2026-04-15', 'kategori' => 'Kegiatan', 'gambar' => 'https://images.unsplash.com/photo-1523050854058-8df90910e8f0?w=800', 'slug' => null],
            ];
        }

        $beritaList = Post::published()
            ->latest('published_at')
            ->skip(3)
            ->take(4)
            ->get()
            ->map(fn ($post) => [
                'judul' => $post->title,
                'excerpt' => $post->excerpt ?? strip_tags(substr($post->content, 0, 100)),
                'tanggal' => $post->published_at?->format('Y-m-d'),
                'kategori' => $post->category,
                'slug' => $post->slug,
            ])
            ->toArray();

        if (empty($beritaList)) {
            $beritaList = [
                ['judul' => 'Workshop Guru: Implementasi Kurikulum Merdeka', 'excerpt' => 'Para guru mengikuti pelatihan intensif...', 'tanggal' => '2026-04-20', 'kategori' => 'Berita', 'slug' => null],
                ['judul' => 'Kegiatan Pesantren Kilat Ramadhan 1447 H', 'excerpt' => 'Siswa mengikuti berbagai kegiatan keagamaan...', 'tanggal' => '2026-03-25', 'kategori' => 'Keagamaan', 'slug' => null],
                ['judul' => 'Lomba Kebersihan Antar Kelas Semester Genap', 'excerpt' => 'Kelas 5B berhasil meraih juara 1...', 'tanggal' => '2026-04-10', 'kategori' => 'Kegiatan', 'slug' => null],
                ['judul' => 'Pengumuman Libur Hari Raya Idul Fitri', 'excerpt' => 'Kegiatan belajar mengajar diliburkan...', 'tanggal' => '2026-03-20', 'kategori' => 'Pengumuman', 'slug' => null],
            ];
        }

        $galeriPreview = Album::where('status', 'published')
            ->latest()
            ->take(6)
            ->get()
            ->map(fn ($album) => [
                'judul' => $album->title,
                'gambar' => $album->getFirstMediaUrl('cover') ?: $album->getFirstMediaUrl('photos') ?: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=400',
            ])
            ->toArray();

        if (empty($galeriPreview)) {
            $galeriPreview = [
                ['judul' => 'Upacara Bendera Senin', 'gambar' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=400'],
                ['judul' => 'Kegiatan Pramuka', 'gambar' => 'https://images.unsplash.com/photo-1531206715517-5c0ba140b2b8?w=400'],
                ['judul' => 'Lomba Olahraga', 'gambar' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=400'],
                ['judul' => 'Peringatan Hari Kartini', 'gambar' => 'https://images.unsplash.com/photo-1577896851231-70ef18881754?w=400'],
                ['judul' => 'Praktik IPA', 'gambar' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=400'],
                ['judul' => 'Pentas Seni', 'gambar' => 'https://images.unsplash.com/photo-1503454537195-1dcabb73ffb9?w=400'],
            ];
        }

        $events = AcademicCalendar::where('status', 'published')
            ->where('start_date', '>=', now())
            ->orderBy('start_date')
            ->take(5)
            ->get()
            ->map(fn ($event) => [
                'tanggal' => $event->start_date->format('j M Y'),
                'event' => $event->title,
            ])
            ->toArray();

        if (empty($events)) {
            $events = [
                ['tanggal' => '1 Mei 2026', 'event' => 'Pembukaan PPDB 2026/2027'],
                ['tanggal' => '2 Mei 2026', 'event' => 'Peringatan Hari Pendidikan Nasional'],
                ['tanggal' => '12-13 Mei 2026', 'event' => 'Penilaian Tengah Semester'],
                ['tanggal' => '20 Mei 2026', 'event' => 'Peringatan Hari Kebangkitan Nasional'],
                ['tanggal' => '10 Juni 2026', 'event' => 'Pembagian Rapor Semester Genap'],
            ];
        }

        $jalurPPDB = [
            ['nama' => 'Zonasi', 'icon' => 'map-pin', 'warna' => 'bg-blue-50 text-blue-700 border-blue-200', 'deskripsi' => 'Siswa berdomisili dalam radius zona terdekat dari sekolah. Kuota maksimal 50% dari daya tampung.'],
            ['nama' => 'Prestasi', 'icon' => 'award', 'warna' => 'bg-amber-50 text-amber-700 border-amber-200', 'deskripsi' => 'Siswa dengan prestasi akademik/non-akademik tingkat kota/kabupaten ke atas. Kuota maksimal 30%.'],
            ['nama' => 'Afirmasi', 'icon' => 'heart', 'warna' => 'bg-red-50 text-red-700 border-red-200', 'deskripsi' => 'Siswa dari keluarga kurang mampu atau penyandang disabilitas. Kuota maksimal 15%.'],
            ['nama' => 'Mutasi', 'icon' => 'refresh-cw', 'warna' => 'bg-green-50 text-green-700 border-green-200', 'deskripsi' => 'Siswa pindahan karena perpindahan tugas orang tua. Kuota maksimal 5%.'],
        ];

        $statistik = [
            'siswa' => Student::where('status', 'active')->count() ?: config('app.sekolah.statistik.siswa', 650),
            'guru' => Teacher::count() ?: config('app.sekolah.statistik.guru', 35),
            'prestasi' => Achievement::count() ?: config('app.sekolah.statistik.prestasi', 120),
            'tahun' => config('app.sekolah.tahun_berdiri', 1985),
        ];

        return view('front.home', compact('highlightBerita', 'beritaList', 'galeriPreview', 'events', 'jalurPPDB', 'statistik'));
    }
}
