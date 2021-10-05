@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Пользователи <a class="btn btn-primary" href="{{ url('admin/add-new-location') }}">Добавить</a></h3>
@stop

@section('content')
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>

        </tr>
        </thead>
        <tbody>
        @if($location->count() > 0)
            @foreach($location as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $item->title }}</td>

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
