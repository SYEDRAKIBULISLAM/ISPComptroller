@extends('layouts.app')

@section('content')

    <h1>Users <a href="{{ url('/users/create') }}" class="btn btn-primary btn-xs" title="Add New User"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <hr/>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Name </th><th> Username </th><th> Email </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($users as $item)
                {{-- */$x++;/* --}}
                {{--@if($item->id != Auth::user()->id)--}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a href="{{ url('/users/' . $item->id) }}" class="btn btn-success btn-xs" title="View User"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/users', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-ban-circle" aria-hidden="true" title="Block User" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-warning btn-xs',
                                    'title' => 'Block User',
                                    'onclick'=>'return confirm("Confirm block?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                {{--@endif--}}
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $users->render() !!} </div>
    </div>

@endsection
