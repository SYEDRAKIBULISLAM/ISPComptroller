@extends('layouts.app')

@section('content')

    <h1>Request {{ $consumer_request->id }}
        @if(isset(Auth::user()->admin->user_id))
            <a href="{{ url('consumer_requests/' . $consumer_request->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Request"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['consumer_requests', $consumer_request->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Request',
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
                    <th>ID</th><td>{{ $consumer_request->id }}</td>
                </tr>
                <tr><th> Consumer Id </th><td> {{ $consumer_request->consumer->name }} </td></tr><tr><th> Note </th><td> {{ $consumer_request->note }} </td></tr><tr><th> Date </th><td> {{ $consumer_request->date }} </td></tr>
            </tbody>
        </table>
    </div>

@endsection
