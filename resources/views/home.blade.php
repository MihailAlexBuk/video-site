@extends('layouts.app')

@section('content')
    <div class="scrolling-pagination">
        <div class="row row-cols-1 row-cols-md-4 g-4" id="video-data">
            @include('data')
        </div>
    </div>
    <div class="ajax-load text-center" style="display: none;">
        <p><img width="30px" src="{{asset('images/load.gif')}}">Loading more videos...</p>
    </div>

    <script>
        function LoadMoreData(page) {
            $.ajax({
                url:'?page=' + page,
                type:'get',
                beforeSend: function () {
                    $('.ajax-load').show();
                }
            })
            .done(function (data) {
                if(data.html == ' '){
                    $('.ajax-load').html('No more records found');
                    return;
                }
                $('.ajax-load').hide();
                $('#video-data').append(data.html);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('Server not responding...');
            })
        }

        let page = 1;
        $(window).scroll(function () {
            if($(window).scrollTop() + $(window).height() >= $(document).height()){
                page++;
                LoadMoreData(page);
            }
        })
    </script>
@endsection
