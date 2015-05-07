@extends('layouts.default')


@section('content')
     
    <div class="container">

    @if(Session::has('success'))
			<div class="alert alert-info text-center">{{ Session::get('success') }}</div>
		@endif
		
   <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Title </th>
          <th>File Name</th>
          <th>Created at</th>
          <th>Updated at</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;?>
        @foreach ($data as $result)
        <tr>
          
        <td>{{ $i }}</td>
        
        <td>{{ $result->title }}</td>
				<td>{{ $result->filename }}</td>
				<td>{{ $result->created_at }}</td>
				<td>{{ $result->updated_at }}</td>
				<td><a href="{{ url('edit_upload/'.$result->id) }}">Edit</a></td>
				<td><a href="{{ action('UploadController@deleteUpload', array($result->id)) }}">Delete</a></td>
        </tr>
        <?php $i++ ;?>
        @endforeach
      </tbody>
    </table>


  
    
    </div>

@stop