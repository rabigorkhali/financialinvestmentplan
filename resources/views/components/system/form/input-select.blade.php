<select class="form-select mb-3 {{ isset($input['error']) && $input['error'] !== '' ? 'is-invalid' : '' }}"
    {{ isset($input['disabled']) && $input['disabled'] !== '' ? 'disabled' : '' }}
    {{ isset($input['multiple']) ? 'multiple' : '' }} {{ isset($input['required']) ? 'required' : '' }}
     data-prefix="{{ getSystemPrefix() }}" data-url="{{ url('/') }}"
    name="{{ $input['name'] ?? '' }}" id="{{ $input['id'] ?? ($input['name'] ?? '') }}" id="validationCustom04">
     @if (isset($input['placeholder']))
        <option value="">{{ translate($input['placeholder']) }}</option>
    @endif
    @if (isset($input['options']))
        @foreach ($input['options'] as $key => $value)
            <option value="{{ $key }}" {{ $input['default'] == $key ? 'selected' : '' }}>{{ $value }}
            </option>
        @endforeach
    @endif
</select>
