<?php

	class Album
	{
		private $db;
		private $id;
		private $name;
		private $artist;
		private $genre;
		private $images;
		public function __construct($db,$id)
		{
			$this->db=$db;
			$this->id=$id;

			$query=mysqli_query($this->db,"SELECT * FROM albums WHERE id='$this->id'");
			$row=mysqli_fetch_array($query);
			$this->name=$row['name'];
			$this->artist=$row['artist'];
			$this->genre=$row['genre'];
			$this->images=$row['images'];

		}
		public function getname()
		{
			return $this->name;

		}
		public function getartist(){
			return new Artist($this->db,$this->artist);
		}
		public function getgenre(){
			return $this->genre;
		}
		public function getimage(){
			return $this->images;
		}
		public function getnumbersongs(){
			$query=mysqli_query($this->db,"SELECT * FROM songs WHERE album='$this->id'");
			return mysqli_num_rows($query);
		}
		public function getsongid(){
			$query=mysqli_query($this->db,"SELECT id FROM songs WHERE album='$this->id' ORDER BY id ASC");
			$array=array();
			while($row=mysqli_fetch_array($query))
			{
				array_push($array,$row['id']);
			}
			return $array;
		}

	}


?>
