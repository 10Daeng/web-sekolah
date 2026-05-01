<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function index()
    {
        return redirect('/admin/academic-calendars');
    }

    public function create() { return redirect('/admin/academic-calendars/create'); }
    public function store() { return redirect('/admin/academic-calendars'); }
    public function show($id) { return redirect("/admin/academic-calendars/{$id}/edit"); }
    public function edit($id) { return redirect("/admin/academic-calendars/{$id}/edit"); }
    public function update($id) { return redirect('/admin/academic-calendars'); }
    public function destroy($id) { return redirect('/admin/academic-calendars'); }
}
