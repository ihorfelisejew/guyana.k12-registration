
var meta = {} ;

$(document).ready(function() {

	$("#header").load("header.html", function() {
		getLoggedInUser();
		$("#footer").load("footer.html");
	});	
	
});



// ** Utils Methods ** //



function getLoggedInUser(){
	
	var user = sessionStorage.getItem("user");
//	alert(user);
	if(user != undefined && user != ""){
		
		user = JSON.parse(user);
		//alert(user.id);
		
		$("#user-top-pnl").show();
		$("#loggedUser-name").html(user.name);
		$("#login-reg-pnl").hide();
		
		loadUsers();
		//loadChatUsers(user.id);
		loadTeammate();
		loadPlayersList();
		loadPlayersListAll();
		loadTeamsC();
		//UserNameByID();
		
	}else {
		
		$("#login-reg-pnl").show();
		$("#user-top-pnl").hide();
	}	
}




function logout(){
	sessionStorage.removeItem("user");
	sessionStorage.removeItem("items");
	getLoggedInUser();

}



// **  Action Methods **  //  


function saveUser(){
	
	
	var user = {};
	user.email = $("#email-rgs").val();
	if(user.email == ""){
		alert("Enter Email");
		return ;
	}
	
	user.password = $("#password-rgs").val();
	if(user.password == ""){
		alert("Enter password");
		return ;
	}
	
	user.repwd = $("#repwd-rgs").val();
	if(user.repwd == ""){
		alert("Enter  password");
		return ;
	}
	
	user.address = $("#addrs-rgs").val();
	if(user.address == ""){
		alert("Enter  address");
		return ;
	}

	
	user.firstname = $("#firstName-rgs").val();
	if(user.firstname == ""){
		alert("Enter  firstname");
		return ;
	}
	
	user.lastname = $("#lastName-rgs").val();
	if(user.lastname == ""){
		alert("Enter  lastname");
		return ;
	}
	
	user.phone = $("#phone-rgs").val();

	if(user.phone == ""){
		alert("Enter  Phone");
		return ;
	}
	
	
	user.postCode = $("#postCode-rgs").val();
	if(user.postCode == ""){
		alert("Enter  Post Code");
		return ;
	}
	
	
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "saveUser",
			data : user
		},
		success : function(response) {
			
			$(".form-control").val("");
			obj = JSON.stringify(user);
			sessionStorage.setItem("user", obj);
			$("#close-rg-btn").click();
			getLoggedInUser();

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}







function login(){
	
	var user = {};
	user.email = $("#login-email").val();
	user.password = $("#login-password").val();
	
	if(user.email == ""){
		alert("Email missing");
		return;
		
	}
	if(user.password == ""){
		alert("Password missing");
		return;
	}
	
	
	
	
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "login",
			data : user
		},
		success : function(data) {
			
			var obj =JSON.parse(data)[0];
			obj = JSON.stringify(obj);
			sessionStorage.setItem("user", obj);
			getLoggedInUser();
			$("#close-lg-btn").click();
		},
		error : function(data) {
			alert("Invalid user");
		}
	});
	
	
	
}

function loadPlayersList(){
	
	//var teamId = $(element).data("teamid");
	// data = { teamId :teamIds } ;
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadPlayersList",
			data : ""
		},
		
		success : function(response) {
			meta.playerlist = {} ;
			meta.playerlist = JSON.parse(response);
               
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
}

function loadPlayersListAll(){
	
	//var teamId = $(element).data("teamid");
	
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadPlayersListAll",
			data : ""
		},
		
		success : function(response) {
		//	alert(response);
			meta.playerlistall = {} ;
			meta.playerlistall = JSON.parse(response);
               
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
}






function loadUsers(){
	
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadUsers",
			data : ""
		},
		success : function(response) {
			meta.users = {} ;
			meta.users = JSON.parse(response);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadChalleneges",
			data : ""
		},
		success : function(response) {
			meta.challenges = {} ;
			meta.challenges = JSON.parse(response);
			$("#challenge-txt").html("No challenge available");
			createChallengeTextHtml();
			loadRounds();

			
			
			
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadChallenegesR1",
			data : ""
		},
		success : function(response) {
			meta.challengesr1 = {} ;
			meta.challengesr1 = JSON.parse(response);
			$("#challenge-txt").html("No challenge available");
			createChallengeTextHtml();
			loadRounds();

			
			
			
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
	
	
	
	/*Round 2*/
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadChallenegesR2",
			data : ""
		},
		success : function(response) {
			meta.challengesr2 = {} ;
			meta.challengesr2 = JSON.parse(response);
			$("#challenge-txt2").html("No challenge available");
			createChallengeTextHtmlR2();

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
	/*Round 3*/
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadChallenegesR3",
			data : ""
		},
		success : function(response) {
			meta.challengesr3 = {} ;
			meta.challengesr3 = JSON.parse(response);
			$("#challenge-txt3").html("No challenge available");
			createChallengeTextHtmlR3();

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
}

function loadTeammate(){
	
	var data = { userid :"57"} ;
	
	$.ajax({
		type : 'POST',
		url : 'server/player.php',
		data : {
			type : "loadTeammate",
			data : data
		},
		success : function(response) {
			
			meta.teammate = {} ;			
			meta.teammate = JSON.parse(response);
           
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
	
}

function loadTeamsC(){
	
	var data = { userid :"57"} ;
	
	$.ajax({
		type : 'POST',
		url : 'server/player.php',
		data : {
			type : "loadTeamsC",
			data : ''
		},
		success : function(response) {
			
			meta.teamsc = {} ;			
			meta.teamsc = JSON.parse(response);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
	
}

function loadRounds(){
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadRounds",
			data : ""
		},
		success : function(response) {
			meta.rounds = {} ;
			meta.rounds = JSON.parse(response);
			getCompleteChallenges();

		}
	});
	

}

function createChallengeTextHtml(){
	
	if(!meta.challenges || meta.challenges.length == 0){
		$("#challenge-txt").html("No challenge available");
		return ;
	}
	
	var html = "<table class='table-hover table-striped table-bordered'>";
	html += "<tr><th class='col-md-1' style='background:#4BADC8'>Challenge</th><th class='col-md-1' style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8' class='col-md-1'>End Date</th><th style='background:#4BADC8' class='col-md-3'>Challenge Text</th><th style='background:#4BADC8' class='col-md-2'>Learning Obj</th><th style='background:#4BADC8' class='col-md-3'>Tutorial Url</th></tr>";
	for(var i in meta.challenges){
		
		var url = meta.challenges[i].Tutorial_url;
				var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid != null) {
				   console.log("video id = ",videoid[1]);
				} else { 
					console.log("The youtube url is not valid.");
				}
		var youtubevidid = videoid[1];
				
		html +=  "<tr><td>"+meta.challenges[i].name + "</td><td> "+ meta.challenges[i].startDate+ "</td><td> "+ meta.challenges[i].endDate+  "</td><td>"+ meta.challenges[i].text+ "</td><td>"+ meta.challenges[i].Learning_obj+ "</td><td><iframe width='100%' height='150' src='https://www.youtube.com/embed/"+youtubevidid+"'></iframe></td></tr>";
		break;
		
	}
	
	html +="</table>"
		
	$("#challenge-txt").html(html);
	
	for(var j in meta.challenges){
		
		var url1 = meta.challenges[j].intro_video;
				var videoid1 = url1.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid1 != null) {
				   console.log("video id = ",videoid1[1]);
				} else { 
					console.log("The youtube url is not valid.");
				}
		var youtubevidid1 = videoid1[1];
				
		html1 =  "<iframe class='embed-responsive-item' width='100%' height='350' src='https://www.youtube.com/embed/"+youtubevidid1+"' allowfullscreen></iframe>";
		break;		
	}
	
	$("#intro_video").html(html1);
}


function showWinners(){
	
	$("#winner-body").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showWinners",
			data : ""
		},
		success : function(response) {
			
			var result  = JSON.parse(response);
			
			var html = "";
			for(var i in result){
				
				html += '<tr>';
			    	html += '<td> '+result[i].teamname+' </td> ';
			    	html += '<td> '+result[i].score+' </td> ';
			    	html += '<td> 1 </td> ';
			    	html += '<td> '+result[i].county+'</td> ';
			  	html += '</tr>';
				
			}
			
			$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}



function getTodaysChallenge(){
	
	$("#winner-body").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTodaysChallenge",
			data : ""
		},
		success : function(response) {
			
			var result = JSON.parse(response);
			for(var i in result){
				
				getWinners(result[i])
			}

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}

function getWinners(challenge){
	
	var groupBy = "";
	
	if(!isRoundCompleted(challenge.round)){
		return ;
	}
	
	if(challenge.round == "1"){
		
		
		groupBy =  "county";
	}
	
	if(challenge.round == "2"){
		groupBy =  "state";
	}
	
	if(challenge.round == "3"){
		groupBy =  "state";
	}
	
	
	var data = {cid : challenge.id , groupBy : groupBy } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getWinners",
			data : data
		},
		success : function(response) {
			meta.users = {} ;
			var result  = JSON.parse(response);
			
			var html = "";
			for(var i in result){
				
				html += '<tr>';
			    	html += '<td> '+result[i].teamName+' </td> ';
			    	html += '<td> '+result[i].rating+' </td> ';
			    	html += '<td> '+challenge.round+' </td> ';
			    	html += '<td> '+challenge.name+' </td> ';
			  	html += '</tr>';
				
			}
			
			$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}

function getCompleteChallenges(){
	
	var data = { };
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getCompletedChallenges",
			data : ""
		},
		success : function(response) {
				
				meta.comletedChallenges = {} ;
				meta.completedChallenges = JSON.parse(response);

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}


function isRoundCompleted(round){
	
	var roundChallanges = 0 ;
	for(var i in meta.rounds){
		if(round == meta.rounds[i].round){
			roundChallanges = meta.rounds[i].challenges ;
		}
	}
	
	for(var i in meta.completedChallenges){
		if(round == meta.completedChallenges[i].round){
			if(roundChallanges == meta.completedChallenges[i].counter){
				return true ;
			} 
		}
	}
	
	return false ;
}


/* Round 2 */
function createChallengeTextHtmlR2(){
	
	if(!meta.challengesr2 || meta.challengesr2.length == 0){
		$("#challenge-txt2").html("No challenge available");
		return ;
	}
	
	var html = "<table class='table table-hover table-striped'>";
	html += "<tr><th class='col-md-1' style='background:#4BADC8'>Challenge</th><th class='col-md-1' style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8' class='col-md-1'>End Date</th><th style='background:#4BADC8' class='col-md-3'>Challenge Text</th><th style='background:#4BADC8' class='col-md-2'>Learning Obj</th><th style='background:#4BADC8' class='col-md-3'>Tutorial Url</th></tr>";
	for(var i in meta.challengesr2){
		var url = meta.challengesr2[i].Tutorial_url
				var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid != null) {
				   console.log("video id = ",videoid[1]);
				} else { 
					console.log("The youtube url is not valid.");
				}
		var youtubevidid = videoid[1];
		
		html +=  "<tr><td>"+meta.challengesr2[i].name + "</td><td> "+ meta.challengesr2[i].startDate+ "</td><td> "+ meta.challengesr2[i].endDate+  "</td><td>"+ meta.challengesr2[i].text+ "</td><td>"+ meta.challengesr2[i].Learning_obj+ "</td><td><iframe width='100%' height='150' src='https://www.youtube.com/embed/"+youtubevidid+"'></iframe></td></tr>";
		break;
		
	}
	
	html +="</table>"
		
		$("#challenge-txt2").html(html);
		
	for(var j in meta.challengesr2){
		
		var url2 = meta.challengesr2[j].intro_video
				var videoid2 = url2.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid2 != null) {
				   console.log("video id = ",videoid2[1]);
				} else { 
					console.log("The youtube url is not valid.");
				}
		var youtubevidid2 = videoid2[1];
				
		html2 =  "<iframe class='embed-responsive-item' width='100%' height='350' src='https://www.youtube.com/embed/"+youtubevidid2+"' allowfullscreen></iframe>";
		break;		
	}
	
	$("#intro_video2").html(html2);	
}

function showWinnersR2(){
	
	$("#winner-body").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showWinnersR2",
			data : ""
		},
		success : function(response) {
			
			var result  = JSON.parse(response);
			
			var html = "";
			for(var i in result){
				
				html += '<tr>';
			    	html += '<td> '+result[i].teamname+' </td> ';
			    	html += '<td> '+result[i].score+' </td> ';
			    	html += '<td> 1 </td> ';
			    	html += '<td> '+result[i].county+'</td> ';
			  	html += '</tr>';
				
			}
			
			$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}


function createChallengeTextHtmlR3(){
	
	if(!meta.challengesr3 || meta.challengesr3.length == 0){
		$("#challenge-txt3").html("No challenge available");
		return ;
	}
	
	var html = "<table class='table table-hover table-striped'>";
	html += "<tr><th class='col-md-1' style='background:#4BADC8'>Challenge</th><th class='col-md-1' style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8' class='col-md-1'>End Date</th><th style='background:#4BADC8' class='col-md-3'>Challenge Text</th><th style='background:#4BADC8' class='col-md-2'>Learning Obj</th><th style='background:#4BADC8' class='col-md-3'>Tutorial Url</th></tr>";
	for(var i in meta.challengesr3){
		var url = meta.challengesr3[i].Tutorial_url;
				var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid != null) {
				   console.log("video id = ",videoid[1]);
				} else { 
					console.log("The youtube url is not valid.");
				}
		var youtubevidid = videoid[1];
		
		html +=  "<tr><td>"+meta.challengesr3[i].name + "</td><td> "+ meta.challengesr3[i].startDate+ "</td><td> "+ meta.challengesr3[i].endDate+  "</td><td>"+ meta.challengesr3[i].text+ "</td><td>"+ meta.challengesr3[i].Learning_obj+ "</td><td><iframe width='100%' height='150' src='https://www.youtube.com/embed/"+youtubevidid+"'></iframe></td></tr>";
		break;
		
	}
	
	html +="</table>"
		
		$("#challenge-txt3").html(html);
		
		for(var j in meta.challengesr3){
		
		var url3 = meta.challengesr3[j].intro_video;
				var videoid3 = url3.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid3 != null) {
				   console.log("video id = ",videoid3[1]);
				} else { 
					console.log("The youtube url is not valid.");
				}
		var youtubevidid3 = videoid3[1];
				
		html3 =  "<iframe class='embed-responsive-item' width='100%' height='350' src='https://www.youtube.com/embed/"+youtubevidid3+"' allowfullscreen></iframe>";
		break;		
	}
	
	$("#intro_video3").html(html3);	
}





function showWinnersR1(){
	
	user = sessionStorage.getItem("user");
	 
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var userstate = user.state;
	//alert(userstate);
	var data = { userstate : userstate  } ;
	$("#winner-body").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showWinners",
			data : data
		},
		success : function(response) {
			
			var result  = JSON.parse(response);
			
			var html = "";
			for(var i in result){
				
				html += '<tr>';
			    	html += '<td> '+result[i].teamname+' </td> ';
			    	html += '<td> '+result[i].score+' </td> ';
			    	html += '<td> 1 </td> ';
			    	html += '<td> '+result[i].county+'</td> ';
					html += '<td> '+user.state+'</td> ';
					html += '<td> '+result[i].org_name+'</td> ';
			  	html += '</tr>';
				
			}
			
			$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}


function showWinnersAll(str){
	$("#admincountyval").show();
	user = sessionStorage.getItem("user");
	 
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	//var userstate = user.state;
	//alert(str);
	var data = { userstate : str  } ;
	$("#winner-body").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showWinnersAll",
			data : data
		},
		success : function(response) {
			
			var result  = JSON.parse(response);
			
			var html = "";
			for(var i in result){
				
				html += '<tr>';
			    	html += '<td> '+result[i].teamname+' </td> ';
			    	html += '<td> '+result[i].score+' </td> ';
			    	html += '<td> 1 </td> ';
			    	html += '<td> '+result[i].county+'</td> ';
					html += '<td> '+str+'</td> ';
					html += '<td> '+result[i].org_name+'</td> ';
			  	html += '</tr>';
				
			}
			
			$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}
function showWinnersAllAdminR2(str){
	
	user = sessionStorage.getItem("user");
	 
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	//var userstate = user.state;
	//alert(str);
	var data = { userstate : str  } ;
	$("#winner-bodyR2").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showWinnersAllAdminR2",
			data : data
		},
		success : function(response) {
			
			var result  = JSON.parse(response);
			
			var html = "";
			for(var i in result){
				
				html += '<tr>';
			    	html += '<td> '+result[i].teamname+' </td> ';
			    	html += '<td> '+result[i].score+' </td> ';
			    	html += '<td> 1 </td> ';
			    	html += '<td> '+result[i].county+'</td> ';
					html += '<td> '+result[i].state+'</td> ';
					html += '<td> '+result[i].org_name+'</td> ';
			  	html += '</tr>';
				
			}
			
			$("#winner-bodyR2").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}



function showWinnersAllAdminR3(){
	
	user = sessionStorage.getItem("user");
	 
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}

	$("#winner-bodyR3").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showWinnersAllAdminR3",
			data : ''
		},
		success : function(response) {
			
			var result  = JSON.parse(response);
			
			var html = "";
			for(var i in result){
				
				html += '<tr>';
			    	html += '<td> '+result[i].teamname+' </td> ';
			    	html += '<td> '+result[i].score+' </td> ';
			    	html += '<td> 1 </td> ';
			    	html += '<td> '+result[i].county+'</td> ';
					html += '<td> '+result[i].state+'</td> ';
					html += '<td> '+result[i].org_name+'</td> ';
			  	html += '</tr>';
				
			}
			
			$("#winner-bodyR3").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}

function showWinnersAllCounty(str){
	
	user = sessionStorage.getItem("user");
	 
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	
	var userstate = $('#adminstateval').val();
	//var userstate = user.state;
	//alert(userstate);
	var data = { userstate : userstate, usercounty: str   } ;
	$("#winner-body").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showWinnersAllCounty",
			data : data
		},
		success : function(response) {
			
			var result  = JSON.parse(response);
			
			var html = "";
			for(var i in result){
				
				html += '<tr>';
			    	html += '<td> '+result[i].teamname+' </td> ';
			    	html += '<td> '+result[i].score+' </td> ';
			    	html += '<td> 1 </td> ';
			    	html += '<td> '+result[i].county+'</td> ';
					html += '<td> '+userstate+'</td> ';
					html += '<td> '+result[i].org_name+'</td> ';
			  	html += '</tr>';
				
			}
			
			$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}

function saveinvoice(){
	
	var email_name = $.session.get("sessemail");
	var Org_name = $.session.get("sessorg");
	var getcurrdate = $.session.get("getcurrdate");
	//alert(email_name);
	//var Org_name = $('#Org_name').val();
//	var cust_name = $('#cust_name').val();
	//var registrations_fee = '20';
	//var is_student = $('#is_student').val();
	var no_students = $('#no_students').val();
	var fullName = $('#fullname').html();
	var lastName = $('#lastname').html();
	//alert(fullName);
	var clasnotot = $('#finaltotal').html();
	//alert(clasnotot);
	
	var data = {Org_name : Org_name , fullName : fullName, lastName : lastName, no_students: no_students, email_name:email_name,clasnotot : clasnotot,getcurrdate: getcurrdate } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "saveInvoice",
			data : data
		},
		success : function(response) {
			//alert(response);
			alert("Invoice Generated Sucesfully");
			window.location.href = "confirmation.html";
			//$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
}

function saveinvoice2(){
	 var user = sessionStorage.getItem("user");
	  user = JSON.parse(user);
	  
	var email_name = user.email;
	var Org_name = user.org_name;
	var getcurrdate = $.session.get("getcurrdate");
	//alert(email_name);
	//var Org_name = $('#Org_name').val();
//	var cust_name = $('#cust_name').val();
	//var registrations_fee = '20';
	//var is_student = $('#is_student').val();
	var no_students = $('#no_students').html();
	var fullName = $('#fullname').html();
	var lastName = $('#lastname').html();
	//alert(fullName);
	var clasnotot = $('#finaltotal').html();
	var p_student = $('#paid_students').val();
	//alert(p_student);
	
	var data = {Org_name : Org_name , fullName : fullName, lastName : lastName, no_students: no_students, email_name:email_name,clasnotot : clasnotot,getcurrdate: getcurrdate, payeestudent: p_student } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "saveInvoice2",
			data : data
		},
		success : function(response) {
			//alert(response);
			alert("Invoice Generated Sucesfully");
			window.location.href = "coach.html";
			//$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
}

function goinvoice(){
	
	
    var searchIDs = $("input:checkbox:checked").map(function(){
        return this.value;
    }).toArray();
    
   // alert(searchIDs);
                   
  
  
	var currentUrl = 'invoice2.html';

    var newUrl = currentUrl + "?no=" + $('#no_students').val()+"&id="+searchIDs;
		
   window.location.href = newUrl;
}