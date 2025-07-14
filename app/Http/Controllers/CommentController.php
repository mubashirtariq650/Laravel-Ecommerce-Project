<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        
        $request->validate([
            'body' => 'required',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'body' => $request->body,
            'parent_id' => $request->parent_id
        ]);

        return back();
    }

    
    
public function adminIndex()
{
    $comments = Comment::with(['user', 'replies.user'])->latest()->get();

    return view('admin.comment_index', compact('comments'));
}





  
}
