<?php include("includes/includedfile.php"); 

	
if(isset($_GET['id']))
{
	$albumid=$_GET['id'];
	
}
else
{
	header("Location: index.php");
}

	$album=new Album($db, $albumid);

	$art=$album->getartist();

?>
	<div class="entityinfo">
		<div class="leftsection">
			<img src="<?php echo $album->getimage(); ?>" >
			
		</div>
		<div class="rightsection">
			<h3><?php echo $album->getname(); ?></h3>
			<p> By <?php echo $art->getaname(); ?></p>
			<p> <?php echo $album->getnumbersongs();?> Songs</p>
	
			

			
		</div>
		
	</div>
	<div class="tracklistcontainer">
		<div class="tracklist">
			<ul>
				<?php
					$arraysong=$album->getsongid();
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
	
	
</nav>

