@extends('layouts.app')

@section('content')
    <h1>Expences <a href="{{ url('/expences/create') }}" class="btn btn-primary btn-xs" title="Add New Expence"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>

    </h1>
    <hr/>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Purpose </th><th> Amount </th><th> Date </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($expences as $item)
                {{-- */$sl++;/* --}}
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ $item->purpose }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->date }}</td>
                    <td>
                        <a href="{{ url('/expences/' . $item->id) }}" class="btn btn-success btn-xs" title="View Expence"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        @if(isset(Auth::user()->admin->user_id))
                            <a href="{{ url('/expences/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Expence"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['/expences', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Expence" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Expence',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $expences->render() !!} </div>
    </div>

@endsection
