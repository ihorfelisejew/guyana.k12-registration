
var meta = {} ;

$(document).ready(function() {

	$("#header").load("header.html", function() {
		getLoggedInUser();
		$("#footer").load("footer.html");
	});	
 	
	getnewstickertext();
	getnewstickertext2();
	getnewstickertext3();
	getLessonCategories();
});


function getnewstickertext(){ 

	var newstickertext  = 'hello';
	var data = { newstickertext : newstickertext};
	//alert(role+subject+meaasge);
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getnewstickertext",
			data : data
		},
		success : function(response) {
			//alert(response);
			var response = JSON.parse(response);
			for(var i in response){
				var news = response[i].news;
				//alert(news);
				$('#newstickertext').val(news);
				$('#newstickermarq').html(news);				
			}
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}

function getnewstickertext2(){ 

	var newstickertext  = 'hello';
	var data = { newstickertext : newstickertext};
	//alert(role+subject+meaasge);
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getnewstickertext2",
			data : data
		},
		success : function(response) {
			//alert(response);
			var response = JSON.parse(response);
			for(var i in response){
				var news = response[i].news;
				//alert(news);
				$('#newstickertext2').val(news);
				$('#newstickermarq2').html(news);				
			}
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}

function getnewstickertext3(){ 

	var newstickertext  = 'hello';
	var data = { newstickertext : newstickertext};
	//alert(role+subject+meaasge);
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getnewstickertext3",
			data : data
		},
		success : function(response) {
			//alert(response);
			var response = JSON.parse(response);
			for(var i in response){
				var news = response[i].news;
				//alert(news);
				$('#newstickertext3').val(news);
				$('#newstickermarq3').html(news);				
			}
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}


// ** Utils Methods ** //
function check_decalre_winner(comp,id){
	var data = { comp : comp};
   
   	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "check_decalre_winner",
			data : data
		},
		success : function(response) {
		//	alert(response);
		  if(response == 1){
			$('#'+id).css('display','block');
		  }

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
}


function getLoggedInUser(){
	
	var user = sessionStorage.getItem("user");
//	alert(user);
	if(user != undefined && user != ""){
		
		user = JSON.parse(user);
		//alert(user.id);
		
		$("#user-top-pnl").show();
		$("#loggedUser-name").html(user.name);
		$("#login-reg-pnl").hide();
		
		return $.when(
			loadUsers(),
			loadTeammate(),
			loadPlayersList(),
			loadPlayersListAll(),
			loadAdminPlayersListAll(),
			loadTeamsC()
		)
		
		//loadChatUsers(user.id);
		
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
	
	return $.ajax({
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
	
	
	return $.ajax({
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
			console.log(meta.playerlistall)
               
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
}


function loadAdminPlayersListAll(){
	
	
	return $.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadAdminPlayersListAll",
			data : ""
		},
		
		success : function(response) {
		//	alert(response);
			meta.adminplayerlistall = {};
			meta.adminplayerlistall = JSON.parse(response);
               
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
}

function loadPlayersListAll(){
	
	//var teamId = $(element).data("teamid");
	
	
	return $.ajax({
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
	var ajx = [
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
	}),

	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadCompchallenges",
			data : ""
		},
		success : function(response) {
			//alert(response);
			meta.compchallenge = {} ;
			meta.compchallenge = JSON.parse(response);
			for(var i in meta.compchallenge){

            $("#compchlng-names").append("<option class='' value="+meta.compchallenge[i].id+">"+meta.compchallenge[i].name+"</option>");
            }
			createCompetitionTextHtml();
			 
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	}),
	
	
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadCompchallenges1",
			data : {userid: user.id}
		},
		success : function(response1) {
			//alert(response);
			meta.compchallenge1 = {} ;
			meta.compchallenge1 = JSON.parse(response1);
			
			createCompetitionTextHtml1();
			 
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	}),
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadCompetitions",
			data : ""
		},
		success : function(response) {
			
			meta.competition = {} ;
			meta.competition = JSON.parse(response);
			
			 for(var i in meta.competition){

            $("#comp-names").append("<option value="+meta.competition[i].m_comp_id+">"+meta.competition[i].m_comp_name+"</option>");
            }
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	}),
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadCompetitionHistory",
			data : ""
		},
		success : function(response) {
			//alert(response);
			meta.comphistory = {} ;
			meta.comphistory = JSON.parse(response);
			$("#comp-history").html("No challenge available");
			showCompetitionHistory();
			//loadRounds();
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	}),
	
	
	$.ajax({
		type : 'POST',
		url : 'server/player.php',
		data : {
			type : "loadCompTeam",
			data : ""
		},
		success : function(response) {
			meta.compteams = {} ;
			meta.compteams = JSON.parse(response);
			
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	}),
	
	$.ajax({
		type : 'POST',
		url : 'server/player.php',
		data : {
			type : "loadCompPlayer",
			data : ""
		},
		success : function(response) {
			meta.compplayer = {} ;
			meta.compplayer = JSON.parse(response);
			
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	}),
	
	
	
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
			console.log('!!!!!!!!!!!!!!')
			console.log( meta.challenges);
			$("#challenge-txt").html("No challenge available");
			createChallengeTextHtml();
			loadRounds();
		
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	}),
	
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadChallenegesJudge",
			data : ""
		},
		success : function(response) {
			//alert(response);
			meta.challengesJudge = {} ;
			meta.challengesJudge = JSON.parse(response);
			$("#challenge-txt-Judge").html("No challenge available");
			createChallengeTextHtmlJudge();
			//loadRounds();

			
			
			
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	}),
	
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadAllChallenges",
			data : {competition_id: user.competition_id}
		},
		success : function(response) {
			meta.allChallenges = {} ;
			console.log(response)
			meta.allChallenges = JSON.parse(response);
			$("#challenge-txt").html("No challenge available");
			createChallengeTextHtml();

			loadRounds();

			
			
			
		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	})
]

return $.when(...ajx)
	
	
	
	
	/*Round 2*/
	// $.ajax({
	// 	type : 'POST',
	// 	url : 'server/coach.php',
	// 	data : {
	// 		type : "loadChallenegesR2",
	// 		data : ""
	// 	},
	// 	success : function(response) {
	// 		meta.challengesr2 = {} ;
	// 		meta.challengesr2 = JSON.parse(response);
	// 		$("#challenge-txt2").html("No challenge available");
	// 		createChallengeTextHtmlR2();

	// 	},
	// 	error : function(data) {
	// 		alert("Server Error please contact admin");
	// 	}
	// }),
	
	
	
	// /*Round 3*/
	// $.ajax({
	// 	type : 'POST',
	// 	url : 'server/coach.php',
	// 	data : {
	// 		type : "loadChallenegesR3",
	// 		data : ""
	// 	},
	// 	success : function(response) {
	// 		meta.challengesr3 = {} ;
	// 		meta.challengesr3 = JSON.parse(response);
	// 		$("#challenge-txt3").html("No challenge available");
	// 		createChallengeTextHtmlR3();

	// 	},
	// 	error : function(data) {
	// 		alert("Server Error please contact admin");
	// 	}
	// });
	
	
	
}


function loadTeammate(){
	
	var data = { userid :"57"} ;
	
	return $.ajax({
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
	
	return $.ajax({
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
function createCompetitionTextHtml1(){
if(!meta.compchallenge1 || meta.compchallenge1.length == 0){
		$("#competition-txt1").html("No competition available");
		return ;
	}
	
	var html = "<table class='table-hover table-striped table-bordered'>";
	html += "<tr><th class='col-md-1' style='background:#4BADC8'>Challenge</th><th class='col-md-1' style='background:#4BADC8'>Competition</th><th class='col-md-1' style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8' class='col-md-1'>End Date</th><th style='background:#4BADC8' class='col-md-3'>Competition Text</th><th style='background:#4BADC8' class='col-md-2'>Learning Obj</th><th style='background:#4BADC8' class='col-md-3'>Tutorial Url</th></tr>";
	
	for(var i in meta.compchallenge1){
		
		var url = meta.compchallenge1[i].Tutorial_url;
				var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid != null) {
				  // console.log("video id = ",videoid[1]);
				} else { 
					//console.log("The youtube url is not valid.");
				}
		var youtubevidid = videoid[1];
				
		html +=  "<tr><td>"+meta.compchallenge1[i].m_comp_name + "</td><td>"+meta.compchallenge1[i].name + "</td><td> "+ meta.compchallenge1[i].startDate+ "</td><td> "+ meta.compchallenge1[i].endDate+  "</td><td>"+ meta.compchallenge1[i].text+ "</td><td>"+ meta.compchallenge1[i].Learning_obj+ "</td><td><iframe width='100%' height='150' src='https://www.youtube.com/embed/"+youtubevidid+"'></iframe></td></tr>";
		//break;
		
	}
	//alert(html);
	html +="</table>"

	$("#competition-txt1").html(html);
	
}
function createCompetitionTextHtml(){
	//alert(meta.compchallenge);
	
	if(!meta.compchallenge || meta.compchallenge.length == 0){
		$("#competition-txt").html("No competition available");
		return ;
	}
	
	var html = "<table class='table-hover table-striped table-bordered'>";
	html += "<tr><th class='col-md-1' style='background:#4BADC8'>Challenge</th><th class='col-md-1' style='background:#4BADC8'>Competition</th><th class='col-md-1' style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8' class='col-md-1'>End Date</th><th style='background:#4BADC8' class='col-md-3'>Competition Text</th><th style='background:#4BADC8' class='col-md-2'>Learning Obj</th><th style='background:#4BADC8' class='col-md-3'>Tutorial Url</th></tr>";
	
	for(var i in meta.compchallenge){
		
		var url = meta.compchallenge[i].Tutorial_url;
				var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid != null) {
				  // console.log("video id = ",videoid[1]);
				} else { 
					//console.log("The youtube url is not valid.");
				}
		var youtubevidid = videoid[1];
				
		html +=  "<tr><td>"+meta.compchallenge[i].m_comp_name + "</td><td>"+meta.compchallenge[i].name + "</td><td> "+ meta.compchallenge[i].startDate+ "</td><td> "+ meta.compchallenge[i].endDate+  "</td><td>"+ meta.compchallenge[i].text+ "</td><td>"+ meta.compchallenge[i].Learning_obj+ "</td><td><iframe width='100%' height='150' src='https://www.youtube.com/embed/"+youtubevidid+"'></iframe></td></tr>";
		//break;
		
	}
	//alert(html);
	html +="</table>"

	$("#competition-txt").html(html);
	
}

function declare_winner(id){
//	alert(id);
   var data = {compid : id } ;	
   $.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "declarewinners",
			data : data
		},
		success : function(response) {
			alert(response);
			location.reload();
		}
	});
}

function showCompetitionHistory(){
	//alert(meta.competition.length);
	if(!meta.comphistory || meta.comphistory.length == 0){
		$("#comp-history").html("No competition available");
		return ;
	}

var html ="";
	for(var i in meta.comphistory){
	  check_decalre_winner(meta.comphistory[i].m_comp_id, 'btn'+meta.comphistory[i].m_comp_id);
		
		html +=  "<tr><td>"+meta.comphistory[i].m_comp_name + "  <button onClick='declare_winner(this.title)' style='display:none' class='"+meta.comphistory[i].m_comp_id+"' title='"+meta.comphistory[i].m_comp_id+"'  id='btn"+ meta.comphistory[i].m_comp_id +"'>Declare Winner</button></td><td>"+ meta.comphistory[i].fname+ ' ' + meta.comphistory[i].lname + "</td><td>"+ meta.comphistory[i].teamname+ "</td></tr>";
		//break;
		
	}
	
	html +="</table>"

	$("#comp-history").html(html);
	
}


function createChallengeTextHtml(){
	
	if(!meta.challenges || meta.challenges.length == 0){
		$("#challenge-txt").html("No challenge available");
		return ;
	}
	
	const isPlayer = user.role_id == 2 ? true : false;

	var html = "<table class='table-hover table-striped table-bordered'>";
	html += `<tr>
	<th class='col-md-1' style='background:#4BADC8'>Challenge</th>
	<th class='col-md-1' style='background:#4BADC8'>Start Date</th>
	<th style='background:#4BADC8' class='col-md-1'>End Date</th>
	<th style='background:#4BADC8' class='col-md-3'>Challenge Text</th>
	<th style='background:#4BADC8' class='col-md-2'>Learning Obj</th>
	<th style='background:#4BADC8' class='col-md-3'>Intro Video & Tutorial Url</th>
	${ isPlayer ? "<th style='background:#4BADC8' class='col-md-2'>Submission</th>" : ''}
	</tr>`;
	for(var i in meta.challenges){
		let startDate = new Date(meta.challenges[i].startDate);
		let endDate = new Date(meta.challenges[i].endDate);
		let now = new Date().setHours(0, 0, 0, 0);
		if (startDate <= now && endDate >= now){

		const isYTLink = function(url){
			var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid != null) {
					return videoid[1];
				} else { 
					return false;
				}
			
		}
		
		const isLink = function(url){
			const regex = /^(https?:\/\/)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)$/;
			return regex.test(url);
			
		}
		
		
				
		
		
		meta.currentChallenge = meta.challenges[i]
		if(typeof preloadSubmission === "function"){

			preloadSubmission(meta.challenges[i], 'current challenge')

		}
		html +=  `<tr>
		<td>${meta.challenges[i].name }</td>
		<td> ${ meta.challenges[i].startDate}</td>
		<td> ${ meta.challenges[i].endDate}</td>
		<td>${ meta.challenges[i].text}</td>
		<td>${ meta.challenges[i].Learning_obj}</td>
		<td>
		<b style="display: block; margin-top:10px;">Intro Video:</b>${ isYTLink(meta.challenges[i].intro_video) ? `<iframe width='100%' height='150' src='https://www.youtube.com/embed/${isYTLink(meta.challenges[i].intro_video)}'></iframe>`: (isLink(meta.challenges[i].intro_video) ? `<a style="word-wrap: break-word;" href="${meta.challenges[i].intro_video}">${meta.challenges[i].intro_video}</a>` : `<span>${meta.challenges[i].intro_video}</span>` ) }<br> 

		<b style="display: block; margin-top:10px;">Tutorial Url:</b> ${ isYTLink(meta.challenges[i].Tutorial_url) ? `<iframe width='100%' height='150' src='https://www.youtube.com/embed/${isYTLink(meta.challenges[i].Tutorial_url)}'></iframe>`: (isLink(meta.challenges[i].Tutorial_url) ? `<a style="word-wrap: break-word;" href="${meta.challenges[i].Tutorial_url}">${meta.challenges[i].Tutorial_url}</a>` : `<span>${meta.challenges[i].Tutorial_url}</span>` ) }<br></td>
		

		${ isPlayer ? `
		<td id="current-challenge-submission">
		<a href="#" data-toggle="modal" data-target="#submission-modal" onclick="getSubmissionData(meta.challenges[${i}])">View my submission</a>
		</td>`: ''}
		</tr>`;

		$("#current-challenge-in-submission").html(`<span> ${meta.challenges[i].name}</span>`);


		break;	
		}
	}
	html +="</table>"
	$("#challenge-txt").html(html);
	
	
	
}

function createChallengeTextHtmlJudge(){
	
	if(!meta.challengesJudge || meta.challengesJudge.length == 0){
		$("#challenge-txt-Judge").html("No challenge available");
		return ;
	}
	
	var html = "<table class='table-hover table-striped table-bordered'>";
	html += "<tr><th class='col-md-1' style='background:#4BADC8'>Challenge</th><th class='col-md-1' style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8' class='col-md-1'>End Date</th><th style='background:#4BADC8' class='col-md-3'>Challenge Text</th><th style='background:#4BADC8' class='col-md-2'>Learning Obj</th><th style='background:#4BADC8' class='col-md-3'>Tutorial Url</th></tr>";
	for(var i in meta.challengesJudge){
		let startDate = new Date(meta.challengesJudge[i].startDate);
		let judgeBy = new Date(meta.challengesJudge[i].judge_by);
		let now = new Date().setHours(0, 0, 0, 0);
		if (startDate <= now && judgeBy >= now){
			console.log(meta.challengesJudge[i])

		
		$("#challenge-judge-by-date").html(meta.challengesJudge[i].judge_by);

		$("#challenge-name").html(meta.challengesJudge[i].name);
		$("#challenge-end-date").html(meta.challengesJudge[i].endDate);
		$("#challenge-tutorial-link a").attr("href", meta.challengesJudge[i].Tutorial_url);
		$("#challenge-tutorial-link a").html(meta.challengesJudge[i].Tutorial_url);
		$("#challenge-description").html(meta.challengesJudge[i].text);		
		break;
		}
	}
	
	
		
	$("#challenge-txt-Judge").html(html);
	
	for(var j in meta.challengesJudge){
		
		var url1 = meta.challengesJudge[j].intro_video;
				var videoid1 = url1.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
				if(videoid1 != null) {
				  // console.log("video id = ",videoid1[1]);
				} else { 
					//console.log("The youtube url is not valid.");
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
				  // console.log("video id = ",videoid[1]);
				} else { 
					//console.log("The youtube url is not valid.");
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
				  // console.log("video id = ",videoid2[1]);
				} else { 
					//console.log("The youtube url is not valid.");
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
				  // console.log("video id = ",videoid[1]);
				} else { 
					//console.log("The youtube url is not valid.");
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
				  // console.log("video id = ",videoid3[1]);
				} else { 
					//console.log("The youtube url is not valid.");
				}
		var youtubevidid3 = videoid3[1];
				
		var html3 =  "<iframe class='embed-responsive-item' width='100%' height='350' src='https://www.youtube.com/embed/"+youtubevidid3+"' allowfullscreen></iframe>";
		break;		
	}
	//alert('hiiiiiiii');
	$("#intro_video3").html('hiiiiiiiiii');	
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
	var org_id = user.org_id;
	var user_id = user.id;
	$('#user_id').val(user.id);
	var getcurrdate = $.session.get("getcurrdate");
	//alert(email_name);
	//var Org_name = $('#Org_name').val();
//	var cust_name = $('#cust_name').val();
	//var registrations_fee = '20';
	//var is_student = $('#is_student').val();
	var no_students = $('#no_students').html();
	var fullName = $('#fullname').html();
	var lastName = $('#lastname').html();
	//alert(org_id);
	var clasnotot = $('#finaltotal').html();
	var p_student = $('#paid_students').val();
	
	var invoice_id = $('#invoice_id').val();
	
	
	var data = {Org_name : Org_name , fullName : fullName, lastName : lastName, no_students: no_students, email_name:email_name,clasnotot : clasnotot,getcurrdate: getcurrdate, payeestudent: p_student,user_id:user_id, invoice_id:invoice_id,org_id:org_id } ;
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

function saveinvoicemain(){

	 /*var user = sessionStorage.getItem("user");
	  user = JSON.parse(user);
	  
	var email_name = user.email;
	var Org_name = user.org_name;
	var user_id = user.id;
	$('#user_id').val(user.id);
	var getcurrdate = $.session.get("getcurrdate");*/
	//alert(email_name);
	//var Org_name = $('#Org_name').val();
//	var cust_name = $('#cust_name').val();
	//var registrations_fee = '20';
	//var is_student = $('#is_student').val();
	var no_studentsmain = $('#no_studentsmain').val();
	var player_id = $('#player_id').val();
	var mobile_money = $('#mobile_money').val();
	var mobile_amount = $('#mobile_amount').val();	
	
    if (mobile_money == "") {
        alert("Mobile Money must be filled out");
        return false;
    }
	if (mobile_amount == "") {
        alert("Mobile Ammount must be filled out");
        return false;
    }
	
	var data = {no_studentsmain : no_studentsmain , player_id : player_id,mobile_money: mobile_money, mobile_amount: mobile_amount} ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "saveinvoicemain",
			data : data
		},
		success : function(response) {
			alert(response);
			alert("Confirmation Sucesfully");
			window.location.href = "coach.html";
			//$("#winner-body").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	
}
function gotoinvoice2(){

	var currentUrl12 = 'invoice2.html';

    var newUrl21 = currentUrl12 + "?no=" + $('#no_studentsmain').val()+"&id="+$('#player_id').val();
		
   window.location.href = newUrl21;
}
function goinvoice(){
	
	
    var searchIDs = $("input:checkbox:checked").map(function(){
        return this.value;
    }).toArray();
    
   // alert(searchIDs);
                   
  
  
	var currentUrl = 'invoicemain.html';

    var newUrl = currentUrl + "?no=" + $('#no_students').val()+"&id="+searchIDs;
		
   window.location.href = newUrl;
}

function loadRankings(){
    var data = { 
        competitionId : user.competition_id,
        user_org_id : user.org_id,
        user_state: user.state
    }
    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "loadRankings",
            data : data
        },
        success : function(response) {
            var res = JSON.parse(response);
            rankings = res;
            console.log(res);
            $('#rankingRoundSelect').html('');
            $('#competition-container').html('');
            res.forEach(comp => {
                $('#competition-container').append(`<div class="ranking-competition-name"><span>${comp.competition.competition_name}</span></div>`)
                for(var i in comp.roundsData){
                    $('#rankingRoundSelect').append(`<option value="${i}">ROUND ${i}</option>`);
                }
            });

            showRankingRound();
         




        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}

function showRankingRound(){
    let round = $('#rankingRoundSelect').val().toString();
    let r = rankings[0];
    $('#round-ends-on').html(r.roundsData[round]['max_judge_by']);
    
    $('#table-rankings-modal').html(`
        <div class="ranking-column-names">
            <div>
                <span>Ranking</span>
            </div>
            <div>
                <span>Team</span>
            </div>
            <div>
                <span>Total Score</span>
            </div>
        </div>
    `);
    let counter = 1;
    r.roundsData[round].teams.forEach(t=>{
       
            let row = `
                <div class="ranking-row">
                    <div>
                        <span class="ranking-number">${counter}</span>
                    </div>
                    <div class="team-container">
                        <span class="team-name">${t.name}</span>
                        <span class="team-county">${t.county}</span>
                        <span class="team-coach-name">${t.coach_name} ${t.coach_last_name}</span>
                    </div>
                    <div>
                        <span class="ranking-team-total">${t.total_points ? t.total_points +'pts': '0pts'}</span>
                    </div>
                </div>
            
            `;
            counter++;
            $('#table-rankings-modal').append(row);
        
    })


    
}

function getLessonCategories(){

	
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "getLessonCategories",
            data : ''
        },
        success : function(response) {
            var res = JSON.parse(response);
            rankings = res;
            console.log(res);
            res.forEach(l => {
                $('#select_lesson').append(`<option value="${l.category}">${l.category}</option>`)
            });
			
			lessionsList(res[0].category);

            $('#select_lesson').on('change', ()=>{
				lessionsList($('#select_lesson').val())
			})
         




        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
	
}