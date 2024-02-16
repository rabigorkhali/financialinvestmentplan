@extends('system.layouts.listing')

@section('create')
@endsection

@section('header')
    <x-system.search-form :action="url($indexUrl)">
        <x-slot name="inputs">
            <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
            <x-system.form.form-inline-group :input="[
                'name' => 'daterange',
                'class' => 'form-control digits',
                'type' => 'text',
                'label' => 'Select Date Range',
                'data-language' => 'true',
                'default' => Request::get('range'),
                'autoComplete' => 'off',
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
        <th>{{translate("S.N")}}</th>
        <th>{{translate("IP")}}</th>
        <th>{{translate('Log Date')}}</th>
        <th style="width: 30%;">{{translate('User Agent')}}</th>
        <th style="width: 30%;">{{translate('Request End Point')}}</th>
        <th style="width: 30%;">{{translate('Response Code')}}</th>
        <th style="width: 30%;">{{translate('Response Time')}}</th>
        <th style="width: 30%;">{{translate('Request Body')}}</th>
        <th style="width: 30%;">{{translate('Response Body')}}</th>
    </tr>
@endsection

@section('table-data')
    @php $pageIndex = pageIndex($items); @endphp
    @foreach($items as $key=>$item)
        <tr>
            <td>{{SN($pageIndex, $key)}}</td>
            <td>{{$item->ip ?? 'N/A'}}</td>
            <td>{{$item->log_date ?? 'N/A'}}</td>
            <td>{{$item->user_agent ?? 'N/A'}}</td>
            <td>{{$item->request_endpoint ?? 'N/A'}}</td>
            <td>{{$item->response_code ?? 'N/A'}}</td>
            <td>{{$item->response_time ?? 'N/A'}}</td>
            <td>{{$item->request_body ?? 'N/A'}}</td>
            <td>{{$item->response_body ?? 'N/A'}}</td>
        </tr>
    @endforeach
@endsection
