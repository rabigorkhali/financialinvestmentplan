@extends('system.layouts.masterGuest')
@section('content')

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">

                    <form class="theme-form login-form" method="post" action="{{ route('login') }}">
                        @include('system.partials.message')
                        <h4>{{translate('Login')}}</h4>
                        <h6>{{translate('Welcome back! Log in to your account.')}}</h6>
                        @csrf
                        @if (isset($redirectUrl))
                            <input type="hidden" name="redirect" value="{{ $redirectUrl }}">
                        @endif
                        <div class="form-group">
                            <label>{{translate('Email Address/Username')}}</label>
                            <div class="input-group"><span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control" type="text" name="email" placeholder="Email Address/Username" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{translate('Password')}}</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="icon-lock"></i>
                                </span>

                                <input class="form-control" type="password" name="password" required="" id="password"
                                       placeholder="*********">
                            </div>
                        </div>
                        <h6>{{ translate('You are current using IP') }} - <strong>{{ Request::ip() }}</strong></h6>

                        <div class="form-group">
                            <div class="checkbox">
                                <input type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">{{translate('Remember password')}}</label>
                            </div>
                            <a class="link" href="{{ route('forgot.password') }}">{{translate('Forgot password?')}}</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">{{translate('Sign in')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
