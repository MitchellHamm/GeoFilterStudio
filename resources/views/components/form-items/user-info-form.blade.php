<form role="form" autocomplete="on" action="{{ $ajax['end_point'] }}" method="{{ $ajax['method'] }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @foreach($requiredFields as $requiredField)
        @include('components.form-items.form-group', array('field' => [ 'label' => $requiredField['label'],
                                                                        'input_type' => $requiredField['input_type'],
                                                                        'placeholder' => $requiredField['placeholder'],
                                                                        'name' => $requiredField['name'],
                                                                        'value' => $requiredField['value'],
                                                                        'required' => true]))
    @endforeach
    @foreach($optionalFields as $optionalField)
        @include('components.form-items.form-group', array('field' => [ 'label' => $optionalField['label'],
                                                                        'input_type' => $optionalField['input_type'],
                                                                        'placeholder' => $optionalField['placeholder'],
                                                                        'name' => $optionalField['name'],
                                                                        'value' => $optionalField['value']]))
    @endforeach
    <div class="form-group">
        <label>How did you hear about us?</label>
            @foreach($referrals as $referral)
                <div class="checkbox">
                    <label><input type="checkbox" name="{{ $referral['name'] }}" value="0">{{ $referral['label'] }}</label>
                </div>
            @endforeach
        </div>
    <button type="submit" class="btn btn-success">Place My Order</button>
</form>