@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Добавить локацию</h3>
@stop

@section('content')
    @include('message')
    <form action="{{ route('createLocation') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Название </label>
            <input type="text" class="form-control" name="title">
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
