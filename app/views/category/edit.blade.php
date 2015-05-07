@extends('layouts.default')


@section('content')
     
    <div class="container">

      @if(Session::has('success'))
			<div class="alert alert-info text-center">{{ Session::get('success') }}</div>
			@endif

      {{ Form::open(array('url' => 'save-edit-category', 'role'=>'form')) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
				{{ Form::text('title', $data->title, array('class'=>'form-control')) }}
        <label for="exampleInputEmail1">Description</label> 
        {{ Form::textarea('description', $data->description, array('class' => 'ckeditor form-control')) }}				
        <input type="hidden" name="id" class="form-control" value={{ $data->id }} >        

      </div>
      <button type="submit" class="btn btn-default">Edit</button>
		{{ Form::close() }}


    
    </div>

@stop