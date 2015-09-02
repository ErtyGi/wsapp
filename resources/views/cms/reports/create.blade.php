@extends('sbadmin/layout')

@section('title') {{trans('app.user_management')}} @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Reports<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                <li><a href="{{URL::to('analisi/reports')}}">Reports</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="container col-md-8 col-md-offset-2">
        {!! Form::model($report = new App\Model\Report ,['url' => 'analisi/reports']) !!}


        <div class="form-group">
            {!! Form::label('user_id', 'User Id:') !!}
            {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('website_id', 'Website ID:') !!}
            {!! Form::text('website_id', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Report', ['class' => 'btn btn-primary form-control']) !!}
        </div>

        {!! Form::close() !!}

        </div>
    </div>

@endsection