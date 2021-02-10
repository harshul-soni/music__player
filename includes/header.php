<?php 
include("includes/Datab.php");
include("includes/classes/User.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");
include("includes/classes/Playlist.php");
if(isset($_SESSION['userloggedin']))
{

	$userloggedin=new User($db,$_SESSION['userloggedin']);
	$username=$userloggedin->getusername();
	echo "<script>userloggedin = '$username';</script>";

}
else
{
	header("Location:register.php");
}



?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="assets/js/index.js"></script>
</head>
<body>

	<!--<script>
		var ele=new Audio();
		ele.setTrack("assets/music/bensound-acousticbreeze.mp3");
		ele.audio.play();
	</script> -->

	<div id="maincontainer">

		<div id="topcontainer">
			<?php include("includes/navbarcont.php"); ?>

			<div id="maincontainerview">
				<div id="maincontent">