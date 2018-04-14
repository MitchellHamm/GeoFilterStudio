<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
    </head>
    <body>
        @include('components/navbars/default')
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    @include('components.headers.default', array('header' => ['title' => 'Login']))
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-offset-2 col-sm-8 col-xs-12">
                    @include('components.form-items.account-login-form', array('ajax' => ['end_point' => route('login.submit'), 'method' => 'post']))
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
        @include('sweet::alert')
    </body>
</html>