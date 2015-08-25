<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Comment;


class CommentsController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

    public function newComment(CommentFormRequest $request)
    {
        $user_id = Auth::user()->id;

        $comment = new Comment(array(
            'post_id' => $request->get('post_id'),
            'content' => $request->get('content'),
            'user_id' => $user_id
        ));

        $comment->save();

        return redirect()->back()->with('custom_success', 'Your comment has been created!');
    }
}
