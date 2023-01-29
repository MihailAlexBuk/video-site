@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($output as $user)
                <a href="" class="link">
                    <h3 class="card-header">{{$user['user']['name']}}</h3>
                </a>
                <div class="row row-cols-1 row-cols-md-4">
                    @foreach($user['videos'] as $video)
                        <div class="col">
                            <div class="card">
                                <a href="{{route('watch', $video->id)}}" class="hover-img">
                                    <img src="{{Storage::url($video->poster)}}" class="card-img-top" alt="Hollywood Sign on The Hill"/>
                                    <img class="play-btn" src="{{asset('assets/icons/play-btn.svg')}}" title="Click to play">
                                </a>
                                <div class="card-body">
                                    <a href="{{route('watch', $video->id)}}" class="video-card">
                                        <h6 class="video-title">{{$video->title}}</h6>
                                    </a>
                                    <a href="{{route('profile', $video->user->id)}}" class="video-card">
                                        <h6 class="video-subtitle">{{$video->user->name}}</h6>
                                    </a>
                                    <div class="video-subtitle d-flex justify-content-between">
                                        <article >{{$video->videoview->count()}}</article>
                                        <article >{{$video->created_at}}</article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{route('profile', $user['user']['id'])}}" class="btn btn-light">view more...</a>

            @endforeach

        </div>
    </div>
@endsection
