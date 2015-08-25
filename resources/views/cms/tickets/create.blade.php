@extends('sbadmin/layout')

@section('title') {{trans('app.user_management')}} @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Tickets<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/')}}">{{trans('app.dashboard')}}</a></li>
                <li><a href="{{URL::to('tickets')}}">Tickets</a></li>
                <li><strong>New Ticket</strong></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="container col-md-8 col-md-offset-2">
    <div class="well well bs-component">

        <form class="form-horizontal" method="post">

            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

            <input type="hidden" name="_token" value="{!! csrf_token() !!}">

            <fieldset>
                <legend>Submit a new ticket</legend>
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Title</label>
                    <div class="col-lg-10">
                        <input type="title" class="form-control" id="title" placeholder="Title" name="title">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-lg-2 control-label">Content</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                        <span class="help-block">Feel free to ask us any question.</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endsection