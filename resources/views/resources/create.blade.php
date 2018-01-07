@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add a Resource</div>
                <div class="panel-body">
                    {!! Form::open(['action' => 'ResourcesController@store', 'method' => 'POST']) !!}
                        {{Form::label('body', 'Title')}}
                        {{Form::text('title', '', ['class' => 'form-control'])}}
                        <br>
                        {{Form::label('body', 'Body (use html)')}}
                        {{Form::textarea('body', '', ['class' => 'form-control'])}}
                        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
