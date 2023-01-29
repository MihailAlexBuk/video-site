<?php

namespace App\Http\Controllers\Components;

use App\Actions\Components\CommentActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function add_comment(CommentRequest $request){
        CommentActions::add_comment($request);
        return back();
    }
}
