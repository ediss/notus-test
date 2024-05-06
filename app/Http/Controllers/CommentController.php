<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\Comment\UpdateCommentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit-comment|delete-comment', ['except' => ['create']]);
    }

    public function index(): View
    {
        
        return view('comments.admin.index', [
            'comments' => Comment::with('product')->paginate(10)
        ]);
    }

    public function edit(Comment $comment): View
    {
        
        return view('comments.admin.edit', [
            'comment' => $comment
        ]);
    }

    public function update(UpdateCommentRequest $request, Comment $comment): RedirectResponse
    {
        $comment->update($request->all());

        return redirect()->back()->withSuccess('Comment is updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('comments.index')->withSuccess('Comment is deleted successfully.');
    }


    public function approveOrUnapprove(Comment $comment): RedirectResponse
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
