<?php

namespace App\Http\Controllers\Components;

use App\Actions\Components\SearchBarActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;

class SearchBarController extends Controller
{
    public function search(SearchRequest $request){

        $videos = SearchBarActions::search_result($request);

        return view('search-result', compact('videos'));
    }

    public function find(SearchRequest $request){

        $videos = SearchBarActions::search_list($request);

        return view('searchlist', compact('videos'));
    }
}
