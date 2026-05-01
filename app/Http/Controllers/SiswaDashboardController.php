<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Document;
use App\Models\Achievement;
use App\Models\Student;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return redirect('/')->with('error', 'Data siswa tidak ditemukan.');
        }

        // Jadwal pelajaran
        $jadwal = Schedule::with(['subject', 'teacher'])
            ->where('class_id', $student->class_id)
            ->orderBy('start_time')
            ->get()
            ->groupBy('day');

        // Materi & tugas untuk kelas siswa
        $materi = Document::with(['subject', 'teacher'])
            ->where('class_id', $student->class_id)
            ->where('status', 'published')
            ->latest()
            ->take(10)
            ->get();

        // Prestasi sendiri
        $prestasi = Achievement::where('student_id', $student->id)
            ->latest()
            ->take(5)
            ->get();

        // Status PPDB (jika pernah mendaftar)
        $ppdb = Registration::where('nisn', $student->nisn)
            ->orWhere('name', 'like', '%' . $student->name . '%')
            ->first();

        return view('siswa.dashboard', compact(
            'student', 'jadwal', 'materi', 'prestasi', 'ppdb'
        ));
    }
}
