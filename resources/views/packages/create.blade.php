@extends('layouts.app')

@section('content')

    <h1>Create New Package</h1>
    <hr/>

    {!! Form::open(['url' => '/packages', 'class' => 'form-horizontal']) !!}

        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'Name *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
        </div>
        <div class="form-group {{ $errors->has('bandwidth') ? 'has-error' : ''}}">
            {!! Form::label('bandwidth', 'Bandwidth *', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('bandwidth', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('bandwidth', '<p class="help-block">:message</p>') !!}
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