<div class="theme-form g-3 row mb-3" id="{{ $input['groupId'] ?? '' }}">
    <label for="{{ $input['name'] ?? '' }}" class="col-sm-2 form-label {{ (isset($input['required']) || isset($input['label-required'])) ? 'require' : '' }}">
        {{ isset($input['label']) ? translate($input['label']) : '' }}
    </label>
    <div class="{{ isset($input['fullWidth']) ? 'col-sm-10' : 'col-sm-6' }}">
        @if(isset($inputs))
        {{$inputs}}
        @else
            <div class="mb-3">
                <x-system.form.input-normal :input="$input"/>
            </div>
        @endif
    </div>
</div>
