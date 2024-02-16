{{--@extends('system.layouts.form')--}}
{{--@section('inputs')--}}
{{--<x-system.form.form-group :input="[ 'name' => 'old_password', 'label'=> 'Old password','type' => 'password', 'required' => true, 'default' => old('old_password'), 'error' => $errors->first('old_password')]" />--}}
{{--<x-system.form.form-group :input="[ 'name' => 'password', 'label'=> 'New Password', 'required' => true, 'type' => 'password', 'default' => old('password'), 'error' => $errors->first('password')]" />--}}
{{--<x-system.form.form-group :input="[ 'name' => 'password_confirmation', 'label'=> 'Confirm Password', 'type' => 'password', 'required' => true, 'default' => old('password_confirmation'), 'error' => $errors->first('password_confirmation')]" />--}}
{{--@endsection--}}

@extends('system.layouts.form')
@section('inputs')
    <x-system.form.form-group
        :input="[ 'name' => 'name', 'label'=> 'Name', 'required' => true, 'default' => old('name') ?? $item->name ?? '', 'error' => $errors->first('name')]"/>
    <x-system.form.form-group
        :input="[ 'name' => 'username', 'label'=> 'Username', 'required' => true, 'default' => old('username') ?? $item->username ?? '', 'error' => $errors->first('username')]"/>
    <x-system.form.form-group
        :input="[ 'name' => 'email', 'label'=> 'Email', 'required' => true, 'default' => old('email') ?? $item->email ?? '', 'error' => $errors->first('email')]"/>

    <x-system.form.form-group :input="[ 'name' => 'image', 'label'=> 'Image']">
        <x-slot name="inputs">
            @if(isset($item->image))
                <img id="image-preview" src="{{asset('uploads/profile/'.$item->image)}}" width="150" height="auto"
                     alt="{{$item->title}}"/>
            @else
                <img id="image-preview" src="" width="150" height="auto"/>
            @endif

            <x-system.form.input-file
                :input="[ 'name' => 'image','label'=> 'Image','id'=>'image-input', 'accept' => 'image/*', 'default' =>old('image') ??  $item->image ?? '' , 'error' => $errors->first('image'),'onchange'=>'loadFile(event)']"/>
        </x-slot>
    </x-system.form.form-group>

    <x-system.form.form-group
        :input="['name' => 'contact', 'type'=>'tel','required' => 'true','label' => 'Contact','default' => old('contact') ?? $item->contact ?? '','error' => $errors->first('contact')]"/>
@endsection


@section('scripts')
    @include('system.partials.js.imageLoad',['imgPreviewId' => 'image-preview','imageId' => 'image-input']);
@endsection
