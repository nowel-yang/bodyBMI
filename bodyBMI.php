<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Your BMI</title>
	<link rel="stylesheet" type="text/css" href="css/bodyBMI.css">
	<!-- JQuery -->
	<script   
		src="https://code.jquery.com/jquery-1.12.2.min.js"   
		integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk="   
		crossorigin="anonymous"></script>
	
	<!-- For Bootstrap -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js/bodyBMI.js"></script> 
</head>

<body>
<div class="container">
	<h1>BMI Records</h1>

	<div class="panel-group" id="accordion">
	<div class="panel panel-info">
	<div class="panel-heading">
		<h4 class="panel-title">
		<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Instruction</a>
		</h4>
	</div>
	<div id="collapse1" class="panel-collapse collapse in">
		<div class="panel-body">
		<ul>
			<li>This table records every visitors BMI. If you don't wish your BMI to be exposed, please do not use this table</li>
			<li>Name field must be entered, and the length must be between 2 - 35 characters</li>
			<li>Weight field is in KG.</li>
			<li>Height field is in Meter.</li>
			<li>If your BMI is under 18.5, you are under weight, and your record will be highlighted in <span class="alert-success">green</span>.</li>
			<li>If your BMI is between 25-29.9, you are over weight, and your record will be highlighted in <span class="alert-warning">yellow</span>.</li>
			<li>If your BMI is over, you are obesity, and your record will be highlighted in <span class="alert-danger">red</span>.</li>
		</ul>
		</div>
	</div>
	</div>
	</div>

	<div class="row">
		<div class="form-group col-sm-4">
			<label for="name" class=".col-sm-3">Name:</label>
			<input type="text" class="form-control" id="name">
		</div>
		<div class="form-group col-sm-4">
			<label for="name">Weight(kg):</label>
			<input type="number" class="form-control" id="weight" step="0.01" min="0">
		</div>
		<div class="form-group col-sm-4">
			<label for="name">Height(m):</label>
			<input type="number" class="form-control" id="height" step="0.01" min="0">
		</div>
	</div>
	<button class="btn btn-info" id="btnAdd">Add me</button>

	<div id="showTable"></div>

	<script>
		// first time request the table
		var page_num = 1;
		requestTable(page_num);
	</script>
</div>
 
</body>
</html>