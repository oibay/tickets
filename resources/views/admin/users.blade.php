@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Пользователи <a class="btn btn-primary" href="{{ url('admin/add-new-user') }}">Добавить</a></h3>
@stop

@section('content')
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>ФИО</th>
            <th>Email</th>
            <th>Локация</th>
            <th>Пароль</th>
        </tr>
        </thead>
        <tbody>
        @if($users->count() > 0)
            @foreach($users as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->location['title'] }}</td>
                    <td>{{ $item->password_text }}</td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
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
