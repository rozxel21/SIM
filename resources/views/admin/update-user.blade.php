@extends('admin')

@section('content')
	<section class="panel">
      	<header class="panel-heading">Update User</header>
      	<div class="panel-body">
      		<div class="validation-message"></div>
          	<form class="form-horizontal tasi-form" id='update-user-form'>
            	<div class="form-group">
                	<label class="col-sm-2 col-sm-2 control-label">First Name</label>
                  	<div class="col-sm-10">
                    	<input type="text" name='firstname' value="{{ $user->firstname}}" placeholder='Enter First Name' class="form-control" required>
                  	</div>
              	</div>
	            <div class="form-group">
	                <label class="col-sm-2 col-sm-2 control-label">Middle Name</label>
	                <div class="col-sm-10">
	                    <input type="text" name='middlename' value="{{ $user->middlename }}" placeholder='Enter Middle Name' class="form-control">
	                </div>
	            </div>
             	<div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                  <div class="col-sm-10">
                      <input type="text" name='lastname' value="{{ $user->lastname }}" placeholder='Enter Last Name' class="form-control" required>
                  </div>
              	</div>
              	<div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                      <input type="text" name='username' value="{{ $user->username }}" placeholder='Enter Username' class="form-control" required>
                  </div>
              	</div>
              	<div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Email Address</label>
                  <div class="col-sm-10">
                      <input type="email" name='email_address' value="{{ $user->email }}" placeholder='Enter Email Address' class="form-control" required>
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
              		<a href='/admin/user' class="btn btn-md btn-danger">Cancel</a>
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
                $("select[name=status]").val({{$user->status}});
            }, 500);

			$('#update-user-form').submit(function(e){
				e.preventDefault();
				$('.validation-message').html('');

				$.ajax({
					type: 'POST',
					url: App.api + '/api/admin/update/user',
					data: {
						id: {{ $user->id }},
						firstname: ucwords($('input[name=lastname]').val()),
						middlename: ucwords($('input[name=lastname]').val()),
						lastname: ucwords($('input[name=lastname]').val()),
						username: $('input[name=username]').val(),
						email: $('input[name=email_address]').val(),
						status: $('select[name=status]').val()
					},
					success: function(){
						var markup = "<div class='alert alert-success'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
						markup += "<i class='fa fa-times'></i></button>";
						markup += "<strong>Well done!</strong> You successfully updated the user."
						markup += '</div>';
						$('.validation-message').html(markup);
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