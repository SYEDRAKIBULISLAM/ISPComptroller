@extends('layouts.app')

@section('content')

    <h1>Create New User</h1>
    <hr/>

    {!! Form::open(['url' => '/users', 'class' => 'form-horizontal']) !!}

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name *', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
            </div>
            <div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
                {!! Form::label('username', 'Username *', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('username', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email *', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('contact') ? 'has-error' : ''}}">
                {!! Form::label('contact', 'Contact', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('contact', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('contact', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                {!! Form::label('password', 'Password *', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="input-group">
                        {!! Form::password('password', ['class' => 'form-control pwd', 'placeholder' => 'Minimum 6 digits password length', 'required' => 'required', 'id' => 'password']) !!}
                        <span class="input-group-btn">
                            <button class="btn btn-default form-control reveal" type="button"><i class="glyphicon glyphicon-eye-open"></i></button>
                        </span>
                    </div>
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection