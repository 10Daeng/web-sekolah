<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClassController extends Controller
{
    public function index()
    {
        return redirect('/admin/classrooms');
    }

    public function create() { return redirect('/admin/classrooms/create'); }
    public function store() { return redirect('/admin/classrooms'); }
    public function show($id) { return redirect("/admin/classrooms/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/classrooms/{$id}/edit"); }
    public function update($id) { return redirect('/admin/classrooms'); }
    public function destroy($id) { return redirect('/admin/classrooms'); }
}
