@extends('layouts.default')


@section('content')
     
    <div class="container">



      {{ Form::open(array('url' => 'edit_upload_data', 'role'=>'form', 'files' => true)) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        {{ Form::text('title', $result->title, array('class' => 'form-control')) }} 
        {{ Form::hidden('id', $result->id) }} 
					<br />
        <label for="exampleInputEmail1">File</label>
        {{ HTML::image('/assets/files/'.$result->filename) }}
				{{ HTML::link('delete_image/'.$result->id, 'Delete') }}
				{{-- HTML::link('edit_image/'.$result->id, 'Edit') --}}
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
   {{ Form::close() }}

  
    
    </div>

@stop