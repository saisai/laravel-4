@extends('layouts.default')



@section('content')
     
    <div class="container">
    
    
      {{ Form::open(array('url' => 'edit_detail_data', 'role'=>'form')) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
				{{ Form::text('email', $email, array('class'=>'form-control', 'id'=>'exampleInputEmail1', 'placeholder'=>'Enter email')) }}
        <label for="exampleInputEmail1">Qualification</label>        
        <textarea name="qualification"  class="ckeditor form-control" cols="80" id="editor1"  rows="10">{{ $qualification }}</textarea>
        <label for="exampleInputEmail1">Responsibility</label>
         <textarea name="responsibility"  class="ckeditor form-control" cols="80" id="editor1"  rows="10">{{ $responsibility }}</textarea>
        <label for="exampleInputEmail1">CompanyInfo</label>
         <textarea name="companyInfo"  class="ckeditor form-control" cols="80" id="editor1"  rows="10">{{ $companyInfo }}</textarea>
        <label for="exampleInputEmail1">Salary</label>
        {{ Form::text('salary', $salary, array('class'=>'form-control')) }} 
        <label for="exampleInputEmail1">Files</label>
        <select name="cvFile"  autocomplete="off">
        <?php foreach($getFiles as $file): ?>
        <?php if($file->id == $cv_file_name): ?>
        <option value={{ $file->id }} selected='selected'>{{ $file->title }}</option>
        <?php else:?>
      <option value={{ $file->id }}  >{{ $file->title }}</option>
        <?php endif;?>
        <?php endforeach;?>
      </select>
				<br />
        <label for="exampleInputEmail1">Apply For</label>
        <select name="apply_for_id"  autocomplete="off">
        <?php foreach($applyFor as $apply): ?>
        <?php if($apply->id == $apply_for_id): ?>
        <option value={{ $apply->id }} selected='selected'>{{ $apply->title }}</option>
        <?php else:?>
      <option value={{ $apply->id }}  >{{ $apply->title }}</option>
        <?php endif;?>
        <?php endforeach;?>
      </select>			
        {{ Form::hidden('link', $link ) }}
      </div>
      <button type="submit" class="btn btn-default">Edit</button>
      <a href='{{ url('list') }}' class="btn btn-default">Back</a>
  {{ Form::close() }}


    
    </div>

@stop