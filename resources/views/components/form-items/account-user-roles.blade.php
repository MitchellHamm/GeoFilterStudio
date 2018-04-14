<form role="form" autocomplete="on" action="{{ $ajax['end_point'] }}" method="{{ $ajax['method'] }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for a user via their email" name="email" value="{{ empty($userSearch) ? '' : $userSearch }}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">Search</button>
        </span>
    </div>
</form>
<br>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Phone Number</th>
        <th>User Role</th>
    </tr>
    </thead>
    <tbody>
    @if($results)
        @foreach($results as $result)
            <tr>
                <td>{{ $result['email'] }}</td>
                <td>{{ $result['first_name'] }}</td>
                <td>{{ $result['last_name'] }}</td>
                <td>{{ $result['phone_number'] }}</td>
                <td>
                    <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <select name="user_role" {{ $result['role'] == 'Developer' ? 'disabled' : '' }}>
                            <option {{$result['role'] == 'User' ? 'selected' : ''}} value="User">User</option>
                            <option {{$result['role'] == 'Designer' ? 'selected' : ''}} value="Designer">Designer</option>
                            <option {{$result['role'] == 'Manager' ? 'selected' : ''}} value="Manager">Manager</option>
                            <option {{$result['role'] == 'Admin' ? 'selected' : ''}} value="Admin">Admin</option>
                            <option disabled {{$result['role'] == 'Developer' ? 'selected' : ''}} value="Developer">Developer</option>
                        </select>
                        <input type="hidden" name="user_id" value="{{ $result['id'] }}">
                        <button {{ $result['role'] == 'Developer' ? 'disabled' : '' }} type="button" class="btn btn-sm btn-success" onclick="updateUserRole(this.form._token.value, this.form.user_id.value, this.form.user_role.value)">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
@if(!empty($searchError))
    <div class="error element-red">{{ $searchError }}</div>
@endif

<script>
    function updateUserRole(token, user_id, user_role) {
        $.ajax({
            type: 'POST',
            url: '{{ route('user-roles.update') }}',
            data: {'_token': token, 'user_id': user_id, 'user_role': user_role},
            success: function(data, textStatus, jqXHR) {
                message = data.result;
                code = data.status;
                if(code == 200) {
                    swal({
                        title: 'Role Updated',
                        text: message,
                        type: 'success',
                        timer: 2000,
                        showConfirmButton: true
                    });
                } else {
                    swal({
                        title: 'Error',
                        text: message,
                        type: 'error',
                        timer: 2000,
                        showConfirmButton: true
                    });
                }
            },
            dataType: 'json'
        });
    }
</script>