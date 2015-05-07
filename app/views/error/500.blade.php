@extends('layouts.default', ['title' => 'This is an 500 page'])

@section('content')
    
    
    <div id="error-page" class="container">
        <h1>Woops, looks like this page doesn't exists!</h1>
        <a class="btn btn-default" href="{{ url('/') }}"><i class="icon-chevron-left"></i> Return to homepage</a>
    </div>

@stop