@if(hasPermission($indexUrl.'/'.$item->id.'/toggle-status', 'get'))
    <button class="update-button btn {{!empty($item->status) ? 'btn-primary' : 'btn-danger'}}"
            data-update-url="{{route('changeStatus', ['id' => $item->id])}}">
        <em class="fa fa-refresh"></em>
        @if ($item->status)
            {{ translate('Active') }}
        @else
            {{ translate('In-Active') }}
        @endif
    </button>
@endif
