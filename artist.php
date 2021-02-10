<?php
include("includes/includedfile.php");
if(isset($_GET['id'])){
	$artistid=$_GET['id'];
}
else
{
	header("Location:index.php" );
}
$artist =new Artist($db,$artistid);


?>	
	
	<div class="entityinfo borderbottom">
		<div class="centersection">
			<div class="artistinfo">
				<h1 class="artistname"><?php echo $artist->getaname(); ?></h1>

				<div class="headerbuttons">
					<button class="button green" onclick='playfirst()'>PLAY</button>
					
				</div>
				
			</div>
			
		</div>
		
	</div>

	<div class="tracklistcontainer borderbottom">
		<h2>SONGS</h2>
		<div class="tracklist">
			<ul>
				<?php
					$arraysong=$artist->getsongid();
					$i=1;


					foreach ($arraysong as $arr) {

						if($i>5){
							break;
						}

			

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

	<div class="gridviewcontainer">
	<h2>ALBUMS</h2>
	<?php

	$albumquery=mysqli_query($db,"SELECT * FROM albums WHERE id='$artistid'");
	while($row=mysqli_fetch_array($albumquery))
	{
		echo "<div class='griditem'>
		<span onclick='openpage(\"album.php?id=" . $row["id"] . "\")'>
		<img src=".$row['images'].">
			<div class='gridinfo'>
				".$row['name']."

			</div>
		</span>


		</div>";
	}


	?>
	</div>

	<nav class="optionmenu">
		<input type="hidden" class="songid">
		<?php echo Playlist::getplaylistdrop($db,$userloggedin->getusername());  ?>

	
	</nav>




