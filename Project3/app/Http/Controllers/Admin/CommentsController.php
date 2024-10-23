<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function index()
    {

        $comments = Comment::with('user', 'blog', 'replies')->get();
        return view('admin.comments.index', compact('comments'));
    }


    public function destroy(string $id)
    {

        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json(null, 204);

        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }
}
