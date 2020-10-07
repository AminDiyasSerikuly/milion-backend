@extends('layouts.dashboard')
@section('title')
    Список учителей
@endsection
@section('dashboard-content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('teacher.create')}}" class="btn btn-success">Добавить учителя</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="curator_data_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>ИИН</th>
                    <th>Номер телефона</th>
                </tr>
                </thead>
                <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{$teacher->first_name}}</td>
                        <td>{{$teacher->last_name}}</td>
                        <td>{{$teacher->middle_name}}</td>
                        <td>{{$teacher->social_id}}</td>
                        <td>{{$teacher->phone}}</td>
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
