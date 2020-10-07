@extends('layouts.dashboard')
@section('dashboard-content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('advisor.create')}}" class="btn btn-success">Добавить куратора</a>
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
                    <th>Адрес</th>
                </tr>
                </thead>
                <tbody>
                @foreach($advisors as $advisor)
                    <tr>
                        <td>{{$advisor->first_name}}</td>
                        <td>{{$advisor->last_name}}</td>
                        <td>{{$advisor->middle_name}}</td>
                        <td>{{$advisor->social_id}}</td>
                        <td>{{$advisor->phone}}</td>
                        <td>{{$advisor->address}}</td>
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
