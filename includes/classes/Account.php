<?php

	class Account
	{
		private $errorm;
		private $db;
		public function __construct($db)
		{
			$this->errorm=array();
			$this->db=$db;

		}
		public function logincheck($loginuser,$loginpass)
		{
			$encrpp=md5($loginpass);
			$check=mysqli_query($this->db,"SELECT * FROM users WHERE username='$loginuser' AND password='$encrpp'");
			if(mysqli_num_rows($check)==1)
			{
				return true;
			}
			else
			{
				array_push($this->errorm,Constants::$loginfailed);
				return false;
			}
		}


		public function insertdata($uname, $fname,$lname,$email,$pass1)
		{
			$encryptpass=md5($pass1);
			$profilepic="assets/images/profilepic/user.jpg";
			$date=date("Y-m-d");

			$result=mysqli_query($this->db,"INSERT INTO users VALUES('','$uname','$fname','$lname','$email','$encryptpass','$date','profilepic')");

			return $result;


		}

		public function register($uname, $fname,$lname,$email,$pass1,$pass2)
		{
			$this->validateuname($uname);
			$this->valfname($fname);
			$this->vallname($lname);
			$this->valemail($email);
			$this->valpass($pass1,$pass2);
			if(empty($this->errorm))
			{
				return $this->insertdata($uname, $fname,$lname,$email,$pass1);
			}
			else
			{
				return false;
			}
		}



		public function geterror($error)
		{
			if(!in_array($error, $this->errorm))
			{
				$error="";

			}
			return "<span class='erromsg'>$error</span>";
		}

		private function validateuname($un)
		{
			if(strlen($un)>25 || strlen($un)<5)
			{
				array_push($this->errorm, Constants::$unameerror);
				return;

			}

			$checkuname=mysqli_query($this->db,"SELECT username FROM users WHERE username='$un'");
			if(mysqli_num_rows($checkuname)!=0)
			{
				array_push($this->errorm,Constants::$unamealready);
				return;
			}

		}
		private function valfname($fn)
		{
			if(strlen($fn)>25 || strlen($fn)<5)
			{
				array_push($this->errorm, Constants::$fnameerror);
				return;

			}

		}
		private function vallname($ln)
		{
			if(strlen($ln)>25 || strlen($ln)<3)
			{
				array_push($this->errorm, Constants::$lnameerror);
				return;

			}

		}
		private function valemail($em)
		{
			if(!filter_var($em,FILTER_VALIDATE_EMAIL))
			{
				array_push($this->errorm,Constants::$emailerror);
				return;
			}

			$checkemail=mysqli_query($this->db,"SELECT email FROM users WHERE email='$em'");
			if(mysqli_num_rows($checkemail)!=0)
			{
				array_push($this->errorm,Constants::$emailtaken);
				return;
			}

		}
		private function valpass($pw,$pw2)
		{
			if($pw!=$pw2)
			{
				array_push($this->errorm,Constants::$passmis);
				return;
			}
			if(strlen($pw)>25 || strlen($pw)<5)
			{
				array_push($this->errorm,Constants::$passlengtherror);
				return;
			}
			if(preg_match('/[^A-Za-z0-9]/',$pw))
			{
				array_push($this->errorm,Constants::$passalpha);
				return ;
			}

		}
	}


?>


