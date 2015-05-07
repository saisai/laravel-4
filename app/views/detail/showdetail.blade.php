@extends('layouts.default')



@section('content')
     
    <div class="container">
    
    
      {{ Form::open(array('url' => 'edit_detail_data', 'role'=>'form')) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label><br />
        {{ $email }}<br />
        <label for="exampleInputEmail1">Qualification</label>        <br />
        {{ $qualification }}<br />
        <label for="exampleInputEmail1">Responsibility</label><br />
         {{ $responsibility }}<br />
        <label for="exampleInputEmail1">CompanyInfo</label><br />
         {{ $companyInfo }}<br />
        <label for="exampleInputEmail1">Salary</label><br />
        {{ $salary }} <br />
        <label for="exampleInputEmail1">Files</label><br />
        {{ $cv_file_name }}<br />
        <label for="exampleInputEmail1">Apply For</label><br />
				{{ $titles }}
      </div>      
      <a href='{{ url('list') }}' class="btn btn-default">Back</a>
  {{ Form::close() }}


    
    </div>

@stop