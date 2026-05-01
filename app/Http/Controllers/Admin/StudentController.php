<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        return redirect('/admin/students');
    }

    public function create() { return redirect('/admin/students/create'); }
    public function store() { return redirect('/admin/students'); }
    public function show($id) { return redirect("/admin/students/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/students/{$id}/edit"); }
    public function update($id) { return redirect('/admin/students'); }
    public function destroy($id) { return redirect('/admin/students'); }
}
