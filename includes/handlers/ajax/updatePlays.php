<?php
include("../../connection.php");

if(isset($_POST['audiobookID'])) {
	$audiobookID = $_POST['audiobookID'];

	$query = mysqli_query($con, "UPDATE audiobook SET plays = plays + 1 WHERE audiobookID='$audiobookID'");
}
?>