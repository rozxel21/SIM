@extends('admin')

@section('content')
	<section class="panel">
      	<header class="panel-heading">Update Subject</header>
      	<div class="panel-body">
      		<div class="validation-message"></div>
          	<form class="form-horizontal tasi-form" id='update-subject-form'>
            	<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Catalog Number</label>
					<div class="col-sm-10">
						<input type="text" name='catalog_no' value="{{ $subject->catalog_no }}" placeholder='Enter Subject' class="form-control" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 col-sm-2 control-label">Descriptive Title</label>
					<div class="col-sm-10">
						<textarea name='descriptive_title' class="form-control" >{{ $subject->descriptive_title }}</textarea>
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
						<input type="number" name='total_units' value="{{ $subject->total_units }}" class="form-control" disabled="true" />
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

			setTimeout(function(){
				$('select[name=lec_units]').val('{{ $subject->lec_units }}');
				$('select[name=lab_units]').val('{{ $subject->lab_units }}');
                $("select[name=status]").val('{{ $subject->status }}');
            }, 500);

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

			$('#update-subject-form').submit(function(e){
				e.preventDefault();
				$('.validation-message').html('');

				var catalogNo = $('input[name=catalog_no]').val();
				var descriptive = $('textarea[name=descriptive_title]').val();
				var lec = $('select[name=lec_units]').val();
				var lab = $('select[name=lab_units]').val();
				var total =  $('input[name=total_units]').val();
				var status = $("select[name=status]").val();
				
				$.ajax({
					type: 'POST',
					url: App.api + '/api/admin/update/subject',
					data: {
						id: {{ $subject->id }},
						catalog_no: catalogNo,
						descriptive_title: descriptive,
						lec_units: lec,
						lab_units: lab,
						total_units: total,
						status: status
					},
					success: function(){
						var markup = "<div class='alert alert-success'>";
						markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
						markup += "<i class='fa fa-times'></i></button>";
						markup += "<strong>Well done!</strong> You successfully updated the college.";
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