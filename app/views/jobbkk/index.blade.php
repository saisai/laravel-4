@extends('layouts.default')


@section('content')
    
    
    <div class="container">
    
    <table class="table table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Title</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1;?>
        @foreach ($jobsdb as $job)
        
        <tr>                    
        <td>{{ $i }}</td>
        <td>
           {{ Form::open(array('method' => 'post')) }}
          <a href="{{ $job->link }}" target="_blank">{{ $job->title  }}</a>
          {{ Form::hidden('title',  $job->title, array('id'=>'title'.$i) ) }}
          {{ Form::hidden('link', $job->link, array('id' =>'link'.$i))  }}
          {{ Form::hidden('from_which_website', Request::path(), array('id'=>'from_which_website'.$i))  }}          
        </td>
        <td>{{ $job->time }}</td>
        <td>{{ Form::submit('click Me!', array('id'=> $i, 'class' => 'btn btn-default formJobsDb')) }}</td>  
        {{ Form::close() }}
        </tr>

        <?php $i++ ;?>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">
        {{-- $jobsdb->links() --}}
    </div>
    </div>

@stop