<div class="row">
    <div class="col-xs-12 text-center">
        <p>Existing Orders</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        @include('components.form-items.account-existing-orders', array('existingOrders' => $params['existingOrders']))
    </div>
</div>