
<label><input type="checkbox" name="{{ $checkbox['name'] }}" id="{{ $checkbox['name'] }}">  {{ $checkbox['label'] }}</label>
<br></br>
<div class="form-group" id="{{ $textArea['name'] }}">
    <label>{{ $textArea['label'] }}</label>
    <textarea class="form-control" rows="{{ $textArea['rows'] }}" name="{{ $textArea['name'] }}">{{ old($textArea['name']) === null ? $textArea['value'] : old($textArea['name'])}}</textarea>
    <div class="error element-red">{{ $errors->first($textArea['name']) }}</div>
</div>

<script>
    $(document).ready(function() {
        $("#{{ $textArea['name'] }}").hide();
        $("#{{ $checkbox['name'] }}").change(function () {
            if ($(this).is(':checked')) {
                $("#{{ $textArea['name'] }}").show();
            } else {
                $("#{{ $textArea['name'] }}").hide();
            }
        });
    });
</script>