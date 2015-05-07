@extends('layouts.default')


@section('content')
     
    <div class="container">

    @if(Session::has('success'))
			<div class="alert alert-info text-center">{{ Session::get('success') }}</div>
		@endif

      {{ Form::open(array('url' => 'upload_data', 'role'=>'form', 'files' => true)) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}      
        <label for="exampleInputEmail1">File</label>
        {{ Form::file('file', Input::old('file')) }}
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
   {{ Form::close() }}

    <div class="bs-example bs-example-bg-classes">
      @if($errors->has())
      {{ $errors->first('title', '<p class="bg-danger">:message</p>') }}
      {{ $errors->first('file', '<p class="bg-danger">:message</p>') }}
     @elseif ($errors->has('title'))
      {{ $errors->first('title', '<p class="bg-danger">:message</p>') }}      
    @elseif( $errors->has('file') )
      {{ $errors->first('file', '<p class="bg-danger">:message</p>') }}
    @endif
    
     @if ($errors->has())
      {{-- $errors->first('title', '<p class="bg-danger">:message</p>') --}}
      {{-- $errors->first('file', '<p class="bg-danger">:message</p>') --}}
    @endif
    
  </div>

  
    
    </div>

@stop