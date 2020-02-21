<?php
if(isset($_POST['loginButton'])) {
	//Login button was pressed
	$username = $_POST['loginUsername'];
	$password = $_POST['loginPassword'];
	$result;
	$query = mysqli_query($con, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
	if(mysqli_num_rows($query) == 1){
		 $result = true;
	}
	else{
		echo "You do not have access";
		 $result = false;
	}

	if($result == true){
		$_SESSION['userLoggedIn'] = $username;
		header("Location: adminAccount.php");
		
	}
}



?>