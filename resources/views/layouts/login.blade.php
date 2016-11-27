<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ISPComptroller</title>

    <!-- Fonts -->
    {!! Html::style('design/css/font-awesome.min.css') !!}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    {{--Bootstrap --}}
    {!! Html::style('design/css/bootstrap.min.css') !!}
    {!! Html::style('design/css/print.css', array('media' => 'print')) !!}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">



@yield('content')

    <!-- JavaScripts -->
    {!! Html::script('design/js/jquery.min.js') !!}
    {!! Html::script('design/js/bootstrap.min.js') !!}
</body>
</html>
