<form role="form" autocomplete="on" action="{{ $ajax['end_point'] }}" method="{{ $ajax['method'] }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @foreach($fields as $field)
        @include('components.form-items.form-group', array('field' => [ 'label' => $field['label'],
                                                                        'input_type' => $field['input_type'],
                                                                        'placeholder' => $field['placeholder'],
                                                                        'name' => $field['name'],
                                                                        'value' => $user[$field['name']]
                                                                        ]))
    @endforeach
    <br>
    <div class="row">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
</form>