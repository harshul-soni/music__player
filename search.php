<?php

include("includes/includedfile.php");
if(isset($_GET['search'])){
	$search =urldecode($_GET['search']);
}
else{
	$search="";
}



?>

<div class="searchcontainer">
	<h4> Search for Song,Album,Artist </h4>	
	<input type="text" class="searchinput" value="<?php echo $search; ?>" placeholder="Search Here..." onFocus="this.value=this.value;">
</div>

<script>


	$('.searchinput').focus();
	
	$(function(){
		
		

		$(".searchinput").keyup(function(){
			clearTimeout(timer);
			timer=setTimeout(function(){
				var val=$(".searchinput").val();
				openpage("search.php?search=" +val);
			},2000);
		})
	})
</script>
<?php

	if($search==""){
		exit();
	}
?>

<div class="tracklistcontainer borderbottom">
		<h2>SONGS</h2>
		<div class="tracklist">
			<ul>
				<?php
					$songquery=mysqli_query($db,"SELECT id FROM songs WHERE title LIKE '$search%' LIMIT 10");
					if(mysqli_num_rows($songquery)==0){
						echo "<span class='noresult'>No Song Matching ". $search ."</span>";
					}


					$arraysong=array();
					$i=1;


					while($row=mysqli_fetch_array($songquery)) {

						if($i>5){
							break;
						}
						array_push($arraysong,$row['id']);

			

						$songobj=new Song($db, $row['id']);
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

<div class="artistcontainer borderbottom">
	<h2> ARTIST</h2>
	<?php 
	$artistquery=mysqli_query($db,"SELECT id FROM artists WHERE aname LIKE '$search%'");
	if(mysqli_num_rows($artistquery)==0){
		echo "<span class='noresult'>No Artist Found Matching ". $search . " </span>";
	}
	while($row=mysqli_fetch_array($artistquery)){
		$artistfound=new Artist($db,$row['id']);
		echo 
		"<div class='searchresultrow'>
			<div class='artistname'>
				<span onclick='openpage(\"artist.php?id=". $artistfound->getid() ."\")'>

				". $artistfound->getaname() ."


				</span>

			</div>

		</div>";
	}

	?>
	
</div>

<div class="gridviewcontainer">
	<h2>ALBUMS</h2>
	<?php

	$albumquery=mysqli_query($db,"SELECT * FROM albums WHERE name LIKE'$search' LIMIT 10");
	if(mysqli_num_rows($albumquery)==0){
		echo "<span class='noresult'>No Album Matching ". $search ."</span>";
	}
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

