@if(hasPermission($indexUrl.'/'.$item->id.'/edit', 'get'))
    <a href="{{url($indexUrl.'/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
       data-bs-placement="top" title="Edit"><em class="fa fa-pencil-square-o"></em></a>
@endif
