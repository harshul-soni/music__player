<?php
include("includes/includedfile.php");

?>

<div class="playlistcontainer">
	<div class="gridviewcontainer">
		<h2>PLAYLISTS</h2>
		<div class="headerbuttons">
			<button class="button green" onClick="createplaylist()">NEW PLAYLIST</button>
			
		</div>




		<?php

			$username=$userloggedin->getusername();

			$playlistquery=mysqli_query($db,"SELECT * FROM playlists WHERE owner='$username'");
			if(mysqli_num_rows($playlistquery)==0){
				echo "<span class='noresult'>No playlist found.Create Now...</span>";
			}
			while($row=mysqli_fetch_array($playlistquery))
			{
				$playlist=new Playlist($db,$row);
				echo "<div class='griditem'>
					<div class='gridinfo'>
						<div class='playlistimage'>
							<img src='assets/images/icons/playlist.png' onclick='openpage(\"playlist.php?id=". $playlist->getid() . " \")'>

						</div>
							".$playlist->getname()."

					</div>


				</div>";
			}


		?>
		
	</div>
	
</div>