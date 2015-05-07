@extends('layouts.default')



@section('content')
     
    <div class="container">
    
    

      <div class="form-group">
         {{ $data->description }}
      </div>      
      <a href='{{ url('list-todolist') }}' class="btn btn-default">Back</a>



    
    </div>

@stop