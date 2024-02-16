@extends('system.layouts.masterGuest')
@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div class="login-main">
                        @include('system.partials.message')
                        <form class="theme-form login-form" method="post" action="" id="forgot-password-form">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group"><span class="input-group-text"><i
                                            class="fa fa-envelope"></i></span>
                                    <input type="text" name="email" class="form-control" placeholder="Email"
                                           value="{{ old('email') }}">
                                </div>
                                @error('email')
                                <div class="d-block invalid-feedback">{{$errors->first('email')}}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="forgot-password-btn">{{ translate('Submit') }} </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
