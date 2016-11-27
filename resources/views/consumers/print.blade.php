@extends('layouts.print')

@section('content')

<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <tbody>
        <tr>
            <th> Name </th><th> {{ $consumer->name }} </th>
        </tr>
        <tr>
            <th> Phone </th><td> {{ $consumer->phone }} </td>
        </tr>
        <tr>
            <th>Present Address </th><td>{{ $consumer->present_address }}</td>
        </tr>
        <tr>
            <th>Package </th><th><a href="{{ url('packages/'.$consumer->package->id) }}">{{ $consumer->package->name }}</a></th>
        </tr>
        <tr>
            <th>Amount </th><th>{{ number_format($consumer->amount) }}</th>
        </tr>
        </tbody>
    </table>
</div>

@endsection
