<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ISP Comptroller </title>

    <!-- Fonts -->
    {!! Html::style('design/css/font-awesome.min.css') !!}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    {{--Bootstrap --}}
    {!! Html::style('design/css/bootstrap.min.css') !!}


    <!-- Morris Charts CSS -->
    {!! Html::style('design/css/morris.css') !!}

    <!-- Styles -->

    {!! Html::style('design/css/admin.css') !!}
    {!! Html::style('design/css/style.css') !!}
    {{--Daterange--}}
    {!! Html::script('design/js/jquery.min.js') !!}




</head>
<body id="app-layout">
    <div id="wrapper">

        <!-- Navigation -->
        {{--Header--}}
        @include('common.header')

        {{--Sidebar--}}
        @include('common.sidebar')

        <div id="page-wrapper">


            {{--Page Heading--}}
            @include('common.breadcrumb')

            @if (Session::has('flash_message'))
                <div class="alert alert-success" align="center" id="success-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('flash_message') }}
                </div>
            @elseif(Session::has('warning_msg'))
                <div class="alert alert-warning" align="center" id="warning-alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ Session::get('warning_msg') }}
                </div>
            @endif

            <div id="page-inner">
                {{--Content--}}
                @yield('content')



            </div>
            {{--Footer--}}
            @include('common.footer')
        </div>


    </div>
    <!-- /#wrapper -->



    <!-- JavaScripts -->
    {!! Html::script('design/js/jquery.min.js') !!}
    {!! Html::script('design/js/bootstrap.min.js') !!}

    {{--Menu--}}
    {!! Html::script('design/js/metis-menu.js') !!}

    {{--Daterange--}}
    {!! Html::script('design/js/moment.js') !!}
    {!! Html::script('design/js/daterangepicker.js') !!}

    <!-- Morris Charts JavaScript -->
    {!! Html::script('design/js/raphael.min.js') !!}
    {{--{!! Html::script('design/js/morris.min.js') !!}--}}
    {{--{!! Html::script('design/js/morris-data.js') !!}--}}

    {{--chart--}}
    {{--{!! Html::script('design/js/easyPiChart.js') !!}--}}
    {{--{!! Html::script('design/js/easyPiChartData.js') !!}--}}
    {{--Custom--}}
    {!! Html::script('design/js/admin.js') !!}
    {!! Html::script('design/js/custom.js') !!}
</body>
</html>
