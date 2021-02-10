<?php

function sanitize($inputt)
{
	$input=strip_tags($inputt);
	return $input;

}




if(isset($_POST['registerbtn']))
{
	$uname=sanitize($_POST['uname']);
	$fname=sanitize($_POST['fname']);
	$lname=sanitize($_POST['lname']);
	$email=sanitize($_POST['email']);
	$pass1=sanitize($_POST['pass1']);
	$pass2=sanitize($_POST['pass2']);
	$success=$account->register($uname,$fname,$lname,$email,$pass1,$pass2);
	if($success)
	{
		$_SESSION['userloggedin']=$uname;
		header("Location:index.php");
	}
	else
	{
		
	}


	

}


?>