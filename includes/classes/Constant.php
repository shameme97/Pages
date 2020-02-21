<?php
class Constant {


	//register error messages
	public static $passwordsDoNotMatch="Your passwords do not match. Please check again.";
	public static $passwordNotAlphanumeric = "Your password can only contain numbers and letters";
	public static $passwordCharacters = "Your Password must be between 5 to 30 characters";
	public static $emailInvalid = "Your Email is invalid. Please check again";
	public static $emailsDoNotMatch = "Your Emails do not match";
	public static $lastNameCharacters = "Your last name must be between 2 and 25";
	public static $firstNameCharacters = "Your first name must be between 2 and 25 characters";
	public static $usernameCharacters = "Your username must be between 5 and 25 characters";
	public static $tooYoung = "You are too young. Please ask your parents to open an account for safer operation";
	public static $usernameTaken = "This Username has already been taken";
	public static $emailTaken = "This Email is already in use";


	//login error messages
	public static $loginFailed = "Your username or password was incorrect";	
}
?>