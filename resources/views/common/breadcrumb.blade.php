
    <div class="header">
        {{--<h1 class="page-header">--}}
            {{--Dashboard <small>Summary of your App</small>--}}
        {{--</h1>--}}
        <br/>
        <div class="breadcrumb">
            <div class="btn-group btn-breadcrumb" style="text-transform: capitalize;">
                <a href="{{ url('/') }}" class="btn btn-primary"><i class="glyphicon glyphicon-home"></i></a>
                {{-- */$key=1;/* --}}
                @foreach(Request::segments() as $segment)
                    <a href="{{ url('/') }}@for($i = 1; $i <= $key; $i++)/{{Request::segment($i)}}@endfor" class="btn btn-primary">{{ Request::segment($key) }}</a>
                    {{--*/$key++;/*--}}
                @endforeach
            </div>
        </div>

    </div>
