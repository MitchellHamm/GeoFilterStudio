<a id="addNewTeam">
    Add New Team
</a>
<form style="display:none" id="addTeamForm" role="form" autocomplete="on" action="{{ $ajax['end_point'] }}" method="{{ $ajax['method'] }}">
    <br>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @include('components.form-items.form-group', array('field' => [ 'label' => 'Team Name',
                                                                    'input_type' => 'text',
                                                                    'placeholder' => 'Team Name',
                                                                    'name' => 'name',
                                                                    'value' => '',
                                                                    'required' => true]))
    <button type="button" id="cancelAddTeam" class="btn btn-default">Cancel</button>
    <button type="submit" class="btn btn-success">Add Team</button>
</form>
@foreach($teams as $team)
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    {{ $team['name'] }}
                </div>
                <div class="col-xs-12 col-sm-6 text-right">
                    Members: 0
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    Members:
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-xs-12">
                    <a onclick="addTeamMember({{ $team['id'] }})">Add Member</a>
                </div>
                <div class="col-xs-12">
                    <a>Contact All Members</a>
                </div>
                <div class="col-xs-12">
                    <a>Delete Team</a>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    Created at {{ date('g:i a F d, Y', strtotime($team['created_at'])) }}
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    $(document).ready(function() {
        $("#addNewTeam").click(function() {
            if($("#addTeamForm").is(':visible')) {
                $("#addTeamForm").hide();
            } else {
                $("#addTeamForm").show();
            }
        });
        $("#cancelAddTeam").click(function() {
            if($("#addTeamForm").is(':visible')) {
                $("#addTeamForm").hide();
            } else {
                $("#addTeamForm").show();
            }
        });
    });

    function addTeamMember(teamId) {
        swal({
            title: 'Enter The Users Email Address',
            //input: 'email',
            //inputClass: 'emailSearch',
            showCancelButton: true,
            confirmButtonText: 'Add User',
            showLoaderOnConfirm: true,
            allowOutsideClick: true,
            html: '<form id="emailAutoComplete"><div style="width:100%" class="input-group"><input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="team_id" value="' + teamId + '"> <input class="emailSearch swal2-input" type="email" name="email" placeholder="Search for an email" class="form-control"> </div> </div> </form>',
            onOpen: function(elements) {
                $(".emailSearch").autocomplete({
                    source: function (request, response) {
                        $.ajax({
                            url: '{{ route('user.search') }}',
                            data: { email: request.term },
                            dataType: 'json',
                            success: function(data) {
                                if(data.status == 200) {
                                    var emails = [];
                                    data.result.forEach(function(result) {
                                        emails.push(result.email);
                                    });
                                    response(emails);
                                } else {
                                    response(['No Results']);
                                }
                            },
                            error: function () {
                                response(['Error Loading Results']);
                            }
                        });
                    },
                    minLength:3,
                    delay:500,
                    appendTo: $('#emailAutoComplete')
                });
            },
            preConfirm: function() {
                return new Promise(function(resolve, reject) {
                    _token = $("[name='_token']").val();
                    team_id = $("[name='team_id']").val();
                    user_email = $("[name='email']").val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('team.add-member') }}',
                        data: { _token: _token, team_id: team_id, user_email: user_email },
                        dataType: 'json',
                        success: function(data) {
                            if(data.status == 200) {
                                resolve();
                            } else {
                                reject(data.result);
                            }
                        },
                        error: function () {
                            reject('Server error adding user');
                        }
                    });
                });
                /*return new Promise(function(resolve, reject) {

                });*/
            }
        }).then(function() {
            swal({
                type: 'success',
                title: 'Team Member Added!',
                text: 'The user has been added to your team and alerted via email. You can now assign them design jobs and track their progress!',
                showCloseButton: true,
                confirmButtonText: 'Got it'
            });
        });
    }
</script>