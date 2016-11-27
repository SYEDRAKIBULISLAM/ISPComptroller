@extends('layouts.app')

@section('content')



    <h1>Previous Consumers </h1>
    <hr/>
    <div class="">
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['url' => '/consumers', 'class' => 'form-inline', 'method' => 'GET']) !!}
                    <div class="form-group">
                        {{--<label class="control-label filter-col" for="rows">Rows</label>--}}
                        <select id="rows" class="form-control input-sm" name="rows">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                            <option selected="selected" value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option value="500">500</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        {!! Form::select('package', $packages->lists('name', 'id'), null, ['class' => 'form-control input-sm', 'placeholder' => 'Package']) !!}
                    </div>
                    <div class="form-group">
                        <input type="text" name="amount" class="form-control input-sm" id="amount" placeholder="Amount" min="0" oninput="validity.valid||(value='');">
                    </div>
                    <div class="form-group">
                        <input type="text" name="IP" class="form-control input-sm" id="IP" placeholder="IP">
                    </div>
                    {{--<div class="form-group">--}}
                    {{--<input type="date" name="date" class="form-control input-sm" id="date" placeholder="Start Date">--}}
                    {{--</div>--}}
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary filter-col btn-sm">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-panel">
            <span class="glyphicon glyphicon-cog"></span> Advanced Search
        </button>
    </div>
    <br/>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th><th> @sortablelink('name') </th>
                <th> @sortablelink('package_id', 'Package') </th>
                <th> @sortablelink('amount') </th>
                <th> @sortablelink('IP') </th>
                <th> @sortablelink('start_date', 'Start Date') </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @foreach($consumers as $item)
                {{-- */$sl++;/* --}}
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ $item->name }}</td>
                    <td><a href="{{ url('packages/'.$item->package->id) }}">{{ $item->package->name }}</a></td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->IP }}</td>
                    <td>{{ $item->start_date }}</td>
                    <td>
                        <a href="{{ url('/previous_consumers/' . $item->id) }}" class="btn btn-success btn-xs" title="View Consumer"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/previous_consumers/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Consumer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        @if(isset(Auth::user()->admin->user_id))
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['/previous_consumers', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Consumer" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Consumer',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $consumers->appends(Request::only('rows'))->appends(Request::only('name'))->appends(Request::only('package'))->appends(Request::only('amount'))->appends(Request::only('IP'))->appends(Request::only('sort'))->appends(Request::only('order'))->render() !!} </div>

    </div>
@endsection
