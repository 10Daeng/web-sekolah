<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function index()
    {
        return redirect('/admin/documents');
    }

    public function create() { return redirect('/admin/documents/create'); }
    public function store() { return redirect('/admin/documents'); }
    public function show($id) { return redirect("/admin/documents/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/documents/{$id}/edit"); }
    public function update($id) { return redirect('/admin/documents'); }
    public function destroy($id) { return redirect('/admin/documents'); }
}
