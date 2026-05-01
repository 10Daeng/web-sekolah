<?php

namespace App\Filament\Widgets;

use App\Models\Registration;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Post;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPendaftar = Registration::count();
        $pendingPendaftar = Registration::where('status', 'Pending')->count();
        $lulusPendaftar = Registration::where('status', 'Lulus')->count();
        $totalSiswa = Student::where('status', 'active')->count();
        $totalGuru = Teacher::count();
        $totalBerita = Post::where('status', 'published')->count();

        return [
            Stat::make('Total Pendaftar PPDB', $totalPendaftar)
                ->description($pendingPendaftar . ' menunggu verifikasi')
                ->descriptionIcon('heroicon-m-arrow-trend-up')
                ->color('primary'),

            Stat::make('Siswa Lulus PPDB', $lulusPendaftar)
                ->description('Dari ' . $totalPendaftar . ' pendaftar')
                ->color('success'),

            Stat::make('Siswa Aktif', $totalSiswa)
                ->description('Tahun ajaran ' . config('app.sekolah.tahun_ajaran_aktif', '2026/2027'))
                ->color('info'),

            Stat::make('Tenaga Pendidik', $totalGuru)
                ->description('Guru & Staff')
                ->color('warning'),

            Stat::make('Berita Publikasi', $totalBerita)
                ->description('Sudah dipublikasikan')
                ->color('success'),
        ];
    }
}
