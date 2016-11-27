@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Consumer {{ $consumer->id }}
        <a href="#" onclick="printSection()" class="btn btn-info btn-xs" title="Print Consumer"><span class="glyphicon glyphicon-print" aria-hidden="true"/></a>
        <a href="{{ url('consumers/' . $consumer->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Consumer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        @if(isset(Auth::user()->admin->user_id))
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['consumers', $consumer->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Consumer',
                        'onclick'=>'return confirm("Confirm delete?")'
                )) !!}
            {!! Form::close() !!}
        @endif
    </h1>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $consumer->id }}</td>
                </tr>
                <tr>
                    <th> Name </th><th> {{ $consumer->name }} </th>
                </tr>
                <tr>
                    <th> Email </th><td> {{ $consumer->email }} </td>
                </tr>
                <tr>
                    <th> Phone </th><td> {{ $consumer->phone }} </td>
                </tr>
                <tr>
                    <th>Occupation </th><td>{{ $consumer->occupation }}</td>
                </tr>
                <tr>
                    <th>Father's Name </th><td>{{ $consumer->father_name }}</td>
                </tr>
                <tr>
                    <th>Mother's Name </th><td>{{ $consumer->mother_name }}</td>
                </tr>
                <tr>
                    <th>Present Address </th><td>{{ $consumer->present_address }}</td>
                </tr>
                <tr>
                    <th>Permanent Address </th><td>{{ $consumer->permanent_address }}</td>
                </tr>
                @if($consumer->img_name)
                <tr>
                    <th>Image </th><td>{!! Html::image('upload/images/'.$consumer->img_name, 'Old Image',array('width' => '200', 'height' => '200')) !!}</td>
                </tr>
                @endif
                <tr>
                    <th>NID </th><td>{{ $consumer->NID }}</td>
                </tr>
                <tr>
                    <th>Package </th><th><a href="{{ url('packages/'.$consumer->package->id) }}">{{ $consumer->package->name }}</a></th>
                </tr>
                <tr>
                    <th>Amount </th><th>{{ number_format($consumer->amount) }}</th>
                </tr>
                <tr>
                    <th>IP </th><th>{{ $consumer->IP }}</th>
                </tr>
                <tr>
                    <th>Start Date </th><th>{{ $consumer->start_date }}</th>
                </tr>
                <tr>
                    <th>End Date </th><td>{{ $consumer->end_date }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<div style="visibility: hidden" >
    <iframe id="printf" name="printf"  src="{{ url('consumers/' . $consumer->id . '/print') }}" height="300px" width=" 100%" ></iframe>
</div>
<script>
    function printSection() {
        window.frames["printf"].focus();
        window.frames["printf"].print();
    }
</script>
@endsection
