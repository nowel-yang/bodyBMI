<?php

require_once ('../../db-info/bmi/db_info.php');

$link = mysqli_connect( $host, $user, $password, $dbname );
if (!$link) {
	die( 'Could not connect: ' . mysqli_connect_error() );
}

// mysqli_select_db( $link, $dbname );

$sql = "SELECT * FROM bmi";

$result = mysqli_query( $link, $sql );

if (!$result) {
	$message  = 'Invalid query: ' . mysqli_error($link) . "<br>";
	$message .= 'Whole query: ' . $query;
	die($message);
}

echo "<table  class=\"table table-bordered table-hover\" id=\"bmiTable\">
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
		echo "<tr class=\"warning\">";
	} else if ($row['result'] === "under weight") {
		echo "<tr class=\"success\">";
	} else if ($row['result'] === "obesity") {
		echo "<tr class=\"danger\">";
	} else {
		echo "<tr>";
	}
	echo "<td><input type=\"checkbox\" name=\"deleteThese\" value=\"" . $row['id'] . "\" /></td>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td>" . $row['name'] . "</td>";
	echo "<td>" . $row['weight'] . "</td>";
	echo "<td>" . $row['height'] . "</td>";
	echo "<td>" . $row['bmi'] . "</td>";
	echo "<td>" . $row['result'] . "</td>";
	echo "</tr>";
}
echo "</table>";
echo "<button class=\"btn btn-info\" id=\"btnDelete\">Delete</button>";
mysql_free_result($row);
mysqli_close($con);
?>