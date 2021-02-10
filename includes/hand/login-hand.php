<?php



if(isset($_POST['loginbtn']))
{
	$loginuser=$_POST['loginusername'];
	$loginpass=$_POST['loginpassword'];
	$succ=$account->logincheck($loginuser,$loginpass);

	if($succ)
	{
		$_SESSION['userloggedin']=$loginuser;
		header("Location:index.php");
	}
	
}


?>