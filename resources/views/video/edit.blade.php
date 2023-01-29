@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="{{route("videos.update", $video->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Title</label>
                        <input class="form-control" name="title" id="exampleInputEmail1" type="text" value="{{$video->title}}">
                    </div>
                    <div class="form-group">
                        <label for="summernote">Description</label>
                        <textarea name="desc" id="summernote">{{$video->desc}}</textarea>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputFile">Poster</label>
                        <div class="my-2">
                            <img src="{{Storage::url($video->poster)}}" width="400px" alt="">
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input value="{{Storage::url($video->poster)}}" type="file" name="poster" multiple class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Change poster image</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Choose category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ $category->id == $video->category_id ? 'selected':''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Choose tags</label>
                        <select class="select2" name="tag_ids[]" multiple="multiple" data-placeholder="Choose tags" style="width: 100%;">
                            @foreach($tags as $tag)
                                <option {{ is_array($video->tags->pluck('id')->toArray()) && in_array($tag->id, $video->tags->pluck('id')->toArray()) ? ' selected' : '' }} value="{{$tag->id}}">{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
