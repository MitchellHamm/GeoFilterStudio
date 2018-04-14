<div class="row">
    <div class="col-xs-12 text-center">
        <p>My Team</p>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        @include('components.form-items.account-my-teams', array('teams' => $params['teams'], 'user' => $params['user'],
                                                                        'ajax' => ['end_point' => route('account.index', ['my-team']), 'method' => 'post']))
    </div>
</div>