@extends('admin.main.index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование пользователя</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{route('users.index')}}">Пользователи</a></li>
                        <li class="breadcrumb-item active">Редактирование пользователя</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <form action="{{route('users.update', $user->id)}}" method="POST" class="col-4">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="role">
                            @foreach($roles as $id => $role)
                                <option value="{{$id}}" {{ $user->role ? 'selected':''}}>{{$role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Обновить">
                    </div>
                </form>

            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

    </section>
@endsection
