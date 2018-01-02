<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Delete a topic.
     *
     * @param  App\Models\Comment  $comment
     * @return void
     */
	public function destroy(Comment $comment)
	{
        $this->authorize('destroy', $comment);

		$comment->delete();

        return redirect($comment->topic->link())->with('message', '删除成功');
	}
}
