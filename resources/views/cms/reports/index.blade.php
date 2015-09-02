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



    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-report"></i> Reports
            </div>
            <div class="actions">
                    <a href="{!! action('Admin\ReportsController@create') !!}" class="btn btn-primary btn-xs yellow-stripe">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-480"> New Report</span>
                    </a>
            </div>
        </div>
    </div>

        <div class="portlet-body">
            <div class="table-container">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($reports->isEmpty())
                    <p> There is no Report.</p>
                @else
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr role="row" class="heading">
                            <th width="10%">ID</th>

                            <th width="20%">Date</th>
                            <th width="10%">Action</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td>{!! $report->id !!}</td>


                                <td>
                                    {!! date('F d, Y H:i', strtotime($report->created_at))  !!}

                                </td>
                                <td>
                                    <a href="{!! action('Admin\ReportsController@show', $report->id) !!}" class="btn btn-xs btn-default">View</a>
                                </td>
                                <td>
                                    <form method="post" action="{!! action('Admin\ReportsController@destroy', $report->id) !!}" class="pull-left">
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