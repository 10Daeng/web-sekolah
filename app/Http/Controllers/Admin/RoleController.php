<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return redirect('/admin');
    }

    public function create() { return redirect('/admin'); }
    public function store() { return redirect('/admin'); }
    public function show($id) { return redirect('/admin'); }
    public function edit($id) { return redirect('/admin'); }
    public function update($id) { return redirect('/admin'); }
    public function destroy($id) { return redirect('/admin'); }
}
