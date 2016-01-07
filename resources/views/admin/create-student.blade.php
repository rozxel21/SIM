@extends('admin')

@section('content')
	<section class="panel">
      	<header class="panel-heading">Create New Student</header>
      	<div class="panel-body">
      		  <div class="validation-message"></div>
          	<!-- <form class="form-horizontal tasi-form" id='create-student-form'>
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
                <label class="col-sm-2 col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" name='address' placeholder='Enter Student Address' class="form-control" required>
                </div>
              </div>
            	<div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">College</label>
                <div class="col-sm-10">
                    <input type="text" name='college' placeholder='Enter Student College' class="form-control" required>
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
          	</form> -->

            <h3 class='text-center'><i>or</i></h3>

            <form class="form-horizontal tasi-form" id='import-student-form' enctype="multipart/form-data">
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">CSV or Exel File</label>
                  <div class="col-sm-10">
                    <input type="file" id='file' name='file' class="form-control" />
                  </div>
              </div>
              <button type='submit' class="btn btn-md btn-primary">Save</button>
            </form>
      	</div>

        <p id='progress'></p>
    </section>
@stop

@section('script')
  <script type="text/javascript">
  $(document).ready(function () {
    var App = {
        name: 'SIM',
        api: 'http://localhost:721'
      }

    $('#import-student-form').submit(function(e){
      e.preventDefault();

      var fd = new FormData(this);

      $.ajax({
        url: App.api + '/test',
        xhr: function() { // custom xhr (is the best)

            var xhr = new XMLHttpRequest();
            var total = 0;

            // Get the total size of files
            $.each(document.getElementById('file').files, function(i, file) {
              total += file.size;
            });

            // Called when upload progress changes. xhr2
            xhr.upload.addEventListener("progress", function(evt) {
              // show progress like example
              var loaded = (evt.loaded / total).toFixed(2)*100; // percent

              $('#progress').text('Uploading... ' + loaded + '%' );
            }, false);

            return xhr;
          },
        processData: false,
        contentType: false,
        type: 'POST',
        data: fd,
        success: function(){
          $('#progress').html('');
          console.log('k');
        },
        error: function(e){
          console.log(e);
          var markup = "<div class='alert alert-danger'>";
          markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
                      markup += "<i class='fa fa-times'></i></button>";
                      markup += e.responseText + "</div>";
          $('.validation-message').html(markup);    
        }
      });

    });

  });
  </script>
@stop