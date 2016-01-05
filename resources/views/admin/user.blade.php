@extends('admin')

@section('content')
	<section class="panel">
        <header class="panel-heading">
              Users
        </header>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
         		<thead>
                	<tr>
                        <th>Name</th>
                        <th>Username</th>
                          <!-- <th>Client</th> -->
                        <th>Email</th>
                          <!-- <th>Price</th> -->
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                	@forelse($users as $user)
					    <tr>
	            			<td>{{ $user['firstname'] }} {{ $user['lastname'] }}</td>
	            			<td>{{ $user['username'] }}</td>
	            			<td>{{ $user['email'] }}</td>
	            			@if( $user['status'] == 1 )
	            				<td><span class="label label-success">Active</span></td>
	            			@else
	            				<td><span class="label label-warning">Deactivated</span></td>	
	            			@endif
	            			<td>
	            				<a href="/admin/update/user/{{ $user['id'] }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
	            				<button class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
	            			</td>

	            		</tr>
					@empty
					    <tr>
					    	<td colspan="5" class="text-center">No Record Found!!!</td>
					    </tr>
					@endforelse
                </tbody>
            </table>
        </div>
    </section>
@stop