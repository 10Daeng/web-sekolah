PRD – SISTEM INFORMASI SEKOLAH TERPADU (SIST)
Nama Proyek : Sistem Informasi Sekolah Terpadu (SIST)
Versi Dokumen : 1.1
Tanggal : Mei 2026 (Update: 1 Mei 2026 — finalisasi hasil diskusi tech stack & scope)
Tujuan : Membangun platform digital sekolah yang mengintegrasikan informasi publik, proses PPDB, dan dukungan akademik dalam satu sistem yang mudah dikelola oleh staff non-teknis.
1. Ringkasan Proyek (Executive Summary)
SIST adalah platform berbasis web yang dirancang untuk mendigitalisasi pengelolaan sekolah secara terpadu. Sistem ini menyediakan tiga modul utama:

Modul Publik → Informasi sekolah, berita, galeri, dan kalender akademik bagi masyarakat.
Modul PPDB → Penerimaan Peserta Didik Baru secara online (pendaftaran, upload berkas, verifikasi, dan pengumuman).
Modul Akademik → Repository materi pembelajaran, tugas, bank soal, dan dokumentasi prestasi siswa.

Tujuan Utama:

Mengurangi penggunaan kertas dan proses manual.
Mempercepat dan meningkatkan transparansi proses PPDB.
Memudahkan guru dalam mendistribusikan materi dan tugas.
Memberikan akses informasi yang cepat dan akurat bagi siswa, wali murid, dan masyarakat.
Memberikan dashboard pengelolaan yang user-friendly bagi admin dan guru.

Manfaat yang Diharapkan:

Proses PPDB lebih efisien dan terdokumentasi.
Guru dapat fokus pada pengajaran daripada administrasi.
Orang tua/siswa mudah mengakses informasi dan materi belajar.
Kepala sekolah mendapatkan laporan dan insight secara real-time.

2. Ruang Lingkup (Scope & Out of Scope)
In Scope (Fitur yang Akan Dibangun):

Manajemen konten publik (berita, pengumuman, galeri, profil sekolah, kalender akademik).
Sistem PPDB online lengkap (pendaftaran, verifikasi berkas, status seleksi, export data).
Repository materi & tugas akademik sederhana.
Manajemen prestasi siswa.
Sistem autentikasi dan manajemen user berbasis role (Super Admin, Admin TU, Guru, Siswa, Wali Murid).
Dashboard admin dan guru (statistik pendaftar, prestasi, ringkasan data).
Manajemen Guru (CRUD, assign ke kelas & mata pelajaran, role-based dashboard).
Jadwal Pelajaran Sederhana (tabel schedules: class, subject, teacher, day, time — bukan timetable penuh dengan clash detection).
Pengaturan Profil Sekolah terpusat (1 halaman admin untuk ganti semua identitas: nama, logo, kontak, visi-misi, nama/jumlah kelas, dll).

Out of Scope (Tidak Termasuk di Tahap Ini):

Modul keuangan (pembayaran SPP, DSP, tagihan).
Absensi siswa harian (presensi, rekap kehadiran).
Penilaian rapor lengkap dan nilai semester.
Timetable penuh dengan slot waktu, room assignment, dan clash detection.
Integrasi dengan Dapodik / EMIS / aplikasi pemerintah lainnya.
Multi-tenancy (satu sistem untuk banyak sekolah).
Aplikasi mobile native (hanya web responsive).

3. Arsitektur Pengguna (User Roles & Permissions)



































RoleDeskripsi SingkatAkses UtamaSuper AdminKontrol penuh sistemSemua modul + manajemen user & roleAdmin TU / Panitia PPDBMengelola PPDB, data master, kalender, dan laporanPPDB, Kalender, Master Data, ExportGuruMengelola materi, tugas, soal, prestasi kelasnyaMateri, Tugas, Prestasi, Galeri KelasSiswaMelihat materi, tugas, berita, dan status PPDB (jika mendaftar)Dashboard siswa, materi, pengumumanWali MuridMelihat informasi anak, materi, dan beritaAkses terbatas melalui akun siswa atau terpisah
Catatan: Sistem menggunakan Spatie Laravel Permission untuk Role & Permission yang fleksibel.
4. Fitur Utama (Detailed Features)
A. Modul Publik (Frontend)

Halaman Beranda (highlight berita, galeri, kalender mini)
Profil Sekolah (visi misi, sejarah, fasilitas, kontak)
Berita & Pengumuman (kategori, search, pagination)
Galeri Dinamis (album foto dengan lightbox)
Kalender Akademik (tampilan bulan/tahun dengan event penting)
Halaman PPDB Publik (informasi jalur, persyaratan, form pendaftaran)

B. Modul PPDB

Formulir pendaftaran online (data calon siswa, orang tua, asal sekolah)
Upload berkas: KK, Akta Kelahiran, Ijazah/SKL, Pas foto (PDF/JPG, max 5MB)
Jalur PPDB: Zonasi, Prestasi, Afirmasi, Mutasi (bisa diatur admin)
Status pendaftaran real-time (Pending, Diverifikasi, Lulus, Tidak Lulus, Cadangan)
Dashboard calon siswa untuk tracking status
Verifikasi & seleksi oleh admin
Export data pendaftar ke Excel (.xlsx)
Notifikasi status via email (opsional WhatsApp di tahap berikutnya)

C. Modul Akademik (E-Learning Sederhana)

Manajemen Kelas & Mata Pelajaran
Repository Materi (upload PDF, PPT, DOC, Video link) per kelas & mapel
Bank Soal & Tugas Mandiri (upload file petunjuk tugas)
Manajemen Prestasi Siswa (tingkat kecamatan hingga internasional + upload bukti)
Riwayat download materi oleh siswa (opsional)

D. Fitur Pendukung

Dashboard khusus Super Admin & Admin TU (statistik pendaftar, prestasi, dll)
Manajemen Master Data (Tahun Ajaran, Kelas, Mata Pelajaran, Siswa, Guru)
Audit Log perubahan data penting
Soft delete untuk data sensitif

5. Struktur Database (Entity Utama)

users + model_has_roles + permissions (Spatie)
students (data siswa aktif, relasi ke kelas & wali murid)
teachers (data guru, relasi ke user, kelas, dan mata pelajaran)
classes, subjects, academic_years
class_subject_teacher (pivot: kelas-mapel-guru many-to-many)
schedules (jadwal pelajaran: class_id, subject_id, teacher_id, day, start_time, end_time)
registrations (PPDB)
posts (berita & pengumuman)
albums & media (galeri – pakai Spatie Media Library)
documents (materi & tugas)
achievements
academic_calendars
settings (konfigurasi sekolah — key-value, di-override via admin panel)

6. Tech Stack & Arsitektur Teknis

Backend : Laravel 11
Admin Panel : Filament PHP v3 (utama) + Blade custom (untuk halaman pengaturan sekolah & dashboard unik yang tidak dicover Filament)
Database : PostgreSQL (direkomendasikan) atau MySQL
Frontend Publik : Blade + Tailwind CSS + Alpine.js (selesai dibangun, tinggal integrasi ke Laravel)
Frontend Sudah Dibangun :
  - 7 halaman publik: Beranda, Profil, Berita (list+detail), Galeri, Kalender, Info PPDB, Form PPDB
  - Admin layout custom (sidebar, topbar) + halaman Pengaturan Sekolah (5 tab)
  - Layout Blade extensible dengan partials navbar & footer
  - Konfigurasi pusat di config/sekolah.php
File Management : Spatie/laravel-medialibrary (dengan image optimization & conversion)
Export : Maatwebsite/Laravel Excel
Authentication : Laravel Fortify / Filament Authentication + Spatie Permission
Storage : Private disk untuk dokumen PPDB, Public untuk galeri & materi

Keamanan & Performa:

Validasi ketat pada form PPDB
File upload dengan batasan ukuran & tipe
Dokumen sensitif disimpan di storage private
Optimasi gambar otomatis
Rate limiting pada form publik
Backup database rutin

7. Roadmap Implementasi (Final — Hasil Diskusi)

Tahap 1 — Fondasi (Setup + Master Data + Frontend Integrasi)

  - Setup Laravel 11 + Filament v3 + Spatie Permission + Spatie Media Library + Maatwebsite Excel
  - Setup database PostgreSQL/MySQL, migrasi semua tabel
  - Filament Resources: Users (role: Super Admin, Admin TU, Guru, Siswa, Wali Murid)
  - Filament Resources: Academic Years, Classes, Subjects, Students, Teachers
  - Pivot table: class_subject_teacher (many-to-many: guru bisa ajar banyak kelas & mapel)
  - Table schedules (jadwal sederhana: class, subject, teacher, day, start_time, end_time)
  - Integrasi Blade frontend yang sudah jadi ke Laravel (routing, controller, config/sekolah.php)
  - Halaman Pengaturan Sekolah (custom Blade page di-admin — edit identitas, logo, kontak, visi-misi, kelas, mapel, statistik)
  - Authentication multi-role via Filament (guru login → dashboard guru; admin TU → dashboard admin)

Tahap 2 — PPDB + Publik

  - Filament Resources: Registrations (PPDB) — list, verifikasi, update status, export Excel
  - Filament Resources: Posts (berita & pengumuman), Albums & Media (galeri), Academic Calendars
  - Dashboard Admin TU: statistik pendaftar per jalur, status verifikasi
  - Notifikasi email untuk perubahan status PPDB
  - Frontend dinamis: halaman publik menarik data dari database (bukan dummy)

Tahap 3 — Akademik + Dashboard

  - Filament Resources: Documents (materi & tugas), Achievements (prestasi)
  - Dashboard Guru: kelas ajar, jadwal, upload materi/tugas, input prestasi
  - Dashboard Siswa: lihat jadwal, materi, tugas, prestasi sendiri
  - Dashboard Super Admin: overview statistik lengkap (siswa, guru, pendaftar, prestasi)

Tahap 4 — Polish & Optimasi

  - Responsive testing di semua device
  - Audit log untuk data sensitif (via Spatie Activity Log)
  - Soft delete untuk semua model utama
  - Backup database otomatis
  - Rate limiting + security hardening
  - Deployment ke production server

Catatan:
  - Modul keuangan (pembayaran, tagihan), absensi, penilaian rapor, dan timetable penuh DITUNDA ke tahap berikutnya.
  - Frontend publik (7 halaman Blade + layout + konfigurasi) SUDAH SELESAI dan siap integrasi.

8. Arsitektur Admin Panel (Filament + Blade Hybrid)

Strategi yang diputuskan: Filament sebagai primary admin panel, Blade sebagai pelengkap.

A. Fitur yang ditangani Filament (auto-generated Resources):
  - CRUD: Users, Students, Teachers, Classes, Subjects, Academic Years
  - CRUD: Posts (berita), Albums & Media (galeri), Calendars (kalender)
  - CRUD: Registrations (PPDB), Documents (materi/tugas), Achievements (prestasi)
  - Schedules (jadwal pelajaran)
  - Export Excel (pendaftar PPDB)
  - Spatie Permission integration (role & permission management)
  - Dashboard widgets (statistik pendaftar, jumlah siswa, dll)

B. Fitur yang ditangani Blade custom:
  - Halaman Pengaturan Sekolah (5 tab: identitas, kontak, logo, akademik, sosmed)
    → Karena Filament Resource biasa terlalu generik untuk form kompleks dengan upload logo, 
      preview real-time, dan dynamic list (kelas, mapel)
  - Frontend publik 7 halaman (tetap Blade + Tailwind + Alpine)

C. Alur Login Multi-Role:
  - Semua role login via /admin/login (Filament)
  - Filament akan redirect ke dashboard sesuai role:
    * Super Admin → dashboard penuh (semua resource visible)
    * Admin TU → PPDB, Posts, Calendars, Export
    * Guru → jadwal mengajar, materi/tugas kelasnya, prestasi kelasnya
    * Siswa → dashboard-sendiri (bukan akses admin panel)

9. Changelog

v1.1 (1 Mei 2026) — Hasil Diskusi Tech Stack & Scope:
  - Admin Panel: Diputuskan pakai Filament v3 utama + Blade custom untuk halaman tertentu
  - Frontend Publik: 7 halaman Blade + Tailwind + Alpine SELESAI dibangun
  - Scope tambahan: Tabel schedules (jadwal pelajaran sederhana) MASUK scope
  - Scope tambahan: Manajemen Guru lengkap (CRUD + assign kelas & mapel) MASUK scope
  - Scope tetap OUT: Absensi, penilaian rapor, modul keuangan, timetable penuh
  - Struktur DB diperbarui: tambah class_subject_teacher pivot + schedules
  - Roadmap diupdate menjadi 4 tahap dengan detail per tahap
  - Konfigurasi pusat sekolah: config/sekolah.php sudah dibuat
