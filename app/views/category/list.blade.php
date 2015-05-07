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
					
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;?>
				

				
        @foreach ($data as $list)
        <tr>
          
        <td>{{ $i }}</td>
        
        <td><a href='{{ $list->name }}' target='_blank'>{{ $list->name  }}</a></td>
				
				<td><a href="{{ url('view-category/'. $list->id) }}">View</a></td>
				<td><a href="{{ url('edit-go-category/'. $list->id) }}">Edit</a></td>
				<td><a href="{{ url('delete-category/'.$list->id) }}">Delete</a></td>
        </tr>
        <?php $i++ ;?>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">
      
      {{-- $data->links() --}}
      
    </div>
    </div>

@stop