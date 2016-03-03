@extends('admin')

@section('content')
	<section class="panel">
        <header class="panel-heading">
              Subjects
        </header>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
         		<thead>
         			<tr>
                        <th></th>
                        <th></th>
                       	<th colspan="3" class="text-center">Units</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                	<tr>
                        <th>Catalog Number</th>
                        <th>Description</th>
                        <th>Lec</th>
                        <th>Lab</th>
                        <th>Total</th>
                        <th>Academic Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                	@forelse($subjects as $subject)
					    <tr>
	            			<td>{{ $subject->catalog_no }}</td>
	            			<td>{{ $subject->descriptive_title }}</td>
	            			<td>{{ $subject->lec_units }}</td>
	            			<td>{{ $subject->lab_units }}</td>
	            			<td>{{ $subject->total_units }}</td>
                            @if( $subject->academic_type == 1 )
                                <td><span class="label label-primary">Academic</span></td>
                            @else
                                <td><span class="label label-warning">Non-Academic</span></td>   
                            @endif
	            			@if( $subject->status == 1 )
	            				<td><span class="label label-success">Active</span></td>
	            			@else
	            				<td><span class="label label-warning">Deactivated</span></td>	
	            			@endif
	            			<td>
	            				<a href="/admin/update/subject/{{ $subject->id }}" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
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