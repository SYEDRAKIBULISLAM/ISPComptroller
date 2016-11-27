@extends('layouts.app')

@section('content')

    <h1>Create New Request</h1>
    <hr/>

    {!! Form::open(['url' => '/consumer_requests', 'class' => 'form-horizontal']) !!}

            {!! Form::hidden('user_id', Auth::user()->id  ) !!}

            <div class="form-group {{ $errors->has('consumer_id') ? 'has-error' : ''}}">
                {!! Form::label('consumer_id', 'Consumer Name *', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('consumer_id', $consumers->lists('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Consumer', 'required' => 'required']) !!}
                    {!! $errors->first('consumer_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
                {!! Form::label('note', 'Request Note *', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('note', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                {!! Form::label('date', 'Approval Date *', ['class' => 'col-sm-3 control-label']) !!}
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