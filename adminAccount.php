<?php
include("includes/connection.php");
include("includes/classes/Album.php");
include("includes/classes/Author.php");
include("includes/classes/Audibook.php");


if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn =  $_SESSION['userLoggedIn']; 
}
else {
	header("Location: register.php");
}

?>

<html>
<head>
	<title>Welcome to Pages!</title>
	<link rel="stylesheet" type="text/css" href="assets/css/adminAccount.css">
	
</head>
<body>
<div id = "background">
<h3 style = "color: black;">Hello, 
<?php
	$username = $_SESSION['userLoggedIn'];
	$query = mysqli_query($con, "SELECT name FROM admin WHERE username = '$username'");
	$result = mysqli_fetch_array($query);
	echo $result[0];
?></h3>
<h2><a href="register.php" class="navItemLink">Logout</a></h2>

<h1 class = "pageHeadingBig" > Audiobooks </h1>
<form align="center" method="post">
	<h4><p>	<label for="sort" >Sort By: </label>
		<input type="radio" name="sort" value="id" > ID
		<input type="radio" name="sort" value="duration"> Duration
		<input type="radio" name="sort" value="date"> Date
		<input type="radio" name="sort" value="played"> Number of times played <br><br>
		<button id="sort" type="submit" name="Result">SORT</button>
	</p></h4>
	<h3>Total number of audiobooks: 
		<?php 
			$query = mysqli_query($con, "SELECT COUNT(*) FROM audiobook");
			$result = mysqli_fetch_array($query);
			echo $result[0];
		?></h3>
	<table id="table" align="center">
		<tr><th>ID</th>
			<th>Title</th>
			<th>Duration</th>
			<th>Number of times played</th>
			<th>Upload Date</th>
		</tr>

	<?php
		$sortBy = $_POST["sort"];

		if($sortBy == "date")
		{
		    $query = "SELECT * FROM audiobook ORDER BY upload_date";
			
		}
		else if ($sortBy == "duration")
		{
		    $query = "SELECT * FROM audiobook ORDER BY duration";
		}
		else if ($sortBy == "played")
		{
			$query = "SELECT * FROM audiobook ORDER BY plays";
		}
		else
		{
			$query = "SELECT * FROM audiobook ORDER BY audiobookID";
		}
		$result = $con-> query($query);
			if ($result-> num_rows > 0){
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr><td>".$row['audiobookID']."</td><td>".$row['title']."</td><td>".$row['duration']."</td><td>".$row['plays']."</td><td>".$row['upload_date']."</td></tr>";
				}
				echo "</table";
			}
			else{
				echo "0 result";
			}
	?>
	</table>
</form>


<h1 class = "pageHeadingBig" > Users </h1>
<form align="center" method="post">
	<h4><p>	<label for="sort">Sort By: </label>
		<input type="radio" name="sort" value="id" > ID
		<input type="radio" name="sort" value="username"> Username
		<input type="radio" name="sort" value="dob"> Date of Birth
		<input type="radio" name="sort" value="dos"> Signup Date <br><br>
		<button id="sort" type="submit" name="Result">SORT</button>
	</p></h4>
	<h3>Total number of accounts: 
		<?php 
			$query = mysqli_query($con, "SELECT COUNT(*) FROM user");
			$result = mysqli_fetch_array($query);
			echo $result[0];
		?></h3>
	<table id="table" align="center">
		<tr><th>ID</th>
			<th>Username</th>
			<th>Name</th>
			<th>Date of Birth</th>
			<th>Email</th>
			<th>Signup Date</th>
		</tr>

	<?php
		$sortBy = $_POST["sort"];

		if($sortBy == "dob")
		{
		    $query = "SELECT * FROM user ORDER BY dob";
			
		}
		else if ($sortBy == "dos")
		{
		    $query = "SELECT * FROM user ORDER BY dos";
		}
		else if ($sortBy == "username")
		{
			$query = "SELECT * FROM user ORDER BY username";
		}
		else
		{
			$query = "SELECT * FROM user ORDER BY id";
		}
		$result = $con-> query($query);
			if ($result-> num_rows > 0){
				while($row = mysqli_fetch_assoc($result)){
					echo "<tr><td>".$row['id']."</td><td>".$row['username']."</td><td>".$row['first_name']." ".$row['last_name']."</td><td>".$row['dob']."</td><td>".$row['email']."</td><td>".$row['dos']."</td></tr>";
				}
				echo "</table";
			}
			else{
				echo "0 result";
			}
	?>
	</table>
</form>
</div>
</body>

<style>

	td, th { border: 1px solid #000000; height: 40px; }

	th {  
		 background: #146704;
		  font-weight: bold; 
	}

	td {  
		background: #46793d; 
		text-align: center; 
	}

		
</html>