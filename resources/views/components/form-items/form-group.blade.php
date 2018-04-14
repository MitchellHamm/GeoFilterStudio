 <div class="form-group">
     <label>{{ $field['label'] }}
         @if(isset($required))
             <span class="element-red">*</span>
         @endif
     </label>
     <input type="{{ $field['input_type'] }}"
            class="form-control" placeholder="{{ $field['placeholder'] }}"
            name="{{ $field['name'] }}" value="{{ old($field['name']) === null ? $field['value'] : old($field['name'])}}">
     <div class="error element-red">{{ $errors->first($field['name']) }}</div>
 </div>