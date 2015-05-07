@extends('layouts.default')


@section('content')
     
    <div class="container">

    

      {{ Form::open(array('url' => 'add_detail', 'role'=>'form')) }}
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">        
        <label for="exampleInputEmail1">Qualification</label>
        {{ Form::textarea('qualification', Input::old('qualification'), array('class' => 'ckeditor form-control')) }}
        <!--<textarea name="qualification"  class="ckeditor form-control" cols="80" id="editor1"  rows="10"></textarea>-->
        <label for="exampleInputEmail1">Responsibility</label> 
        {{ Form::textarea('responsibility', Input::old('responsibility'), array('class' => 'ckeditor form-control')) }}
        <!--<textarea name="responsibility"  class="ckeditor form-control" cols="80" id="editor1"  rows="10"></textarea>-->
        <label for="exampleInputEmail1">CompanyInfo</label>
        {{ Form::textarea('companyInfo', Input::old('companyInfo'), array('class' => 'ckeditor form-control')) }}
        <!--<textarea name="companyInfo"  class="ckeditor form-control" cols="80" id="editor1"  rows="10"></textarea>-->
        <label for="exampleInputEmail1">Salary</label>
        {{ Form::text('salary', Input::old('salary'), array('class' => 'form-control')) }}        
        <!--<input type="text" name="salary" class="form-control" >        -->
        <label for="exampleInputEmail1">Files</label>
        <?php $categories= array(); ?>
        @foreach ($getFiles as $files)
                   <?php $categories[$files->id] = $files->title; ?>
        @endforeach
				{{ Form::select('cvFile', $categories) }}
				<br />
        <label for="exampleInputEmail1">Apply For</label>
        <?php $apply_for= array(); ?>
        @foreach ($applyFor as $apply)
                   <?php $apply_for[$apply->id] = $apply->title; ?>
        @endforeach				
	      {{ Form::select('applyFor', $apply_for) }}

        {{-- Form::select('size', array('L' => 'Large', 'S' => 'Small'), 'S') --}}
        {{ Form::hidden('link', $link ) }}
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
  {{ Form::close() }}


  <div class="bs-example bs-example-bg-classes">
     @if ($errors->has())
      {{ $errors->first('email', '<p class="bg-danger">:message</p>') }}
    @endif
  </div>
    
    </div>

@stop