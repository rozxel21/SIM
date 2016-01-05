@extends('admin')

@section('content')
	<section class="panel">
      	<header class="panel-heading">Create New User</header>
      	<div class="panel-body">
      		<div class="validation-message"></div>
          	<form class="form-horizontal tasi-form" id='create-user-form'>
            	<div class="form-group">
                	<label class="col-sm-2 col-sm-2 control-label">First Name</label>
                  	<div class="col-sm-10">
                    	<input type="text" name='firstname' placeholder='Enter First Name' class="form-control" required>
                  	</div>
              	</div>
	            <div class="form-group">
	                <label class="col-sm-2 col-sm-2 control-label">Middle Name</label>
	                <div class="col-sm-10">
	                    <input type="text" name='middlename' placeholder='Enter Middle Name' class="form-control">
	                </div>
	            </div>
             	<div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                  <div class="col-sm-10">
                      <input type="text" name='lastname' placeholder='Enter Last Name' class="form-control" required>
                  </div>
              	</div>
              	<div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                      <input type="text" name='username' placeholder='Enter Username' class="form-control" required>
                  </div>
              	</div>
              	<div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Email Address</label>
                  <div class="col-sm-10">
                      <input type="email" name='email_address' placeholder='Enter Email Address' class="form-control" required>
                  </div>
              	</div>
           		<div class="form-group">
                	<label class="col-sm-2 col-sm-2 control-label">Password</label>
                  	<div class="col-sm-10">
                    	<input type="password" name='password' placeholder='Enter Password' class="form-control" placeholder="" required>
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
			var App = {
				name: 'SIM',
				api: 'http://localhost:721'
			}

			$('#create-user-form').submit(function(e){
				e.preventDefault();
				$('.validation-message').html('');

				$.ajax({
					type: 'POST',
					url: App.api + '/api/admin/save/user',
					data: {
						firstname: $('input[name=firstname]').val(),
						middlename: $('input[name=middlename]').val(),
						lastname: $('input[name=lastname]').val(),
						username: $('input[name=username]').val(),
						email: $('input[name=email_address]').val(),
						password: $('input[name=password]').val()
					},
					success: function(){
						var markup = "<div class='alert alert-success'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
						markup += "<i class='fa fa-times'></i></button>";
						markup += "<strong>Well done!</strong> You successfully create a new user."
						markup += '</div>';
						$('.validation-message').html(markup);

						$('input[name=firstname]').val('');
						$('input[name=middlename]').val('');
						$('input[name=lastname]').val('');
						$('input[name=username]').val('');
						$('input[name=email_address]').val('');
						$('input[name=password]').val('');
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