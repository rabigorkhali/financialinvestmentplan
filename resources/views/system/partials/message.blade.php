@if( ($errors->first('alert-success') || $errors->first('alert-danger') || $errors->first('alert-warning')))
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if($errors->has('alert-' . $msg))
            <div class="alert alert-{{ $msg }} dark alert-dismissible fade show" role="alert">
                <p>{{translate($errors->first('alert-' .$msg))}}
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </p>
            </div>
        @endif
    @endforeach
@elseif($errors->first('alert-throttle'))
    <div class="alert alert-danger dark alert-dismissible fade show" id="alert-throttle" role="alert">
        <p>{{$errors->first('alert-throttle')}}
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </p>
    </div>
@endif

