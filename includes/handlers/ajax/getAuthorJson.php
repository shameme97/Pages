<?php
include("../../connection.php");

if(isset($_POST['authorId'])) {
	$authorId = $_POST['authorId'];

	$query = mysqli_query($con, "SELECT * FROM author WHERE author_id='$authorId'");

	$resultArray = mysqli_fetch_array($query);

	echo json_encode($resultArray);
}
?>