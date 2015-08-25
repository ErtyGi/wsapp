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
                <li><a href="{{URL::to('ticket/'.$ticket->slug)}}">Return to: {!! $ticket->title !!}</a></li>

            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->



    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-ticket"></i> Tickets
            </div>
            <div class="actions">
                @if(isperms('contact'))
                    <a href="{{URL::to('/ticket/create')}}" class="btn btn-primary btn-xs yellow-stripe">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-480"> New Ticket</span>
                    </a>
                @endif
            </div>
        </div>
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
                    <legend>Edit ticket</legend>
                    <div class="form-group">
                        <label for="title" class="col-lg-2 control-label">Title</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="title" name="title" value="{!! $ticket->title !!}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Content</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" rows="3" id="content" name="content">{!! $ticket->content !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="status" {!! $ticket->status?"":"checked"!!} > Close this ticket?
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="{{URL::to('ticket/'.$ticket->slug)}}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    </div>
@endsection