@extends('admin')

@section('content')
	<section class="panel">
		<header class="panel-heading">Create New Subject</header>
		<div class="panel-body">
			<div class="validation-message"></div>
			<form class="form-horizontal tasi-form" id='create-subject-form'>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Catalog Number</label>
					<div class="col-sm-10">
						<input type="text" name='catalog_no' placeholder='Enter Subject' class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Descriptive Title</label>
					<div class="col-sm-10">
						<textarea name='descriptive_title' class="form-control" ></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Lecture Units</label>
					<div class="col-sm-10">
						<select class="form-control" name='lec_units'>
							@for ($i = 0; $i < 11; $i++)
								<option value='{{ $i }}'> {{ $i }} </option>
							@endfor
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Laboratory Units</label>
					<div class="col-sm-10">
						<select class="form-control" name='lab_units'>
							@for ($i = 0; $i < 11; $i++)
								<option value='{{ $i }}'> {{ $i }} </option>
							@endfor
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Total Units</label>
					<div class="col-sm-10">
						<input type="number" name='total_units' value="0" class="form-control" disabled="true" />
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
		$(document).ready(function() {

			$('select[name=lec_units]').change(function(){
				var lec = $('select[name=lec_units]').val();
				var lab = $('select[name=lab_units]').val();
				var total = parseInt(lec) + parseInt(lab);
				$('input[name=total_units]').val(total);
			});

			$('select[name=lab_units]').change(function(){
				var lec = $('select[name=lec_units]').val();
				var lab = $('select[name=lab_units]').val();
				var total = parseInt(lec) + parseInt(lab);
				$('input[name=total_units]').val(total);
			});

			$('#create-subject-form').submit(function(e){
				e.preventDefault();

				var catalogNo = $('input[name=catalog_no]').val();
				var descriptive = $('textarea[name=descriptive_title]').val();
				var lec = $('select[name=lec_units]').val();
				var lab = $('select[name=lab_units]').val();
				var total = $('input[name=total_units]').val();

				$.ajax({
					url: App.api + '/api/admin/save/subject',
					type: 'POST',
					data: {
						catalog_no: catalogNo,
						descriptive_title: descriptive,
						lec_units: lec,
						lab_units: lab,
						total_units: total
					},
					success: function(){
						var markup = "<div class='alert alert-success'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
						markup += "<i class='fa fa-times'></i></button>";
						markup += "<strong>Well done!</strong> You successfully create a new subject."
						markup += '</div>';
						$('.validation-message').html(markup);

						$('input[name=catalog_no]').val('');
						$('textarea[name=descriptive_title]').val('');
						$('select[name=lec_units]').val('0');
						$('select[name=lab_units]').val('0');
						$('input[name=total_units]').val('0');
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