@extends('layouts.app')

@section('content')
    <h1>Account Statement</h1>
    <hr/>
    <div class="">
        <div id="filter-panel" class="collapse filter-panel">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! Form::open(['url' => '/account_statement', 'class' => 'form-inline', 'method' => 'GET']) !!}

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

    <div class="table table-responsive ">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" rowspan="2">S.No</th><th colspan="3" class="text-center"> Expences </th><th colspan="3" class="text-center"> Revenues </th>
                </tr>
                <tr>
                    <th>Date</th><th> Purpose </th><th> Amount </th><th>Date</th><th> Consumer </th><th> Amount </th>
                </tr>
            </thead>
            <tbody>
            {{-- */$sl=0;/* --}}
                {{-- */$totalExp=0;/* --}}
                {{-- */$totalRev=0;/* --}}
                @for($i = 0; $i < $max; $i++)
                    {{-- */$sl++;/* --}}
                    <tr>
                        <td>{{ $sl }}</td>
                        @if(isset($expences[$i]))
                            <td>{{ $expences[$i]->date }}</td>
                            <td>{{ $expences[$i]->purpose }}</td>
                            <td>{{ $expences[$i]->amount }}</td> {{-- */$totalExp+=$expences[$i]->amount;/* --}}
                        @else
                            <td></td><td></td><td></td>
                        @endif

                        @if(isset($payments[$i]))
                            <td>{{ $payments[$i]->date }}</td>
                            <td>{{ $payments[$i]->consumer->name }}</td>
                            <td>{{ $payments[$i]->amount }}</td> {{-- */$totalRev+=$payments[$i]->amount;/* --}}
                        @else
                            <td></td><td></td><td></td>
                        @endif
                    </tr>
                @endfor
                <tr class="text-danger lead">
                    <th></th><th></th><th>Total Expence</th><th>{{ $totalExp }}</th><th></th><th>Total Revenue</th><th>{{ $totalRev }}</th>
                </tr>
                {{-- */$totalProfit=$totalRev-$totalExp;/* --}}
                @if($totalProfit > 0)
                    <tr class="text-success lead">
                        <th></th><th></th><th></th><th></th><th></th><th>Total Profit</th><th>{{ $totalProfit }}</th>
                    </tr>
                @else
                    <tr class="text-warning lead">
                        <th></th><th></th><th></th><th></th><th></th><th>Total Profit</th><th>{{ $totalProfit }}</th>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $generateBills->appends(Request::only('bill'))->render() !!} </div>
    </div>


@endsection