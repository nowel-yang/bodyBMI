$(function() {

	$( '#btnAdd' ).click(function() {
		var name = $("#name").val();
		var weight = $("#weight").val();
		var height = $("#height").val();

		// Validation Check
		if(!validateName(name)) {
			alert("Are you sure you enter the correct name?");
		}
		else if(!validateWeight(weight)) {
			alert("Invalid weight");
		}
		else if(!validateHeight(height)) {
			alert("Please enter height in meter");
		} else {
			insertRequest(name, weight, height);
			requestTable(1);
		}
	});

});

// Validation Check
var validateName = function(name) {
	var regex = /^[A-Za-z\s]{2,35}/;
	return regex.test(name);
}

var validateWeight = function(number) {
	if(number == "" || number < 0 || number > 999.99) {
		return false;
	}
	return true;
}

var validateHeight = function(number) {
	if(number == "" || number < 0 || number > 3.5) {
		return false;
	}
	return true;
}

// Send input data to the server
var insertRequest = function(name, weight, height) {
	$.post( "bodyBMI_operate.php", { "name": name, "weight": weight, "height": height },
		function( data ) {
			console.log( data );
	});
}

function requestTable(page_num) {
	// Build XMLHttpRequest Object
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}

	xmlhttp.open("POST", "bodyBMI_table.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			$("#showTable").html(xmlhttp.responseText);
		}
	};
	// Send requests to PHP
	xmlhttp.send('page='+page_num);
}

// After bodyBMI_table.php is loaded, hook the event
function hookEvent() {
	$( '#btnDelete' ).click(function() {
		alert("still working on delete...");
	});

	$( '.pagination li' ).click(function(){
    	var page_num = $(this).text();
    	requestTable(page_num);
	})
}