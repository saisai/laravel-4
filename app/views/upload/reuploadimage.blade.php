@extends('layouts.default')


@section('content')
     
    <div class="container">



      {{ Form::open(array('url' => 'reupload_image', 'role'=>'form', 'files' => true)) }}
      <div class="form-group">
				<label for="exampleInputEmail1">File</label>
				{{ Form::file('file') }}
				{{ Form::hidden('id', $data->id) }}
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
   {{ Form::close() }}

  
    
    </div>

@stop