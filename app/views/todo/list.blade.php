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
          <th>Created at</th>


        </tr>
      </thead>
      <tbody>
        <?php $i = 1;?>
        @foreach ($data as $list)
        <tr>
          
        <td>{{ $i }}</td>
        
        <td><a href="{{ url('view-todo/'. $list->id) }}" target='_blank'>{{ $list->title  }}</a></td>
				<td>{{ $list->created_at }}</td>
				<td><a href="{{ url('view-todo/'. $list->id) }}">View</a></td>
				<td><a href="{{ url('edit-go-todo/'. $list->id) }}">Edit</a></td>
				<td><a href="{{ url('delete-todo/'.$list->id) }}">Delete</a></td>
        </tr>
        <?php $i++ ;?>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">
      
      {{ $data->links() }}
      
    </div>
    </div>

@stop