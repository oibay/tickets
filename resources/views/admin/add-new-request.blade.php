@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Новый запрос</h3>
@stop

@section('content')
    @include('message')
    <form action="{{ route('createTicket') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Название</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Описание</label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Пользователь</label>
            <select name="user_id" id="" class="form-control">
                @foreach($user as $item)
                    <option value="{{ $item->id }}"> {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Приоритет</label>
            <select name="priority" id="" class="form-control">
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Локация</label>
            <select name="location" id="" class="form-control">
                @foreach($location as $item)
                    <option value="{{ $item->id }}"> {{ $item->title }}</option>
                @endforeach
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
