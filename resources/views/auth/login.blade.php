@extends('layouts.login')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="{{ URL::to('/') }}">
            <img src="{{ asset('/images/Logo_Badan_POM.png')}}" alt="Balai Besar POM Kota Pontianak" width="200px" height="180px"/>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg"><b>Balai Besar POM Kota Pontianak</b></p>

        <form action="{{ route('login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group has-feedback {{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}">
            <input id="username" type="text" class="form-control" placeholder="E-mail or Username" name="username" value="{{ old('username') }}">
            @if ($errors->has('username'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password">
            @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
                {{-- <a href="#">Lupa Password?</a> --}}
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
            </div>
            <!-- /.col -->
        </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection