@extends('layouts.app')

@section('content')

    <h1>
        Dashboard <small class="pull-right">This Month</small>
    </h1>
    <h2>
        <small>From Date : {{ $fromDate->format('Y-M-d') }}</small><small class="pull-right">To Date : {{ $toDate->format('Y-M-d') }}</small>
    </h2>
    <hr/>
    <!-- /. ROW  -->

        <div class="row">

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-blue">
                    <div class="panel-heading text-center lead">Total Consumer</div>
                    <div class="panel-body text-center"><p class="fa-3x "><a href="#" target="_blank"> {{ $consumers->count('id') }}</a></p> </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-blue">
                    <div class="panel-heading text-center lead">Paid Consumers</div>
                    <div class="panel-body text-center"><p class="fa-3x">
                            <a href="#" target="_blank">
                            @if (!empty($totalPaid))
                                {{ $totalPaid }}
                            @else
                                {{ 0  }}
                            @endif
                            </a>
                        </p> </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-blue">
                    <div class="panel-heading text-center lead">Due Consumers</div>
                    <div class="panel-body text-center"><p class="fa-3x">
                            <a href="#" target="_blank">
                            @if (!empty($totalPaid))
                                {{ $consumers->count('id')-$totalPaid }}
                            @else
                                {{ 0  }}
                            @endif
                            </a>
                        </p> </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-blue">
                    <div class="panel-heading text-center lead">Today Payment</div>
                    <div class="panel-body text-center"><p class="fa-3x">
                        <a href="#" target="_blank">
                        @if (!empty($todayPaid))
                            {{ $todayPaid }}
                        @else
                            {{ 0  }}
                        @endif
                        </a>
                        </p></div>
                </div>
            </div>

            @if(isset(Auth::user()->admin->user_id))
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-blue">
                    <div class="panel-heading text-center lead">Total Bill</div>
                    <div class="panel-body text-center"><p class="fa-2x">
                            <a href="#" target="_blank">
                                @if (!empty($totalBillAmount))
                                    {{ number_format($totalBillAmount) }}
                                @else
                                    {{ 0  }}
                                @endif
                            </a>
                    </p></div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-blue">
                    <div class="panel-heading text-center lead">Total Receive</div>
                    <div class="panel-body text-center"><p class="fa-2x">
                            <a href="#" target="_blank">
                            @if (!empty($totalReceive))
                                {{ number_format($totalReceive) }}
                            @else
                                {{ 0  }}
                            @endif
                            </a>
                        </p> </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-blue">
                    <div class="panel-heading text-center lead">Total Discount</div>
                    <div class="panel-body text-center"><p class="fa-2x">
                            <a href="#" target="_blank">
                            @if (!empty($totalDiscount))
                                {{ number_format($totalDiscount) }}
                            @else
                                {{ 0  }}
                            @endif
                            </a>
                        </p> </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="panel panel-blue">
                    <div class="panel-heading text-center lead">Today Receive</div>
                    <div class="panel-body text-center"><p class="fa-2x">
                            <a href="#" target="_blank">
                            @if (!empty($todayReceive))
                                {{ number_format($todayReceive) }}
                            @else
                                {{ 0  }}
                            @endif
                            </a>
                        </p></div>
                </div>
            </div>
            @endif

        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">

                <div class="panel panel-success">
                    <div class="panel-heading lead">
                        Paid Consumers
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th> Consumer </th>
                                </tr>
                                </thead>
                                <tbody>
                                 {{--*/$x=0;/*--}}
                                @if (!empty($paidPayments))
                                    @foreach($paidPayments as $payments)
                                        {{--*/$x++;/*--}}
                                        @if (isset($payments->consumer->id))
                                            <tr>
                                                <td>{{ $x }}</td>
                                                <td><a href="{{ url('consumers/'.$payments->consumer->id) }}" target="_blank">{{ $payments->consumer->name }}</a></td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $x }}</td>
                                                <td><a href="#" class="text-danger" target="_blank">Delated</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">

                <div class="panel panel-danger">
                    <div class="panel-heading lead">
                        Due Consumers
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th> Consumer </th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- */$x=0;/* --}}
                                @if (!empty($paidPayments))
                                    @foreach($duePayments as $payments)
                                        @if (isset($payments->consumer->id))
                                            {{-- */$x++;/* --}}
                                            <tr>
                                                <td>{{ $x }}</td>
                                                <td><a href="{{ url('consumers/'.$payments->consumer->id) }}" target="_blank">{{ $payments->consumer->name }}</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /. ROW  -->

@endsection
