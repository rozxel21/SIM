@extends('admin')

@section('content')
	<section class="panel">
      	<header class="panel-heading">Create New Student</header>
      	<div class="panel-body">
      		  <div class="validation-message"></div>
          	<form class="form-horizontal tasi-form" id='create-student-form'>
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">ID Number</label>
                  <div class="col-sm-10">
                    <input type="text" name='idno' placeholder='Enter Student ID Number: XXXX-XXXX' class="form-control" required>
                  </div>
              </div>
            	<div class="form-group">
                	<label class="col-sm-2 col-sm-2 control-label">First Name</label>
                  <div class="col-sm-10">
                    <input type="text" name='firstname' placeholder='Enter Student First Name' class="form-control" required>
                  </div>
              </div>
	            <div class="form-group">
	                <label class="col-sm-2 col-sm-2 control-label">Middle Name</label>
	                <div class="col-sm-10">
	                    <input type="text" name='middlename' placeholder='Enter Student Middle Name' class="form-control">
	                </div>
	            </div>
             	<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" name='lastname' placeholder='Enter Student Last Name' class="form-control" required>
                </div>
            	</div>
            	<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">College</label>
                <div class="col-sm-10">
                    <select name="college" class="form-control" required>
                        @foreach ($colleges as $college) 
                            <option value="{{ $college->college_code }}" > {{ $college->college_name }} </option>
                        @endforeach
                    </select>
                </div>
            	</div>
            	<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Course</label>
                <div class="col-sm-10">
                    <input type="email" name='course' placeholder='Enter Student Course' class="form-control" required>
                </div>
            	</div>
         		  <div class="form-group">
              	<label class="col-sm-2 col-sm-2 control-label">Section</label>
                	<div class="col-sm-10">
                  	<input type="text" name='section' placeholder='Enter Student Section' class="form-control" placeholder="" required>
              	</div>
            	</div>
            	<div class="form-group text-center">
            		<a href='/admin' class="btn btn-md btn-danger">Cancel</a>
              	<button type='submit' class="btn btn-md btn-primary">Save</button>
            	</div>  
          	</form>

            <h3 class='text-center'><i>or</i></h3>

            <form class="form-horizontal tasi-form" id='import-student-form' enctype="multipart/form-data">
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">CSV or Exel File</label>
                  <div class="col-sm-10">
                    <input type="file" id='file' name='file' class="form-control" ng-pattern='([^\s]+(\.(?i)(csv))$)' required />
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                     <button type='submit' class="btn btn-md btn-primary">Upload</button>
                  </div>
              </div>
            </form>
      	</div>
    </section>
@stop

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#import-student-form').submit(function(e){
                e.preventDefault();

                var file = $('input[type=file]').val();
                if (!file.match(/\.(?:csv)$/)) {
                    var markup = "<div class='alert alert-danger'>";
                        markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
                        markup += "<i class='fa fa-times'></i></button>";
                        markup += "CSV File Only</div>";
                    $('.validation-message').html(markup);  
                }else{
                    var fd = new FormData(this);

                    $.ajax({
                        url: App.api + '/api/admin/save/student',
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        data: fd,
                        success: function(data){
                            $('#progress').html('');
                            markup = "<div class='alert alert-success'><button data-dismiss='alert' class='close close-sm' type='button'>";
                            markup += "<i class='fa fa-times'></i></button>";
                            markup += "Success Uploaded</div>";
                            $('.validation-message').html(markup);

                            if(data != null){
                                markup += "<div class='alert alert-warning'><button data-dismiss='alert' class='close close-sm' type='button'>";
                                markup += "<i class='fa fa-times'></i></button><ul>";
                                $.each(data, function(i, list){
                                    markup += '<li>' + list + '</li>';
                                });
                                markup += "</ul></div>";
                                $('.validation-message').html(markup);
                            }
                        },
                    });
                }   
            });
        });
    </script>
@stop 