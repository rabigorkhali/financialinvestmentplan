@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="url($indexUrl)">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'label' => 'Search keyword', 'default' => Request::get('keyword')]" />
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th scope="col">{{translate('S.N')}}</th>
    <th scope="col">{{translate('Language')}}</th>
    <th scope="col">{{translate('Action')}}</th>
</tr>
@endsection

@section('table-data')
@php $pageIndex = pageIndex($items); @endphp
@foreach($items as $key=>$item)
<tr>
    <td>{{SN($pageIndex, $key)}}</td>
    <td>{{ $item->name }} ({{$item->language_code}})</td>
    <td>
        @if(!$item->isDefault() && hasPermission($indexUrl.'/'.$item->id, 'delete'))
        @include('system.partials.deleteButton')
        @endif
    </td>
</tr>
@endforeach
@endsection
