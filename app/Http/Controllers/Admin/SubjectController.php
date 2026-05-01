<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function index()
    {
        return redirect('/admin/subjects');
    }

    public function create() { return redirect('/admin/subjects/create'); }
    public function store() { return redirect('/admin/subjects'); }
    public function show($id) { return redirect("/admin/subjects/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/subjects/{$id}/edit"); }
    public function update($id) { return redirect('/admin/subjects'); }
    public function destroy($id) { return redirect('/admin/subjects'); }
}
