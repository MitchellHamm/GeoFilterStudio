<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        @include('components.headers.default', array('header' => ['title' => 'Account Created!']))
                    </div>
                </div>
                <div class="row col-xs-12 text-center">
                    <p>Your account has been created. Click <a href="{{route('account-home.index', ['home'])}}">here</a> to see your profile and view your orders.</p>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
        @include('sweet::alert')
    </body>
</html>