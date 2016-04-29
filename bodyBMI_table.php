<?php

if( isset($_POST['page']) ) {
	// result that is going to return by this post call
	$outcome = "";

	include_once ('../../db-info/bmi/db_connect.php');

	// Pagination referrence - https://www.developphp.com/video/PHP/Pagination-MySQLi-Google-Style-Paged-Results-Tutorial
	$sql_count = 'SELECT COUNT(*) FROM bmi';
	$query = mysqli_query( $link, $sql_count );
	$data = mysqli_fetch_row( $query );
	$total_rows = $data[0];
	$page_rows = 10;
	$last_page = ceil( $total_rows / $page_rows );
	if($last < 1) {
		$last = 1;
	}

	// get the page number
	$page_num = preg_replace('#[^0-9]#', '', $_POST['page']);
	if($page_num < 1) {
		$page_num = 1;
	} else if($page_num > $last_page) {
		$page_num = $last_page;
	}

	$sql = 'SELECT * FROM bmi ORDER by ID DESC LIMIT ' . ($page_num - 1) * $page_rows . ', ' . $page_rows;

	$result = mysqli_query( $link, $sql );

	if( !$result ) {
		$message  = 'Invalid query: ' . mysqli_error($link) . "<br>";
		$message .= 'Whole query: ' . $sql;
		die($message);
	}

	mysqli_close( $link );

	$outcome .= paginationControl($last_page);
	$outcome .= buildTable( $result );
	$outcome .= addScript();
	echo $outcome;
}

function buildTable( $result ) {
	$table = "";

	$table .= "<table  class=\"table table-bordered table-hover\" id=\"bmiTable\">
		<tr>
			<th>Check</th>
			<th>ID</th>
			<th>Name</th>
			<th>Weight (kg)</th>
			<th>Height (m)</th>
			<th>BMI</th>
			<th>Result</th>
		</tr>";

	while($row = mysqli_fetch_array($result)) {
		if($row['result'] === "over weight") {
			$table .= "<tr class=\"warning\">";
		} else if ($row['result'] === "under weight") {
			$table .= "<tr class=\"success\">";
		} else if ($row['result'] === "obesity") {
			$table .= "<tr class=\"danger\">";
		} else {
			$table .= "<tr>";
		}
		$table .= "<td><input type=\"checkbox\" name=\"deleteThese\" value=\"" . $row['id'] . "\" /></td>";
		$table .= "<td>" . $row['id'] . "</td>";
		$table .= "<td>" . $row['name'] . "</td>";
		$table .= "<td>" . $row['weight'] . "</td>";
		$table .= "<td>" . $row['height'] . "</td>";
		$table .= "<td>" . $row['bmi'] . "</td>";
		$table .= "<td>" . $row['result'] . "</td>";
		$table .= "</tr>";
	}
	$table .= "</table>";
	$table .= "<button class=\"btn btn-info\" id=\"btnDelete\">Delete</button>";

	mysql_free_result( $row );
	return $table;
}

function paginationControl( $last_page ) {
	$control = "";
	$control .= "<ul class=\"pagination\">";
	for($i = 1; $i <= $last_page; $i++) {
		$control .= "<li value=\"$i\"><a href=\"#\">$i</a></li>";
	}
	$control .= "</ul>";
	return $control;
}

function addScript() {
	return "<script>hookEvent();</script>";
}

?>