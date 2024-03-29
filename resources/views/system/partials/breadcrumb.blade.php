@if(isset($breadcrumbs))
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $breadcrumb)
            <li class="breadcrumb-item {{ isset($breadcrumb['active']) && $breadcrumb['active']=='true' ? 'active' : '' }}">
                @if(isset($breadcrumb['active']) && $breadcrumb['active'])
                    {{ translate($breadcrumb['title']) }}
                @else
                    <a href="{{ $breadcrumb['link'] ? url($breadcrumb['link']) : '' }}">{{ translate($breadcrumb['title']) ?? '' }}</a>
                @endif
            </li>
        @endforeach
    </ol>
    </nav>
@endif

