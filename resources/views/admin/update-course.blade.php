@extends('admin')

@section('content')
	<section class="panel">
      	<header class="panel-heading">Update Course</header>
      	<div class="panel-body">
      		<div class="validation-message"></div>
          	<form class="form-horizontal tasi-form" id='update-course-form'>
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
                	<label class="col-sm-2 col-sm-2 control-label">Course Abbrevation</label>
                  	<div class="col-sm-10">
                    	<input type="text" name='abrr' value="{{ $course->abrr }}" placeholder='Enter College Abbrevation' class="form-control" required>
                  	</div>
              	</div>
	            <div class="form-group">
	                <label class="col-sm-2 col-sm-2 control-label">Course Name</label>
	                <div class="col-sm-10">
	                    <input type="text" name='name' value="{{ $course->name }}" placeholder='Enter Middle Name' class="form-control" required>
	                </div>
	            </div>
              	<div class="form-group">
                	<label class="col-sm-2 col-sm-2 control-label">Status</label>
                  	<div class="col-sm-10">
                    	<select name="status" class="form-control">
                    		<option value="1">Active</option>
                    		<option value="0">Deactivate</option>
                    	</select>
                	</div>
              	</div>
              	<div class="form-group text-center">
              		<a href='/admin/course' class="btn btn-md btn-danger">Cancel</a>
                	<button type='submit' class="btn btn-md btn-primary">Update</button>
              	</div>  
          	</form>
      	</div>
    </section>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){

			setTimeout(function(){
                $("select[name=status]").val('{{ $course->status }}');
                $("select[name=college]").val('{{ $course->college }}');
            }, 500);

			$('#update-course-form').submit(function(e){
				e.preventDefault();
				$('.validation-message').html('');

				$.ajax({
					type: 'POST',
					url: App.api + '/api/admin/update/course',
					data: {
						id: {{ $course->id }},
						abrr: $('input[name=abrr]').val(),
						name: $('input[name=name]').val(),
						college: $('select[name=college]').val(),
						status: $('select[name=status]').val()
					},
					success: function(){
						var markup = "<div class='alert alert-success'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
						markup += "<i class='fa fa-times'></i></button>";
						markup += "<strong>Well done!</strong> You successfully updated the course.";
						markup += '</div>';
						$('.validation-message').html(markup);
					},
					error: function(e){
						console.log(e.responseText);
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