<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index()
    {
        return redirect('/admin/teachers');
    }

    public function create() { return redirect('/admin/teachers/create'); }
    public function store() { return redirect('/admin/teachers'); }
    public function show($id) { return redirect("/admin/teachers/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/teachers/{$id}/edit"); }
    public function update($id) { return redirect('/admin/teachers'); }
    public function destroy($id) { return redirect('/admin/teachers'); }
}
