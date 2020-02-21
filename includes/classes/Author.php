<?php
	class Author {

		private $con;
		private $id;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
		}

		public function getName() {
			$authorQuery = mysqli_query($this->con, "SELECT name FROM author WHERE author_id ='$this->id'");
			$author = mysqli_fetch_array($authorQuery);
			return $author['name'];
		}
	}
?>