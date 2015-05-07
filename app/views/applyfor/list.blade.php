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
          <th>Updated at</th>

        </tr>
      </thead>
      <tbody>
        <?php $i = 1;?>
        @foreach ($data as $applyfor)
        <tr>
          
        <td>{{ $i }}</td>
        
        <td>{{ $applyfor->title  }}</td>
				<td>{{ $applyfor->created_at }}</td>
				<td>{{ $applyfor->updated_at }}</td>
				<td><a href="{{ url('edit_apply_for/'. $applyfor->id) }}">Edit</a></td>
				<td><a href="{{ url('delete-apply-for/'.$applyfor->id) }}">Delete</a></td>
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