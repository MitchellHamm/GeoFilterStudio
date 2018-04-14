<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}">
        <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
    </head>
    <body>
        @include('components/navbars/default')
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        @include('components.headers.default', array('header' => ['title' => 'User Profile']))
                        <br><br>
                    </div>
                    <div class="col-sm-3 text-center">
                        @include('components.list-groups.default', array('listItems' => $listItems))
                    </div>
                    <div class="col-sm-9">
                        @include('components.account-items.' . $accountTab, array('params' => $tabParams))
                    </div>
                </div>
            </div>
        </div>
        @include('sweet::alert')
    </body>
</html>