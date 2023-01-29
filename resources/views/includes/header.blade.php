<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Home
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>
            <ul style="width: 400px;">
                <form action="{{route('find')}}" method="post" class="input-group pt-3" >
                    @csrf
                    <input autocomplete="off" type="search" name="search" id="search" class="form-control rounded-3" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit"  class="btn">
                        <img src="{{asset('assets/icons/search.svg')}}" alt="">
                    </button>
                </form>
                <div id="result" class="search-list visually-hidden">
                    <div id="memList">

                    </div>
                </div>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
{{--                    @foreach($notifications as $notification)--}}
{{--                            {{$qwe['message']}}--}}
{{--                    <br>--}}
{{--                    @endforeach--}}
                    <li class="nav dropdown">
                        <a class="" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img src="{{asset('assets/icons/bell-fill.svg')}}" alt="notifications">
                            @if(auth()->user()->unreadnotifications->count() > 0)
                                <span class="count-notif">{{auth()->user()->unreadnotifications->count()}}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu" >
                            @if(auth()->user()->unreadnotifications->count() > 0)
                                @foreach($notifications as $notification)
                                    <li class="dropdown-header">
                                        <div class="d-flex justify-content-between">
                                            <span class="">
                                                @if($notification['notif_type'] === 'App\Notifications\UserFollowed')
                                                    <a href="{{route('profile', $notification['user_id'])}}"><b>{{$notification['user_name']}}</b></a> started following you !!!
                                                @elseif($notification['notif_type'] === 'App\Notifications\NewVideo')
                                                    <a href="{{route('profile', $notification['user_id'])}}"><b>{{$notification['user_name']}}</b></a> published a <a href="{{route('watch', $notification['video_id'])}}">video</a> !!!
                                                @endif
                                            </span>
                                            <span data-user="{{$notification['notif_id']}}" id="markAsRead" class="btn btn-danger ml-1">read</span>
                                        </div>
                                    </li>
                                @endforeach
                                <li class="float-end me-3 mt-3">
                                    <span class="btn btn-success ml-1" id="markAsReadAll">read all</span>
                                </li>
                            @else
                                <li class="dropdown-header">No notifications</li>
                            @endif
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<script>

    $(document).mouseup(function (e) {
        let container = $("#memList");
        if (container.has(e.target).length === 0){
            $('#result').addClass('visually-hidden')
        }
    });

    $('#search').keyup(function () {
        let search = $('#search').val()
        if(search == ''){
            $('#memList').html('')
            $('#result').addClass('visually-hidden')
        }else{
            $.get("{{URL::to('search')}}", {search:search}, function (data) {
                $('#memList').empty().html(data)
                $('#result').removeClass('visually-hidden')
            })
        }
    })

    $(document).on('click', '#markAsRead',function () {
        let id_follower = $(this).data('user')
        $.ajax({
            url: '{{url('markAsRead')}}',
            type: 'post',
            dataType: 'json',
            data:{
                id: id_follower,
                _token:"{{csrf_token()}}"
            },
            success:function (res) {
            }
        })
    })

    $(document).on('click', '#markAsReadAll',function () {
        let id_follower = $(this).data('user')
        $.ajax({
            url: '{{url('markAsReadAll')}}',
            type: 'get',
            success:function (res) {
            }
        })
    })
</script>
