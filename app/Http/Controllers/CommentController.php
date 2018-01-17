<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;
use Carbon\Carbon;
use Auth;

class CommentController extends Controller
{
	/**
     * Store a Comment.
     *
     * @param  App\Http\Requests\CommentRequest  $request
	 * @param  App\Comment  $comment
     * @return void
     */
	public function store(CommentRequest $request, Comment $comment)
	{
		$comment->fill($request->all());
		$comment->user_id = Auth::id();
		$comment->save();

		return redirect(jump_to_comment($comment));
	}

    /**
     * Delete a Comment.
     *
     * @param  App\Comment  $comment
     * @return void
     */
	public function destroy(Comment $comment)
	{
        $this->authorize('destroy', $comment);

		$comment->delete();

        return redirect($comment->topic->link())->with('message', '删除成功');
    }
    
    /**
     * Vote or abstain a comment by a user.
     *
     * @param  App\Comment  $comment
     * @return void
     */
    public function vote(Comment $comment, $action = 'up')
    {
        $voteId = Auth::user()->vote->id;
        $voteTime = Carbon::now()->toDateTimeString();

        $comment->votes()->toggle([
            $voteId => [
                'created_at' => $voteTime,
                'updated_at' => $voteTime,
            ],
        ]);

        if ($action == 'up') {
            $comment->increment('star');
        } else {
            $comment->decrement('star');
        }
    }
}
