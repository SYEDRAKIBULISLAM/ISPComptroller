@extends('layouts.app')

@section('content')

    <h1>Create New Expence</h1>
    <hr/>

    {!! Form::open(['url' => '/expences', 'class' => 'form-horizontal', 'files' => true]) !!}

        {!! Form::hidden('user_id', Auth::user()->id  ) !!}

        <div class="form-group {{ $errors->has('purpose') ? 'has-error' : ''}}">
            {!! Form::label('purpose', 'Purpose *', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('purpose', null, ['class' => 'form-control']) !!}
                {!! $errors->first('purpose', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            {!! Form::label('amount', 'Amount *', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('amount', null, ['class' => 'form-control', 'min' => '0', 'oninput' => 'validity.valid||(value="");', 'required' => 'required']) !!}
                {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
            {!! Form::label('date', 'Date *', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::date('date', $today, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
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