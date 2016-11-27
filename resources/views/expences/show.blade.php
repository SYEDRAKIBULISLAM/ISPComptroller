@extends('layouts.app')

@section('content')

    <h1>Expence {{ $expence->id }}
        @if(isset(Auth::user()->admin->user_id))
            <a href="{{ url('expences/' . $expence->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Expence"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['expences', $expence->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Expence',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
            {!! Form::close() !!}
        @endif
    </h1>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $expence->id }}</td>
                </tr>
                <tr>
                    <th> Purpose </th><td> {{ $expence->purpose }} </td>
                </tr>
                <tr>
                    <th> Amount </th><td> {{ $expence->amount }} </td>
                </tr>
                <tr>
                    <th> Date </th><td> {{ $expence->date }} </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
