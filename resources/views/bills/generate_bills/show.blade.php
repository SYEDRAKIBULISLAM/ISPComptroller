@extends('layouts.app')

@section('content')

    <h1>Bill Generator {{ $generate_bill->id }}
        <a href="{{ url('bills/generate_bills/' . $generate_bill->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Bill Generator"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['bills/generate_bills', $generate_bill->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Bill Generator',
                    'onclick'=>'return confirm("Confirm delete?")'
            )) !!}
        {!! Form::close() !!}
    </h1>
    <hr/>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $generate_bill->id }}</td>
                </tr>
                <tr><th> Name </th><td> {{ $generate_bill->name }} </td></tr><tr><th> Date </th><td> {{ $generate_bill->date }} </td></tr>
            </tbody>
        </table>
    </div>

@endsection
