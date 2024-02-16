@if(!$items->isEmpty())
    @if(method_exists($items, 'perPage') && method_exists($items, 'currentPage'))
        <div class="pagination-tile">
            <label class="pagination-sub" style="display: block">
                {{translate('Showing') }} {{($items->currentpage()-1)*$items->perpage()+1}} {{translate('to')}} {{(($items->currentpage()-1)*$items->perpage())+$items->count()}} {{translate('of')}} {{$items->total()}} {{translate('entries')}}
            </label>
            <ul class="pagination">
                {!! str_replace('/?', '?',$items->appends([Request::input()])->render()) !!}
            </ul>
        </div>
    @endif
@endif
