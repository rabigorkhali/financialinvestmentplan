<div class="col-md-2">
  <div class="col-auto mb-3 d-flex gap-2" id="{{ $input['groupId'] ?? '' }}">
    <label class="sr-only" for="{{ $input['name'] ?? '' }}">{{ translate($input['label'] ?? '') }}</label>
    @if(isset($inputs))
    {{$inputs}}
    @else
    <x-system.form.input-normal :input="$input" />
    @endif
  </div>
</div>
