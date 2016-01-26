@extends('admin')

@section('content')
	<section class="panel">
		<header class="panel-heading">Create New Curriculum</header>
		<div class="panel-body">
			<div class="validation-message"></div>
			<form class="form-horizontal tasi-form" id='create-curriculum-form'>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Course</label>
					<div class="col-sm-10">
						<select name="course" class="form-control" required>
							<option value=""><i>Select Course</i></option>
							@foreach( $courses as $course)
								<option value='{{ $course->course_guid }}'> {{ $course->name }} </option>
							@endForeach
						</select>
					</div>
				</div>
				<div id='major'></div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Effectiveness </label>
					<div class="col-sm-10">
						<input type="text" name='effectiveness' placeholder='Enter Course Abbreviation' class="form-control" required>
					</div>
				</div>
			</form>
		</div>
	</section>

	<section class="panel">
		<header class="panel-heading">
			<span class='clearfix'><i class='col-sm-offset-11 col-sm-1 fa fa-times text-right'></i></span>
		</header>
		<div class="panel-body">
			<div class="validation-message"></div>
			<form class="form-horizontal tasi-form" id='create-curriculum-form'>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Year Level</label>
					<div class="col-sm-10">
						<select name="course" class="form-control" required>
							<option value="first_yr">First Year</option>
							<option value="second_yr">Second Year</option>
							<option value="third_yr">Third Year</option>
							<option value="fourth_yr">Fourth Year</option>
							<option value="fifth_yr">Fifth Year</option>
							<option value="sixth_yr">Sixth Year</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Semester</label>
					<div class="col-sm-10">
						<select name="course" class="form-control" required>
							<option value="first_sem">First Semester</option>
							<option value="second_sem">Second Semester</option>
							<option value="summer">Summer</option>
						</select>
					</div>
				</div>
			</form>
		</div>
	</section>

	<div class="text-center">
		<button class="btn btn-md">Add Period</button>
	</div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			
			$('select[name=course]').change(function(){
				var course = $('select[name=course]').val();
				if(course != ''){
					$.getJSON(App.api + '/admin/api/get/majors/' + course, function(data){
						if(data.length != 0){
							var markup = "<div class='form-group'>";
							markup += "<label class='col-sm-2 col-sm-2 control-label'>Major</label>";
							markup += "<div class='col-sm-10'>";
							markup += "<select name='major' class='form-control' >";
							$.each(data, function(i, list){
								markup += "<option value='" + list.major_guid + "''>" + list.name + "</option>"
							});
							markup += "</select></div></div>";

							$('#major').html(markup);
						}else{
							$('#major').html('');
						}
					});
				}else{
					$('#major').html('');
				}
			});
		});
	</script>
@stop