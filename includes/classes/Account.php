<?php
	class Account {

		private $errorArray;
		private $con;
		public function __construct($con) {
			$this->con = $con;
			$this->errorArray = array();
		}

		public function register($un, $fn, $ln, $em, $em2, $pw, $pw2,$dob,$gender) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validatePasswords($pw, $pw2);
			$this->validateBirthdate($dob);
			if(empty($this->errorArray)){
				//insert into db
				return $this->insertUserDetails($un , $fn, $ln, $em, $pw,$dob,$gender);
			}
			else {
				return false;
			}
		}
		private function insertUserDetails($un , $fn, $ln, $em, $pw,$dob,$gender){
			
			$encryptedPw = hash('sha256', $pw); //password encrypted
			$profilePic = "assets/images/profile-pics/head_emerald.png";
			$date = date("Y-m-d");
			$datob=date("Y-m-d",strtotime($dob));
			$resultUser = mysqli_query($this->con , "INSERT INTO user VALUES ('$fn','$ln','$un','$encryptedPw','$datob','$em','$date','')" );
			$useridq= "SELECT id FROM user WHERE username = '$un'";
			$query = mysqli_query( $this->con, $useridq) or die(mysqli_error($this->con));
			$row = mysqli_fetch_array($query);
			$userid = $row['id'];
			//echo "user id ".$userid;
			$resultUser2 = mysqli_query($this->con , "INSERT INTO profilepic VALUES ('$profilePic','$date','$userid')" ); 

		}

		private function validateUsername($un) {

			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray,Constant::$usernameCharacters);
				return;
			}

			//TODO: check if username exists
			$checkUsernameQ = mysqli_query($this->con, "SELECT username FROM user where username = '$un'");
			if(mysqli_num_rows($checkUsernameQ)!=0){
				array_push($this->errorArray, Constant::$usernameTaken);
			}
		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, Constant::$firstNameCharacters);
				return;
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, Constant::$lastNameCharacters);
				return;
			}
		}

		private function validateEmails($em, $em2) {
			if($em != $em2) {
				array_push($this->errorArray, Constant::$emailsDoNotMatch);
				return;
			}

			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constant::$emailInvalid);
				return;
			}
			$checkEmailQ = mysqli_query($this->con, "SELECT email FROM user where email = '$em'");
			//TODO: Check that email hasn't already been used
			if(mysqli_num_rows($checkEmailQ)!=0){
				array_push($this->errorArray, Constant::$emailTaken);
			}

		}

		private function validatePasswords($pw, $pw2) {
			if($pw != $pw2) {
				array_push($this->errorArray, Constant::$passwordsDoNotMatch);
				return;
			}
			else if(preg_match('/[^A-Za-z0-9]/', $pw)){
				array_push($this->errorArray,Constant::$passwordNotAlphanumeric);
			}
			else if(strlen($pw) > 30 || strlen($pw) < 5){
				array_push($this->errorArray,Constant::$passwordCharacters);
			}
			
		}
		private function validateBirthdate($dob){
			//todo check the birthday if it is after 2010 
		}
		public function showError($error){
			if(!in_array($error, $this->errorArray)){
				$error = "";
			}
			return "<span class = 'errorMessage' > $error </span>";
		}

		// For login  handler

		public function login($un, $pw){
			$pw = hash('sha256', $pw);
			$query = mysqli_query($this->con, "SELECT * FROM user WHERE username = '$un' AND password = '$pw'");
			if(mysqli_num_rows($query) == 1){
				return true;
			}
			else{
				array_push($this->errorArray, Constant::$loginFailed);
				 return false;
			}
		}
	}
?>