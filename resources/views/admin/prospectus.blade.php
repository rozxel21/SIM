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

	<div class="panel">
		<div class="panel-body text-center">
			<h4>First Year</h4>
		</div>
	</div>

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
						<td> <span id="descriptive">-------</span> </td>
						<td><span id="units">0</span></td>
						<td>NONE</td>
						<td><button id='saveFyfsBtn' class="btn btn-primary" disabled="true"><i class="fa fa-save"></i> Save</button></td>
					</tr>

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
						<td> <span id="descriptive">-------</span> </td>
						<td><span id="units">0</span></td>
						<td> <button class="btn btn-xs" >Add Prereq</button> </td>
						<td><button id='saveFyfsBtn' class="btn btn-primary" disabled="true"><i class="fa fa-save"></i> Save</button></td>
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
		$('#fyfs-subject').typeahead({
		    order: "asc",
		    hint: true,
		    source: {
		       sample: {
		            url: [App.api + "/api/search/subjects"]
		        },
		    },
		    callback: {
		        onClickAfter: function (node, a, item, event) {
		            event.preventDefault();
		          	var catalog = $('input[name=fyfs-subject]').val();
		          	$.getJSON(App.api + "/api/get/subject/data/" + base32.encode(catalog), function(data){
		          		$('#descriptive').text(data.descriptive_title);
		          		$('#units').text(data.total_units);
		          		$('#saveFyfsBtn').removeAttr('disabled');
		          	});
		        },
		    }
		});

		$('#fyfs-subject').blur(function(){
			var catalog = $('input[name=fyfs-subject]').val();
          	$.ajax({
          		url: App.api + '/api/get/subject/data/' + base32.encode(catalog),
          		type: 'GET',
          		dataType: 'JSON',
          		success: function(data){
          			$('#descriptive').text(data.descriptive_title);
		          	$('#units').text(data.total_units);
		          	$('#saveFyfsBtn').removeAttr('disabled');
          		},
          		error: function(){
          			$('#descriptive').text('-------');
		          	$('#units').text('0');
		          	$('#saveFyfsBtn').attr('disabled','disabled');
          		}
          	});
		});

		$('#saveFyfsBtn').click(function(e){
			e.preventDefault();
			var catalog = $('input[name=fyfs-subject]').val();
			var semester = 'first';
			var year = 'first';
			var type = 'NONE';
			var ref = '';
			$.ajax({
				url: App.api + '/api/admin/save/prospectus',
				type: 'POST',
				data: {
					curriculum: "{{ $curriculum->curriculum_guid }}",
					catalog_no: catalog,
					year: year,
					semester: semester,
					type: type,
					ref: ref
				},
				success: function(data){
					var markup = "";

					markup = "<tr> <td> " + data.get_catalog.catalog_no + "</td>";
					markup += "<td>" + data.get_catalog.descriptive_title + "</td>";
					markup += "<td>" + data.get_catalog.total_units + "</td>";
					markup += "<td>" + data.type + "</td>";
					markup += "<td> <button class='btn btn-default btn-xs'><i class='fa fa-times'></i></button> </td> </tr>";

					$('.fyfs tbody').append(markup);

					$('#descriptive').text('-------');
		          	$('#units').text('0');
		          	$('#saveFyfsBtn').attr('disabled','disabled');
		          	$('input[name=subject]').val('');
				},
				error: function(e){
						var errors = $.parseJSON(e.responseText);
						var markup = "<div class='alert alert-danger'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
                        markup += "<i class='fa fa-times'></i></button>";
                        markup += "<strong>Oh snap!</strong> Change a few things up and try submitting again."
						markup += "<ul>";
						$.each(errors, function(i, data){
							markup += "<li>" + data + "</li>";
						});
						markup += "</ul></div>";

						$('.validation-fyfs').html(markup);
					}
			});
		});



	</script>
@stop