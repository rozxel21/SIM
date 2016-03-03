@extends('admin')

@section('content')
	<section class="panel">
        <header class="panel-heading">
              Curriculum
        </header>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
         		<thead>
                	<tr>
                        <th>Course</th>
                        <th>Major</th>
                        <th>Effective SY</th>
                        <th>BOR Res No.</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                	@forelse($curricula as $curriculum)
					    <tr>
	            			<td>{{ $curriculum->getCourse->name }}</td>
	            			@if( $curriculum->getMajor != null )
	            				<td>{{ $curriculum->getMajor->name }}</td>
	            			@else
	            				<td></td>
	            			@endIf
	            			<td>{{ $curriculum->effective_sy }}</td>
	            			<td>{{ $curriculum->bor_res }}</td>
	            			@if( $curriculum->status == 1 )
	            				<td><span class="label label-success">Active</span></td>
	            			@else
	            				<td><span class="label label-warning">Deactivated</span></td>	
	            			@endif
	            			<td>
	            				@inject('base32', 'App\MyLibraries\Base32')
	            				<a href="/admin/curriculum/{{ $base32->encode($curriculum->curriculum_guid) }}" class="btn btn-primary btn-xs">View Subjects</i></a>
	            				<a href="" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
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