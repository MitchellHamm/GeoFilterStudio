<form role="form" autocomplete="on" action="{{ $ajax['end_point'] }}" method="{{ $ajax['method'] }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @foreach($requiredFields as $requiredField)
        @include('components.form-items.form-group', array('field' => [ 'label' => $requiredField['label'],
                                                                        'input_type' => $requiredField['input_type'],
                                                                        'placeholder' => $requiredField['placeholder'],
                                                                        'name' => $requiredField['name'],
                                                                        'value' => ''
                                                                        ]))
    @endforeach
    <br>
    <div class="row">
        <div class="col-xs-12 text-center">
            <button type="submit" class="btn btn-success">Create My Account</button>
        </div>
    </div>
</form>