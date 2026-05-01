<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Document;
use App\Models\Achievement;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $teacher = $user->teacher;

        if (!$teacher) {
            return redirect('/admin')->with('error', 'Data guru tidak ditemukan.');
        }

        // Jadwal mengajar hari ini dan besok
        $today = now()->locale('id')->dayName;
        $jadwalHariIni = Schedule::with(['class', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->where('day', $today)
            ->orderBy('start_time')
            ->get();

        $jadwalSemua = Schedule::with(['class', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->orderBy('start_time')
            ->get()
            ->groupBy('day');

        // Materi & tugas yang diupload guru ini
        $materiTerbaru = Document::with(['class', 'subject'])
            ->where('teacher_id', $teacher->id)
            ->latest()
            ->take(5)
            ->get();

        // Prestasi siswa dari kelas yang diajar
        $classIds = $teacher->classes()->pluck('classes.id');
        $prestasiTerbaru = Achievement::with('student')
            ->whereHas('student', function ($q) use ($classIds) {
                $q->whereIn('class_id', $classIds);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('guru.dashboard', compact(
            'teacher', 'jadwalHariIni', 'jadwalSemua', 'materiTerbaru', 'prestasiTerbaru'
        ));
    }
}
