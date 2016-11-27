@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create New Payment</h1>
    <hr/>

    {!! Form::open(['url' => '/payments', 'class' => 'form-horizontal']) !!}

        {!! Form::hidden('user_id', Auth::user()->id  ) !!}
        <div class="form-group {{ $errors->has('consumer_id') ? 'has-error' : ''}}">
            {!! Form::label('consumer_id', 'Consumer ID', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('consumer_id', $consumers->lists('id', 'id'), null, ['class' => 'form-control', 'id' => 'consumer_id', 'required' => 'required', 'placeholder' => 'Select Consumer ID', 'onchange' => 'showBillNameUseID(this.value)']) !!}
                {!! $errors->first('consumer_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('consumer_name') ? 'has-error' : ''}}">
            {!! Form::label('consumer_name', 'Consumer Name *', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('consumer_name', $consumers->lists('name', 'id'), null, ['class' => 'form-control', 'id' => 'consumer_name', 'required' => 'required', 'placeholder' => 'Select Consumer', 'onchange' => 'showBillName(this.value)']) !!}
                {!! $errors->first('consumer_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('consumer_id') ? 'has-error' : ''}}">
            {!! Form::label('consumer_address', 'Consumer Address', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('consumer_address', null, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address', 'readonly']) !!}
                {!! $errors->first('consumer_address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('bill_id') ? 'has-error' : ''}}">
            {!! Form::label('consumer_id', 'Bill *', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('bill_id', ['0' => ''], null, ['class' => 'form-control', 'placeholder' => 'Select Bill', 'id' => 'bill_id', 'onchange' => 'showAmount()', 'required' => 'required']) !!}
                {!! $errors->first('bill_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            {!! Form::label('amount', 'Amount *', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('amount', null, ['class' => 'form-control', 'id' => 'amount', 'required' => 'required', 'min' => '0', 'oninput' => 'validity.valid||(value="");', 'onchange' => 'showDue()']) !!}
                {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
            {!! Form::label('discount', 'Discount', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('discount', null, ['class' => 'form-control', 'id' => 'discount', 'min' => '0', 'oninput' => 'validity.valid||(value="");', 'onchange' => 'showDue()']) !!}
                {!! $errors->first('discount', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('due') ? 'has-error' : ''}}">
            {!! Form::label('due', 'Due', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('due', null, ['class' => 'form-control', 'id' => 'due', 'min' => '0', 'oninput' => 'validity.valid||(value="");', 'readonly']) !!}
                {!! $errors->first('due', '<p class="help-block">:message</p>') !!}
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

</div>

    <script type="text/javascript">
        function showBillName(v){
            var baseUrl = '{{ url('/') }}';
            $.get(baseUrl + '/ajax/bills', {consumer_id:v},
                    function(data){
                        $('#bill_id').html(data);
                    });
        }
        function showBillNameUseID(v){
            var baseUrl = '{{ url('/') }}';
            $.get(baseUrl + '/ajax/billsUseID', {consumer_id:v},
                    function(data){
                        $('#bill_id').html(data);
                    });
        }
        function showAmount(){
            var bill = $('#bill_id').find('option:selected').attr("amount");
            $('#amount').val(bill);
        }
        function showDue(){
            var bill = $('#bill_id').find('option:selected').attr("amount");
            var amount = $('#amount').val();
            var discount = $('#discount').val();
            var due = bill - amount - discount;
            if (due){
                var showDue =  due;
            }
            else {
                var showDue;
            }
            $('#due').val(showDue);
        }

    </script>
@endsection