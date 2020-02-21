<?php 
include("includes/header.php");
include("includes/classes/Account.php");
include("includes/handlers/login-handler.php"); ?>
<div><h4>Hello, 
<?php
	$username = $_SESSION['userLoggedIn'];
	$query = mysqli_query($con, "SELECT first_name, last_name FROM user WHERE username = '$username'");
	$result = mysqli_fetch_array($query);
	echo $result[0]." ".$result[1];
?></h4></div>
<h1 class = "pageHeadingBig" > Audiobooks You May Like</h1>
<div class = "gridViewContainer">
	<?php 
	

	$albumQuery = mysqli_query($con,"SELECT * from album ORDER BY RAND() LIMIT 10 ");
	while($row = mysqli_fetch_array($albumQuery)){

		//echo $row['title'];
		echo "<div class='gridViewItem'>
				<a href='album.php?id=".$row['albumid']."'>
				<img src='".$row['artworkpath']."'>

				<div class='gridViewInfo'>".$row['title'].
				"</div>
				</a>
			</div>";

	}

	?>

</div>


<?php include("includes/footer.php"); ?>		