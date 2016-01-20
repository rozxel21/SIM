@extends('admin')

@section('content')
	<section class="panel">
		<header class="panel-heading">Create New Course</header>
		<div class="panel-body">
			<div class="validation-message"></div>
			<form class="form-horizontal tasi-form" id='create-course-form'>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">College</label>
					<div class="col-sm-10">
						<select name="college" class="form-control" required>
							<option value=""><i>Select College</i></option>
							@foreach ($colleges as $college)
								<option value="{{ $college->abrr }}">{{ $college->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Course Abbreviation</label>
					<div class="col-sm-10">
						<input type="text" name='abrr' placeholder='Enter Course Abbreviation' class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Course Name</label>
					<div class="col-sm-10">
						<input type="text" name='name' placeholder='Enter Course Name' class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<p style="color:green"><i>*not required</i></p>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Major</label>
					<div class="col-sm-10">
						<input type="text" name='major-1' placeholder='Enter Course Major' class="form-control">
					</div>
				</div>
				<div id='add-major'></div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="button" class="btn btn-md add-major-btn">Add Major</button>
					</div>
				</div>
				<div class="form-group text-center">
					<a href='/admin' class="btn btn-md btn-danger">Cancel</a>
					<button type='submit' class="btn btn-md btn-primary">Save</button>	
				</div>  
			</form>
		</div>
	</section>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){

			var addMajor = 1;
			$('.add-major-btn').click(function(){
				addMajor++;
				var markup = "<div class='form-group'><div class='col-sm-offset-2 col-sm-10'>";
					markup += "<input type='text' name='major-" + addMajor + "' placeholder='Enter Course Major' class='form-control'>";
					markup += "</div></div>";
				$('#add-major').append(markup);
			});

			$('#create-course-form').submit(function(e){

				e.preventDefault();

				var abrr = $('input[name=abrr]').val();
				var name = $('input[name=name]').val();
				var college = $('select[name=college]').val();

				var majorList = [];
				for (var i = 1; i <= addMajor; i++) {
                    var temp = $("input[name=major-"+i+"]").val();
                    if (temp != "" && temp != undefined && temp != null) {
                        majorList.push(temp); 
                    }
                }
                var majorString = JSON.stringify(majorList);

				$.ajax({
					url: App.api + '/api/admin/save/course',
					type: 'POST',
					data: {
						abrr: abrr,
						name: name,
						college: college,
						majors: majorString
					},
					success: function(){
						var markup = "<div class='alert alert-success'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
						markup += "<i class='fa fa-times'></i></button>";
						markup += "<strong>Well done!</strong> You successfully create a new course."
						markup += '</div>';
						$('.validation-message').html(markup);

						$('input[name=abrr]').val('');
						$('input[name=name]').val('');
						$('select[name=college]').val('');
						addMajor = 1;

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
