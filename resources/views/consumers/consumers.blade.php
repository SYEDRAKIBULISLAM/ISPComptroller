@extends('layouts.print')

@section('content')

    <h1>Consumers <button onclick="printSection('printDiv')" class="btn btn-info btn-xs" title="Print all consumers"><span class="glyphicon glyphicon-print" aria-hidden="true"/></button></h1>
    <div id="printDiv">
        <div class="table">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th> S.No</th>
                    <th> Name </th>
                    <th> Phone </th>
                    <th> Present Address </th>
                    <th> Package </th>
                    <th> Amount </th>
                </tr>
                </thead>
                <tbody>
                {{-- */$sl=0;/* --}}
                @foreach($consumers as $item)
                    {{-- */$sl++;/* --}}
                    <tr>
                        <td>{{ $sl }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->present_address }}</td>
                        <td>{{ $item->package->name }}</td>
                        <td>{{ $item->amount }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        //customPrint
        function printSection(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
