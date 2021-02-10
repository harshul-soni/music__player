<?php

	class User
	{
		private $db;
		private $username;

		public function __construct($db,$username){
			$this->db=$db;
			$this->username=$username;

		}
		public function getusername(){
			return $this->username;
			
		}
		public function getname(){
			$query=mysqli_query($this->db,"SELECT concat(firstname , ' ' ,lastname) as 'name' FROM users WHERE username='$this->username'");
			$row=mysqli_fetch_array($query);
			return $row['name'];

		}
		public function getemail(){
			$username=$this->username;
			$query1=mysqli_query($this->db,"SELECT email FROM users WHERE username ='$username'");
			$row1=mysqli_fetch_array($query1);
			return $row1['email'];
			
		}
	}


?>