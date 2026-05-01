<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AcademicYearController extends Controller
{
    public function index()
    {
        return redirect('/admin/academic-years');
    }

    public function create() { return redirect('/admin/academic-years/create'); }
    public function store() { return redirect('/admin/academic-years'); }
    public function show($id) { return redirect("/admin/academic-years/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/academic-years/{$id}/edit"); }
    public function update($id) { return redirect('/admin/academic-years'); }
    public function destroy($id) { return redirect('/admin/academic-years'); }
}
