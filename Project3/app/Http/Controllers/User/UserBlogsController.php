<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class UserBlogsController extends Controller
{
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('user.blogs.show', compact('blog'));
    }

    public function index()
    {
        $blogs = Blog::with('user:id,name')->get();
        return view('user.blogs.index', compact('blogs'));
    }


    public function create()
    {
        return view('user.blogs.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'sections' => 'required|string',
        ]);


        Blog::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'sections' => $request->input('sections'),
            'created_by' => Auth::id(),
        ]);

        session()->flash('success', 'Your blog was created successfully!');
        return redirect()->route('user.blogs.index');
    }

    public function edit($id)
    {
        $blog = Blog::where('created_by', Auth::id())->findOrFail($id);
        return view('user.blogs.edit', compact('blog'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'sections' => 'required|string',
        ]);

        $blog = Blog::where('created_by', Auth::id())->findOrFail($id);

        $blog->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'sections' => $request->input('sections'),
        ]);

        session()->flash('success', 'Your blog was updated successfully!');
        return redirect()->route('user.blogs.index');
    }


    public function destroy($id)
    {
        $blog = Blog::where('created_by', Auth::id())->findOrFail($id);
        $blog->delete();

        session()->flash('success', 'Your blog was deleted successfully!');
        return response()->json(['success' => true], 204);
    }
    // like  and unlike
    public function likeBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $like = Like::firstOrCreate([
            'user_id' => Auth::id(),
            'blog_id' => $blog->id,
        ]);

        session()->flash('success', 'Blog liked!');
        return redirect()->route('user.comments.index');
    }

    public function unlikeBlog($id)
    {
        $blog = Blog::findOrFail($id);
        Like::where('user_id', Auth::id())->where('blog_id', $blog->id)->delete();

        session()->flash('success', 'Blog unliked!');
        return redirect()->route('user.comments.index');
    }
}
