@extends('system.layouts.listing')

@section('create')
@endsection
@section('header')
    <x-system.search-form :action="url($indexUrl)">
        <x-slot name="inputs">
            <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
            <x-system.form.form-inline-group :input="['name' => 'daterange','class' => 'form-control digits','type' => 'text','label' => 'Select Date Range','data-language' => 'true','default' => Request::get('range'),'autoComplete' => 'off',
            ]" />
            <input type="hidden" name="from" id="from" value="{{ Request::get('from') }}">
            <input type="hidden" name="to" id="to" value="{{ Request::get('to') }}">
        </x-slot>
    </x-system.search-form>
    @if (hasPermission($indexUrl . '/download-excel', 'get'))
        <a class="btn btn-sm btn-info mr-3 mb-2" type="submit"
           href="{{ $indexUrl }}/download-excel?from_date={{ Request::get('from') }}&to_date={{ Request::get('to') }}&keyword={{ Request::get('keyword') }}"> {{ translate('Download Excel') }}</a>
    @endif
@endsection

@section('table-heading')
    <tr>
        <th scope="col">{{ translate('S.N') }}</th>
        <th scope="col">{{ translate('User') }}</th>
        <th scope="col">{{ translate('Ip Address') }}</th>
        <th scope="col">{{ translate('Time') }}</th>
        <th scope="col">{{ translate('ISP') }}</th>
        <th scope="col">{{ translate('Location') }}</th>
    </tr>
@endsection

@section('table-data')
    @php $pageIndex = pageIndex($items); @endphp
    @foreach ($items as $key => $item)
        <tr>
            <td>{{ SN($pageIndex, $key) }}</td>
            <td>{{ $item->user->name ?? 'N/A' }}</td>
            <td>{{ $item->ip ?? '' }}</td>
            <td>{{ localDateTime($item->created_at) }}</td>
            <td>
                Latitude : {{ $item->lat ?? '' }}<br>
                Longitude : {{ $item->lon ?? '' }}<br>
                City : {{ $item->city ?? '' }}<br>
                Country : {{ $item->country ?? '' }}<br>
            </td>
            <td>{{ $item->region_name ?? '' }}</td>
        </tr>
    @endforeach
@endsection
