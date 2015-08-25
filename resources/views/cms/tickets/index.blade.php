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
        <div class="portlet-body">
            <div class="table-container">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($tickets->isEmpty())
                    <p> There is no ticket.</p>
                @else
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="5%">ID</th>
                            <th width="30%">Title</th>
                            <th width="20%">Status</th>
                            <th width="20%">Date</th>
                            <th width="20%">Action</th>
                            <th width="5%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{!! $ticket->id !!}</td>
                                <td>
                                    <a href="{!! action('TicketsController@show', $ticket->slug) !!}">{!! $ticket->title !!} </a>
                                </td>
                                <td>{!! $ticket->status ? 'Pending' : 'Answered' !!}</td>
                                <td>{!! date('F d, Y H:i', strtotime($ticket->created_at))  !!}</td>
                                <td>
                                    <a href="{!! action('TicketsController@show', $ticket->slug) !!}" class="btn btn-xs btn-default">View</a>
                                    <a href="{!! action('TicketsController@edit', $ticket->slug) !!}" class="btn btn-xs btn-info">Edit</a>
                                </td>
                                <td>
                                    <form method="post" action="{!! action('TicketsController@destroy', $ticket->slug) !!}" class="pull-left">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <div class="form-group">
                                            <div>
                                                <button type="submit" class="btn  btn-xs btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

@endsection


















    <div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> Tickets </h2>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        @if ($tickets->isEmpty())
            <p> There is no ticket.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{!! $ticket->id !!}</td>
                        <td>
                            <a href="{!! action('TicketsController@show', $ticket->slug) !!}">{!! $ticket->title !!} </a>
                        </td>
                        <td>{!! $ticket->status ? 'Pending' : 'Answered' !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection