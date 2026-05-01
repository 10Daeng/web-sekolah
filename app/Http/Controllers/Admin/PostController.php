<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return redirect('/admin/posts');
    }

    public function create()
    {
        return redirect('/admin/posts/create');
    }

    public function store()
    {
        return redirect('/admin/posts');
    }

    public function show($id)
    {
        return redirect("/admin/posts/{$id}/edit");
    }

    public function edit($id)
    {
        return redirect("/admin/posts/{$id}/edit");
    }

    public function update($id)
    {
        return redirect('/admin/posts');
    }

    public function destroy($id)
    {
        return redirect('/admin/posts');
    }
}
