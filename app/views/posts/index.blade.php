@extends('layouts.default')


@section('content')
     
    <div class="container">

			@if(Session::has('success'))
				<div class="alert alert-info text-center">{{ Session::get('success') }}</div>
			@endif

      {{ Form::open(array('url' => 'add-post', 'role'=>'form')) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" name="title" class="form-control"  >        
        <label for="exampleInputEmail1">Category</label>
         <select name="category">
					<?php echo $data; ?>					
				</select>
				<br />
        <label for="exampleInputEmail1">Description</label> 
        {{ Form::textarea('description', Input::old('responsibility'), array('class' => 'ckeditor form-control')) }}
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
  {{ Form::close() }}



    
    </div>

@stop