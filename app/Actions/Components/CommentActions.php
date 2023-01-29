<?php

namespace App\Actions\Components;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentActions
{
    public function add_comment(CommentRequest $request){
        $data = $request->validated();

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->video_id = $data['video_id'];
        $comment->comment = $data['comment'];
        if(isset($data['parent_id'])){
            $comment->parent_id = $data['parent_id'];
        }
        $comment->save();
    }


}
