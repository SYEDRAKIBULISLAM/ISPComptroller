@extends('layouts.app')

@section('content')

    <h1>Packages
        @if(isset(Auth::user()->admin->user_id))
            <a href="{{ url('/packages/create') }}" class="btn btn-primary btn-xs" title="Add New Package"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
        @endif
    </h1>
    <hr/>
    <div class="">
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['url' => '/packages', 'class' => 'form-inline', 'method' => 'GET']) !!}
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
                        </div> <!-- form group [rows] -->
                        <div class="form-group">
                            <label class="filter-col" style="margin-right:0;" for="name">Name</label>
                            <input type="text" name="name" class="form-control input-sm" id="name" placeholder="Package Name">
                        </div><!-- form group [search] -->
                        {{--<div class="form-group">--}}
                            {{--<label class="filter-col" style="margin-right:0;" for="order">Order by</label>--}}
                            {{--<select id="order" name="order" class="form-control">--}}
                                {{--<option value="">Ascendant</option>--}}
                                {{--<option value="desc">Descendant</option>--}}
                            {{--</select>--}}
                        {{--</div> <!-- form group [order by] -->--}}
                        {{--<div class="form-group">--}}
                            {{--<label class="filter-col" style="margin-right:0;" for="data">Data</label>--}}
                            {{--<select id="data" name="data" class="form-control">--}}
                                {{--<option value="">Useable</option>--}}
                                {{--<option value="desc">Trashed</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        <div class="form-group pull-right">
                            {{--<div class="checkbox" style="margin-left:10px; margin-right:10px;">--}}
                                {{--<label><input type="checkbox"> Remember parameters</label>--}}
                            {{--</div>--}}
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
                    <th>S.No</th><th> Name </th><th> Bandwidth </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($packages as $item)
                {{-- */$sl++;/* --}}
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ $item->name }}</td><td>{{ $item->bandwidth }}</td>
                    <td>
                        <a href="{{ url('/packages/' . $item->id) }}" class="btn btn-success btn-xs" title="View Package"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        @if(isset(Auth::user()->admin->user_id))
                        <a href="{{ url('/packages/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Package"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/packages', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Package" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Package',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $packages->appends(Request::only('rows'))->appends(Request::only('name'))->appends(Request::only('order'))->render() !!} </div>
    </div>

@endsection
