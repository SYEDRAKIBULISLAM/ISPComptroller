@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Edit Previous Consumer {{ $consumer->id }}</h1>
        <hr>
        {!! Form::model($consumer, [
            'method' => 'PATCH',
            'url' => ['/previous_consumers', $consumer->id],
            'class' => 'form-horizontal upload-form',
            'files'=>true
        ]) !!}

        {!! Form::hidden('user_id', Auth::user()->id  ) !!}
        <div class="form-group  {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
            {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
            {!! Form::label('phone', 'Phone', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('phone', null, ['class' => 'form-control']) !!}
                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('occupation') ? 'has-error' : ''}}">
            {!! Form::label('occupation', 'Occupation', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('occupation', null, ['class' => 'form-control']) !!}
                {!! $errors->first('occupation', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('father_name') ? 'has-error' : ''}}">
            {!! Form::label('father_name', 'Father\'s Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('father_name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('father_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('mother_name') ? 'has-error' : ''}}">
            {!! Form::label('mother_name', 'Mother\'s Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('mother_name', null, ['class' => 'form-control']) !!}
                {!! $errors->first('mother_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('present_address') ? 'has-error' : ''}}">
            {!! Form::label('present_address', 'Present Address', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('present_address', null, ['class' => 'form-control']) !!}
                {!! $errors->first('present_address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('permanent_address') ? 'has-error' : ''}}">
            {!! Form::label('permanent_address', 'Permanent Address', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('permanent_address', null, ['class' => 'form-control']) !!}
                {!! $errors->first('permanent_address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
            {!! Form::label('image', 'Image', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <!-- image-preview-filename input [CUT FROM HERE]-->
                <div class="input-group image-preview">
                    <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                    <span class="input-group-btn">
                            <!-- image-preview-clear button -->
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span> Clear
                            </button>
                        <!-- image-preview-input -->
                            <div class="btn btn-default image-preview-input">
                                <span class="glyphicon glyphicon-folder-open"></span>
                                <span class="image-preview-input-title">Browse</span>
                                <input type="file" data-max-size="1048576" class="upload-file" accept="image/png, image/jpeg, image/jpeg" name="image" id="image"/> <!-- rename it -->
                            </div>
                        </span>
                </div><!-- /input-group image-preview [TO HERE]-->
                {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @if($consumer->img_name)
            <div class="form-group">
                {!! Form::label('old-Image', 'Old Image', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Html::image('upload/images/'.$consumer->img_name, 'Old Image',array('class' => 'img-responsive img-thumbnail')) !!}
                </div>
            </div>
        @endif
        <div class="form-group {{ $errors->has('NID') ? 'has-error' : ''}}">
            {!! Form::label('NID', 'Nid', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('NID', null, ['class' => 'form-control']) !!}
                {!! $errors->first('NID', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('package_id') ? 'has-error' : ''}}">
            {!! Form::label('package_id', 'Package Id', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::select('package_id', $consumer->package->lists('name', 'id'), null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('package_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
            {!! Form::label('amount', 'Amount', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::number('amount', null, ['class' => 'form-control', 'min' => '0', 'oninput' => 'validity.valid||(value="");', 'required' => 'required']) !!}
                {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('IP') ? 'has-error' : ''}}">
            {!! Form::label('IP', 'Ip', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('IP', null, ['class' => 'form-control']) !!}
                {!! $errors->first('IP', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
            {!! Form::label('start_date', 'Start Date', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::date('start_date', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
            {!! Form::label('end_date', 'End Date', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
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