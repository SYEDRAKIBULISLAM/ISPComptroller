@extends('layouts.app')

@section('content')

    <h1>Statement </h1>
    <hr/>
    <div class="">
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['url' => '/statement', 'class' => 'form-inline', 'method' => 'GET']) !!}
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
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option selected value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="2000">2000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="consumer" style="margin-right:0;" for="fromdate">Consumer</label>
                        <input type="text" name="consumer" id="consumer" class="form-control input-sm" placeholder="Consumer Name">
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label filter-col" for="bill">Bill Name</label>--}}
                        {{--<select id="bill" class="form-control " name="bill">--}}
                            {{--<option value="">Select Bill</option>--}}
                            {{--@foreach($generateBills as $bill)--}}
                                {{--<option value="{{ $bill->id }}">{{ $bill->name }}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
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
        <h5 class="pull-right"> <b>Date :</b> {{ $today->format('Y-m-d') }}    </h5>

    </div>
    <br/>
    <div class="table table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th><th> Consumer </th><th> Total Bill </th><th> Total Payment </th><th> Discount </th><th> Due </th><th> Due Bill</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$total=0;/* --}}
            {{-- */$totalDue=0;/* --}}
            {{-- */$totalPayment=0;/* --}}
            {{-- */$totalDiscount=0;/* --}}
            @foreach($consumers as $item)
                 {{--*/$sl++;/* --}}
                <tr>
                    <td>{{ $sl }}</td>
                    <td><a href="{{  url('consumers/'.$item->id) }}">{{ $item->name }} </a></td>
                    <td>{{ $item->bill->sum('amount') }}</td>  {{-- */$total+=$item->bill->sum('amount');/* --}}
                    <td>{{ $item->payment->sum('amount') }}</td>  {{-- */$totalPayment+=$item->payment->sum('amount');/* --}}
                    <td>{{ $item->payment->sum('discount') }}</td>  {{-- */$totalDiscount+=$item->payment->sum('discount');/* --}}
                    <td>{{ $item->bill->sum('amount')-$item->payment->sum('amount')-$item->payment->sum('discount') }}</td>  {{-- */$totalDue+=$item->bill->sum('amount')-$item->payment->sum('amount')-$item->payment->sum('discount');/* --}}
                    <td>
                        @foreach($item->bill as $bill_name)
                            {{-- */$y=0;/* --}}
                            @foreach ($item->payment as $payment_name)
                                @if($bill_name->id == $payment_name->bill_id)
                                    {{-- */$y++;/* --}}
                                @endif
                            @endforeach
                            @if($y == 0)
                                <a href="{{ url('bills?rows=15&consumer='.$item->name.'&bill='.$bill_name->generateBill->name.'&amount=') }}">{{ $bill_name->generateBill->name }} </a> |
                            @endif

                        @endforeach
                    </td>
                </tr>
            @endforeach
                <tr class="text-danger">
                    <th></th><th>  </th><th> Total Bill: {{ $total  }} </th><th> Total Payment: {{ $totalPayment  }} </th><th> Total Discount: {{ $totalDiscount  }} </th><th> Total Due: {{ $totalDue  }} </th><th> </th>
                </tr>
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $consumers->appends(Request::only('rows'))->appends(Request::only('consumer'))->render() !!} </div>
    </div>

@endsection
