<?php include("includes/includedfile.php");; 

	
if(isset($_GET['id']))
{
	$playlistid=$_GET['id'];
	
}
else
{
	header("Location: index.php");
}

	$playlist=new Playlist($db,$playlistid);
	$owner=new User($db,$playlist->getowner());

?>
	<div class="entityinfo">
		<div class="leftsection">
			<img src="assets/images/icons/playlist.png" class="playlistimage" >
			
		</div>
		<div class="rightsection">
			<h3><?php echo $playlist->getname(); ?></h3>
			<p> By <?php echo $playlist->getowner(); ?></p>
			<p> <?php echo $playlist->getnumbersongs();?> Songs</p>
			<button class="button" onclick="deleteplaylist('<?php echo $playlistid; ?>')">DELETE PLAYLIST</button>
	
			

			
		</div>
		
	</div>
	<div class="tracklistcontainer">
		<div class="tracklist">
			<ul>
				<?php
					$arraysong=$playlist->getsongid();
					$i=1;


					foreach ($arraysong as $arr) {

			

						$songobj=new Song($db, $arr);
						$albumartist=$songobj->getartistid()->getaname();
				
						echo "<li class='tracklistrow'>
							<div class='trackcount'>
							<img src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $songobj->getid() . "\", tempPlaylist, true)'>
								<span class='tracknumber'>$i</span>
							</div>

							<div class='trackinfo'>
								<span class='trackname'>". $songobj->gettitle() ."</span>
								<span class='artistname'>$albumartist</span>
							</div>

							<div class='trackoptions'>
								<input type='hidden' class='songid' value='". $songobj->getid() ."'>
								<img class='optionbutton' src='assets/images/icons/more.png' onclick='showoptionmenu(this)'>

							</div>

							<div class='trackduration'>
								<span class='duration'>". $songobj->getduration() ."</span>
							</div>

						</li>";
						$i++;

					}
				?>

				<script>
					var tempsongid='<?php echo json_encode($arraysong); ?>';
					tempPlaylist=JSON.parse(tempsongid);
				</script>



			</ul>
			
		</div>
		
		
	</div>

	<nav class="optionmenu">
		<input type="hidden" class="songid">
		<?php echo Playlist::getplaylistdrop($db,$userloggedin->getusername());  ?>
		<div class="item" onclick="removefromplaylist(this,'<?php echo $playlistid;  ?>')">Remove from playlist</div>


	
	</nav>

