@extends('layouts.app')

@section('content')

    <h1>Payment {{ $payment->id }}
        @if(isset(Auth::user()->admin->user_id))
            <a href="{{ url('payments/' . $payment->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Payment"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
            {!! Form::open([
                'method'=>'DELETE',
                'url' => ['payments', $payment->id],
                'style' => 'display:inline'
            ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Payment',
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
                    <th>ID</th><td>{{ $payment->id }}</td>
                </tr>
                @if(isset($payment->consumer->id))
                    <th> Consumer </th><td><a href="{{ url('consumers/'.$payment->consumer->id) }}"> {{ $payment->consumer->name }} </a></td>
                @else
                    <th> Consumer </th><td><a href="#" class="text-danger"> Deleted </a></td>
                @endif
                <tr><th> Bill </th><td><a href="{{ url('bills/generate_bills/'.$payment->bill->generateBill->id) }}"> {{ $payment->bill->generateBill->name }} </a></td></tr>
                <tr><th> Amount </th><td> {{ $payment->amount }} </td></tr>
                <tr><th> Discount </th><td> {{ $payment->discount }} </td></tr>
                <tr><th> Due </th><td> {{ $payment->due }} </td></tr>
                <tr><th> Date </th><td> {{ $payment->date }} </td></tr>
            </tbody>
        </table>
    </div>

@endsection
