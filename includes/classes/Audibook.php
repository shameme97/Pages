<?php
	class Audiobook {

		private $con;
		private $id;
		private $mysqliData;
		private $title;
		private $authorId;
		private $albumId;
		private $genre;
		private $duration;
		private $path;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

			$query = mysqli_query($this->con, "SELECT * FROM audiobook WHERE audiobookID='$this->id'");
			$this->mysqliData = mysqli_fetch_array($query);
			$this->title = $this->mysqliData['title'];
			$this->albumId = $this->mysqliData['alid'];
		//	$album = new Album($this->con, $this->albumId);
		//	$arid = $album->getAuthorId();
			
		//	$this->authorId = $album->getAuthor($this->con,$arid);
			
			$this->genre = $this->mysqliData['gid'];
			$this->duration = $this->mysqliData['duration'];
			$this->path = $this->mysqliData['path'];

			$this->authorId = $this->mysqliData['authorid'];
			
		}

		public function getTitle() {
			return $this->title;
		}

		public function getId() {
			return $this->id;
		}
		
		public function getAuthor() {
			return new Author($this->con, $this->authorId);
		}

		public function getAlbum() {
			return new Album($this->con, $this->albumId);
		}

		public function getPath() {
			return $this->path;
		}

		public function getDuration() {
			return $this->duration;
		}

		public function getMysqliData() {
			return $this->mysqliData;
		}

		public function getGenre() {
			return $this->genre;
		}

	}
?>