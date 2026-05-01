<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function index()
    {
        return redirect('/admin/albums');
    }

    public function create() { return redirect('/admin/albums/create'); }
    public function store() { return redirect('/admin/albums'); }
    public function show($id) { return redirect("/admin/albums/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/albums/{$id}/edit"); }
    public function update($id) { return redirect('/admin/albums'); }
    public function destroy($id) { return redirect('/admin/albums'); }
}
