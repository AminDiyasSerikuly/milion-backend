@extends('layouts.dashboard')
@section('dashboard-content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Форма для заполнение предмета</h3>
                </div>
                <div class="alert"><span class="text-danger">При создание предмета автоматический создается группа под этот предмет.</span>
                </div>
                <form action="{{route('subject.update', ['subject' => $subject->id ])}}" method="POST">
                    @method('PUT')
                    {{Form::token()}}
                    <div class="card-body">
                        <div class="form-group">
                            <label>Название предмета</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pen"></i></span>
                                </div>

                                {!! Form::text('title',$subject->title,[
                                            'class' => 'form-control',
                                            ]) !!}
                            </div>
                        </div>


                        <button class="btn btn-primary">
                            Сохранить
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
