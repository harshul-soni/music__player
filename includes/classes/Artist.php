<?php
	class Artist
	{
		private $db;
		private $id;
		public function __construct($db,$id)
		{
			$this->db=$db;
			$this->id=$id;

		}
		public function getid(){
			return $this->id;
		}
		public function getaname()
		{
			$artistquery=mysqli_query($this->db,"SELECT aname FROM artists WHERE id='$this->id'");
			$artist=mysqli_fetch_array($artistquery);
			return $artist['aname'];
		}
		public function getsongid(){
			$query=mysqli_query($this->db,"SELECT id FROM songs WHERE artist='$this->id' ORDER BY songplays DESC");
			$array=array();
			while($row=mysqli_fetch_array($query))
			{
				array_push($array,$row['id']);
			}
			return $array;
		}
	}


?>
