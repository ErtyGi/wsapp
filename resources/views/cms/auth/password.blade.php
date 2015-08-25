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
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                @if(session()->has('status'))
                    @include('partials/error', ['type' => 'success', 'message' => session('status')])
                @endif
                @if(session()->has('error'))
                    @include('partials/error', ['type' => 'danger', 'message' => session('error')])
                @endif
                <hr>
                <h2 class="intro-text text-center">{{ trans('front/password.title') }}</h2>
                <hr>
                <p>{{ trans('front/password.info') }}</p>
                {!! Form::open(['url' => 'password/email', 'method' => 'post', 'role' => 'form']) !!}

                <div class="row">

                    {!! Form::control('email', 6, 'email', $errors, trans('front/password.email')) !!}
                    {!! Form::submit(trans('front/form.send'), ['col-lg-12']) !!}
                    {!! Form::text('address', '', ['class' => 'hpet']) !!}

                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop