<form role="form" autocomplete="on" action="{{ $ajax['end_point'] }}" method="{{ $ajax['method'] }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @foreach($textAreas as $textArea)
        @include('components.form-items.textarea', array('field' => [ 'label' => $textArea['label'],
                                                                      'name' => $textArea['name'],
                                                                      'value' => $textArea['value'],
                                                                      'rows' => $textArea['rows'],
                                                                      'required' => true
                                                                      ]))
    @endforeach
    @foreach($optionalTextAreas as $optionalTextArea)
        @include('components.form-items.check-show-text-area', array('checkbox' => $optionalTextArea['checkbox'],
                                                                     'textArea' => $optionalTextArea['textArea']
                                                                    ))
    @endforeach
    @include('components.form-items.textarea', array('field' => $additionalComments))
    <div class="row">
        <div class="col-xs-12">
            <button type="submit" class="btn btn-success">Place Order</button>
        </div>
    </div>
</form>