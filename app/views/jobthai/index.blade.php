@extends('layouts.default')


@section('content')
    
    
    <div class="container">
    
    


<table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Title </th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;?>
        @foreach ($users as $user)
        <tr>

          {{ Form::open(array('method' => 'post', 'class' => 'formJobThai')) }}
        <td>
          <div class="alert alert-info info" style="display: none;">
              <ul>
                  <li></li>
              </ul>
          </div>
          {{ $i }}</td>
        <td>
          <a href="{{ $user->link }}" target="_blank">{{ $user->title  }}</a>
          {{ Form::hidden('title',  $user->title ) }}           
          {{ Form::hidden('link', $user->link  )  }}
          {{ Form::hidden('from_which_website', Request::path())  }}
        </td>
        <td>{{ Form::submit('click Me!', array('class' => 'btn btn-default')) }}</td>
        {{ Form::close() }}
        </tr>
        <?php $i++ ;?>
        @endforeach
      </tbody>
    </table>
    </div>
    <div class="text-center">
        {{ $users->links() }}
    </div>

    




@stop