@extends('layouts.app')

@section('content')

    <h1>Bill {{ $bill->id }}
        @if(isset(Auth::user()->admin->user_id))
            <a href="{{ url('bills/' . $bill->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Bill"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['bills', $bill->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Bill',
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
                    <th>ID</th><td>{{ $bill->id }}</td>
                </tr>
                <tr>
                    @if(isset($bill->consumer->id))
                        <th> Consumer </th><td><a href="{{ url('consumers/'.$bill->consumer->id) }}"> {{ $bill->consumer->name }} </a></td>
                    @else
                        <th> Consumer </th><td><a href="#" class="text-danger"> Deleted </a></td>
                    @endif

                </tr>
                <tr>
                    <th> Bill </th><td><a href="{{ url('bills/generate_bills/'.$bill->generateBill->id) }}"> {{ $bill->generateBill->name }} </a></td>
                </tr>
                <tr>
                    <th> Amount </th><td> {{ $bill->amount }} </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
