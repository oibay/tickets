@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>Новые запросы <a class="btn btn-primary" href="{{ url('admin/add-new-request') }}">Добавить</a></h3>
@stop

@section('content')
    <table id="table_id" class="display">
        <thead>
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Пользователь</th>
            <th>Локация</th>
            <th>Статус</th>
            <th>Приоритет</th>
        </tr>
        </thead>
        <tbody>
        @if($tickets->count() > 0)
            @foreach($tickets as $item)
            <tr>
                <td>{{ $loop->index +1  }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->user['name'] }}</td>
                <td>{{ $item->location['title'] }}</td>
                <td>
                    @if($item->status == 'wait')
                        <span class="badge badge-danger">Ожидает</span>

                    @elseif($item->status == 'inprogress')
                        <span class="badge badge-primary">В работе</span>
                    @else
                        <span class="badge badge-success">Закрыт</span>
                    @endif
                </td>
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
