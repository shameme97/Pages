<?php
include("../../connection.php");

if(isset($_POST['audiobookID'])) {
	$audiobookID = $_POST['audiobookID'];

	$query = mysqli_query($con, "SELECT * FROM audiobook WHERE audiobookID='$audiobookID'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);
}


?>