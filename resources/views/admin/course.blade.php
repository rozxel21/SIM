@extends('admin')

@section('content')
	<section class="panel">
        <header class="panel-heading">
              Colleges
        </header>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
         		<thead>
                	<tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>College</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                	@forelse($courses as $course)
					    <tr>
					    	@inject('str', 'Illuminate\Support\Str')
	            			<td>{{ $str->upper($course->abrr) }}</td>
	            			<td>{{ $course->name }}</td>
	            			<td>{{ $str->upper($course->college) }}</td>
	            			@if( $course->status == 1 )
	            				<td><span class="label label-success">Active</span></td>
	            			@else
	            				<td><span class="label label-warning">Deactivated</span></td>	
	            			@endif
	            			<td>
	            				<a href="/admin/update/course/{{ $course->id }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
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