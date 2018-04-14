<div class="row">
    <div class="col-xs-12 text-center">
        <p>Place An Order</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        @include('components.form-items.account-order', array(  'textAreas' => $params['textAreas'],
                                                                'optionalTextAreas' => $params['optionalTextAreas'],
                                                                'additionalComments' => $params['additionalComments'],
                                                                'user' => $params['user'],
                                                                'ajax' => ['end_point' => route('account.index', ['order']), 'method' => 'post']))
    </div>
</div>