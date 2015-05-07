@extends('layouts.default')



@section('content')
     
    <div class="container">
    
      <div class="text-center">
        {{ Form::open(array('url' => 'login')) }}

          @if (Session::has('flash_error'))
          <div id="flash_error">{{ Session::get('flash_error') }}</div>
          @endif
          <!-- if there are login errors, show them here -->
          @if (Session::get('loginError'))
          <div class="alert alert-danger">{{ Session::get('loginError') }}</div>
          @endif

          <p>
            {{ $errors->first('email') }}
            {{ $errors->first('password') }}
          </p>
          <hr>
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', Input::old('email'), array('placeholder' => 'youremail@gmal.com')) }}
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
          {{ Form::submit('Login!') }}
					<br />
					<input type="checkbox" name="remember" id="remember" />
					<label for="remember">
						Remember me
					</label>

        {{ Form::close() }}
      </div>

    
    </div>

@stop