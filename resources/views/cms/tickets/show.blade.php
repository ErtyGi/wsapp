@extends('sbadmin/layout')

@section('title') {{trans('app.user_management')}} @endsection


@section('head')

@endsection



@section('content')

    <div class="row">
        <div class="col-md-12">
            <h3 class="page-title">Tickets<small></small></h3>
            <ul class="page-breadcrumb breadcrumb">
                <li><i class="fa fa-home"></i> <a href="{{URL::to('/dashboard')}}">{{trans('app.dashboard')}}</a></li>
                <li><a href="{{URL::to('tickets')}}">Tickets</a></li>
            </ul>
        </div>
    </div>
    <!-- BEGIN PAGE CONTENT-->


    <div class="row">
    <div class="container col-md-8 col-md-offset-2">
        <div class="well well bs-component">
            <div class="content">
                <h2 class="header">{!! $ticket->title !!}</h2>
                <p><i class="fa fa-user"></i> {!! $ticket->user->name !!} {!! $ticket->user->surname !!}</p>
                <p> <strong>Status</strong>: {!! $ticket->status ? 'Pending' : 'Answered' !!}</p>
                <p class="lead"> {!! $ticket->content !!} </p>
            </div>
            <div class="btn-toolbar">
                <a href="{!! action('TicketsController@edit', $ticket->slug) !!}" class="btn btn-info pull-left">Edit</a>

                <form method="post" action={!! action('TicketsController@destroy', $ticket->slug) !!} class="pull-right">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-warning">Delete</button>
                        </div>
                    </div>
                </form>
             </div>
            <div class="clearfix"></div>
        </div>

        @foreach($comments as $comment)
            <div class="well well bs-component">
                <div class="content">
                    <section class="comment-list">
                        <header class="text-left">
                            <p class="text-right">Answer</p>
                            <div class="comment-user"><i class="fa fa-user"></i> {!! $comment->user->name !!} {!! $comment->user->surname !!}</div>
                        </header>
                        <div class="comment-post">
                            <p>{!! $comment->content !!}</p>
                            <p class="text-right"><time class="comment-date " datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> {!! date('F d, Y H:i', strtotime($comment->created_at))  !!}</time></p>
                        </div>
                    </section>
                </div>
            </div>
        @endforeach



        <div class="well well bs-component">
            <form class="form-horizontal" method="post" action="/comment">

                @foreach($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="post_id" value="{!! $ticket->id !!}">

                <fieldset>
                    <legend>Reply</legend>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <textarea class="form-control" rows="3" id="content" name="content"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button type="reset" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        </div>
    </div>
@endsection



@section('footer')

@endsection