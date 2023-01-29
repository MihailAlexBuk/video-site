@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center col-12">
            @if($videos->count() > 0)
                @foreach($videos as $video)
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="{{route('watch', $video->id)}}">
                            <img src="{{Storage::url($video->poster)}}" class="img-fluid rounded-start" alt="Poster">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <a class="link" href="{{route('watch', $video->id)}}">
                                <h5 class="card-title text-truncate" style="max-width: 1000px;">{{$video->title}}</h5>
                            </a>

                            <div class="mt-1">
                                <a class="mt-1" href="{{route('profile', $video->user->id)}}">
                                    <br>{{$video->user->name}}
                                </a>
                            </div>

                            <p class="mt-3 card-text text-truncate" style="max-width: 1000px;">{{strip_tags($video->desc)}}</p>

                            <div class="mt-4">
                                <span class="card-text"><small class="text-muted">Watch: {{$video->likes()}}</small></span>
                                <span class="card-text"><small class="text-muted">Likes: {{$video->likes()}}</small></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
                no result
            @endif
        </div>
    </div>


@endsection
