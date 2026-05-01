<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $albums = Album::where('status', 'published')
            ->latest()
            ->get();

        return view('front.galeri', compact('albums'));
    }
}
