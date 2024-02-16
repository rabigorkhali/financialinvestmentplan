@extends('system.layouts.listing')
@section('header')
<x-system.search-form :action="$indexUrl">
    <x-slot name="inputs">
        <x-system.form.form-inline-group :input="['name' => 'keyword', 'placeholder' => 'Keyword', 'default' => Request::get('keyword')]"></x-system.form.form-inline-group>
    </x-slot>
</x-system.search-form>
@endsection

@section('table-heading')
<tr>
    <th>{{translate('S.N')}}</th>   
    <th>{{translate('Action')}}</th>
</tr>
@endsection

@section('table-data')
@php $a=$items->perPage() * ($items->currentPage()-1); @endphp
@foreach($items as $item)
@php $a++ @endphp
<tr>
    <td>{{ $a }} </td>    
    <td>
        @include('system.partials.editButton')
        @include('system.partials.deleteButton')
    </td>
</tr>
@endforeach
@endsection