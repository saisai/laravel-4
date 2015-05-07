@extends('layouts.default')


@section('content')
     
    <div class="container">

      @if(Session::has('success'))
			<div class="alert alert-info text-center">{{ Session::get('success') }}</div>
			@endif

      {{ Form::open(array('url' => 'save-edit-post', 'role'=>'form')) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
				{{ Form::text('title', $result->post_title, array('class'=>'form-control')) }}        
        <label for="exampleInputEmail1">Category</label>
         <select name="category" autocomplete = "off">
					<?php echo $data; ?>					
				</select>
				<br />
        <label for="exampleInputEmail1">Description</label> 
        {{ Form::textarea('description', $result->post_content, array('class' => 'ckeditor form-control')) }}				
        <input type="hidden" name="id" class="form-control" value={{ $result->id }} >        

      </div>
      <button type="submit" class="btn btn-default">Edit</button>
		{{ Form::close() }}


    
    </div>

@stop