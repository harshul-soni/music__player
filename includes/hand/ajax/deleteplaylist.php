<?php
include("../../datab.php");
if(isset($_POST['playlistid'])){
	$playlistid=$_POST['playlistid'];
	$query=mysqli_query($db,"DELETE FROM playlists WHERE id='$playlistid'");
	$playlistsong=mysqli_query($db,"DELETE FROM playlistsongs WHERE playlistid='$playlistid'");

} 
else
{
	echo "Error deleting file";
}


?>