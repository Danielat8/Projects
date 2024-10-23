<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\Like;

use Illuminate\Support\Facades\Auth;


class UserCommentsController extends Controller
{
    public function index()
    {

        $comments = Comment::with(['user', 'replies.user', 'blog', 'likes'])->get();
        return view('user.comments.index', compact('comments'));
    }

    public function show($id)
    {
        $comment = Comment::with('replies')->findOrFail($id);
        return response()->json($comment);
    }

    public function create()
    {
        $blogs = Blog::all();
        return view('user.comments.create', compact('blogs'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id !== Auth::id()) {
            return redirect()->route('user.comments.index')->with('error', 'Unauthorized access.');
        }
        return view('user.comments.edit', compact('comment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:255',
            'blog_id' => 'required|exists:blogs,id',
            'reply_id' => 'nullable|exists:comments,id'
        ]);


        Comment::create([
            'user_id' => Auth::id(),
            'blog_id' => $request->blog_id,
            'body' => $request->body,
            'reply_id' => $request->input('reply_id'),
        ]);
        session()->flash('success', 'Your reply comment has been added successfully!');
        return redirect()->route('user.comments.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['body' => 'required|string|max:255']);

        $comment = Comment::findOrFail($id);
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access.'], 403);
        }

        $comment->update(['body' => $request->body]);
        return redirect()->route('user.comments.index');
        session()->flash('success', 'Comment updated successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access.'], 403);
        }

        $comment->delete();
        session()->flash('success', 'Comment deleted successfully!');
        return response()->json(['success' => true], 204);
    }
    // like and unlike for comment
    public function like($id)
    {
        $comment = Comment::findOrFail($id);
        $like = Like::firstOrCreate([
            'user_id' => Auth::id(),
            'comment_id' => $comment->id,
        ]);
        session()->flash('success', 'Comment liked!');
        return redirect()->route('user.comments.index');
    }

    public function unlike($id)
    {
        $comment = Comment::findOrFail($id);
        Like::where('user_id', Auth::id())->where('comment_id', $comment->id)->delete();
        session()->flash('success', 'Comment unliked!');
        return redirect()->route('user.comments.index');
    }
}
