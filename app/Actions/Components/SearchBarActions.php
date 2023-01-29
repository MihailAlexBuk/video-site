<?php

namespace App\Actions\Components;

use App\Models\Video;

class SearchBarActions
{
    public function search_result($request){
        $data = $request->validated();

        $videos = Video::query()
            ->where('title', 'LIKE', "%{$data['search']}%")
            ->orWhereHas('user', function ($query) use ($data){
                return $query->where('name', 'LIKE', "%{$data['search']}%");
            })
            ->take(15)
            ->get();

        return $videos;
    }

    public function search_list($request){
        $data = $request->validated();
        $videos = Video::query()
            ->where('title', 'LIKE', "%{$data['search']}%")
            ->orWhere('desc', 'LIKE', "%{$data['search']}%")
            ->orWhereHas('user', function ($query) use ($data){
                return $query->where('name', 'LIKE', "%{$data['search']}%");
            })
            ->get();

        return $videos;
    }



}
