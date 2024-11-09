<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'article_id' => $request->article_id,
            'comment' => $request->comment,
            'comment_id' => $request->comment_id
        ]);

        if($comment){
            return redirect()->back()->with('status', 'Comment Successfully');
        }
        return redirect()->back()->with('status', 'Comment Failed');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('status', 'Comment Successfully Deleted');
    }
}
