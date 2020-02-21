<?php
	include("includes/connection.php");
	include("includes/classes/Account.php");
	include("includes/classes/Constant.php");
	$account = new Account($con);
 
	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");
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

	<script src= "assets/js/register.js"></script>
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
				<form id="loginForm" action="register.php" method="POST">
					<h2>Login to your account</h2>   
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
					<div class="hasAccountText">
							<span id= "hideLogin">Don't have an account yet? Signup here.</span>
					</div>	
				</form>

				<div id="adminSignup">
					<div class="navItem">
						<a href="adminlogin.php" class="navItemLink">Sign in as admin</a>
					</div>
				</div>

				<form id="registerForm" action="register.php" method="POST">
					<h2>Create your free account</h2>
					<p>
						<?php echo $account->showError( Constant::$usernameCharacters); ?>
						<?php echo $account->showError( Constant::$usernameTaken); ?>
						<label for="username">Username</label>
						<input id="username" name="username" type="text" required>
					</p>

					<p>
						<?php echo $account->showError( Constant::$firstNameCharacters); ?>
						<label for="firstName">First name</label>
						<input id="firstName" name="firstName" type="text" required>
					</p>

					<p>
						<?php echo $account->showError( Constant::$lastNameCharacters); ?>
						<label for="lastName">Last name</label>
						<input id="lastName" name="lastName" type="text"  required>
					</p>

					<p>
						<?php echo $account->showError(Constant::$emailsDoNotMatch); ?>
						<?php echo $account->showError(Constant::$emailInvalid); ?>
						<?php echo $account->showError(Constant::$emailTaken); ?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email"  required>
					</p>

					<p>
						<label for="email2">Confirm email</label>
						<input id="email2" name="email2" type="email"  required>
					</p>
					<p>	<label for="gender">Gender</label>
						<input type="radio" name="gender" value="male" checked> Male
		 				<input type="radio" name="gender" value="female"> Female
		  				<input type="radio" name="gender" value="other"> Other
					</p>
					<p>
						<label for="dob">Birthday</label>
		  				<input id="dob" name="dob" type="date">
					</p>
					<p>
							<?php echo $account->showError( Constant::$passwordsDoNotMatch); ?>
						<?php echo $account->showError(Constant::$passwordCharacters);?>
							<?php echo $account->showError( Constant::$passwordNotAlphanumeric); ?>
						<label for="password">Password</label>
						<input id="password" name="password" type="password"  required>
					</p>

					<p>

						<label for="password2">Confirm password</label>
						<input id="password2" name="password2" type="password"  required>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>
					<div class="hasAccountText">
							<span id= "hideRegister">Already have an account? Log in here.</span>
					</div>	
				</form>


			</div>

		<div id= "loginText">
			<h1>Pages</h1>
			<h2>We speak for the books </h2>
			<ul>
				<li>Listen to new audiobooks everyday</li> 
				 <li>Create playlists of your favorite audiobooks</li>
				 <li>Enjoy books of your favorite genres</li>
			</ul>
		</div>

		</div>
	</div>

	<style>
					#adminSignup {
					 	 font-weight: bold;
					    font-size: 12px;
					    cursor: pointer;
					}
					#adminSignup{
						text-align: center;
					}
</body>
</html>