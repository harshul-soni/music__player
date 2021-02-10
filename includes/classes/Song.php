<?php 

	class Song{
		public $id;
		public $db;
		public $title;
		public $artistid;
		public $albumid;
		public $genre;
		public $duration;
		public $path;
		public $mysqldata;


		public function __construct($db,$id){
			$this->db=$db;
			$this->id=$id;
			
			$query=mysqli_query($this->db, "SELECT * FROM songs WHERE id='$this->id'");
			$this->mysqldata=mysqli_fetch_array($query);
			$this->title=$this->mysqldata['title'];
			$this->artistid=$this->mysqldata['artist'];
			$this->albumid=$this->mysqldata['album'];
			$this->genre=$this->mysqldata['genre'];
			$this->duration=$this->mysqldata['duration'];
			$this->path=$this->mysqldata['path'];



		}
		public function getid(){
			return $this->id;
		}
		public function gettitle(){
			
			return $this->title;

		}
		public function getartistid(){
			return new Artist($this->db,$this->artistid);

		}
		public function getalbum(){
			return new Album($this->db,$this->albumid);
		}
		public function getgenre(){
			return $this->genre;
		}
		public function getduration(){
			return $this->duration;
		}
		public function getpath(){
			return $this->path;
		}
	}


?>