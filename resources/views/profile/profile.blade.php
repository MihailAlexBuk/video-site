@extends('layouts.app')

@section('content')

    <div class="container bg-light">
        <div class="d-flex justify-content-between my-auto">
            <div class="icon-user d-flex mt-5">
                <a class="link">
                    <img class="rounded-circle" height="100px" width="100px" src="{{Storage::url($user->avatar)}}" alt="">
                </a>
                <span class="ms-3">
                    <div ><span class="fs-4">{{$user->name}}</span></div>
                    <div style="font-size: 16px"><span class="fw-bold">{{$user->followers->count()}}</span> subscribe</div>
                </span>
            </div>
            @if(Auth::id() !== $user->id)
            <div class=" my-auto">
                @auth()
                    @if (auth()->user()->isFollowing($user->id))
                        <td>
                            <form action="{{route('unfollow', ['id' => $user->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" id="delete-follow-{{ $user->id }}" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i> Unfollow
                                </button>
                            </form>
                        </td>
                    @else
                        <td>
                            <form action="{{route('follow', ['id' => $user->id])}}" method="POST">
                                @csrf
                                <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success">
                                    <i class="fa fa-btn fa-user"></i> Follow
                                </button>
                            </form>
                        </td>
                    @endif
                @endauth
            </div>
            @endif
        </div>
        <ul class="nav nav-tabs justify-content-center fs-5">
            <!-- Первая вкладка (активная) -->
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
            </li>
            <!-- Вторая вкладка -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#videos">Videos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#about">About</a>
            </li>
            @if(Auth::id() == $user->id)
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#statistic">Statistic</a>
                </li>
            @endif

        </ul>
        <div class="tab-content">
            <!-- HOME -->
            <div class="tab-pane fade show active" id="home">
                @if($most_popular_video->count() > 0)
                    <h3 class="mt-5 fw-bold">Most Popular</h3>
                    <div class="row row-cols-1 row-cols-md-4 g-4 mt-1" id="video-data">
                        @foreach($most_popular_video as $video)
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
                                        <a href="" class="video-card">
                                            <h6 class="video-subtitle">{{$video->user->name}}</h6>
                                        </a>
                                        <div class="video-subtitle d-flex justify-content-between">
                                            <article >watch</article>
                                            <article >{{$video->created_at}}</article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if($most_views_video->count() > 0)
                    <h3 class="mt-5 fw-bold">Most Views</h3>
                    <div class="row row-cols-1 row-cols-md-4 g-4 mt-1" id="video-data">
                        @foreach($most_views_video as $video)
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
                                        <a href="" class="video-card">
                                            <h6 class="video-subtitle">{{$video->user->name}}</h6>
                                        </a>
                                        <div class="video-subtitle d-flex justify-content-between">
                                            <article >watch</article>
                                            <article >{{$video->created_at}}</article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>

            <!-- VIDEOS -->
            <div class="tab-pane fade" id="videos">
                <div class="row row-cols-1 row-cols-md-4 g-4 mt-5" id="video-data">
                    @foreach($all_videos as $video)
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
                                <a href="" class="video-card">
                                    <h6 class="video-subtitle">{{$video->user->name}}</h6>
                                </a>
                                <div class="video-subtitle d-flex justify-content-between">
                                    <article >watch</article>
                                    <article >{{$video->created_at}}</article>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>

            <!-- ABOUT -->
            <div class="tab-pane fade" id="about">
                <div class="col-md-10 mx-auto mt-2">
                    <section class="content">
                        <div class="container-fluid mt-5">
                            {!! $user->desc !!}
                        </div>
                    </section>
                </div>
            </div>

            <!-- STATISTIC -->
        @if(Auth::id() == $user->id)

            <div class="tab-pane fade" id="statistic">
                <div class="col-10 mt-2">
                    <section class="content">

                        <div class="container-fluid mt-5">
                            <h3 class="text-center">Views</h3>
                            <canvas id="chartViews"></canvas>
                        </div>

                        <div class="container-fluid mt-5">
                            <h3 class="text-center">Likes</h3>
                            <canvas id="chartLikes"></canvas>
                        </div>

                        <div class="container-fluid mt-5">
                            <h3 class="text-center">Subscriptions</h3>
                            <canvas id="chartSubscriptions"></canvas>
                        </div>

                    </section>
                </div>
            </div>

        @endif
        </div>
    </div>

@endsection

@section('scripts')
<script>

    // Views
    const chartView = document.getElementById('chartViews');
    const view_months = JSON.parse('{!! json_encode($views_per_month['view_months']) !!}');
    const view_monthCount = JSON.parse('{!! json_encode($views_per_month['view_monthCount']) !!}');
    new Chart(chartView, {
        type: 'bar',
        data: {
            labels: view_months,    //x
            datasets: [{
                label: 'Views',
                data: view_monthCount,          //y
                borderWidth: 1
            }]
        },

    });

    // Likes
    const chartLikes = document.getElementById('chartLikes');
    const like_months = JSON.parse('{!! json_encode($likes_per_month['like_months']) !!}');
    const like_monthCount = JSON.parse('{!! json_encode($likes_per_month['like_monthCount']) !!}');
    new Chart(chartLikes, {
        type: 'bar',
        data: {
            labels: like_months,
            datasets: [{
                label: 'Likes',
                data: like_monthCount,
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y',
            scales: {
                y: {
                    ticks: {
                        crossAlign: 'far',
                    }
                }
            }
        }

    });

    // Subscriptions
    const chartSubscriptions = document.getElementById('chartSubscriptions');
    const subscription_months = JSON.parse('{!! json_encode($subscriptions_per_month['subscription_months']) !!}');
    const subscription_monthCount = JSON.parse('{!! json_encode($subscriptions_per_month['subscription_monthCount']) !!}');
    new Chart(chartSubscriptions, {
        type: 'line',
        data: {
            labels: subscription_months,
            datasets: [{
                label: 'New users',
                data: subscription_monthCount,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
    })


</script>
@endsection
