<?php
	include("includes/connection.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constant.php");

	$account = new Account($con);
 
	include("includes/handlers/admin-login-handler.php");
	function getInputValue($name){
		if(isset($_POST[$name])){
			echo $_POST[$name];
		} 
	}
?>

<html>
<head>
	<title>Welcome to Pages!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	

</head>
<body>
	<?php 
	if(isset($_POST['registerButton'])){
		echo '<script>
		$(document).ready(function(){
			$("#loginForm").hide();
			$("#registerForm").show();
		});
		</script>';
	}
	else{
		echo'<script>
		$(document).ready(function(){
			$("#loginForm").show();
			$("#registerForm").hide();
		});
		</script>';
	}
	?>
	<div id= "background">
		<div id = "loginContainer">
			<div id="inputContainer">
				<form id="loginForm" action="adminlogin.php" method="POST">
					<h2>Login to your admin account</h2>   
					<p>

						<?php echo $account->showError(Constant::$loginFailed); ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" name="loginUsername" type="text" value="<?php getInputValue('loginUsername') ?>" required>
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" type="password"  required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>
				</form>
			</div>
		</div>
	</div>
</body>
