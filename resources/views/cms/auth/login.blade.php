@extends('sbadmin.login_layout')

@section('title')
    {{trans('app.app_name')}} - {{trans('app.userlogin')}}
@endsection


<div class="row">
    <div class="iconLogo">
        <img id="profile-img" class="profile-img-card" src="http://www.prima-posizione.it/wp-content/uploads/2014/09/logo_prima-posizione.png" />
    </div>
</div>

@section('content')



    <form role="form" method="post" action="{{ url('/auth/login') }}">
        <fieldset>

            @include('sbadmin/partial/inc_error')

            <div class="form-group">
                <input class="form-control" placeholder="{{trans('app.email')}}" name="email" type="email" autofocus required>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="{{trans('app.password')}}" name="password" type="password" value="" required>
            </div>

           {{-- <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" id="remember">{{trans('app.remember')}}
                </label>
                <p class="help-block">{{trans('app.rememberme')}}</p>
            </div> --}}

            <button type="submit" class="btn btn-lg btn-success btn-block">{{trans('app.login')}}</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </fieldset>
    </form>

    <div class="row">
        <div class="col-lg-12">
            {!! link_to('password/email', trans('passwords.forget')) !!}
        </div>
    </div>

@stop