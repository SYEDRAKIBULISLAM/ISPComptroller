@extends('layouts.app')

@section('content')
    <h1>Bill Generate <a href="{{ url('/bills/generate_bills/create') }}" class="btn btn-primary btn-xs" title="Add New Generate_bill"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <hr/>
    <div class="">
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['url' => '/bills/generate_bills', 'class' => 'form-inline', 'method' => 'GET']) !!}
                    <div class="form-group">
                        <label class="control-label filter-col" for="rows">Rows</label>
                        <select id="rows" class="form-control" name="rows">
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
                        <label class="filter-col" style="margin-right:0;" for="name">Name</label>
                        <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Bill Name">
                    </div>
                    <div class="form-group">
                        <label class="filter-col" style="margin-right:0;" for="Year">Year</label>
                        <input type="text" name="year" class="form-control input-sm" id="year" placeholder="Bill Year">
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
                    <th>S.No</th><th> Name </th><th> Date </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($generate_bills as $item)
                {{-- */$sl++;/* --}}
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ $item->name }}</td><td>{{ $item->date }}</td>
                    <td>
                        <a href="{{ url('/bills/generate_bills/' . $item->id) }}" class="btn btn-success btn-xs" title="View Generate_bill"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/bills/generate_bills/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Generate_bill"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/bills/generate_bills', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Generate_bill" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Generate_bill',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $generate_bills->appends(Request::only('rows'))->appends(Request::only('name'))->appends(Request::only('date'))->render() !!} </div>
    </div>

@endsection
