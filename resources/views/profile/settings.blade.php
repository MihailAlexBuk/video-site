@extends('layouts.app')

@section('content')
    <div class="col-md-6 mx-auto mt-2">
        <section class="content">
            <div class="container-fluid">
                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div class="row">
                    <form action="{{route("updateUserData")}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <h3>Change username</h3>
                            <input type="text" class="form-control" name="name" placeholder="{{$user->name}}">
                        </div>

                        <div class="form-group mt-2">
                            <h3>Change avatar</h3>
                            <div class="text-center mt-2">
                                <img src="{{Storage::url($user->avatar)}}" class="rounded-circle" height="100px" width="100px" alt="">
                            </div>
                            <div class="custom-file mt-5">
                                <input type="file" name="avatar" multiple class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">image</label>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <h3>Change description</h3>
                            <textarea name="desc" id="summernote">{{$user->desc}}</textarea>
                        </div>

                        <div class="form-group mt-2">
                            <h3>Change Password</h3>
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="old_password" >
                            <label>New Password</label>
                            <input type="password" class="form-control" name="new_password" value="">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="new_password_confirmation" value="">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary w-100" value="Update">
                        </div>
                    </form>

                </div>
            </div>
        </section>

    </div>
@endsection
