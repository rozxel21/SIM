@extends('admin')

@section('content')
	<section class="panel">
      	<header class="panel-heading">Update College</header>
      	<div class="panel-body">
      		<div class="validation-message"></div>
          	<form class="form-horizontal tasi-form" id='update-college-form'>
            	<div class="form-group">
                	<label class="col-sm-2 col-sm-2 control-label">College Code</label>
                  	<div class="col-sm-10">
                    	<input type="text" name='college_code' value="{{ $college->college_code }}" placeholder='Enter College Abbr' class="form-control" required>
                  	</div>
              	</div>
	            <div class="form-group">
	                <label class="col-sm-2 col-sm-2 control-label">College Name</label>
	                <div class="col-sm-10">
	                    <input type="text" name='college_name' value="{{ $college->college_name }}" placeholder='Enter Middle Name' class="form-control" required>
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
              		<a href='/admin/college' class="btn btn-md btn-danger">Cancel</a>
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
                $("select[name=status]").val({{ $college->status }});
            }, 500);

			$('#update-college-form').submit(function(e){
				e.preventDefault();
				$('.validation-message').html('');

				$.ajax({
					type: 'POST',
					url: App.api + '/api/admin/update/college',
					data: {
						id: {{ $college->id }},
						college_code: $('input[name=college_code]').val(),
						college_name: $('input[name=college_name]').val(),
						status: $('select[name=status]').val()
					},
					success: function(){
						var markup = "<div class='alert alert-success'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
						markup += "<i class='fa fa-times'></i></button>";
						markup += "<strong>Well done!</strong> You successfully updated the college."
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