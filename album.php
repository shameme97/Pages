<?php include("includes/header.php"); 

if(isset($_GET['id'])) {
	$albumId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$album = new Album($con, $albumId);
$author = $album->getAuthor();
?>

<div class="entityInfo">

	<div class="leftSection">
		<img src="<?php echo $album->getArtworkPath(); ?>">
	</div>

	<div class="rightSection">
		<h2><?php echo $album->getTitle(); ?></h2>
		<p>By <?php echo $author->getName(); ?></p>
		<p>Genre: <?php echo $album->getGenreName(); ?></p>
		<p>Total number of plays: <?php echo $album->timesPlayed(); ?></p>
		<p><?php echo$album->getNumberOfBooks();?> Audiobook(s)</p>

		<div id="play">
		<form method="post">
		    <button type="submit" name="playButton">PLAY</button>
		</form>
		<?php
		    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['playButton']))
		    {
		        $album->increasePlay();
		    }
		?>
		</div>


	</div>

</div>



<div class="tracklistContainer">
	<ul class="tracklist">
		
		<?php
		$bookIdArray = $album->getBookIds();
		//echo sizeof($bookIdArray);
		$i = 1;
		foreach($bookIdArray as $audiobookID) {

			$albumBook = new Audiobook($con, $audiobookID);
		//	$album = new Album($con, $albumId);
		//	$author = $album->getAuthor();
			$albumAuthor = $albumBook->getAuthor();


			echo "<li class='tracklistRow'>
					<div class='trackCount'>
						<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumBook->getId() . "\", tempPlaylist, true)'>
						<span class='trackNumber'>$i</span>
					</div>


					<div class='trackInfo'>
						<span class='trackName'>" . $albumBook->getTitle() . "</span>
						<span class='artistName'>" . $albumAuthor->getName() . "</span>
					</div>

					<div class='trackOptions'>
						<img class='optionsButton' src='assets/images/icons/more.png'>
					</div>

					<div class='trackDuration'>
						<span class='duration'>" . $albumBook->getDuration() . "</span>
					</div>


				</li>";

			$i = $i + 1;


		}

		?>

	</ul>

</div>


<?php include("includes/footer.php"); ?>