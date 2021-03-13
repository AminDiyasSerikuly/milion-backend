@extends('layouts.dashboard')
@section('title')
    Информация
@endsection
@section('dashboard-content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$results['user_count']}}</h3>
                            <p>Кол-во пользователей</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Подробнее<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$results['student_count']}}</h3>

                            <p>Кол-во студентов</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Подробнее<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$results['advisor_count']}}</h3>

                            <p>Кол-во кураторов</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Подробнее<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$results['teacher_count']}}</h3>
                            <p>Кол-во учителей</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Подробнее<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$results['group_count']}}</h3>
                            <p>Кол-во групп</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Подробнее<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$results['subject_count']}}</h3>
                            <p>Кол-во предметов</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Подробнее<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$results['news_count']}}</h3>
                            <p>Кол-во новостей</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            Подробнее<i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Загрузки</span>
                            <span class="info-box-number">13,648</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Лайки</span>
                            <span class="info-box-number">0</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-battery-three-quarters"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Производительность</span>
                            <span class="info-box-number">13,648</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-memory"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Оставшиеся память</span>
                            <span class="info-box-number">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">График активности пользователей</h3>
                                <a href="javascript:void(0);">Посмотреть таблицу</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg"></span>
                                    <span>Общее кол-во активных пользователей</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="chart">
                                <canvas id="barChart"
                                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                {{--                                <a href="{{route('home.index', ['week_number' => (1 - 1)])}}"--}}
                                {{--                                   class="mr-2 btn btn-success text-white">--}}
                                {{--                                    <i class="fas fa-arrow-left"></i> &nbsp; Предыдущая неделя--}}
                                {{--                                </a>--}}

                                {{--                                <a href="{{route('home.index', ['week_number' => (1 + 1)])}}"--}}
                                {{--                                   class=" btn btn-success text-white">--}}
                                {{--                                    Следующая неделя &nbsp;<i class="fas fa-arrow-right "></i>--}}
                                {{--                                </a>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
