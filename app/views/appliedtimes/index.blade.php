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
        @foreach ($data as $result)
        <tr>
          
        <td>{{ $i }}</td>
        
        <td>{{ $result->id }}</td>
				<td>{{ $result->created_at }}</td>				

        </tr>
        <?php $i++ ;?>
        @endforeach
      </tbody>
    </table>


  
    
    </div>

@stop