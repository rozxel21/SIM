@extends('admin')

@section('content')

	<section class="panel">
		<header class="panel-heading">Curriculum</header>
		<div class="panel-body">
			<div class="validation-message"></div>
			<div class="text-center">
				<h3> {{ $course->name }}</h3>
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
			<div class="validation-message"></div>
			
			<table class="table striped">
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
						                <input id="subject" name="subject" type="search" placeholder="Search" autocomplete="on">
						            </span>
						        </div>
						    </div>
						</td>
						<td> <span id="descriptive">-------</span> </td>
						<td><span id="units">0</span></td>
						<td>NONE</td>
						<td><button class="btn btn-primary" ><i class="fa fa-save"></i> Save</button></td>
					</tr>

					<div class="fyfs"></div>

				</tbody>
			</table>
		</div>
	</section>
@stop

@section('script')
	<script type="text/javascript">
		$('#subject').typeahead({
		    order: "asc",
		    hint: true,
		    source: {
		       sample: {
		            url: [App.api + "/api/search/subjects"]
		        },
		    },
		    callback: {
		        onClickAfter: function (node, a, item, event) {
		            console.log(event);
		            event.preventDefault();
		          	var catalog = $('input[name=subject]').val();
		          	$.getJSON(App.api + "/api/get/subject/data/" + base32.encode(catalog), function(data){
		          		$('#descriptive').text(data.descriptive_title);
		          		$('#units').text(data.total_units);
		          	});
		        },
		    }
		});
	</script>
@stop