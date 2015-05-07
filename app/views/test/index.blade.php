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
          <a href="{{ $job->link }}" target="_blank">{{ $job->title  }}</a>
        </td>
        <td>{{ $job->time }}</td>        

        </tr>

        <?php $i++ ;?>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">
        {{ $jobsdb->links() }}
    </div>
    </div>

@stop