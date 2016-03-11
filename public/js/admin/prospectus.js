$('#year').text(ucwords(year) + ' Year');

$('#subject').typeahead({
    order: "asc",
    hint: true,
    source: {
       sample: {
            url: [App.api + "/api/search/subjects"]
        },
    },
    callback: {
        onClickAfter: function (node, a, item, event) {
            event.preventDefault();
          	var catalog = $('input[name=subject]').val();
          	$.getJSON(App.api + "/api/get/subject/data/" + base32.encode(catalog), function(data){
          		$('#descriptive').text(data.descriptive_title);
          		$('#units').text(data.total_units);
          		$('#saveBtn').removeAttr('disabled');
          	});
        },
    }
});

$('#subject').blur(function(){
	var catalog = $('input[name=subject]').val();
  	$.ajax({
  		url: App.api + '/api/get/subject/data/' + base32.encode(catalog),
  		type: 'GET',
  		dataType: 'JSON',
  		success: function(data){
  			$('#descriptive').text(data.descriptive_title);
          	$('#units').text(data.total_units);
          	$('#saveBtn').removeAttr('disabled');
  		},
  		error: function(){
  			$('#descriptive').text('-------');
          	$('#units').text('0');
          	$('#saveBtn').attr('disabled','disabled');
  		}
  	});
});

$('#saveBtn').click(function(e){
	e.preventDefault();
	var catalog = $('input[name=subject]').val();
	var semester = $('select[name=semester]').val();
	var year = year;
	var type = 'NONE';
	console.log(year);
	$.ajax({
		url: App.api + '/api/admin/save/prospectus',
		type: 'POST',
		data: {
			curriculum: curriculum,
			catalog_no: catalog,
			year: year,
			semester: semester,
			type: type,
		},
		success: function(data){
			var markup = "";
			var semester_id = "";
			var indicator = "";

			if( semester == 'first' ){
				semester_id = 'first';
				indicator = first;
			}else if( semester == 'second' ){
				semester_id = 'second';
				indicator = second;
			}else if( semester == 'summer' ){
				semester_id = 'summer';
				indicator = summer;
			}

			if(indicator == 0 ){
				markup += "<section class='panel'>";
				markup += "<header class='panel-heading'>First Semester</header>";
				markup += "<div class='panel-body'>";
				markup += "<table class='table "+ semester +"'>";
				markup += "<thead><tbody><tr>";
				markup += "<th>Catalog No.</th>";
				markup += "<th>Descriptive Title</th>";
				markup += "<th class='text-center'>Total Units</th>";
				markup += "<th>Prerequisite(s)</th>";
				markup += "<th>Action</th>";
				markup += "</tr></thead><tbody>";		
			}

			markup += "<tr id=' "+ data.prospectus_guid +" '>";
			markup += "<td> " + data.get_catalog.catalog_no + "</td>";
			markup += "<td>" + data.get_catalog.descriptive_title + "</td>";
			markup += "<td class='text-center'>" + data.get_catalog.total_units + "</td>";
			
			if(year == 'first'){
				markup += "<td>" + data.type + "</td>";
			}else{
				markup += "<td><button class='btn btn-xs' data-toggle='modal' data-target='#myModal'>Add Prereq</button> </td>";
			}
	
			markup += "<td> <button id='delete' data-prospectus='" + data.id + "' data class='btn btn-default btn-xs'><i class='fa fa-times'></i></button> </td>";
			markup += "</tr>";

			if(indicator == 0){
				markup += "</tbody></table></div></section>";
				$("#" + semester + "-sem").html(markup);
			}else{
				$("." + semester + " tbody").append(markup);
			}


			if( semester == 'first' ){
				first++;
			}else if( semester == 'second' ){
				second++;
			}else if( semester == 'summer' ){
				summer++;
			}
			
			$('descriptive').text('-------');
          	$('units').text('0');
          	$('saveBtn').attr('disabled','disabled');
          	$('input[name=subject]').val('');

          	markup = "<div class='alert alert-success'>";
			markup += "<button data-dismiss='alert' class='close close-sm' type='button'>";
			markup += "<i class='fa fa-times'></i></button>";
			markup += "<strong>Well done!</strong> You successfully Added a new subject for this curriculum."
			markup += '</div>';
			$('.validation-msg').html(markup);

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

				$('.validation-msg').html(markup);
			}
	});
});
