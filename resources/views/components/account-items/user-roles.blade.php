<div class="row">
    <div class="col-xs-12 text-center">
        <p>Assign User Roles</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        @include('components.form-items.account-user-roles', array( 'results' => isset($params['results']) ? $params['results'] : false,
                                                                    'userSearch' => isset($params['userSearch']) ? $params['userSearch'] : false,
                                                                    'searchError' => isset($params['searchError']) ? $params['searchError'] : false,
                                                                    'ajax' => ['end_point' => route('account.index', ['user-roles']), 'method' => 'post']))
    </div>
</div>