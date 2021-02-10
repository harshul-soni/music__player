<?php
include("../../datab.php");
if(isset($_POST['playlistid']) && isset($_POST['songid'])){
	$playlistid=$_POST['playlistid'];
	$songid=$_POST['songid'];
	$playlistsong=mysqli_query($db,"DELETE FROM playlistsongs WHERE playlistid='$playlistid' AND songid='$songid'");

} 
else
{
	echo "Error deleting file";
}



?>