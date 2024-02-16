@extends('system.layouts.form')
@section('inputs')
    <x-system.form.form-group
        :input="[ 'name' => 'title', 'label' => 'Title', 'required' => true, 'default' => $item->title ?? old('title'), 'error' => $errors->first('title')]"/>
    <x-system.form.form-group
        :input="[ 'name' => 'code', 'label' => 'Code', 'required' => true, 'default' => $item->code ?? old('code'),'readonly'=>true, 'error' => $errors->first('code')]"/>
    <x-system.form.form-group
        :input="[ 'name' => 'from', 'label' => 'From Email', 'required' => true, 'default' => $item->from ?? old('from'), 'error' => $errors->first('from')]"/>

    @php
        $lang= app()->getLocale()
    @endphp

    <input type="hidden" name="language_code" value="{{$lang}}">
    <x-system.form.form-group
        :input="['label' => 'Subject', 'required' => true,'error' => $errors->first('subject')]">
        <x-slot name="inputs">
            <x-system.form.input-normal
                :input="['name'=>'subject', 'label' => 'Subject','default' => isset($item) ? $item->emailTranslationWithLocale->subject : old('subject'), 'error' => $errors->first('subject')]"/>
        </x-slot>
    </x-system.form.form-group>
    <x-system.form.form-group
        :input="['label' => 'Template', 'required' => true,'error' => $errors->first('template')]">
        <x-slot name="inputs">
            <x-system.form.text-area
                :input="['name'=>'template', 'label' => 'Template', 'editor' => true,'rows'=>10, 'default' => isset($item) ? $item->emailTranslationWithLocale->template : old('template'), 'error' => $errors->first('template')]"/>
            <label><strong>Placeholders: {{isset($item) ? $item->placeholders : null}}</strong></label>
        </x-slot>
    </x-system.form.form-group>
@endsection
@section('scripts')
    <script>
        const errors = `{{ array_key_first($errors->get('multilingual.*')) }}`
        if (errors.length > 0) {
            const indexes = errors.split('.')
            $('#tabControls' + indexes[1] + 'tab').tab('show')
        } else {
            $('#tabControls0tab').tab('show')
        }
    </script>
@endsection
