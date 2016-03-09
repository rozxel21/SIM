@extends('admin')

@section('content')

	<section class="panel">
		<header class="panel-heading">Curriculum</header>
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
			<table class="table">
				<thead>
					<tr>
						<td>
							<div class="typeahead-container">
						    	<div class="typeahead-field">
						            <span class="typeahead-query">
						                <input id="fyfs-subject" name="fyfs-subject" type="search" placeholder="Search" autocomplete="on">
						            </span>
						        </div>
						    </div>
						</td>
						<td colspan="2"> <span id="fyfs-descriptive">-------</span> </td>
						<td><span id="fyfs-units">0</span></td>
						<td><button id='fyfs-saveBtn' class="btn btn-primary" disabled="true"><i class="fa fa-save"></i> Save</button></td>
					</tr>
				</thead>
			</table>
		</div>	
	</section>

	<section class="panel">
		<header class="panel-heading">First Semester</header>
		<div class="panel-body">
			<div class="validation-fyfs"></div>
			<table class="table fyfs">
				<thead>
					<tr>
						<th>Catalog No.</th>
						<th>Descriptive Title</th>
						<th>Total Units</th>
						<th>Prerequisite(s)</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $subjects as $subject )
						@if( $subject->year == 'first' && $subject->semester == 'first' )
							<tr>
								<td> {{ $subject->getCatalog->catalog_no }} </td>
								<td> {{ $subject->getCatalog->descriptive_title }} </td>
								<td> {{ $subject->getCatalog->total_units }} </td>
								<td> {{ $subject->type }} </td>
								<td>
		            				<button class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
		            			</td>
							</tr>
						@endIf
					@endForeach
				</tbody>
			</table>
		</div>
	</section>

	<section class="panel">
		<header class="panel-heading">Second Semester</header>
		<div class="panel-body">
			<div class="validation-message"></div>
			
			<table class="table fyss">
				<thead>
					<tr>
						<th>Catalog No.</th>
						<th>Descriptive Title</th>
						<th>Total Units</th>
						<th>Prerequisite(s)</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="typeahead-container">
						    	<div class="typeahead-field">
						            <span class="typeahead-query">
						                <input id="fyss-subject" name="fyss-subject" type="search" placeholder="Search" autocomplete="on">
						            </span>
						        </div>
						    </div>
						</td>
						<td> <span id="fyss-descriptive">-------</span> </td>
						<td><span id="fyss-units">0</span></td>
						<td> <button id='fyss-prereq' class="btn btn-xs" >Add Prereq</button> </td>
						<td><button id='fyss-saveBtn' class="btn btn-primary" disabled="true"><i class="fa fa-save"></i> Save</button></td>
					</tr>

					@foreach( $subjects as $subject )
						@if( $subject->year == 'first' && $subject->semester == 'second' )
							<tr>
								<td> {{ $subject->getCatalog->catalog_no }} </td>
								<td> {{ $subject->getCatalog->descriptive_title }} </td>
								<td> {{ $subject->getCatalog->total_units }} </td>
								<td>  </td>
								<td>
		            				<button class="btn btn-default btn-xs"><i class="fa fa-times"></i></button>
		            			</td>
							</tr>
						@endIf
					@endForeach
				</tbody>
			</table>
		</div>
	</section>

@stop

@section('script')
	<script type="text/javascript">
		var curriculum  = "{{ $curriculum->curriculum_guid }}"; 
	</script>

	<script type="text/javascript" src="{{ URL::asset('js/admin/prospectus.js') }}"></script>
@stop