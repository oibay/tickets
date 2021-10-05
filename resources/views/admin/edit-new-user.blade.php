@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>{{ $user->name }}</h3>
@stop

@section('content')
    @include('message')
    <form action="{{ route('updateUser',$user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">ФИО</label>
            <input type="text" class="form-control" value="{{ $user->name }}" required name="name">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">Локация</label>
            <select name="location" id="" class="form-control">
                @foreach($location as $item)
                    <option value="{{ $item->id }}"
                    @if($user->location_id == $item->id) selected @endif
                    > {{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" class="form-control" value="{{ $user->email }}" required name="email">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Пароль</label>
            <input type="text" name="password" class="form-control" value="{{ $user->password_text }}" required>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Роли</label>
            <select name="role" id="" class="form-control">
                <option value="user" @if($user->role == 'user') selected @endif >Пользователь</option>
                <option value="admin" @if($user->role == 'admin') selected @endif>Администратор</option>
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
