<?php
include("../../connection.php");

if(isset($_POST['albumId'])) {
	$albumId = $_POST['albumId'];

	$query = mysqli_query($con, "SELECT * FROM album WHERE albumid='$albumId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);
}
?>