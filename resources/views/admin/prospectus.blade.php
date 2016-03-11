@extends('admin')

@section('content')

	<section class="panel">
		<div class="panel-body">
			<div class="text-center">
				<h3> {{ $curriculum->getCourse->name }}</h3>
				@if( $curriculum->getMajor != null )
					<h4> Major in {{ $curriculum->getMajor->name }} </h4>
				@endIf
				<span> Effective SY {{ $curriculum->effective_sy }} </span>
				<span> <br /> BOR Res No. {{ $curriculum->bor_res }} </span>
			</div>
		</div>
	</section>

	<section class="panel">
		<div class="panel-body">
			<div class="text-center">
				<h4 id="year"></h4>
			</div>
		</div>
	</section>

	<section class="panel">
		<div class="panel-body">
			<div class="validation-msg"></div>
			<div class="row">
				<div class="col-md-3">
					<div class="typeahead-container">
				    	<div class="typeahead-field">
				            <span class="typeahead-query">
				                <input id="subject" name="subject" type="search" placeholder="Enter Catalog No." autocomplete="on">
				            </span>
				        </div>
				    </div>
				</div>
				<div class="col-md-3">
					<span id="descriptive">----------------------------</span>
				</div>
				<div class="col-md-1">
					<span id="units">0</span>
				</div>
				<div class="col-md-3">
					<select name='semester' class="form-control">
						<option value="first">First Semester</option>
						<option value="second">Second Semester</option>
						<option value="summer">Summer Semester</option>
					</select>
				</div>
				<div class="col-md-2 text-center">
					<button id='saveBtn' class="btn btn-primary" disabled="true"><i class="fa fa-save"></i> Save</button>
				</div>
			</div>
		</div>	
	</section>

	@if( $semester['first'] > 0 )
		<section class="panel">
			<header class="panel-heading">First Semester</header>
			<div class="panel-body">
				<table class="table first">
					<thead>
						<tr>
							<th>Catalog No.</th>
							<th>Descriptive Title</th>
							<th class='text-center'>Total Units</th>
							<th>Prerequisite(s)</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $subjects as $subject )
							@if( $subject->semester == 'first' )
								<tr id="{{ $subject->prospectus_guid }}">
									<td> {{ $subject->getCatalog->catalog_no }} </td>
									<td> {{ $subject->getCatalog->descriptive_title }} </td>
									<td class='text-center'> {{ $subject->getCatalog->total_units }} </td>
									@if( $year == 'first' )
										<td> {{ $subject->type }} </td>
									@else
										<td><button class="btn btn-xs" data-toggle="modal" data-target="#myModal">Add Prereq</button> </td>
									@endIf
									<td>
			            				<button id="#delete" data-prospectus="{{ $subject->prospectus_guid }}" class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
			            			</td>
								</tr>
							@endIf
						@endForeach
					</tbody>
				</table>
			</div>
		</section>
	@else
		<div id='first-sem'></div>
	@endIf

	@if( $semester['second'] > 0 )
		<section class="panel">
			<header class="panel-heading">Second Semester</header>
			<div class="panel-body">
				<table class="table second">
					<thead>
						<tr>
							<th>Catalog No.</th>
							<th>Descriptive Title</th>
							<th class='text-center'>Total Units</th>
							<th>Prerequisite(s)</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $subjects as $subject )
							@if( $subject->semester == 'second' )
								<tr id="{{ $subject->prospectus_guid }}">
									<td> {{ $subject->getCatalog->catalog_no }} </td>
									<td> {{ $subject->getCatalog->descriptive_title }} </td>
									<td class="text-center"> {{ $subject->getCatalog->total_units }} </td>
									<td><button class="btn btn-xs" data-toggle="modal" data-target="#myModal">Add Prereq</button> </td>
									<td>
			            				<button id="#delete" data-prospectus="{{ $subject->prospectus_guid }}" class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
			            			</td>
								</tr>
							@endIf
						@endForeach
					</tbody>
				</table>
			</div>
		</section>
	@else
		<div id='second-sem'></div>
	@endIf

	@if( $semester['summer'] > 0 )
		<section class="panel">
			<header class="panel-heading">Summer</header>
			<div class="panel-body">
				<table class="table summer">
					<thead>
						<tr>
							<th>Catalog No.</th>
							<th>Descriptive Title</th>
							<th class='text-center'>Total Units</th>
							<th>Prerequisite(s)</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $subjects as $subject )
							@if( $subject->semester == 'summer' )
								<tr id="{{ $subject->prospectus_guid }}">
									<td> {{ $subject->getCatalog->catalog_no }} </td>
									<td> {{ $subject->getCatalog->descriptive_title }} </td>
									<td class="text-center"> {{ $subject->getCatalog->total_units }} </td>
									<td><button class="btn btn-xs" data-toggle="modal" data-target="#myModal">Add Prereq</button> </td>
									<td>
			            				<button id="#delete" data-prospectus="{{ $subject->prospectus_guid }}" class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
			            			</td>
								</tr>
							@endIf
						@endForeach
					</tbody>
				</table>
			</div>
		</section>
	@else
		<div id='summer-sem'></div>
	@endIf

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header" style="background-color: #39435C; color: #fff">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Add Prerequisite(s)</h4>
	      	</div>
	      	<div class="modal-body">
	        	<select class="form-control">
	        		<option value="">Select Type</option>
	        		<option value="subject">Subjects</option>
	        		<option value="status">Student Status</option>
	        		<option value="all">All Subject</option>
	        	</select>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
	        	<button type="button" class="btn btn-sm btn-info">Save</button>
	      	</div>
	    </div>
	  </div>
	</div>

@stop

@section('script')
	<script type="text/javascript">
		var curriculum  = "{{ $curriculum->curriculum_guid }}";
		var year = "{{ $year }}";
		var first = "{{ $semester['first'] }}";
		var second = "{{ $semester['second'] }}";
		var summer = "{{ $semester['summer'] }}";
	</script>

	<script type="text/javascript" src="{{ URL::asset('js/admin/prospectus.js') }}"></script>
@stop