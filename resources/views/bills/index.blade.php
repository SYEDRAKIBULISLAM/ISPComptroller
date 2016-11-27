@extends('layouts.app')

@section('content')

    <h1>Bills
        @if(isset(Auth::user()->admin->user_id))
            <a href="{{ url('/bills/create') }}" class="btn btn-primary btn-xs" title="Add New Bill"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
        @endif
    </h1>
    <hr/>
    <div class="">
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['url' => '/bills', 'class' => 'form-inline', 'method' => 'GET']) !!}
                    <div class="form-group">
                        <label class="control-label filter-col" for="rows">Rows</label>
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
                        {{--<label class="filter-col" style="margin-right:0;" for="consumer">Consumer</label>--}}
                        <input type="text" name="consumer" class="form-control input-sm" id="consumer" placeholder="Consumer Name">
                    </div>
                    <div class="form-group">
                        <label class="filter-col" style="margin-right:0;" for="fromdate">From Date</label>
                        <input type="date" name="fromdate" id="fromdate" class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="filter-col" style="margin-right:0;" for="todate">To Date</label>
                        <input type="date" name="todate" class="form-control input-sm" id="todate">
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-primary filter-col">
                            <span class="glyphicon glyphicon-search"></span> Search
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
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Consumer </th><th> Bill </th><th> Amount </th><th> Actions </th>
                </tr>
            </thead>
            <tbody>
            @foreach($bills as $item)
                {{-- */$sl++;/* --}}
                <tr>
                    <td>{{ $sl }}</td>
                    @if(isset($item->consumer->id))
                        <td><a href="{{ url('consumers/'.$item->consumer->id) }}">{{ $item->consumer->name }}</a></td>
                    @else
                        <td><a href="#" class="text-danger">Deleted</a></td>
                    @endif
                    <td><a href="{{ url('bills/generate_bills/'.$item->generateBill->id) }}">{{ $item->generateBill->name }}</a></td>
                    <td>{{ $item->amount }}</td>
                    <td>
                        <a href="{{ url('/bills/' . $item->id) }}" class="btn btn-success btn-xs" title="View Bill"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        @if(isset(Auth::user()->admin->user_id))
                            <a href="{{ url('/bills/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Bill"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['/bills', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Bill" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Bill',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $bills->appends(Request::only('rows'))->appends(Request::only('consumer'))->appends(Request::only('fromdate'))->appends(Request::only('todate'))->render() !!} </div>
    </div>

@endsection
