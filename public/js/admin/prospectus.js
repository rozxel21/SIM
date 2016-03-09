$('#fyfs-subject').typeahead({
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
          	var catalog = $('input[name=fyfs-subject]').val();
          	$.getJSON(App.api + "/api/get/subject/data/" + base32.encode(catalog), function(data){
          		$('#fyfs-descriptive').text(data.descriptive_title);
          		$('#fyfs-units').text(data.total_units);
          		$('#fyfs-saveBtn').removeAttr('disabled');
          	});
        },
    }
});

$('#fyfs-subject').blur(function(){
	var catalog = $('input[name=fyfs-subject]').val();
  	$.ajax({
  		url: App.api + '/api/get/subject/data/' + base32.encode(catalog),
  		type: 'GET',
  		dataType: 'JSON',
  		success: function(data){
  			$('#fyfs-descriptive').text(data.descriptive_title);
          	$('#fyfs-units').text(data.total_units);
          	$('#fyfs-saveBtn').removeAttr('disabled');
  		},
  		error: function(){
  			$('#fyfs-descriptive').text('-------');
          	$('#fyfs-units').text('0');
          	$('#fyfs-saveBtn').attr('disabled','disabled');
  		}
  	});
});

$('#fyfs-saveBtn').click(function(e){
	e.preventDefault();
	var catalog = $('input[name=fyfs-subject]').val();
	var semester = 'first';
	var year = 'first';
	var type = 'NONE';
	var ref = '';
	$.ajax({
		url: App.api + '/api/admin/save/prospectus',
		type: 'POST',
		data: {
			curriculum: curriculum,
			catalog_no: catalog,
			year: year,
			semester: semester,
			type: type,
			ref: ref
		},
		success: function(data){
			var markup = "";

			markup = "<tr> <td> " + data.get_catalog.catalog_no + "</td>";
			markup += "<td>" + data.get_catalog.descriptive_title + "</td>";
			markup += "<td>" + data.get_catalog.total_units + "</td>";
			markup += "<td>" + data.type + "</td>";
			markup += "<td> <button class='btn btn-default btn-xs'><i class='fa fa-times'></i></button> </td> </tr>";

			$('.fyfs tbody').append(markup);

			$('#fyfs-descriptive').text('-------');
          	$('#fyfs-units').text('0');
          	$('#fyfs-saveBtn').attr('disabled','disabled');
          	$('input[name=fyfs-subject]').val('');
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

				$('.validation-fyfs').html(markup);
			}
	});
});

// first year second sem
$('#fyss-subject').typeahead({
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
          	var catalog = $('input[name=fyss-subject]').val();
          	$.getJSON(App.api + "/api/get/subject/data/" + base32.encode(catalog), function(data){
          		$('#fyss-descriptive').text(data.descriptive_title);
          		$('#fyss-units').text(data.total_units);
          		$('#fyss-saveBtn').removeAttr('disabled');
          	});
        },
    }
});

$('#fyss-subject').blur(function(){
	var catalog = $('input[name=fyss-subject]').val();
  	$.ajax({
  		url: App.api + '/api/get/subject/data/' + base32.encode(catalog),
  		type: 'GET',
  		dataType: 'JSON',
  		success: function(data){
  			$('#fyss-descriptive').text(data.descriptive_title);
          	$('#fyss-units').text(data.total_units);
          	$('#fyss-saveBtn').removeAttr('disabled');
  		},
  		error: function(){
  			$('#fyss-descriptive').text('-------');
          	$('#fyss-units').text('0');
          	$('#fyss-saveBtn').attr('disabled','disabled');
  		}
  	});
});

$('#fyss-saveBtn').click(function(e){
	e.preventDefault();
	var catalog = $('input[name=fyss-subject]').val();
	var semester = 'second';
	var year = 'first';
	var type = 'prereq';
	var ref = '';
	$.ajax({
		url: App.api + '/api/admin/save/prospectus',
		type: 'POST',
		data: {
			curriculum: "{{ $curriculum->curriculum_guid }}",
			catalog_no: catalog,
			year: year,
			semester: semester,
			type: type,
			ref: ref
		},
		success: function(data){
			var markup = "";

			markup = "<tr> <td> " + data.get_catalog.catalog_no + "</td>";
			markup += "<td>" + data.get_catalog.descriptive_title + "</td>";
			markup += "<td>" + data.get_catalog.total_units + "</td>";
			markup += "<td>" + data.type + "</td>";
			markup += "<td> <button class='btn btn-default btn-xs'><i class='fa fa-times'></i></button> </td> </tr>";

			$('.fyss tbody').append(markup);

			$('#fyss-descriptive').text('-------');
          	$('#fyss-units').text('0');
          	$('#fyss-saveBtn').attr('disabled','disabled');
          	$('input[name=fyss-subject]').val('');
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

				$('.validation-fyss').html(markup);
			}
	});
});

localStorage.clear();
localStorage.setItem('fyssPrereqIndicator', 1);

$('#fyss-prereq').click(function(){
	var i = parseInt(localStorage.getItem('fyssPrereqIndicator'));
	$.getJSON(App.api + '/api/get/subjects/' + base32.encode(curriculum), function(data){
		var listMarkup = "";
		listMarkup += "<tr> <td colspan='4'> <select name='fyss-prereq-subject-"+i+"' class='form-control'>";
		listMarkup += "<option value=''> Select a Catalog Number </option>";

		if(data.length != null){
            $.each(data, function(i, list){
                listMarkup += "<option value='" + list.catalog_no + "'>";
                listMarkup += list.catalog_no;
                listMarkup += "</option>";
           });     
		}
		listMarkup += '</select> </td> </tr>';
		$('.fyss tbody tr:nth-child('+ i +')').after(listMarkup);
		i++;
		localStorage.setItem('fyssPrereqIndicator', i);
	});	
});