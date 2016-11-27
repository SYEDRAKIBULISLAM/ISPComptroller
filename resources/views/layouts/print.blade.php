<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ISPComptroller</title>

    {{--Bootstrap --}}
    {!! Html::style('design/css/bootstrap.min.css') !!}
    {!! Html::style('design/css/print.css', array('media' => 'print')) !!}
</head>
<body>



@yield('content')

<!-- JavaScripts -->
{!! Html::script('design/js/jquery.min.js') !!}
{!! Html::script('design/js/bootstrap.min.js') !!}


</body>
</html>
