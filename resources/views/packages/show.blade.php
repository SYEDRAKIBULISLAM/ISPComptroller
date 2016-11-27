@extends('layouts.app')

@section('content')

    <h1>Package {{ $package->id }}
        @if(isset(Auth::user()->admin->user_id))
        <a href="{{ url('/packages/' . $package->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Package"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/packages', $package->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Package',
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
                    <th>ID</th><td>{{ $package->id }}</td>
                </tr>
                <tr><th> Name </th><td> {{ $package->name }} </td></tr><tr><th> Bandwidth </th><td> {{ $package->bandwidth }} </td></tr>
            </tbody>
        </table>
    </div>


@endsection
