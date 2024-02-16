@extends('system.layouts.masterGuest')
@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div class="login-main">
                        @include('system.partials.message')
                        <form class="theme-form login-form" method="post" action="{{url(getSystemPrefix().'/set-password')}}"
                              id="forgot-password-form">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="fa fa-envelope"></i></span>
                                    <input type="text" name="email" class="form-control" placeholder="Email"
                                           value="{{ old('email') ?? Request::get('email') }}" readonly>
                                </div>
                                @error('email')
                                <div class="d-block invalid-feedback">{{$errors->first('email')}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>OTP Code</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="fa fa-key"></i></span>
                                    <input type="text" name="otp_code" class="form-control" placeholder="OTP Code"
                                           value="{{ old('otp_code') }}">
                                </div>
                                @error('otp_code')
                                <div class="d-block invalid-feedback">{{$errors->first('otp_code')}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="fa fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                           value="{{ old('password') }}">
                                </div>
                                @error('password')
                                <div class="d-block invalid-feedback">{{$errors->first('password')}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="fa fa-lock"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control"
                                           placeholder="Confirm Password"
                                           value="{{ old('password_confirmation') }}">
                                </div>
                                @error('password_confirmation')
                                <div class="d-block invalid-feedback">{{$errors->first('password_confirmation')}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block"
                                        id="forgot-password-btn">{{ translate('Submit') }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
