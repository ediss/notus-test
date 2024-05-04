<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\Comment\UpdateCommentRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit-comment|delete-comment', ['except' => ['create']]);
    }

    public function index()
    {
        
        return view('comments.admin.index', [
            'comments' => Comment::with('product')->paginate(10)
        ]);
    }

    public function edit(Comment $comment)
    {
        
        return view('comments.admin.edit', [
            'comment' => $comment
        ]);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->all());

        return redirect()->back()->withSuccess('Comment is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('comments.index')->withSuccess('Comment is deleted successfully.');
    }


    public function approveOrUnapprove(Comment $comment)
    {
        if($comment->approved) {
            $comment->update(['approved' => false]);

            $message = 'unapproved';
        } else {
            $comment->update(['approved' => true]);
            $message = 'approved';
        }

        
        return redirect()->route('comments.index')->with('success', "Comment  $message successfully");
    }
}
