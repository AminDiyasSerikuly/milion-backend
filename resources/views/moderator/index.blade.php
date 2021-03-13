@extends('layouts.dashboard')
@section('title')
    Список модераторов
@endsection
@section('dashboard-content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('moderator.create')}}" class="btn btn-success">Добавить модератора</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="moderator_data_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Активный</th>
                    <th>Дата создание</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($moderators as $moderator)
                    <tr>
                        <td>{{$moderator->first_name}}</td>
                        <td>{{$moderator->last_name}}</td>
                        <td>{{$moderator->is_active ? 'Да' : 'Нет'}}</td>
                        <td>{{$moderator->created_at}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
@section('js')
    <script src="{{asset("dashboard/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
    <script>
        $(function () {
            $("#curator_data_table").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
