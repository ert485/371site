@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-body">
                    {!! $body !!}
                </div>
                @if (isset($accesses)) 
                    <div class="panel-footer">
                        {!! Form::open(array('url' => 'resource/'.$title.'/edit', 'method' => 'GET')) !!}
                            {{Form::submit('Edit', ['class' => 'btn btn-primary'])}}
                        {!! Form::close() !!}
                        Views: {{$accesses}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
