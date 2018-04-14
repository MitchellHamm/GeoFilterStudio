<div class="form-group">
    <label>{{ $field['label'] }}
        @if(isset($required))
            <span class="element-red">*</span>
        @endif
    </label>
    <textarea class="form-control" rows="{{ $field['rows'] }}" name="{{ $field['name'] }}">{{ old($field['name']) === null ? $field['value'] : old($field['name'])}}</textarea>
    <div class="error element-red">{{ $errors->first($field['name']) }}</div>
</div>