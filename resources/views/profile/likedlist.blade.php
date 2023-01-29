@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center col-12">
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
                            <a href="{{route('watch', $video->id)}}">
                                <h5 class="card-title">{{$video->title}}</h5>
                            </a>
                            <p class="card-text">{{strip_tags($video->desc)}}</p>
                            <p class="card-text"><small class="text-muted">Likes: {{$video->likes()}}</small></p>
                            <p class="card-text"><small class="text-muted">Watch: {{$video->likes()}}</small></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


@endsection
