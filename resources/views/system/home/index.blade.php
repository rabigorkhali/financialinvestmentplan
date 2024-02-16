@extends('system.layouts.master')
@section('contents')
 <div class="container-fluid default-dash">
        <div class="row">
            <div class="col-xl-6 col-md-6 dash-xl-50">
                <div class="card profile-greeting">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <div class="greeting-user">
                                    <h1>Hello, {{Auth::user()->name?? ''}} </h1>
                                    <p>Welcome back, your dashboard is ready!</p>
                                </div>
                            </div>
                        </div>
                        <div class="cartoon-img"><img class="img-fluid" src="{{asset('images/images.svg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
