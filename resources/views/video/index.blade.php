@extends('layouts.app')

@section('content')

    <div class="m-2">
        <a href="{{route('videos.create')}}" class="btn btn-success">Add video</a>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach($videos as $video)
        <div class="col">
            <div class="card">
            <a href="{{route('watch', $video->id)}}">
                <img src="{{Storage::url($video->poster)}}" class="card-img-top" alt="Hollywood Sign on The Hill"/>
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
                <div class="d-flex justify-content-center">
                    <a href="{{route('videos.edit', $video->id)}}" class="btn btn-warning mt-2">edit</a>
                    <form action="{{route('videos.destroy', $video->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2 ml-1">remove</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        @endforeach
    </div>


@endsection
