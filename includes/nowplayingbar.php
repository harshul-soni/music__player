<?php 
	$randquery=mysqli_query($db,"SELECT id FROM songs ORDER BY RAND() LIMIT 10");
	$songarr=array();
	while($row=mysqli_fetch_array($randquery))
	{
		array_push($songarr,$row['id']);

	}
	$jsonarray=json_encode($songarr);


?>

<script>
	
	$(document).ready(function(){
		var newplaylist=<?php echo  $jsonarray; ?>;
		audioelement=new Audio();
		updatevolume(audioelement.audio);
		setTrack(newplaylist[0],newplaylist,false);

		$("#nowplayingbarcontainer").on("mousedown touchstart mousemove touchmove",function(e){
			e.preventDefault();
		})

		$(".playbackbar .progressbar").mousedown(function(){
			mouseDown=true;
		});
		$(".playbackbar .progressbar").mousemove(function(e){
			if(mouseDown)
			{
				settime(e,this);
			}
		});
		$(".playbackbar .progressbar").mouseup(function(e){
				settime(e,this);
		});



		$(".volumebar .progressbar").mousedown(function(){
			mouseDown=true;
		});
		$(".volumebar .progressbar").mousemove(function(e){
			if(mouseDown){
				var volumeset= e.offsetX / $(this).width();
				if(volumeset>=0 && volumeset<=1)
				{
					audioelement.audio.volume=volumeset;

				}
				

			}
		});
		$(".volumebar .progressbar").mouseup(function(e){
			var volumeset= e.offsetX / $(this).width();
			if(volumeset>=0 && volumeset<=1)
			{
				audioelement.audio.volume=volumeset;
			}
			
		});



	});

	$(document).mouseup(function(){
		mouseDown=false;
	});

	function settime(mouse,progress)
	{
		var percentage=mouse.offsetX / $(progress).width() *100;
		var seconds=audioelement.audio.duration * (percentage/100);
		audioelement.setTime(seconds); 
	}

	function nextsong(){
		if(repeat){
			audioelement.setTime(0);
			playsong();
			return;

		}
		if(currentindex==currentplaylist.length-1){
			currentindex=0;
		}
		else
		{
			currentindex++;
		}
		var tracktoplay= shuffle ? shuffleplaylist[currentindex] : currentplaylist[currentindex];
		setTrack(tracktoplay,currentplaylist,true);

	}
	function previoussong(){
		if(audioelement.audio.currentTime>=3 || currentindex==0){
			audioelement.setTime(0);
		}
		else
		{
			currentindex--;
			setTrack(currentplaylist[currentindex],currentplaylist,true);

		}
	}

	function mute(){
		audioelement.audio.muted= !audioelement.audio.muted;
		var image= audioelement.audio.muted ? "volume-mute.png" : "volume.png";
		$(".controlbutton.volume img").attr("src","assets/images/icons/"+image);

	}
	function setshuffle(){
		shuffle= !shuffle;
		var image=shuffle ? "shuffle-active.png" : "shuffle.png";
		$(".controlbutton.shuffle img").attr("src","assets/images/icons/"+image);

		if(shuffle){
			shuffleArray(shuffleplaylist);
			currentindex=shuffleplaylist.indexOf(audioelement.currentlyplaying.id);

		}
		else
		{
			currentindex=currentplaylist.indexOf(audioelement.currentlyplaying.id);

		}

	}
	function shuffleArray(array) {
	    for (var i = array.length - 1; i > 0; i--) {
	        var j = Math.floor(Math.random() * (i + 1));
	        var temp = array[i];
	        array[i] = array[j];
	        array[j] = temp;
	    }
	}

	function setrepeat(){
		repeat= !repeat;
		var image=repeat ? "repeat-active.png" :"repeat.png";
		$(".controlbutton.repeat img").attr("src","assets/images/icons/"+image);

	}

	function setTrack(trackid,newplaylist,play){

		if(currentplaylist!=newplaylist){
			currentplaylist=newplaylist;
			shuffleplaylist=currentplaylist.slice();
			shuffleArray(shuffleplaylist);
		}

		if(shuffle){
			currentindex=shuffleplaylist.indexOf(trackid);

		}
		else
		{
			currentindex=currentplaylist.indexOf(trackid);

		}	
		pausesong();

		$.post("includes/hand/ajax/getsong.php" , { songid:trackid } , function(data){
			
			var track=JSON.parse(data);
			console.log(track);
			$(".trackname span ").text(track.title);

			$.post("includes/hand/ajax/getartist.php", { artistid:track.artist }, function(data){
				var artist=JSON.parse(data);
				console.log(artist);
				$(".trackartist span ").text(artist.aname);	
				$(".trackartist span").attr("onclick","openpage('artist.php?id=" + artist.id + "')");	

			});

			$.post("includes/hand/ajax/getalbum.php", { albumid:track.album }, function(data){
				var album=JSON.parse(data);
				$(".albumlink img").attr("src",album.images);
				$(".albumlink img").attr("onclick","openpage('album.php?id=" + album.id + "')");
				$(".trackname span ").attr("onclick","openpage('album.php?id=" + album.id + "')");


			});



			audioelement.setTrack(track);
			if(play){
			playsong();
			}
	

		}); 

		

	}
	function playsong(){

		if(audioelement.audio.currentTime==0)
		{
			$.post("includes/hand/ajax/updateplay.php",{ songid : audioelement.currentlyplaying.id});

		}
		else
		{
			console.log(audioelement);
		}
		$(".controlbutton.play").hide();
		$(".controlbutton.pause").show();
		audioelement.play();
	}
	function pausesong(){
		$(".controlbutton.pause").hide();
		$(".controlbutton.play").show();
		audioelement.pause();
	}
	
</script>




<div id="nowplayingbarcontainer">
<div id="nowplayingbar">
	<div id="left">
		<div class="content">
			<span class="albumlink">
				<img src="" class="albumwork">						
			</span>
			<div class="trackinfo">
				<span class="trackname">
					<span></span>
				</span>
				<span class="trackartist">
					<span></span>
				</span>
				
			</div>
			
		</div>
		
		
	</div>
	<div id="center">
		<div class="content playercontrols">

			<div class="buttons">
				<button class="controlbutton shuffle" title="Shuffle" onclick="setshuffle()">
					<img src="assets/images/icons/shuffle.png">
					
				</button>
				<button class="controlbutton next" title="Previous" onclick="previoussong()">
					<img src="assets/images/icons/previous.png">							
				</button>
				<button class="controlbutton play" title="Play" onclick="playsong()">
					<img src="assets/images/icons/play.png">
					
				</button>
				<button class="controlbutton pause" title="pause button" style="display: none" onclick="pausesong()">
					<img src="assets/images/icons/pause.png">
					
				</button>
				<button class="controlbutton previous" title="Next" onclick="nextsong()">
					<img src="assets/images/icons/next.png">							
				</button>
				<button class="controlbutton repeat" title="Repeat" onclick="setrepeat()">
					<img src="assets/images/icons/repeat.png">
					
				</button>
									
			</div>

			<div class="playbackbar">
				<span class="currenttime">0.00</span>
				<div class="progressbar">
					<div class="progressbarbg">
						<div class="currentbar"></div>
						
					</div>
					
				</div>
				<span class="remainingtime">0.00</span>						
			</div>


		</div>				
	</div>
	<div id="right">
		<div class="volumebar">
			<button class="controlbutton volume" title="Volume" onclick="mute()">
				<img src="assets/images/icons/volume.png">
				
			</button>
			<div class="progressbar">
					<div class="progressbarbg">
						<div class="currentbar"></div>
						
					</div>
					
			</div>
			
		</div>			
		
	</div>
	
</div>
</div>