var currentplaylist = new Array();
var shuffleplaylist=[];
var tempPlaylist=[];
var audioelement;
var mouseDown=false;
var currentindex=0;
var repeat =false;
var shuffle=false;
var userloggedin;
var timer;

$(document).click(function(click){
	var target=$(click.target);
	if(!target.hasClass("optionbutton") && !target.hasClass("item")){
		hideoptionmenu();

	}
})

$(document).on("change","select.playlist",function(){
	var select=$(this);
	var playlistid=select.val();
	var songid=select.prev(".songid").val();

	$.post("includes/hand/ajax/addtoplaylist.php", { playlistid:playlistid , songid:songid }).done(function(error){
		if(error!="")
		{
			alert(error);
			return ;
		}
		hideoptionmenu();
		select.val("");


	});
	
})

$(window).scroll(function(){
	hideoptionmenu();

})


function openpage(url){
	if(timer != null){
		clearTimeout(timer);
	}
	if(url.indexOf("?") == -1)
	{
		url= url + "?";
	}
	var encodeurl=encodeURI(url + "&userloggedin=" +userloggedin);
	$("#maincontent").load(encodeurl);
	$("body").scrollTop(0);
	history.pushState(null,null,url);

}

function logout(){
	$.post("includes/hand/ajax/logout.php", function(){
		location.reload();
	})
}

function updateemail(emailclass){
	var emailvalue=$("."+emailclass).val();
	$.post("includes/hand/ajax/updateemail.php", { email: emailvalue , username: userloggedin }).done(function(response){
		$("."+emailclass).nextAll(".message").text(response);

	});

}

function updatepassword(oldpasswordclass,newpassword1class,newpassword2class){
	var oldpassword=$("."+oldpasswordclass).val();
	var newpassword1=$("."+newpassword1class).val();
	var newpassword2=$("."+newpassword2class).val();
	$.post("includes/hand/ajax/updatepassword.php",{
		oldpassword:oldpassword,
		newpassword1:newpassword1,
		newpassword2:newpassword2,
		username:userloggedin}).done(function(response){
	 	$("."+oldpasswordclass).nextAll(".message").text(response);

	 })

}
function removefromplaylist(button, playlistid){
	var songid=$(button).prevAll(".songid").val();
	$.post("includes/hand/ajax/removefromplaylist.php",{ playlistid:playlistid, songid:songid }).done(function(error){
			if(error!=""){
				alert(error);
				return;
			}
			else
			{
				openpage("playlist.php?id="+playlistid);
			}
	});


}

function hideoptionmenu(){
	var menu=$(".optionmenu");
	if(menu.css("display")!="none"){
		menu.css("display","none");

	}
}

function showoptionmenu(button){
	var songid=$(button).prevAll(".songid").val();
	var menu=$(".optionmenu");
	var menuwidth=menu.width();
	menu.find(".songid").val(songid);

	var scrolltop=$(window).scrollTop();
	var offset=$(button).offset().top;

	var top=offset-scrolltop;
	var left=$(button).position().left;

	menu.css({ "top":top +"px" , "left":left-menuwidth +"px" ,display:"inline"});


}

function createplaylist(){
	var pop=prompt("Enter Name of Playlist ");
	if(pop != null){
		$.post("includes/hand/ajax/createplaylist.php", { name:pop , username:userloggedin }).done(function(error){
			if(error!="")
			{
				alert(error);
				return;
			}else{
					openpage("yourmusic.php");	
			}
			

		});
	}
	else
	{
		alert("Playlist name cannot be empty");
	}

}

function deleteplaylist(playlistid){
	var prompt=confirm("Are you sure you want to delete?");
	if(prompt){

		$.post("includes/hand/ajax/deleteplaylist.php",{ playlistid:playlistid }).done(function(error){
			if(error!=""){
				alert(error);
				return;
			}
			else
			{
				openpage("yourmusic.php");
			}
	});

	}
	

}

function playfirst(){
	setTrack(tempPlaylist[0],tempPlaylist,true);

}

function format(seconds){
	var time=Math.round(seconds);
	var minutes=Math.floor(time/60);
	var seconds=time-(minutes*60);
	var extrazero;
	if(seconds<10){
		extrazero="0";

	}
	else
	{
		extrazero="";
	}
	return minutes + ":"+ extrazero+ seconds;
}

function updateprogress(audio){
	$(".currenttime").text(format(audio.currentTime));
	$(".remainingtime").text(format(audio.duration-audio.currentTime));
	var progress=(audio.currentTime/audio.duration )* 100;
	$(".playbackbar .currentbar").css("width",progress+"%");

}

function updatevolume(audio){ 
	var volume=audio.volume * 100;
	$(".volumebar .currentbar").css("width",volume+ "%");
}

function Audio(){

	this.audio=document.createElement('audio');
	this.currentlyplaying;

	this.audio.addEventListener("ended",function(){
		nextsong();
	});

	this.audio.addEventListener("canplay", function(){

		var duration=format(this.duration);
		$(".remainingtime").text(duration);
		

	});

	this.audio.addEventListener("timeupdate",function(){
		if(this.duration){
			updateprogress(this);
		}

	});

	this.audio.addEventListener("volumechange",function(){
		updatevolume(this);
	})
	

	this.setTrack = function(track) {
		this.currentlyplaying=track;
		this.audio.src = track.path;
	}

	this.play = function(){
		this.audio.play();
	}

	this.pause = function(){
		this.audio.pause();
	}
	this.setTime=function(seconds){
		this.audio.currentTime=seconds;
	}

}