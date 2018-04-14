<div class="row">
    <div class="col-xs-12 text-center">
        <p>Additional Info</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        @include('components.form-items.account-additional-info', array('fields' => $params['additionalInfo'], 'user' => $params['user'],
                                                                        'ajax' => ['end_point' => route('account.index', ['home']), 'method' => 'post']))
    </div>
</div>