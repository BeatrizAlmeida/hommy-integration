<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;
use App\User;
use App\Republic;


class CommentController extends Controller
{
    public function createComment(Request $request) {
        $comment = new Comment;
        $comment->text = $request->text;
        $comment->user_id = $request->user_id;
        $comment->save();
        return response()->json($comment);
    }

    public function deleteComment($id) {
        Comment::destroy($id);
        return response()->json(['O seu comentário foi deletado com sucesso.']);
    }

    public function addUserComment($id, $comment_id) {
        $comment = Comment::findOrFail($comment_id);
        $comment->user_id = $id;
        $comment->save();
        return response()->json($comment);

    }

}
