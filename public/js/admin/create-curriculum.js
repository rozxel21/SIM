var majorIndicator = false;

$('select[name=course]').change(function(){
	var course = $('select[name=course]').val();
	if(course != ''){
		$.getJSON(App.api + '/admin/api/get/majors/' + course, function(data){
			if(data.length != 0){
				var markup = "<div class='form-group'>";
				markup += "<label class='col-sm-2 col-sm-2 control-label'>Major</label>";
				markup += "<div class='col-sm-10'>";
				markup += "<select name='major' class='form-control' >";
				$.each(data, function(i, list){
					markup += "<option value='" + list.major_guid + "''>" + list.name + "</option>"
				});
				markup += "</select></div></div>";

				majorIndicator = true;
				$('#major').html(markup);
			}else{
				$('#major').html('');
			}
		});
	}else{
		$('#major').html('');
		majorIndicator = false;
	}
});

$('select[name=effective-1]').val(App.year);
$('select[name=effective-2]').val(App.year);

$('#create-curriculum-form').submit(function(e){

	e.preventDefault();

	var course = $('select[name=course]').val();
	if(majorIndicator == true){
		var major = $('select[name=major]').val();
	}else{
		var major = null;
	}

	var effective1 = $('select[name=effective-1]').val();
	var effective2 = $('select[name=effective-2]').val();

	if(effective1 == effective2){
		var effective = effective1;
	}else{
		var effective = effective1 + " - " + effective2;
	}

	var year_taken = $('select[name=year]').val();
	var bor = $('input[name=bor_res').val();

	$.ajax({
		url: App.api + '/api/admin/save/curriculum',
		type: 'POST',
		data: {
			course: course,
			major: major,
			effective: effective,
			years_taken: year_taken,
			bor: bor
		},
		success: function(data){
			window.location.href = App.api + '/admin/curriculum/first/' + data;
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