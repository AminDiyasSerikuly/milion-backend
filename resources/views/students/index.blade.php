@extends('layouts.dashboard')
@section('dashboard-content')
    <div class="card">
        <div class="card-header">
            <a href="{{route('student.create')}}" class="btn btn-success">Добавить студента</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="curator_data_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Email</th>
                    <th>Адрес</th>
                    <th>Школа</th>
                    <th>Телефон</th>
                    <th>Стоимость курса</th>
                    <th>Куратор</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{$student->name}}</td>
                        <td>{{$student->last_name}}</td>
                        <td>{{$student->middle_name}}</td>
                        <td>{{$student->user? $student->user->email : 'Не указано'}}</td>
                        <td>{{$student->address}}</td>
                        <td>{{$student->school}}</td>
                        <td>{{$student->phone}}</td>
                        <td>{{$student->course_price}}</td>
                        <td>{{$student->advisor_id}}</td>
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
