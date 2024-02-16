@extends('system.layouts.form')
@section('inputs')
<x-system.form.form-group :input="[
        'name' => 'title',
        'required' => 'true',
        'id' => 'title',
        'label' => 'Page Title',
        'default' => $item->title ?? old('title'),
        'error' => $errors->first('title'),
    ]" />
<x-system.form.form-group :input="[
        'name' => 'slug',
        'required' => 'true',
        'id' => 'slug',
        'label' => 'Page Slug',
        'default' => $item->slug ?? old('slug'),
        'error' => $errors->first('slug'),
    ]" />
<x-system.form.form-group :input="[ 'name' => 'image', 'label'=> 'Image']">
    <x-slot name="inputs">

        @if(isset($item->image))
        <img id="image-preview" src="{{asset('uploads/pages/'.$item->image)}}" width="150" height="auto" alt="{{$item->title}}" />
        @else
        <img id="image-preview" src="" width="150" height="auto" />
        @endif

        <x-system.form.input-file :input="[ 'name' => 'image','label'=> 'Image','id'=>'image-input', 'accept' => 'image/*', 'default' =>old('image') ??  $item->image ?? '' , 'error' => $errors->first('image'),'onchange'=>'loadFile(event)']" />
    </x-slot>
</x-system.form.form-group>

<x-system.form.form-group :input="['label' => 'Page Description']">
    <x-slot name="inputs">
        <x-system.form.text-area :input="[
                'name' => 'description',
                'required' => 'true',
                'label' => 'Description',
                'editor' => true,
                'default' =>old('description') ?? $item->description ?? '',
                'error' => $errors->first('description'),
            ]" />
    </x-slot>
</x-system.form.form-group>
<x-system.form.form-group :input="[
        'name' => 'meta_title',
        'required' => 'true',
        'id' => 'seoTitle',
        'label' => 'Meta Title',
        'default' => old('meta_title') ?? $item->meta_title ?? '',
        'error' => $errors->first('meta_title'),
    ]" />
<x-system.form.form-group :input="['label' => 'Meta Description']">
    <x-slot name="inputs">
        <x-system.form.text-area :input="[
                'name' => 'meta_description',
                'label' => 'Meta Description',
                'default' => old('meta_description') ?? $item->meta_description ?? '',
                'error' => $errors->first('meta_description'),
            ]" />
    </x-slot>
</x-system.form.form-group>

<div class="theme-form g-3 row mb-3" id="">
    <label class="input-label col-sm-2 form-label">Tag</label>
    <div class="col-sm-6">
        <input type="text" class="form-control" placeholder="keywords" data-role="tagsinput" name="keywords" value="{{ old('keywords') ??  $item->keywords ?? '' }}">
    </div>
</div>

<x-system.form.form-group :input="['label' => 'Status']">
    <x-slot name="inputs">
        <x-system.form.input-radio :input="['name' => 'status', 'options' => $status, 'default' => $item->status ?? 1]" />
    </x-slot>
</x-system.form.form-group>
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
@include('system.partials.js.slug',['name' => 'title']);
@include('system.partials.js.imageLoad',['imgPreviewId' => 'image-preview','imageId' => 'image-input']);
<script>
    $(function() {
        $('input')
            .on('change', function(event) {
                var $element = $(event.target);
                var $container = $element.closest('.example');

                if (!$element.data('tagsinput')) return;

                var val = $element.val();
                if (val === null) val = 'null';
                var items = $element.tagsinput('items');

                $('code', $('pre.val', $container)).html(
                    $.isArray(val) ?
                    JSON.stringify(val) :
                    '"' + val.replace('"', '\\"') + '"'
                );
                $('code', $('pre.items', $container)).html(
                    JSON.stringify($element.tagsinput('items'))
                );
            })
            .trigger('change');
    });
</script>
@endsection