<?php
	class Album {

		private $con;
		private $id;
		private $albumid;
		private $title;
		private $arid;
		private $albumorder;
		private $artworkpath;
		private $genreName;
		private $genreid;
		private $gid;
		private $plays;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

			$query = mysqli_query($this->con, "SELECT * FROM album WHERE albumid ='$this->id'");
			$album = mysqli_fetch_array($query);
		//	$query2 = mysqli_query($this->con, "SELECT gid FROM album WHERE albumid= $this->id");
		//	$genreid = mysqli_fetch_array($query2);
			
			$this->title = $album['title'];
			$this->albumid = $album['albumid'];
			$this->arid = $album['arid'];
			$this->artworkPath = $album['artworkpath'];
			$this->genreid = $album['gid'];

			$query3= mysqli_query($this->con, "SELECT name FROM genre WHERE genreid = '$this->genreid'");
			$genre=mysqli_fetch_array($query3);
			$this->genreName = $genre['name'];

		//	$query2 = mysqli_query($con, "UPDATE audiobook SET plays = plays + 1 WHERE alid='$this->albumid'");
			$query4 = mysqli_query($this->con, "SELECT plays FROM audiobook WHERE alid='$this->albumid'");
			$timesPlayed = mysqli_fetch_array($query4);
			$this->plays = $timesPlayed['plays'];

		}

		public function getTitle() {
			return $this->title;
		}
		public function getAuthorId() {
			return $this->arid;
		}
		public function getGenreID() {
			return $this->genreid;
		}
		public function getGenreName() {
			return $this->genreName;
		//	return new Genre($this->con, $this->genreid);
		}
		public function getAlbumId() {
			$this->albumid;
		}

		public function getAuthor() {
			return new Author($this->con, $this->arid);
		}

		public function getAlbumorder() {
			return $this->albumorder;
		}

		public function getArtworkPath() {
			return $this->artworkPath;
		}
		public function getNumberOfBooks(){
			$query = mysqli_query($this->con,"SELECT COUNT(*) FROM audiobook where alid='$this->id'");
			return  mysqli_num_rows($query);
		}
		public function getBookIds(){
			$query = mysqli_query($this->con,"SELECT audiobookID FROM audiobook WHERE alid='$this->albumid'");
			$array = array();
			while($row = mysqli_fetch_array($query)){
				array_push($array,$row['audiobookID']);
			}
			return $array;
		}
		public function timesPlayed(){
		//	$query = mysqli_query($this->con, "UPDATE audiobook SET plays = plays + 1 WHERE alid='$this->albumid'");
		//	$query4 = mysqli_query($this->con, "SELECT plays FROM audiobook WHERE alid='$this->albumid'");
		//	$timesPlayed = mysqli_fetch_array($query4);
		//	$this->plays = $timesPlayed['plays'];
			return $this->plays;
		}
		public function increasePlay(){
			$query2 = mysqli_query($this->con, "UPDATE audiobook SET plays = plays + 1 WHERE alid='$this->albumid'");
		}
	}
?>