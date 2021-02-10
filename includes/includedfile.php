<?php
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
	include("includes/Datab.php");
	include("includes/classes/User.php");
	include("includes/classes/Artist.php");
	include("includes/classes/Album.php");
	include("includes/classes/Song.php");
	include("includes/classes/Playlist.php");
	if(isset($_GET['userloggedin'])){
		$userloggedin=new User($db,$_GET['userloggedin']);
	}else
	{
		echo "error";
		exit();
	}

}
else
{
	include("includes/header.php");
	include("includes/footer.php");

	$url=$_SERVER['REQUEST_URI'];
	echo "<script>openpage('$url')</script>";
	exit();
	

}


?>