@extends('layouts.app-admin')
@section('content')
    @include('layouts.header')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            miLionApp
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="https://png.pngtree.com/element_our/png/20181206/users-vector-icon-png_260862.jpg"
                         class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{route('profile.show')}}"
                       class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="pages/widgets.html" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Информация
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Пользователи
                                <i class="fas fa-angle-left right"></i>
                                <span class="badge badge-info right">4</span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pages/layout/top-nav.html" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Модератор</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('teacher.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Учитель</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('advisor.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Куратор</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('student.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Студент</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('subject.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Предметы
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('schedule.show')}}" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Расписание
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('news.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Новости
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('schedule.show')}}" class="nav-link">
                            <i class="nav-icon fas fa-check"></i>
                            <p>
                                Посещаемость
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('configure.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Системные настройки
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="content-wrapper">
        <div class="content-header">
            @if($success = session()->has('success') || $danger =  session()->has('danger'))
                <div class="container-fluid">
                    <div
                        class="alert alert-{{session()->has('success') ? 'success': 'danger'}} alert-dismissible fade show"
                        role="alert">
                        @if(isset($danger)) @foreach(session()->get('danger') as $error)
                            <strong>{{$error}}</strong> <br>
                        @endforeach
                        @endif
                        <strong>{{session()->get('success')}}</strong>


                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> @yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            @yield('dashboard-content')
        </section>
    </div>
    @include('layouts.footer')
@endsection
