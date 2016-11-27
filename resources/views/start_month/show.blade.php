@extends('layouts.app')

@section('content')

    <h1>Start_month {{ $start_month->id }}
        <a href="{{ url('start_month/' . $start_month->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Start_month"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['start_month', $start_month->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Start_month',
                    'onclick'=>'return confirm("Confirm delete?")'
            )) !!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $start_month->id }}</td>
                </tr>
                
            </tbody>
        </table>
    </div>

@endsection
