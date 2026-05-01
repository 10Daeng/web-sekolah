<?php

/**
 * KONFIGURASI SEKOLAH
 *
 * Semua pengaturan identitas sekolah terpusat di file ini.
 * Untuk mengganti identitas sekolah (nama, logo, kontak, dll),
 * cukup edit file ini.
 *
 * File ini akan di-override oleh data dari database (tabel `settings`)
 * melalui service provider. Prioritas: DB settings > config/sekolah.php
 */

return [
    'nama' => env('SEKOLAH_NAMA', 'SD Negeri Contoh 01 Jakarta'),
    'nama_pendek' => env('SEKOLAH_NAMA_PENDEK', 'SDN CONTOH 01'),
    'tagline' => env('SEKOLAH_TAGLINE', 'Unggul, Mandiri, Berprestasi'),
    'deskripsi_singkat' => env('SEKOLAH_DESKRIPSI', 'Sekolah yang berkomitmen mencetak generasi unggul melalui pendidikan berkualitas dan berkarakter.'),
    'deskripsi' => env('SEKOLAH_DESKRIPSI_PANJANG', ''),

    'npsn' => env('SEKOLAH_NPSN', '20101234'),
    'akreditasi' => env('SEKOLAH_AKREDITASI', 'A'),
    'tahun_berdiri' => env('SEKOLAH_TAHUN_BERDIRI', 1985),
    'kepala_sekolah' => env('SEKOLAH_KEPALA', 'Bapak Ahmad Syahid, S.Pd., M.Pd.'),

    'visi' => env('SEKOLAH_VISI', 'Terwujudnya peserta didik yang unggul dalam prestasi, mandiri, berkarakter, dan berwawasan lingkungan berdasarkan iman dan takwa.'),
    'misi' => env('SEKOLAH_MISI', "1. Melaksanakan pembelajaran yang aktif, inovatif, kreatif, efektif, dan menyenangkan.\n2. Mengembangkan bakat dan minat peserta didik melalui kegiatan ekstrakurikuler.\n3. Menanamkan nilai-nilai karakter dan budi pekerti luhur.\n4. Mewujudkan lingkungan sekolah yang bersih, hijau, dan nyaman.\n5. Meningkatkan kualitas tenaga pendidik secara berkelanjutan."),

    'telp' => env('SEKOLAH_TELP', '(021) 1234-5678'),
    'email' => env('SEKOLAH_EMAIL', 'info@sdncontoh01.sch.id'),
    'alamat' => env('SEKOLAH_ALAMAT', 'Jl. Pendidikan No. 1, Kecamatan Menteng, Jakarta Pusat 10310'),
    'alamat_singkat' => env('SEKOLAH_ALAMAT_SINGKAT', 'Jl. Pendidikan No. 1, Jakarta'),

    'logo' => env('SEKOLAH_LOGO', null),
    'logo_initials' => env('SEKOLAH_LOGO_INITIALS', 'S'),
    'favicon' => env('SEKOLAH_FAVICON', null),

    'tahun_ajaran_aktif' => env('SEKOLAH_TA', '2026/2027'),
    'semester_aktif' => env('SEKOLAH_SEMESTER', '2'),

    'kelas' => ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'],
    'mapel' => ['Pendidikan Agama', 'PKn', 'Bahasa Indonesia', 'Matematika', 'IPA', 'IPS', 'SBdP', 'PJOK'],

    'statistik' => [
        'siswa' => env('SEKOLAH_JUMLAH_SISWA', 650),
        'guru' => env('SEKOLAH_JUMLAH_GURU', 35),
        'prestasi' => env('SEKOLAH_JUMLAH_PRESTASI', 120),
    ],

    'social' => [
        'facebook' => env('SEKOLAH_FACEBOOK', 'https://facebook.com/sdncontoh01'),
        'instagram' => env('SEKOLAH_INSTAGRAM', 'https://instagram.com/sdncontoh01'),
        'youtube' => env('SEKOLAH_YOUTUBE', 'https://youtube.com/@sdncontoh01'),
        'tiktok' => env('SEKOLAH_TIKTOK', ''),
    ],

    'ppdb' => [
        'dibuka' => env('PPDB_DIBUKA', true),
        'tanggal_mulai' => env('PPDB_MULAI', '2026-05-01'),
        'tanggal_selesai' => env('PPDB_SELESAI', '2026-06-30'),
        'daya_tampung' => env('PPDB_KUOTA', 100),
        'jalur_zonasi_kuota' => 50,
        'jalur_prestasi_kuota' => 30,
        'jalur_afirmasi_kuota' => 15,
        'jalur_mutasi_kuota' => 5,
    ],
];
