@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Новый пользователь</h3>
@stop

@section('content')
    @include('message')
    <form action="{{ route('createUser') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">ФИО</label>
            <input type="text" class="form-control" placeholder="Иван Иванов" required name="name">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">Локация</label>
            <select name="location" id="" class="form-control">
                @foreach($location as $item)
                    <option value="{{ $item->id }}"> {{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" class="form-control" placeholder="Email" required name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Пароль</label>
            <input type="text" name="password" class="form-control" value="{{ \Illuminate\Support\Str::random(8) }}" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Роли</label>
            <select name="role" id="" class="form-control">
                <option value="user">Пользователь</option>
                <option value="admin">Администратор</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

@stop

@section('js')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@stop
