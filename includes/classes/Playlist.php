<?php
	class Playlist{
		private $id;
		private $db;
		private $owner;
		private $name;
		public function __construct($db,$data){

			if(!is_array($data)){
				$query=mysqli_query($db,"SELECT * FROM playlists WHERE id='$data'");
				$data=mysqli_fetch_array($query);
			}


			$this->db=$db;
			$this->id=$data['id'];
			$this->owner=$data['owner'];
			$this->name=$data['name'];
		}
		public function getid(){
			return $this->id;
		}
		public function getowner(){
			return $this->owner;
		}
		public function getname(){
			return $this->name;
		}
		public function getnumbersongs(){
			$query=mysqli_query($this->db,"SELECT songid FROM playlistsongs WHERE playlistid='$this->id'");
			return mysqli_num_rows($query);
		}

		public function getsongid(){
			$query=mysqli_query($this->db,"SELECT songid FROM playlistsongs WHERE playlistid='$this->id' ORDER BY playlistorder ASC");
			$array=array();
			while($row=mysqli_fetch_array($query))
			{
				array_push($array,$row['songid']);
			}
			return $array;
		}

		public static function getplaylistdrop($db,$username){
			$dropdown ='<select class="item playlist">
						<option class="item" value=""> Add to playlist</option>';
					$query=mysqli_query($db,"SELECT id, name FROM playlists WHERE owner='$username'");
					while($row=mysqli_fetch_array($query)){
						$id=$row['id'];
						$name=$row['name'];
						$dropdown = $dropdown. "<option class='item' value='$id'>$name</option>";
					}

					return $dropdown . '</select>';

		}

	}



?>