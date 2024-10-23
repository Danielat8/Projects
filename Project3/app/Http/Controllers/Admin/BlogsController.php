<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class BlogsController extends Controller
{
    public function index()
    {

        $blogs = Blog::with('user:id,name')->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {

        $users = User::all();
        return view('admin.blogs.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'sections' => 'required|string',
        ]);


        $blogData = $request->all();
        $blogData['created_by'] = Auth::id();

        Blog::create($blogData);

        session()->flash('success', 'Blog created successfully!');
        return redirect()->route('admin.blogs.index');
    }


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $users = User::all();
        return view('admin.blogs.edit', compact('blog', 'users'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'sections' => 'required|string',
        ]);


        $blog = Blog::findOrFail($id);
        if ($blog->created_by !== Auth::id()) {
            return redirect()->route('admin.blogs.index')->withErrors('You cannot edit this blog.');
        }
        $blog->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'sections' => $request->input('sections'),
        ]);

        session()->flash('success', 'Blog updated successfully!');
        return redirect()->route('admin.blogs.index');
    }


    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        session()->flash('success', 'Blog deleted successfully!');
        return response()->noContent();
    }
}
