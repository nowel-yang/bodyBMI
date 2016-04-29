<?php
	
if( isset($_POST['name']) && isset($_POST['height']) && isset($_POST['weight']) ) {
	$name = $_POST['name'];
	$weight = $_POST['weight'];
	$height = $_POST['height'];

	// Need to come back to verify name field
	// if ( !preg_match("^[A-Za-z\s]{0,35}",$name) ) {
	// 	echo "Incorrect input of name field $name";
	// } else

	if( !is_numeric($weight) || $weight == "" || $weight < 0 || $weight > 999.99 ) {
		echo "Incorrect input of weight field";
	} else if( !is_numeric($height) || $height == "" || $height < 0 || $height > 3.5) {
		echo "Incorrect input of height field";
	} else {
		$bmi = $weight / pow($height, 2);
		$bmi = number_format($bmi, 2, '.', '');
		$result = "";

		if( $bmi <= 18.5 ) {
			$result = "under weight";
		} else if ($bmi >= 30) {
			$result = "obesity";
		} else if($bmi >= 25 && $bmi <= 29.9) {
			$result = "over weight";
		} else {
			$result = "normal weight";
		}

		$sql = "INSERT INTO `bmi`(`name`, `weight`, `height`, `bmi`, `result`)";
		$sql .= "VALUES (\"$name\", $weight, $height, $bmi, \"$result\")";

		send_to_DB($sql);
	}	
}

if( isset($_POST['delete']) ) {

	include_once ('../../db-info/bmi/db_connect.php');
	//DELETE FROM `cyang21_bmi`.`bmi` WHERE `bmi`.`id` = 30;

	$sql = "DELETE FROM `bmi` WHERE `bmi`.`id` = " . $_POST['delete'];

	send_to_DB($sql);
}

function send_to_DB($sql) {
	include_once ('../../db-info/bmi/db_connect.php');

	$result = mysqli_query( $link, $sql );

	if (!$result) {
		$message  = 'Invalid query: ' . mysqli_error($link) . "<br>";
		$message .= 'Whole query: ' . $sql;
		die($message);
	}

	mysqli_free_result($result);
	mysqli_close($link);
}
?>