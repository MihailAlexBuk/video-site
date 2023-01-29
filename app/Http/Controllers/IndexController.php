<?php

namespace App\Http\Controllers;

use App\Models\LikeDislike;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request){
        $videos = Video::orderBy('created_at', 'DESC')->paginate(12);

        if($request->ajax()){
            $view = view('data', compact('videos'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('home', compact('videos'));
    }



}
