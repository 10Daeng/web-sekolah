<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    public function index()
    {
        return redirect('/admin/albums');
    }

    public function create() { return redirect('/admin/albums'); }
    public function store() { return redirect('/admin/albums'); }
    public function show($id) { return redirect('/admin/albums'); }
    public function edit($id) { return redirect('/admin/albums'); }
    public function update($id) { return redirect('/admin/albums'); }
    public function destroy($id) { return redirect('/admin/albums'); }
}
