<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return redirect('/admin/users');
    }

    public function create() { return redirect('/admin/users/create'); }
    public function store() { return redirect('/admin/users'); }
    public function show($id) { return redirect("/admin/users/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/users/{$id}/edit"); }
    public function update($id) { return redirect('/admin/users'); }
    public function destroy($id) { return redirect('/admin/users'); }
}
