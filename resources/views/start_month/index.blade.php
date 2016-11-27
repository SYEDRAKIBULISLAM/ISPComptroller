@extends('layouts.app')

@section('content')

    <h1>Start Month </h1>
    <hr>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Day</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($start_month as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $item->day }}</td>
                    
                    <td>
                        {{--<a href="{{ url('/start_month/' . $item->id) }}" class="btn btn-success btn-xs" title="View Start_month"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>--}}
                        <a href="{{ url('/start_month/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Start_month"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {{--{!! Form::open([--}}
                            {{--'method'=>'DELETE',--}}
                            {{--'url' => ['/start_month', $item->id],--}}
                            {{--'style' => 'display:inline'--}}
                        {{--]) !!}--}}
                            {{--{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Start_month" />', array(--}}
                                    {{--'type' => 'submit',--}}
                                    {{--'class' => 'btn btn-danger btn-xs',--}}
                                    {{--'title' => 'Delete Start_month',--}}
                                    {{--'onclick'=>'return confirm("Confirm delete?")'--}}
                            {{--)) !!}--}}
                        {{--{!! Form::close() !!}--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $start_month->render() !!} </div>
    </div>

@endsection
