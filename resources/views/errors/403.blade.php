<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ISP Comptroller | Access Forbidden</title>

    <!-- Fonts -->
    {!! Html::style('design/css/font-awesome.css') !!}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    {!! Html::style('design/css/bootstrap.css') !!}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="hero-unit" align="center">
                    <h1>Access Forbidden <small><font face="Tahoma" color="red">Error 403</font></small></h1>
                    <br />
                    <h3>403 Forbidden - You don't have permission to access "/" on this server.</h3>
                    <hr>
                    <h2><b>Additionally, a 403 Forbidden error was encountered while trying to use an ErrorDocument to handle the request.</b></h2>
                    <a href="{{ url('/') }}" class="btn btn-large btn-success"><span class="glyphicon glyphicon-home"></span> Go To Home</a>
                    <a href="http://syedrakibulislam.com/" target="_blank" class="btn btn-large btn-info"><span class="glyphicon glyphicon-user"></span> Contact Us</a>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScripts -->
    {!! Html::script('design/js/jquery-1.11.2.min.js') !!}
    {!! Html::script('design/js/bootstrap.js') !!}
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
