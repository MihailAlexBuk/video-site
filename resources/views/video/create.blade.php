@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-8">
                <form action="{{route("videos.store")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Title</label>
                        <input class="form-control" name="title" id="exampleInputEmail1" type="text" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="summernote">Description</label>
                        <textarea name="desc" id="summernote" value="{{old('desc')}}"></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputFile">Poster</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="poster" multiple class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">image</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="exampleInputFile">Upload video</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="video_url" multiple class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">video</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Choose category</label>
                        <select name="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{ $category->id == old('category_id') ? 'selected':''}}>{{$category->title}}</option>
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
                                <option {{ is_array(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? 'selected' : '' }} value="{{$tag->id}}">{{$tag->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Create">
                    </div>



                </form>
            </div>
        </div>
    </div>

@endsection
