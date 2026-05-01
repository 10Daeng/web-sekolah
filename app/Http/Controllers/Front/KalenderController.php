<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AcademicCalendar;
use Illuminate\Http\Request;

class KalenderController extends Controller
{
    public function index()
    {
        $events = AcademicCalendar::where('status', 'published')
            ->orderBy('start_date')
            ->get();

        return view('front.kalender', compact('events'));
    }
}
