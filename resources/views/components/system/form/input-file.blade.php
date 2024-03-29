<div class="">
  <input type="file" class="form-control {{ (isset($input['error']) && $input['error'] !== "") ? 'is-invalid' : '' }}" id="{{ $input['id'] ?? $input['name'] }}" accept="{{ $input['accept'] ?? '*' }}"
         name="{{ $input['name'] }}"  {{ isset($input['disabled']) ? 'disabled' : '' }} {{ isset($input['multiple']) ? 'multiple' : '' }}>
<label class="col-sm-3 col-form-label" for="{{ $input['id'] ?? $input['name'] }}" data-browse="{{translate('Browse')}}">{{ translate($input['placeholder'] ?? '')}}</label>
</div>
@if(isset($input['helpText']))
  <small class="form-text text-muted">{{ translate($input['helpText']) ?? '' }}</small>
@endif
@if(isset($input['error']))<div class="invalid-feedback">{{ translate($input['error']) }}</div>@endif

