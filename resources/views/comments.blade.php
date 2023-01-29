<div class="mt-3 row">
    <div class="col-12">
        <h4 class="text-start pb-2">Comments</h4>
        @Auth()
            <form class="" action="{{route('add-comment')}}" method="POST">
                @csrf
                <div class="d-flex">
                    <img src="{{Storage::url($video->user->avatar)}}" class="rounded-circle" height="70px" width="70px" alt="">
                    <input type="text" name="comment" class="ms-2 my-auto form-control" placeholder="Add a comment...">
                    <input type="hidden" name="video_id" value="{{$video->id}}">
                    <button class="btn" title="Send"><i class="fas fa-chevron-right"></i></button>
                </div>
            </form>
        @endauth
{{--        1--}}
        @foreach($comments as $comment)
        <div class="mt-4 d-flex flex-start">
            <a class="link" href="{{route('profile',$comment->user->id)}}">
                <img class="rounded-circle shadow-1-strong me-3" src="{{Storage::URL($comment->user->avatar)}}" alt="avatar" width="70" height="70" />
            </a>
            <div class="flex-grow-1 flex-shrink-1">
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-1">
                            <a class="link" href="{{route('profile',$comment->user->id)}}">
                                {{$comment->user->name}} <span class="small">- {{$comment->created_at->diffForHumans()}}</span>
                            </a>
                        </p>
                        @Auth()
                        <a data-toggle="collapse" href="#collapseReplyComment{{$comment->id}}"><i class="fas fa-reply fa-xs"></i><span class="small"> reply</span></a>
                        @endauth
                    </div>
                    <p class="small mb-0">
                        {{$comment->comment}}
                    <form class="collapse" id="collapseReplyComment{{$comment->id}}" class="" action="{{route('add-comment')}}" method="POST">
                        @csrf
                        <div class="d-flex col-6">
                            <input type="text" name="comment" class="ms-2 my-auto form-control" placeholder="Reply to comment...">
                            <input type="hidden" name="video_id" value="{{$video->id}}">
                            <input type="hidden" name="parent_id" value="{{$comment->id}}">
                            <button class="btn" title="Send"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </form>
                    </p>
                </div>

                {{--REPLY--}}
                @if(count($comment->replies) > 0)
                    <a data-toggle="collapse" href="#collapseReplies"><span class="small">{{count($comment->replies)}} replies <i class="fas fa-angle-down"></i></span></a>
                    <div class="collapse" id="collapseReplies">
                        @foreach($comment->replies as $reply)
                            <div class="d-flex flex-start mt-2">
                                <a class="me-3 link" href="{{route('profile', $reply->user->id)}}">
                                    <img class="rounded-circle shadow-1-strong"
                                         src="{{Storage::URL($reply->user->avatar)}}" alt="avatar"
                                         width="65" height="65" />
                                </a>
                                <div class="flex-grow-1 flex-shrink-1">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="mb-1">
                                                <a class="me-3 link" href="{{route('profile', $reply->user->id)}}">
                                                    {{$reply->user->name}} <span class="small">- {{$reply->created_at->diffForHumans()}}</span>
                                                </a>
                                            </p>
                                        </div>
                                        <p class="small mb-0">
                                            {{$reply->comment}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

