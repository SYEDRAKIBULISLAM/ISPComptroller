@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> {{ $user->name }}
            <a href="{{ url('myprofile/edit') }}" class="btn btn-primary btn-xs" title="Edit My Profile"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        </h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                <tr><th> Name </th><td> {{ $user->name }} </td></tr>
                <tr><th> Username </th><td> {{ $user->username }} </td></tr>
                <tr><th> Email </th><td> {{ $user->email }} </td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
