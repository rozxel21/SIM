@extends('admin')

@section('content')
	<section class="panel">
		<header class="panel-heading">Create New College</header>
		<div class="panel-body">
			<div class="validation-message"></div>
			<form class="form-horizontal tasi-form" id='create-college-form'>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">College Abbreviation</label>
					<div class="col-sm-10">
						<input type="text" name='abrr' placeholder='Enter College Abbreviation' class="form-control" required>
					</div>
				</div>
				<div class="form-group">
						<label class="col-sm-2 col-sm-2 control-label">College Name</label>
						<div class="col-sm-10">
							<input type="text" name='name' placeholder='Enter College Name' class="form-control" required>
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

			$('#create-college-form').submit(function(e){

				e.preventDefault();

				var abrr = $('input[name=abrr]').val();
				var name = $('input[name=name]').val();

				$.ajax({
					url: App.api + '/api/admin/save/college',
					type: 'POST',
					data: {
						abrr: abrr,
						name: ucwords(name)
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
