@props(['action', 'method'])
<form method="{{ $method ?? 'get' }}" action="{{$action}}" class="mb-2">
    <div class="row g-3">
        {{$inputs}}
        <div class="col-md-2">
            <button class="btn btn-primary mb-2" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Search"><em class="fa fa-search"></em></button>
            <a href="{{ $action }}" class="btn btn-danger mb-2 ml-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Reset"><em class="fa fa-refresh"></em></a>
        </div>
    </div>
</form>
