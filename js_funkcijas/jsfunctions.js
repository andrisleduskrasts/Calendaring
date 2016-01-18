function changeText3(){
	
	var newHTML = "<div class='exlibri1' id='ex1'><ul class='exlibri_list'><li class='exlibr_text2 links'><a href='#' onclick='develop()'><img src='resources/doc_edit.png' class='exlibri_img'><div class='exlibri_setup'>Develop</div></a></li><li class='exlibr_text2 links'><a href='#' onclick='customPage()'><img src='resources/eye.png' class='exlibri_img'><div class='exlibri_setup' id='customize'>Customize</div></a></li><li class='exlibr_text2 links'><a href='#' onclick='setProfile()'><img src='resources/cog.png' class='exlibri_img'><div class='exlibri_setup' id='Profile'>Profile</div></a></li><li class='exlibr_text2 links'><a href='book-last.html'><img src='resources/delete.png' class='exlibri_img'><div class='exlibri_setup'>Close</div></a></li></div><INPUT TYPE='image' onclick='changeText4()'  SRC='resources/inkplay.png'  id='exlibri_playback' ALT='BUTTON'> "
	
	document.getElementById('exlibritextandplayback').innerHTML = newHTML;
}


function changeText4(){

	var newHTML = "<div class='exlibri1' id='ex1'><ul class='exlibri_list'><li class='exlibr_text welcome_message'>Hi, Dude!</li><li class='exlibr_text links'><a href='book-last.html'>Create</a></li><li class='exlibr_text links'><a href='book-last.html'>Talk</a></li><li class='exlibr_text links'><a href='book-last.html'>Learn</a></li><li class='exlibr_text links'><a href='book-last.html'>Find</a></li></div><INPUT TYPE='image' onclick='changeText3()'  SRC='resources/inkback.png'  id='exlibri_playback' ALT='BUTTON'>"

	document.getElementById('exlibritextandplayback').innerHTML = newHTML;
}

function setProfile(){

	var newHTML = "<div class='activecontent'><h1 class='text activetext activetitle'>Setting up your profile</h1><button id='activebtn' onclick='closeActive()'>Save changes</button></div>"

	document.getElementById('activepage').innerHTML = newHTML;	

}

function customPage(){

	var newHTML = "<div class='activecontent2'><h1 class='text activetext activetitle'>Customize your page</h1><button id='activebtn' onclick='closeActive()'>Save changes</button></div>"

	document.getElementById('activepage').innerHTML = newHTML;
}

function develop(){

	var newHTML = "<div class='activecontent1'><h1 class='text activetext activetitle'>Develop this page</h1><button id='activebtn' onclick='closeActive()'>Save changes</button></div>"

	document.getElementById('activepage').innerHTML = newHTML;
}

function nodzest(id){
var newHTML = "";
document.getElementById(id).innerHTML = newHTML;
}

function makeItPassword(value){

    document.getElementById(value)
    .innerHTML = "<input id=\"password\" name=\"password\" type=\"password\"pattern=\".{8,20}\"/>";
    document.getElementById("password").focus();

}
function makeItUsername(value){

	document.getElementById(value)
	.innerHTML = "<input id=\"username\" name=\"Lietotajvards\" type=\"text\"pattern=\".{4,20}\"/>";
	document.getElementById("username").focus();

}