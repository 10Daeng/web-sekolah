<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AchievementController extends Controller
{
    public function index()
    {
        return redirect('/admin/achievements');
    }

    public function create() { return redirect('/admin/achievements/create'); }
    public function store() { return redirect('/admin/achievements'); }
    public function show($id) { return redirect("/admin/achievements/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/achievements/{$id}/edit"); }
    public function update($id) { return redirect('/admin/achievements'); }
    public function destroy($id) { return redirect('/admin/achievements'); }
}
