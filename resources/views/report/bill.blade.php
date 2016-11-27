@extends('layouts.app')

@section('content')

    <h1>Bills Report</h1>
    <hr/>
    <div class="">
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['url' => '/bills_report', 'class' => 'form-inline', 'method' => 'GET']) !!}
                    <div class="form-group">
                        <label class="control-label filter-col" for="rows">Rows</label>
                        <select id="rows" class="form-control " name="rows">
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
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option selected="selected" value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="2000">2000</option>
                        </select>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label class="consumer" style="margin-right:0;" for="fromdate">Consumer</label>--}}
                        {{--<input type="text" name="consumer" id="consumer" class="form-control input-sm" placeholder="Consumer Name">--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label class="control-label filter-col" for="bill">Bill Name</label>
                        <select id="bill" class="form-control " name="bill">
                            <option value="">Select Bill</option>
                            @foreach($generateBills as $bill)
                                <option value="{{ $bill->id }}">{{ $bill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label class="filter-col" style="margin-right:0;" for="amount">Amount</label>--}}
                        {{--<input type="number" name="amount" class="form-control input-sm" id="amount" placeholder="Amount" min="0" oninput="validity.valid||(value='');">--}}
                    {{--</div>--}}

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
        <h5 class="pull-right"> <b>Date Period :</b> {{ $fromDate->format('Y-M-d') }} ---- {{ $toDate->format('Y-M-d') }}    </h5>
    </div>
    <br/>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th><th> Consumer </th><th> Bill </th><th> Amount </th><th> Date </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$total=0;/* --}}
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
                    <td>{{ $item->amount }}</td>    {{-- */$total+=$item->amount;/* --}}
                    <td>{{ $item->generateBill->date }}</td>
                </tr>
            @endforeach
            <tr class="text-danger lead">
                <th></th><th>  </th><th> Total </th><th> {{ $total  }} </th><th> </th>
            </tr>
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $bills->appends(Request::only('rows'))->appends(Request::only('consumer'))->appends(Request::only('bill'))->render() !!} </div>
    </div>
@endsection
