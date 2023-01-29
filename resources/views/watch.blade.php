@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-start bg-light mb-3">
        <div class="col ms-5">
            <video controls width="900px">
                <source src="{{Storage::url($video->video_url)}}" type="video/mp4" size="1080">
                <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
            </video>
            <h2 class="mt-3">{{$video->title}}</h2>
            <div class="m-3">
                <div class="d-flex justify-content-between">
                    <div class="icon-user d-flex">
                        <a href="{{route('profile', $video->user->id)}}" class="link">
                            <img src="{{Storage::url($video->user->avatar)}}" class="rounded-circle" height="70px" width="70px" alt="">
                        </a>
                        <span class="ms-3">
                            <a href="{{route('profile', $video->user->id)}}" class="link"><span >{{$video->user->name}}</span></a>
                            <div style="font-size: 12px">{{$video->user->followers->count()}} subscribe</div>
                        </span>

                        <span class="ms-5">
                            @auth()
                                @if (auth()->user()->isFollowing($video->user->id))
                                    <td>
                                        <form action="{{route('unfollow', ['id' => $video->user->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="delete-follow-{{ $video->user->id }}" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i> Unfollow
                                            </button>
                                        </form>
                                    </td>
                                @else
                                    @if(auth()->id() !== $video->user->id)
                                    <td>
                                        <form action="{{route('follow', ['id' => $video->user->id])}}" method="POST">
                                            @csrf
                                            <button type="submit" id="follow-user-{{ $video->user->id }}" class="btn btn-success">
                                                <i class="fa fa-btn fa-user"></i> Follow
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                @endif
                            @endauth

                        </span>
                    </div>
                    <div>
                        <h6 class="ms-3 float-end"><b>{{$video->videoview->count()}}</b> views <br>{{$date}}</h6>
                    </div>

                    @auth()
                        <div>
                        <span title="Likes" id="saveLikeDislike" data-type="like" data-like data-video="{{$video->id}}" class="mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold">
                            Like
                            <span class="like-count">{{$video->likes()}}</span>
                        </span>
                            <span title="Dislikes" id="saveLikeDislike" data-type="dislike" data-dislike data-video="{{$video->id}}" class="mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold">
                            Dislike
                            <span class="dislike-count">{{$video->dislikes()}}</span>
                        </span>
                        </div>
                    @endauth
                    @guest()
                        <div>
                            <a href="{{route('login')}}" title="Likes" class="mr-2 btn btn-sm btn-outline-primary d-inline font-weight-bold">
                                Like
                                <span class="like-count">{{$video->likes()}}</span>
                            </a>
                            <a href="{{route('login')}}" title="Dislikes" class="mr-2 btn btn-sm btn-outline-danger d-inline font-weight-bold">
                                Dislike
                                <span class="dislike-count">{{$video->dislikes()}}</span>
                            </a>
                        </div>
                    @endguest
                </div>

            </div>

            <div class="mt-3">
                <span class="show-text">
                    {{strip_tags($video->desc)}}
                </span>
            </div>

{{--            COMMENTS--}}
        @include('comments', ['comments'=> $video->comments])


        </div>

        <div class="col ms-3">
            @foreach($recommendations as $video)
            <div class="card">
                <a href="{{route('watch', $video->id)}} ">
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
                </div>
            </div>
            @endforeach
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        let is_liked
        $(document).ready(function () {
            let video_id = $('#saveLikeDislike').data('video')
            let like = $('[data-like]')
            let dislike = $('[data-dislike]')
            $.ajax({
                url: '{{url('check-likedislike')}}',
                type: 'post',
                datatype: 'json',
                data:{
                    video: video_id,
                    _token:"{{csrf_token()}}"
                },
                success:function (res) {
                    if(res.result == 'like'){
                        like.addClass('active').removeClass('btn');
                        is_liked = true
                        dislike.addClass('disabled');
                    }else if(res.result == 'dislike'){
                        dislike.addClass('active').removeClass('btn');
                        is_liked = true
                        like.addClass('disabled');
                    }
                }
            })
        })
        $(document).on('click', '#saveLikeDislike', function () {
            if(!is_liked){
                let _video = $(this).data('video');
                let _type = $(this).data('type');
                let vm = $(this);

                $.ajax({
                    url:'{{url('save-likedislike')}}',
                    type: 'post',
                    dataType: 'json',
                    data:{
                        video:_video,
                        type: _type,
                        _token:"{{csrf_token()}}"
                    },
                    beforeSend:function () {
                        vm.addClass('disabled');
                    },
                    success:function (res) {
                        if(res.bool == true){
                            vm.removeClass('disabled').addClass('active');
                            is_liked = true
                            vm.removeAttr('id');
                            let _prevCount = $('.'+_type+'-count').text();
                            _prevCount++;
                            $('.'+_type+'-count').text(_prevCount);
                        }
                    }
                })
            }

        })
    </script>
@endsection
