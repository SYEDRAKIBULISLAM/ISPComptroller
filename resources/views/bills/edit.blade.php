@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Bill {{ $bill->id }}</h1>
    <hr/>
    {!! Form::model($bill, [
        'method' => 'PATCH',
        'url' => ['/bills', $bill->id],
        'class' => 'form-horizontal'
    ]) !!}
            {!! Form::hidden('user_id', Auth::user()->id  ) !!}
            <div class="form-group {{ $errors->has('consumer_id') ? 'has-error' : ''}}">
                {!! Form::label('consumer_id', 'Consumer Name *', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('consumer_id', $bill->consumer->lists('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Consumer', 'required' => 'required']) !!}
                    {!! $errors->first('consumer_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('generate_bill_id') ? 'has-error' : ''}}">
                {!! Form::label('generate_bill_id', 'Bill Name *', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('generate_bill_id', $bill->generateBill->lists('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Bill', 'required' => 'required']) !!}
                    {!! $errors->first('generate_bill_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
                {!! Form::label('amount', 'Amount *', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('amount', null, ['class' => 'form-control', 'min' => '0', 'oninput' => 'validity.valid||(value="");', 'required' => 'required']) !!}
                    {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
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

</div>
@endsection