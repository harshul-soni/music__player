<?php
include("../../datab.php");
if(isset($_POST['playlistid']) && isset($_POST['songid'])){
	$playlistid=$_POST['playlistid'];
	$songid=$_POST['songid'];

	$orderidquery=mysqli_query($db,"SELECT max(playlistorder) +1 as playlistorder FROM playlistsongs WHERE playlistid='$playlistid'");
	$row=mysqli_fetch_array($orderidquery);
	$order=$row['playlistorder'];


	$query=mysqli_query($db,"INSERT INTO playlistsongs VALUES('','$songid','$playlistid','$order') ");

}
else
{
	echo "Something went wrong";
}


?>