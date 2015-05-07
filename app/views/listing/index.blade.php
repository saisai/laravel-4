@extends('layouts.default')


@section('content')
    
    
    <div class="container">
    @if(Session::has('success'))
			<div class="alert alert-info text-center">{{ Session::get('success') }}</div>
		@endif
			<table class="table table-striped">
			<tr><td>Searching</td><td>{{ Form::open(array('url' => 'selected-search', 'method' => 'post')) }} {{ Form::text('txtSearching', Input::old('txtSearching'), array('class' => 'form-control')) }}</td><td>{{ Form::submit('Search', array('class' => 'btn btn-default')) }} {{ Form::close() }}</td></tr>
			</table>		
		@if(Session::has('noresult'))
			<div class="alert alert-info text-center">{{ Session::get('noresult') }}</div>
		@else
			<table class="table table-striped">
				<thead>
					<tr>
						{{ Form::open(array('method' => 'post', 'id'=>'frmcheckall')) }}
						<th><input type='submit' id='btnDeleteAll' value="Delete" /> <input type="checkbox" id="check_all"  value=""> </th>
						<th>Title </th>
						<th>Applied Times</th>
						<th>Apply For</th>
						<th>Created at</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;?>
					@foreach ($data as $user)
					<tr>
						
					<td>{{-- $i --}} <input type="checkbox" value="{{ $user->id }}" name="data[]" ccattr="{{ $user->id }}" id="data_{{ $i }}"></td>
					{{ Form::close() }}
					<td>
						<a href="{{ $user->link }}" target="_blank">{{ $user->title  }}</a>
					</td>
			@if($user->detail != 0)
			<td><a href="{{ url('how-many-applies/'.$user->id) }}">{{ $user->apply_times }}</a></td>
			@else
			<td>&nbsp;</td>
			@endif
					@if($user->detail != 0)
			<td>{{ $user->applyfortitle }}</td>
			@else
			<td>&nbsp;</td>
			@endif
					<td>{{ $user->created_at }}</td>
							@if($user->detail == 0)
									<td colspan='2'>
									{{ Form::open(array('url' => 'show_detail', 'method' => 'post')) }}
									{{ Form::submit('Add', array('class' => 'btn btn-default')) }}
									{{ Form::hidden('link', $user->link) }}
									{{ Form::hidden('detailId', $user->id)  }}
									{{ Form::close() }}
									</td>
							@else					
					 
									<td>
					
									{{ Form::open(array('url' => 'edit_detail')) }}
									{{ Form::submit('Edit', array('class' => 'btn btn-default')) }}
									 {{ Form::hidden('link', $user->link) }}
									{{ Form::hidden('detailId', $user->id)  }}
									{{ Form::close() }}
								</td>
									<td>
									{{ Form::open(array('url' => 'view_detail')) }}
									{{ Form::submit('View', array('class' => 'btn btn-default')) }}
									 {{ Form::hidden('link', $user->link) }}
									{{ Form::hidden('detailId', $user->tb_detail_id)  }}
									{{ Form::close() }}
								</td>              
							@endif

					<td>
						{{ Form::open(array('url' => 'post_apply')) }}
						@if($user->detail != 0)
								@if( $user->apply == 0)
									{{ Form::submit('Fire!', array('class' => 'btn btn-default')) }}
									{{ Form::hidden('fireId', $user->tb_detail_id) }}
									{{ Form::hidden('tb_apply_id', $user->id) }}
								@endif
							@endif
						{{ Form::close() }}
						</td>
					<td>
					<a href={{ url('delete_list/'.$user->id) }} class = 'btn btn-default'>Delete</a>
					<!--<input type='checkbox' chkid='{{ $user->id }}' class='chkdeletelist' id='chkdeletelist_{{$user->id}}' name="ChkDeleteList" />-->
					
					</td>
					</tr>
					<?php $i++ ;?>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				
				{{ $data->links() }}
				
			</div>
		@endif
    </div>

@stop