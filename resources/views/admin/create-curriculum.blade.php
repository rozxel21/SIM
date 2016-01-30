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
					<label class="col-sm-2 col-sm-2 control-label">Effective SY</label>
					<div class="col-sm-4">
						<select name="effective-1" class="form-control" required>
							@for ($i = 2030; $i >= 1990; $i--)
								<option value='{{ $i }}'> {{ $i }} </option>
							@endFor
						</select>
					</div>
					<label class="col-sm-1 text-center"> - </label>
					<div class="col-sm-5">
						<select name="effective-2" class="form-control" required>
							@for ($i = 2030; $i >= 1990; $i--)
								<option value='{{ $i }}'> {{ $i }} </option>
							@endFor
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">BOR Res No.</label>
					<div class="col-sm-10">
						<input type="text" name='bor_res' class="form-control" placeholder='Enter BOR Res Number' />
					</div>
				</div>

				<div class="form-group text-center">
					<a href='/admin/curriculum' class="btn btn-md btn-danger">Cancel</a>
					<button type='submit' class="btn btn-md btn-primary">Save</button>
				</div>
			</form>
		</div>
	</section>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			var majorIndicator = false;

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

							majorIndicator = true;
							$('#major').html(markup);
						}else{
							$('#major').html('');
						}
					});
				}else{
					$('#major').html('');
					majorIndicator = false;
				}
			});

			$('select[name=effective-1]').val(App.year);
			$('select[name=effective-2]').val(App.year);

			$('#create-curriculum-form').submit(function(e){

				e.preventDefault();

				var course = $('select[name=course]').val();
				if(majorIndicator == true){
					var major = $('select[name=major]').val();
				}else{
					var major = null;
				}

				var effective1 = $('select[name=effective-1]').val();
				var effective2 = $('select[name=effective-2]').val();

				if(effective1 == effective2){
					var effective = effective1;
				}else{
					var effective = effective1 + " - " + effective2;
				}

				var bor = $('input[name=bor_res').val();

				$.ajax({
					url: App.api + '/api/admin/save/curriculum',
					type: 'POST',
					data: {
						course: course,
						major: major,
						effective: effective,
						bor: bor
					},
					success: function(){
						var markup = "<div class='alert alert-success'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
						markup += "<i class='fa fa-times'></i></button>";
						markup += "<strong>Well done!</strong> You successfully create a new college."
						markup += '</div>';
						$('.validation-message').html(markup);

						$('input[name=abrr]').val('');
						$('input[name=name]').val('');
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

						$('.validation-message').html(markup);
					}
				});
				
			});
		});
	</script>
@stop