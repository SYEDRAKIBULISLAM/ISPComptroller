@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User {{ $user->id }}
        <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['users', $user->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" title="Block User"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-warning btn-xs',
                    'title' => 'Block User',
                    'onclick'=>'return confirm("Confirm block?")'
            )) !!}
        {!! Form::close() !!}
    </h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $user->id }}</td>
                </tr>
                <tr><th> Name </th><td> {{ $user->name }} </td></tr>
                <tr><th> Username </th><td> {{ $user->username }} </td></tr>
                <tr><th> Email </th><td> {{ $user->email }} </td></tr>
                <tr><th> Contact </th><td> {{ $user->contact }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
