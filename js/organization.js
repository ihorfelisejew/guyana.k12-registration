var user  = null ;
var team_players = [] ;
var teamsids =[];
var cur_org='';
$(document).ready(function() {

	 user = sessionStorage.getItem("user");
	
	
		
	if(user != undefined && user != ""){
		user = JSON.parse(user);
		$("#name").html(user.name);
		$("#email").html(user.email);
		
		if(user.role_id =="1"){
			$("#role").html("Coach");
		}
		if(user.role_id =="2"){
			$("#role").html("Player");
		}
		if(user.role_id =="3"){
			$("#role").html("Judge");
		}
		if(user.role_id =="4"){
			$("#role").html("Organization");
		}
		if(user.role_id =="6"){
			$("#role").html("Master Account");
		}
		$("#user").val(user.id);
		$("#dp").attr("src","server/uploads/"+user.picUrl.trim());
		
		var data = { orgId : user.id};
		$(".coachTable").hide();
		
		//alert('hiii');
		$.ajax({
			type : 'POST',
			url : 'server/user.php',
			data : {
				type : "loadCoachOrganizationM",
				data : data
			},
			success : function(response) {
				//alert(response);
				console.log(response);
				var response = JSON.parse(response);
				for(var i in response){
					var html ="";
					html +='<li><a href="javascript:void(0)" onclick="loadTeam(this)" data-coachId="'+response[i].id+'">'+response[i].name+'</a></li>';					
					$("#coach-listM").append(html);
				}

			},
			error : function(data) {
				alert("Server Error please contact admin")
			}
		});
		
		$.ajax({
			type : 'POST',
			url : 'server/user.php',
			data : {
				type : "loadCoachOrganizationMaster",
				data : data
			},
			success : function(response) {
				//alert(response);
				console.log(response);
				var response = JSON.parse(response);
				for(var i in response){
					var html ="";
					html +='<li><a href="javascript:void(0)" onclick="loadTeam(this)" data-coachId="'+response[i].id+'">'+response[i].name+'</a></li>';					
					$("#coach-list").append(html);
				}

			},
			error : function(data) {
				alert("Server Error please contact admin")
			}
		});
		
	
	
		$.ajax({
			type : 'POST',
			url : 'server/user.php',
			data : {
				type : "loadCoachOrganizationMaster1",
				data : data
			},
			success : function(response1) {
				//alert('ssssssssssssssssssss');
				//alert(response1);
				var response1 = JSON.parse(response1)
				//console.log(response1);e1);
				for(var i in response1){
					var html ="";
					html +='<li><a href="javascript:void(0)" onclick="Organization_Report(this)" data-mastId="'+response1[i].id+'">'+response1[i].org_name+'</a></li>';
					//cur_org=response1[i].name;					
					$("#coach-list1").append(html);
				}

			},
			error : function(data) {
				alert("Server Error please contact admin")
			}
		});

	}
	
	var options = { 
		  // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			resetForm: true        // reset the form after successful submit 
		}; 
		
	 $('#MyUploadForm').submit(function() { 
	 
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		});
		
	//Organization_Report();	

});

function afterSuccess(data)
{

	$('#submit-btn').show(); //hide submit button
	$('#loading-img').hide(); //hide submit button
	
	$("#dp").attr("src","server/uploads/"+data.trim());
	user.picUrl = data.trim() ;
	var obj = JSON.stringify(user);
	sessionStorage.setItem("user", obj);

}

function beforeSubmit(){
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
	   
		if( !$('#FileInput').val()) //check empty input filed
		{
			$("#output").html("Are you kidding me?");
			return false
		}
		
		var fsize = $('#FileInput')[0].files[0].size; //get file size
		var ftype = $('#FileInput')[0].files[0].type; // get file type
		

		//allow file types 
		switch(ftype)
        {
            case 'image/png': 
			case 'image/gif': 
			case 'image/jpeg': 
             break;
            default:
                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
				return false
        }
		
		//Allowed file size is less than 5 MB (1048576)
		if(fsize>5242880) 
		{
			$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
			return false
		}
				
		$('#submit-btn').hide(); //hide submit button
		$('#loading-img').show(); //hide submit button
		$("#output").html("");  
	}
	else
	{
		//Output error to older unsupported browsers that doesn't support HTML5 File API
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
}

//progress bar function
function OnProgress(event, position, total, percentComplete)
{
    //Progress bar

}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}


function getTeamRanking(){
	
	user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var teamId = teamsids.toString();
	var usercouty = user.county;
	//alert(usercouty);
	var data = { teamIds :teamId, usercouty :usercouty  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTeamRanking1",
			data : data
		},
		success : function(response) {
		
		
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].name+"</td>"
						html+="<td>"+data[i].rating+"</td>"
						html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
						html+="<td>"+data[i].org_name+"</td>"
					html+="</tr>"
					
					
				}
				
				$("#standings").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}


function leagueTeamByOrg(){
	
	 user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var teamId = teamsids.toString();
	var userorgid = user.org_id;
	//alert(userorgid);
	var data = { teamIds :teamId, userorgid :userorgid  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "leagueTeamByOrg",
			data : data
		},
		success : function(response) {
		
		
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].name+"</td>"
						html+="<td>"+data[i].rating+"</td>"						
						html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
						html+="<td>"+data[i].org_name+"</td>"
					html+="</tr>"
					
					
				}
				
				$("#standings").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

function loadTeam(element){
	$(".coachTable").hide();
	var coachId = $(element).data("coachid");
	var data = { coachId : coachId};
	//alert(coachId);
	$("#standingBtn").hide();
	
	$('#changeReportData').attr('onclick', 'showAttendanceReport('+coachId+')');
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadTeams",
			data : data
		},
		success : function(response) {
			
			$("#teamList").html("");
			var response = JSON.parse(response);
			for(var i in response){
				//alert(response[i].name);
				$(".coachTable").show();
				var html= "<tr>";
					html +="<td>"+response[i].id+"</td>";
					html +="<td>"+response[i].name+"</td>";
					html +="<td>"+response[i].userfname+' '+response[i].last_name+"</td>";
					html +='<td><button onclick="loadPlayers(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addPlayer" type="button" class="btn btn-warning" > Players</button></td>';
					html +='<td><div id="score'+response[i].id+'" ></div><button onclick="loadScore(this)" data-teamId="'+response[i].id+'" data-toggle="" data-target="#scorePP" type="button" class="btn btn-warning" >Team Average Score</button></td>';
					
				html += "</tr>";
				//alert(html);
				teamsids.push(response[i].id);
				$("#standingBtn").show();
				$("#teamlist").append(html);
			}		
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}

function loadScore(element){
	


	var teamId = $(element).data("teamid");

	
	var data = { teamId :teamId } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTeamRating",
			data : data
		},
		success : function(response) {
			$("#video-list").html("");
		
			if(response != ""){
				var data = JSON.parse(response);
				if( data[0].rating == null){
					$("#score"+teamId).html(""+0);
				}else{
					//var score = data[0].rating / meta.challenges.length ;
					
					//$("#score").html(""+score);
					var rating = data[0].rating ;
					var creativity = data[0].creativity ;
					var artistic = data[0].artistic ;
					var logic = data[0].logic ;
					var problem_solved = data[0].problem_solved ;
					
					$("#score"+teamId).html("<table class='table' style='color: #000;'><tr><th>Rating</th><th>creativity</th><th>artistic</th><th>logic</th><th>problem_solved</th></tr><tr><td>"+rating+"</td><td>"+creativity+"</td><td>"+artistic+"</td><td>"+logic+"</td><td>"+problem_solved+"</td></tr></table>");
				}
				
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}



function loadPlayers(element){
	
	var teamId = $(element).data("teamid");
	$("#addPlayerBtn").data("teamid",teamId);
	
	var data = { teamId :teamId } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "loadPlayers",
			data : data
		},
		success : function(response) {
			
			team_players = [] ;
			
			$("#dd-players").html("<option value='-1'>Select Player</option>");
			$("#players-list").html("");
			for(var i in meta.users){
				if(meta.users[i].role_id == "2"){
					$("#players-list").append("<option value="+meta.users[i].id+">"+meta.users[i].name+"</option>");
				}
			}
			
			if(response != ""){
				var players = JSON.parse(response);
				$("#players-list").html("");
				for(var i in players){
					
						team_players.push(players[i]);
						$("#players-list").append("<li>"+players[i].name+"</li>");
					
				}
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}


function getTeamRankingOr1(){
	//alert('rrrrrrrr');
	 user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var teamId = teamsids.toString();
	var usercouty = user.county;
	var role_id = user.role_id;
	//alert('ggg');
	//alert(teamId);
	var data = { teamIds :teamId, usercouty :usercouty, role_id: role_id  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTeamRanking1",
			data : data
		},
		success : function(response) {
		
		
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].name+"</td>"
						html+="<td>"+data[i].rating+"</td>"
						html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
						html+="<td>"+data[i].county+"</td>"
						html+="<td>"+data[i].state+"</td>"
						html+="<td>"+data[i].org_name+"</td>"
					html+="</tr>"
					
					
				}
				
				$("#standings").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

function getTeamRankingOR2(){
	
	 user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	//var teamId = teamsidsr2.toString();
	var userstate = user.state;
	//alert(usercouty);
	var data = { userstate :userstate  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTeamRankingR2",
			data : data
		},
		success : function(response) {
		
		
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].name+"</td>"
						html+="<td>"+data[i].rating+"</td>"
						html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
						html+="<td>"+data[i].county+"</td>"
						html+="<td>"+data[i].state+"</td>"
						html+="<td>"+data[i].org_name+"</td>"
					html+="</tr>"
					
					
				}
				
				$("#standingsR2").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

function getTeamRankingOR3(){
	
	 user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	//var teamId = teamsidsr3.toString();
	
	var data = {  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTeamRankingR3",
			data : ''
		},
		success : function(response) {
		
		
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].name+"</td>"
						html+="<td>"+data[i].rating+"</td>"
						html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
						html+="<td>"+data[i].county+"</td>"
						html+="<td>"+data[i].state+"</td>"
						html+="<td>"+data[i].org_name+"</td>"
					html+="</tr>"
					
					
				}
				
				$("#standingsR3").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

function leagueTeamByOrgMR1(){
	
	 user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var teamId = teamsids.toString();
	var userorgid = user.id;
	//alert(userorgid);
	var data = { teamIds :teamId, userorgid :userorgid  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "leagueTeamByOrg",
			data : data
		},
		success : function(response) {
		
		
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].name+"</td>"
						html+="<td>"+data[i].rating+"</td>"						
						html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
						html+="<td>"+data[i].county+"</td>"
						html+="<td>"+data[i].state+"</td>"
						html+="<td>"+data[i].org_name+"</td>"
					html+="</tr>"
					
					
				}
				
				$("#standings").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}


function leagueTeamByOrgMR2(){
	
	 user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var teamId = teamsids.toString();
	var userorgid = user.id;
	//alert(userorgid);
	var data = { teamIds :teamId, userorgid :userorgid  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "leagueTeamByOrgR2",
			data : data
		},
		success : function(response) {
		
		
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].name+"</td>"
						html+="<td>"+data[i].rating+"</td>"						
						html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
						html+="<td>"+data[i].county+"</td>"
						html+="<td>"+data[i].state+"</td>"
						html+="<td>"+data[i].org_name+"</td>"
					html+="</tr>"
					
					
				}
				
				$("#standings").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

function leagueTeamByOrgMR3(){
	
	 user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var teamId = teamsids.toString();
	var userorgid = user.id;
	//alert(userorgid);
	var data = { teamIds :teamId, userorgid :userorgid  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "leagueTeamByOrgR3",
			data : data
		},
		success : function(response) {
		
		
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].name+"</td>"
						html+="<td>"+data[i].rating+"</td>"						
						html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
						html+="<td>"+data[i].county+"</td>"
						html+="<td>"+data[i].state+"</td>"
						html+="<td>"+data[i].org_name+"</td>"
					html+="</tr>"
					
					
				}
				
				$("#standings").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}



function showWinnersOR1(){
	user = sessionStorage.getItem("user");
	 
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var userstate = user.state;
	var usercounty = user.county;
	
	var data = { userstate : userstate, usercounty: usercounty  } ;
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



function showWinnersAllOR2(){
	user = sessionStorage.getItem("user");
	 
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	var userstate = user.state;
	
	var data = { userstate : userstate  } ;
	$("#winner-body").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showWinnersAllR2",
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
			
			$("#winner-bodyR2").append(html);

		},
		error : function(data) {
			alert("Server Error please contact admin");
		}
	});
	

	
}







function showAttendanceReport(coachid){
	//alert('rrrrrrrr');
	 user = sessionStorage.getItem("user");
	
	if(user != undefined && user != ""){
		user = JSON.parse(user);
	}
	//alert('ggg');
	
	if(coachid === null || coachid === undefined){
		coachid = user.id;
		actype = 'master';
	}else{
		coachid = coachid;
		actype = 'org';
	}
	//alert(coachid);
	//alert(coachid);
	var data = { userId :coachid, acctype :actype } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "showAttendanceReport1",
			data : data
		},
		success : function(response) {
			console.log(response);
			//alert(response);
			if(response != ""){
				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					html+="<tr>"
						html+="<td>"+data[i].org_name+"</td>"
						html+="<td>"+data[i].coach_name+"</td>"
						html+="<td>"+data[i].team_name+"</td>"
						html+="<td>"+data[i].lessionname+"</td>"
						html+="<td>"+data[i].date+"</td>"					
					html+="</tr>"
					
					
				}
				
				$("#Attendance_Report").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}




function Organization_Report(element){
	//alert('rrrrrrrr');
	//  user = sessionStorage.getItem("user");
	
	 var orgId = $(element).data("mastid");
	// alert(orgId);
	// alert (coachId);
	// // console.log($(element).data);
	// if(user != undefined && user != ""){
	// 	user = JSON.parse(user);
	// }
	// var teamId = teamsids.toString();
	// var usercouty = user.county;
	// var role_id = user.role_id;
	// //alert('ggg');
	// //alert(teamId);
	// var data = { teamIds :teamId, usercouty :usercouty, role_id: role_id} ;
	// $.ajax({
	// 	type : 'POST',
	// 	url : 'server/coach.php',
	// 	data : {
	// 		type : "Organization_Report",
	// 		data : data
	// 	},
	// 	success : function(response) {
		
		
	// 		if(response != ""){
	// 			var data = JSON.parse(response);
	// 			var html ="";
	// 			for(var i in data){
	// 				html+="<tr>"
	// 					html+="<td>"+data[i].org_name+"</td>"
	// 					html+="<td>"+data[i].name+"</td>"
	// 					html+="<td>"+data[i].rating+"</td>"
	// 					html+="<td>"+data[i].userfname+' '+data[i].last_name+"</td>"
	// 					html+="<td>"+data[i].county+"</td>"
	// 				html+="</tr>"
					
	// 			}
				
	// 			$("#Organization_Report").html(html)
	// 		}

	// 	},
	// 	error : function(data) {
	// 		alert("Server Error please contact admin")
	// 	}
	// });
	
	//user = sessionStorage.getItem("user");
	var data = { userId :user.id, orgId : orgId} ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "Organization_Report",
			data : data
		},
		success : function(response) {
			//alert('vvv');
			console.log(response);
			var cnt=0;
			if(response != ""){

				var data = JSON.parse(response);
				var html ="";
				for(var i in data){
					cnt++;
					html+="<tr>"
						html+="<td>"+data[i].org_name+"</td>"
						html+="<td>"+data[i].coach_name+"</td>"	
						html +='<td><p id="score'+data[i].team_id+'" class="btn label label-danger" onclick="loadScoreR(this)"  data-mastId="'+data[i].organization_id+'" '+'data-teamId="'+data[i].team_id +'">' +'View Score</p></td>';							
						html+="<td>"+data[i].team_name+"</td>"	
						html+="<td>"+data[i].county+"</td>"	
					html+="</tr>"							
				}
				$("#Organization_Report").html(html)
			}
			if(cnt<1) alert("The organization has no teams");

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}


function loadScoreR(element){

    var mastId = $(element).data("mastid");
    var teamId = $(element).data("teamid");
   // alert(teamId);
    var data = { mastId :mastId, teamid : teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getTeamRatingR",
            data : data
        },
        success : function(response) {
			console.log(response);
			//alert(response);
            $("#video-list").html("");

            if(response != ""){
                var data = JSON.parse(response);
                if( data[0].rating == null){
                    $("#score"+teamId).html(""+0);
                }else{
                	$("#score"+teamId).html(""+data[0].rating);
                    // var rating = data[0].rating ;
                    // var creativity = data[0].creativity ;
                    // var artistic = data[0].artistic ;
                    // var logic = data[0].logic ;
                    // var problem_solved = data[0].problem_solved ;

                    // $("#score"+mastId).html("<table class='table' style='color: #000;'><tr><th>Rating</th><th>creativity</th><th>artistic</th><th>logic</th><th>problem_solved</th></tr><tr><td>"+rating+"</td><td>"+creativity+"</td><td>"+artistic+"</td><td>"+logic+"</td><td>"+problem_solved+"</td></tr></table>");
                }

            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}
