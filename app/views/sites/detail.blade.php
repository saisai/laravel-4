@extends('layouts.default')



@section('content')
     
    <div class="container">
    
    
      {{ Form::open(array('url' => 'edit_detail_data', 'role'=>'form')) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Title</label><br />
        {{ $data->title }}<br />
        <label for="exampleInputEmail1">Link</label>        <br />
        <a href='{{ $data->link }}' target='_blank'>{{ $data->link }}</a><br />
        <label for="exampleInputEmail1">Description</label><br />
         {{ $data->description }}<br />
      </div>      
      <a href='{{ url('list-link') }}' class="btn btn-default">Back</a>
  {{ Form::close() }}


    
    </div>

@stop