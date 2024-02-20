<div class="col-md-2">
    <div class="col-auto {{ isset($input['class']) ? $input['class'] : '' }}" id="{{ $input['groupId'] ?? '' }}">
        <label class="sr-only" for="{{ $input['name'] ?? '' }}">{{ translate($input['label'] ?? '') }}</label>
        @if (isset($inputs))
            {{ $inputs }}
        @else
            <x-system.form.input-normal :input="$input" />
        @endif
    </div>
</div>
