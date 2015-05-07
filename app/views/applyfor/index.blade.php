@extends('layouts.default')


@section('content')
     
    <div class="container">

			@if(Session::has('success'))
				<div class="alert alert-info text-center">{{ Session::get('success') }}</div>
			@endif

      {{ Form::open(array('url' => 'add_apply_for', 'role'=>'form')) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" name="title" class="form-control"  >        

      </div>
      <button type="submit" class="btn btn-default">Submit</button>
  {{ Form::close() }}


  <div class="bs-example bs-example-bg-classes">
     @if ($errors->has())
      {{ $errors->first('email', '<p class="bg-danger">:message</p>') }}
    @endif
  </div>
    
    </div>

@stop