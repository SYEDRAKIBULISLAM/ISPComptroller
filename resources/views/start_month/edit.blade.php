@extends('layouts.app')

@section('content')

    <h1>Edit Start Month</h1>
    <hr>
    {!! Form::model($start_month, [
        'method' => 'PATCH',
        'url' => ['/start_month', $start_month->id],
        'class' => 'form-horizontal'
    ]) !!}

    <div class="form-group {{ $errors->has('day') ? 'has-error' : ''}}">
        {!! Form::label('day', 'Day *', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::number('day', null, ['class' => 'form-control', 'placeholder' => 'Enter Month Start Day (max 28)', 'min' => '0', 'max' => '28', 'oninput' => 'validity.valid||(value="");', 'required' => 'required']) !!}
            {!! $errors->first('day', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
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