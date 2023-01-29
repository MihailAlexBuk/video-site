@if(count($videos) > 0)
    @foreach($videos as $video)
        <div>
            <form action="{{route('find')}}" method="POST">
                @csrf
                <input id="search-list" type="hidden" name="search" value="{{$video->title}}">
                <button type="submit" class="btn">{{$video->title}}</button>
            </form>
        </div>
    @endforeach
@else
    <div>
        No Results Found
    </div>
@endif



