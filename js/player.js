var user  = null ;
var team_players = [] ;
var teamsids =[];
var userData = null;
var challengeList = null;
var rankings = null;
$(document).ready(function() {


	
	
	$('#BoostTeam').on('hidden.bs.modal', function () {
		// do something…
		location.reload();
	});

    // setInterval(function(){
    //     // $('.direct-chat-messages').html('');
    //     $.get('./server/chat.php?action=getHistoryChat&coach_id='+user.id+'&player=1',function(data){
    //         // console.log($.parseJSON(data));
    //          console.log(data);
    //         $arrobj = $.parseJSON(data);
    //         $i=1;
    //         for(var key in $arrobj){

    //             if($i > 1){
    //                 if(user.id != $arrobj[key]['from_id']){
    //                     $('.direct-chat-messages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left" style="width:100%">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text" style="width:55%">'+$arrobj[key]['msg']+'</div></div>');
    //                     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    //                 }else{
    //                     $('.direct-chat-messages').append('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 70%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text">'+$arrobj[key]['msg']+'</div></div></div>');
    //                     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    //                 }
    //             }else{
    //                 if(user.id != $arrobj[key]['from_id']){
    //                     $('.direct-chat-messages').html('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left" style="width:100%">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text" style="width:55%">'+$arrobj[key]['msg']+'</div></div>');
    //                     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    //                 }else{
    //                     $('.direct-chat-messages').html('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 70%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text">'+$arrobj[key]['msg']+'</div></div></div>');
    //                     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    //                 }
    //             }
    //             $i++;
    //         }
    //     });
    // },1000);

    user = sessionStorage.getItem("user");
	user1 = sessionStorage.getItem("user1");
	//alert(user);
   // console.log(user);
    if(user != undefined && user != ""){
        user = JSON.parse(user);
        userData = {...userData, user};
		user1 = JSON.parse(user1);
        $("#name").html(user.name);
		$("#last_name").html(user.last_name);
        $("#email").html(user.email);
        $("#league").html(user.league);
		$("#org_name").html(user.org_name_c);
		$("#coach_id").html(user.coach_name);
		
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
        $("#user").val(user.id);
        $("#dp").attr("src","server/uploads/"+user.picUrl.trim());


        var data = { coachId : user.id}
        $.ajax({
            type : 'POST',
            url : 'server/coach.php',
            data : {
                type : "loadTeamsR21",
                data : data
            },
            success : function(response) {
            //    alert(response);
				//console.log(response);
                var response = JSON.parse(response);
                for(var i in response){
                    var html= "<tr>";
                    html +="<td>"+response[i].team_id+"</td>";
                    html +="<td>"+response[i].teamname+"</td>";
                    html +="<td>"+response[i].name+" "+response[i].last_name+"</td>";
                    html +='<td></td>';
                    html +='<td></td>';
                    //html +='<td><button onclick="loadScore(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#scorePP" type="button" class="btn btn-default" >Team Average Score</button></td>';
                    html +='<td><p id="score" class="label label-danger" onclick="loadScore(this)" data-teamId="'+response[i].team_id+'" >View Score</p></td>'; 
					if(response[i].total_data < 1){
						html +='<td><p><a href="#" data-toggle="modal" data-target="#BoostTeam" onclick="loadquestion(this)" data-teamId="'+response[i].team_id+'">Boost Score</a></p></td>'; 
					}
                    html += "</tr>";

                    teamsids.push(response[i].id);
                    $("#coachList").append(html);
                }

            },
            error : function(data) {
                alert("Server Error please contact admin")
            }
        });
        
        data = {user_id: user.id}
        $.ajax({
            type : 'POST',
            url : 'server/coach.php',
            data : {
                type : "getPlayerDashboardData",
                data : data
            },
            success : function(response) {
                var res = JSON.parse(response);
				userData = {...userData, ...res};
                processPlayerDashboardData(userData);
            },
            error : function(data) {
                alert(data)
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


	
	getPlayers();
	lessionsList();
	lessionsList2();
	lessionsList3();
    getChallenges();
    getMatches();
	PlayerBand(user.id);
});


function processPlayerDashboardData(data){
    console.log(data)
    if (data.team.captain_id == data.user.id){
        $('#team_captain').css('display', 'block')
        
    } else{
        $('#team_captain').hide()
    }

    if (data.team.name){
        $('#team_name').html(data.team.name)
    }

    $('#average_team_score').html((data.team.average_score ? data.team.average_score : 0) +'pts')
    $('#team_total_points').html((data.team.total_points ? data.team.total_points : 0)+'pts')


}

function loadquestion(identifier){
	
	document.getElementById('timer').innerHTML = 01 + ":" + 00;
	startTimer();
	
	var teamId = $(identifier).data('teamid');
	//alert(teamId);
	
	var data = { userId : user.id, teamId:teamId}
	$.ajax({
		type : 'POST',
		url : 'server/player.php',
		data : {
			type : "loadquestion",
			data : data
		},
		success : function(response) {
		    //alert(response);
			//console.log(response);
			var response = JSON.parse(response);
			for(var i in response){
				var html= "<tr><td><img src='"+response[i].question+"' /></td></tr>";
				html +="<tr><td><label class='answerinputlabel'>Enter your answer (Type A,B,C or D)</label><input type='hidden' id='questionid' value='"+response[i].id+"' /><input type='text' id='your_answer' name='your_answer' class='answerinput' /><input type='hidden' id='teamIdPI' value='"+teamId+"' /></td></tr>";				
				$("#teamquestion").html(html);
                break;
			}
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
}



function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var m = timeArray[0];
  var s = checkSecond((timeArray[1] - 1));
  if(s==59){m=m-1}
  if(m<0){
		var html= "<tr><td><span style='color: #f00;text-align:center'>Your time is over, better luck next time !!</span></td></tr>";
		$("#teamquestion").html(html);
		$("#timerdiv").hide();	
	}
  
  document.getElementById('timer').innerHTML =
    m + ":" + s;
  setTimeout(startTimer, 1000);
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
}

 var clicks = 0;
function answerQuestion(){
	clicks += 1;
 //   alert(clicks);
	var your_answer = $('#your_answer').val();
	var questionid =  $('#questionid').val();
	var teamIdPI = $('#teamIdPI').val();
	//alert(teamIdPI);
	//alert('sss'+your_answer);
	var data = { }
	data.userId =  user.id;
	data.your_answer = your_answer;
	data.questionid = questionid;
	data.teamIdPI = teamIdPI;
	//alert(JSON.stringify(data));
	$.ajax({
		type : 'POST',
		url : 'server/player.php',
		data : {
			type : "answerQuestion",
			data : data
		},
		success : function(response) {
			//alert(response);
			//console.log(response);
			var response = JSON.parse(response);
			for(var i in response){
				var total = response[i].total;
				if(total >0){
					var html= "<tr><td><span style='color: #275419;text-align:center;font-weight: bold;'>Your Answer is Right Your team Score is Boosted to "+response[i].grade+" !!</span></td></tr>";
					$("#timerdiv").hide();	
					//setTimeout(function(){
					//	location.reload();
					//}, 5000);
					$('#BoostTeam').on('hidden.bs.modal', function () {
						// do something…
						location.reload();
					});					
				}else{
                    alert('Your Answer is wrong, try another question !!');
                    loadquestionagain(teamIdPI,clicks);
					//var html= "<tr><td><span style='color: #f00;text-align:center'>Your Answer is wrong, better luck next time !!</span></td></tr>";
					//$("#timerdiv").hide();	
                    
				}
			}
			$("#teamquestion").html(html);
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
}
function loadquestionagain(piteamid, piclick){
    
    
    var teamId = piteamid;
  //  alert(piteamid+piclick);
    
    var data = { userId : user.id, teamId:teamId, piclick: piclick}
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "loadquestionagain",
            data : data
        },
        success : function(response) {
           // alert(response);
           // console.log(response);
            var response = JSON.parse(response);
            for(var i in response){
                var html= "<tr><td><span style='color: #f00;text-align:center'>Your Answer is wrong, try another question !!</span></td></tr>";
                html= "<tr><td><img src='"+response[i].question+"' /></td></tr>";
                html +="<tr><td><label class='answerinputlabel'>Enter your answer (Type A,B,C or D)</label><input type='hidden' id='questionid' value='"+response[i].id+"' /><input type='text' id='your_answer' name='your_answer' class='answerinput' /><input type='hidden' id='teamIdPI' value='"+teamId+"' /></td></tr>";              
                $("#teamquestion").html(html);
                break;
            }
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}
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

function getChallenges(){
    
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "ChallangeList",
            data : "hello"
        },
        success : function(response) {
            
        // var html = "<tr><th style='background:#4BADC8'>Challenge</th><th style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8'>End Date</th><th style='background:#4BADC8'>Challenge Text</th></tr>";
        // $("#chng-list").html(html);
       
        var html = '';
        
        var response = JSON.parse(response);
        console.log(response)
        challengeList = response;
        for(var i in response){
        //html +='<li id="'+meta.users[i].id+'"><span>'+meta.challenges[i].name+' Start Date :'+meta.challenges[i].startDate+' , End Date : '+meta.challenges[i].endDate+' <span> ';
        // html +=  "<tr><td>"+response[i].name + "</td><td> "+ response[i].startDate+ "</td><td> "+ response[i].endDate+  "</td><td>"+ response[i].text+ "</td></tr>";
		let endDate = new Date(response[i].endDate);
		let now = new Date();
		if (response[i].endDate && response[i].startDate && endDate < now){
        html +=    `
            <div class="challenge inside-container">
				<div>
					<span>${response[i].name}</span>
					<span>ROUND ${response[i].round}</span>
				</div>
				<div>
					<span>${response[i].startDate} -<br> ${response[i].endDate}</span>
				</div>
				<div>
					<span id="challenge-total-score-${response[i].id}"> - </span>
				</div>
				<div id="challenge-submission-link-${response[i].id}">
					<a href="#" data-toggle="modal" data-target="#submission-modal" onclick="getSubmissionData(challengeList[${i}])">View my submission</a>
                    
				</div>
		</div>
        `   
        preloadSubmission(response[i], 'challenge history');
        }
        }
        
        $("#chng-list").html(html);
        
        

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}

function getMatches(){
    
    // $.ajax({
    //     type : 'POST',
    //     url : 'server/coach.php',
    //     data : {
    //         type : "getMatches",
    //         data : ""
    //     },
    //     success : function(response) {
            
    //     // var html = "<tr><th style='background:#4BADC8'>Challenge</th><th style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8'>End Date</th><th style='background:#4BADC8'>Challenge Text</th></tr>";
    //     // $("#chng-list").html(html);
       
    //     var html = '';
        
    //     var response = JSON.parse(response);
    //     console.log(response)
    //     challengeList = response;
    //     for(var i in response){
    //     //html +='<li id="'+meta.users[i].id+'"><span>'+meta.challenges[i].name+' Start Date :'+meta.challenges[i].startDate+' , End Date : '+meta.challenges[i].endDate+' <span> ';
    //     // html +=  "<tr><td>"+response[i].name + "</td><td> "+ response[i].startDate+ "</td><td> "+ response[i].endDate+  "</td><td>"+ response[i].text+ "</td></tr>";
	// 	let endDate = new Date(response[i].endDate);
	// 	let now = new Date();
	// 	if (endDate < now){
    //     html +=    `
    //         <div class="challenge inside-container">
	// 			<div>
	// 				<span>${response[i].name}</span>
	// 				<span>ROUND ${response[i].round}</span>
	// 			</div>
	// 			<div>
	// 				<span>${response[i].startDate} -<br> ${response[i].endDate}</span>
	// 			</div>
	// 			<div>
	// 				<span id="challenge-total-score-${response[i].id}"> - </span>
	// 			</div>
	// 			<div id="challenge-submission-link-${response[i].id}">
	// 				<a href="#" data-toggle="modal" data-target="#submission-modal" onclick="getSubmissionData(challengeList[${i}])">View my submission</a>
                    
	// 			</div>
	// 	</div>
    //     `   
    //     preloadSubmission(response[i], 'challenge history');
    //     }
    //     }
        
    //     $("#chng-list").html(html);
        
        

    //     },
    //     error : function(data) {
    //         alert("Server Error please contact admin")
    //     }
    // });

}

function preloadSubmission(challenge, mode){
    //alert(user.id);
    var data = { 
      user_id :user.id, 
      challenge_id :challenge.id, 
      challenge_round: challenge.round
      } ;
      console.log(data)
  
    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "getSubmissionData",
            data : data
        },
        success : function(response) {
            //	alert(response);
            var response = JSON.parse(response);
            console.log(response)

            if (response.length == 0){
                if(mode == 'challenge history'){
                    $(`#challenge-submission-link-${challenge.id}`).html(`<span>No submission</span>
                  `);
                } else if (mode == 'current challenge'){
                    
                        $(`#current-challenge-submission`).html(`
                        <span>No submission</span>
                        `);
                    
                        isCaptain(function(){
                            $(`#current-challenge-submission`).html(`
                            <button class="btn btn-info btn-lg" style="width:100% !important" data-toggle="modal" data-target="#addVideos" id="showhidevideobtn" onclick="loadLinks(this)">Add Submission</button>
                            `);
                        })
                }
                
                  
            } else {
                if(mode == 'challenge history'){
                    $(`#challenge-total-score-${challenge.id}`).html(response[0].rating ? (response[0].rating + " / 100") : '-' );

                } else if (mode == 'current challenge'){
                   
                }
            }
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });  
}

function getSubmissionData(challenge){
  //alert(user.id);
  var data = { 
    user_id :user.id, 
    challenge_id :challenge.id, 
    challenge_round: challenge.round
    } ;
    console.log(data)

  $.ajax({
      type : 'POST',
      url : 'server/judge.php',
      data : {
          type : "getSubmissionData",
          data : data
      },
      success : function(response) {
          //	alert(response);
          console.log(response)
          var response = JSON.parse(response);
          for(var i in response){

              var url = response[i].url;
              var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
              if(videoid != null) {
                  console.log("video id = ",videoid[1]);
              } else {
                  console.log("The youtube url is not valid.");
              }
              var youtubevidid = videoid[1];

              $("#submission-video").attr("src", "https://www.youtube.com/embed/" +youtubevidid);

              if (response[i].rating == null) {
                $('#submission-modal-rating-section').html('<div><span class="score-cat">Not rated</span></div>')
            } else {
                $("#total-rating").html(response[i].rating);
              $("#artistic-rating").html(response[i].artistic);
              $("#logic-rating").html(response[i].logic);
              $("#creativity-rating").html(response[i].creativity);
              $("#problem-solved-rating").html(response[i].problem_solved);
                }
              
          }

          $("#challenge-name").html(challenge.name);
        //   $("#challenge-start-date").html(challenge.startDate);
          $("#challenge-tutorial-link a").attr("href", challenge.Tutorial_url);
          $("#challenge-tutorial-link a").html(challenge.Tutorial_url);
          $("#challenge-description").html(challenge.text);
      },
      error : function(data) {
          alert("Server Error please contact admin")
      }
  });  
}

function getVideos(){
    //alert(user.id);
    var data = { data :user.id} ;

    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "loadRatedLinksByAllJudges",
            data : data
        },
        success : function(response) {
            //	alert(response);
            var response = JSON.parse(response);
            console.log('!!!! ' + response)

            for(var i in response){

                var url = response[i].url;
                var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
                if(videoid != null) {
                    console.log("video id = ",videoid[1]);
                } else {
                    console.log("The youtube url is not valid.");
                }
                var youtubevidid = videoid[1];

                var html ="";
                html +='<div class="col-md-6">';
                html +='<p>"'+response[i].name+'"</p>';
                html +='<p>"'+response[i].tname+'"</p>';
                html +='<span class="badge">'+response[i].rating+'</span>';
                //html += "<table style='color: #000;'><tr><td>"+response[i].rating+"</td><td>"+response[i].creativity+"</td><td>"+response[i].artistic+"</td><td>"+response[i].logic+"</td><td>"+response[i].problem_solved+"</td></tr></table>";
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
                html +='</a>';

                html +='</div>';

                $("#historyLinks").append(html);
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}
function saveTeam(){
    var data = {};
    var teamName = $("#teamName").val();
    if(teamName != ""){
        data.teamName = teamName ;

        var user = sessionStorage.getItem("user");
        user = JSON.parse(user);
        data.coach_id = user.id;



        $.ajax({
            type : 'POST',
            url : 'server/coach.php',
            data : {
                type : "saveTeam",
                data : data
            },
            success : function(response) {

                alert("Added Successfully");
                location.reload();

            },
            error : function(data) {
                alert("Server Error please contact admin")
            }
        });

    }
}



function addPlayer(){
    var data = {};
    var teamId =  $("#addPlayerBtn").data("teamid");

    data.teamId = teamId ;
    data.user_id = $("#dd-players").val();
    if(data.user_id  == "-1"){
        return ;
    }
    var temp = "";


    for(var j in team_players){
        if(team_players[j].id == data.user_id){

            alert("Player is already added.");
            return ;
        }
    }




    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "addPlayer",
            data : data
        },
        success : function(response) {

            for(var i in meta.users){
                if(data.user_id == meta.users[i].id){
                    team_players.push(meta.users[i]);
                    $("#players-list").append("<li>"+meta.users[i].name+"</li>");
                }
            }


        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });


}

function getCompTeams(){
    $("#comp-teams").html("");
    var html ="";

    for(var i in meta.compteams){



        html+="<tr>"
        html+="<td>"+meta.compteams[i].teamname+"</td>"

        html+="</tr>"
    }

    $("#comp-teams").html(html);
}


function getCompPlayers(){
    $("#comp-players").html("");
    var html ="";

    for(var i in meta.compplayer){

        html+="<tr>"
        html+="<td>"+meta.compplayer[i].firstname+"</td>"
        html+="<td>"+meta.compplayer[i].lastname+"</td>"
        html+="<td>"+meta.compplayer[i].teamname+"</td>"
        html+="</tr>"
    }

    $("#comp-players").html(html);
}

function getPlayers(){
    // console.log('user id: '+user.id);
    // $("#player-list-st").html("");
    var html ="";
    $intUserId = user.id;
    $.post('server/player.php?userId='+$intUserId,{'type':'getTeamMembers','data':$intUserId},function(data){
        $objJson = $.parseJSON(data);
        console.log($objJson);
        var old = $("#team_members").html();
        html += old;
        for(var key in $objJson){
            // html+="<tr>"
            // html+="<td>"+$objJson[key]['name']+"</td>"
            // html+="<td>"+$objJson[key]['last_name']+"</td>"
            // html+="<td>"+$objJson[key]['team_name']+"</td>"
            // html+="<td>"+$objJson[key]['grade'].toString()+"</td>"
            // html+="</tr>"
            // $("#player-list-st").html(html);
            

            html += "<span>"+$objJson[key]['name']+ " " +$objJson[key]['last_name']+ "</span>";
        }

        
        $("#team_members").html(html);
    });



}

function changeStatus(element){

    var index = $(element).data("index");
    var user = meta.users[index] ;
    var state = $(element).data("state");

    var data = {state : state , id :user.id };
    meta.users[index].state = state;

    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "changeStatus",
            data : data
        },
        success : function(response) {


            alert('Stated Changed Successfully');
            location.reload();

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
                    $("#dd-players").append("<option value="+meta.users[i].id+">"+meta.users[i].name+"</option>");
                }
            }

            if(response != ""){
                var players = JSON.parse(response);

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


/*function loadLinks(element){

 for(var i in meta.challenges){

 $("#chg-players").append("<option value="+meta.challenges[i].id+">"+meta.challenges[i].name+"</option>");
 }
 var teamId = $(element).data("teamid");
 $("#addLinkBtn").data("teamid",teamId);

 var data = { teamId :teamId } ;
 $.ajax({
 type : 'POST',
 url : 'player.php',
 data : {
 type : "loadLinks",
 data : data
 },
 success : function(response) {
 $("#video-list").html("");

 if(response != ""){
 var links = JSON.parse(response);

 for(var i in links){

 $("#video-list").append("<li><a href="+links[i].url+">"+links[i].title+"</a></li>");

 }
 }

 },
 error : function(data) {
 alert("Server Error please contact admin")
 }
 });

 }
 */
function loadScore(element){

    var teamId = $(element).data("teamid");
    //alert(teamId);
    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getTeamRating",
            data : data
        },
        success : function(response) {
			//alert(response);
			//console.log(response);
            $("#video-list").html("");

            if(response != ""){
                var data = JSON.parse(response);
				var totgrade =  data[1].totgrade;
                if( data[0].rating == null){
                    $("#score").html(""+0);
                }else{
                    var score = data[0].rating / meta.challenges.length ;
					score = score+totgrade;
                    $("#score").html(""+score);
                }

            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}

function load_team_score(team_id){

    var data = { teamId :team_id } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadTeamDcore",
            data : data
        },
        success : function(response) {
			//alert(response);
			//console.log(response);
            $("#video-list").html("");

            if(response != ""){
                var data = JSON.parse(response);
				var totgrade =  data[1].totgrade;
                if( data[0].rating == null){
                    $("#average_team_score").html(""+0+"pts");
                }else{
                    var score = data[0].rating / meta.challenges.length ;
					score = score+totgrade;
                    $("#average_team_score").html(""+score+"pts");
                }

            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}


function getTeamRanking(){



    var teamId = teamsids.toString();

    var data = { teamIds :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getTeamRanking",
            data : data
        },
        success : function(response) {


            if(response != ""){
                var data = JSON.parse(response);
                var html ="";
                for(var i in data){
                    html+="<tr>"
                    html+="<td>"+data[i].name+"llllllll</td>"
                    html+="<td>"+data[i].rating+"</td>"
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
/*
 function addLink(){
 var data = {};
 var teamId =  $("#addLinkBtn").data("teamid");

 data.teamId = teamId ;
 data.challenge_id = $("#chg-players").val();
 data.videoTitle =  $("#videoTitle").val();
 data.url =  $("#url").val();

 if(data.videoTitle == "" && data.url == ""){
 return ;
 }


 $.ajax({
 type : 'POST',
 url : 'server/coach.php',
 data : {
 type : "addLink",
 data : data
 },
 success : function(response) {

 alert(response);
 location.reload();


 },
 error : function(data) {
 alert("Server Error please contact admin")
 }
 });


 }
 */

/* Round 2 */
function getChallengesR2(){

    $("#chng-list").html("");
    var html ="";
    html += "<tr><th>Challenge</th><th>Start Date</th><th>End Date</th><th>Challenge Text</th></tr>";
    for(var i in meta.challengesr2){
        //html +='<li id="'+meta.users[i].id+'"><span>'+meta.challenges[i].name+' Start Date :'+meta.challenges[i].startDate+' , End Date : '+meta.challenges[i].endDate+' <span> ';
        html +=  "<tr><td>"+meta.challengesr2[i].name + "</td><td> "+ meta.challengesr2[i].startDate+ "</td><td> "+ meta.challengesr2[i].endDate+  "</td><td>"+ meta.challengesr2[i].text+ "</td></tr>";


        //html +="</li>";
    }

    $("#chng-list").html(html);

}



function getVideosR2(){

    var data = { data :user.id} ;

    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "loadRatedLinksByAllJudgesR2",
            data : data
        },
        success : function(response) {

            var response = JSON.parse(response);
            for(var i in response){

                var url = response[i].url;
                var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
                if(videoid != null) {
                    console.log("video id = ",videoid[1]);
                } else {
                    console.log("The youtube url is not valid.");
                }
                var youtubevidid = videoid[1];

                var html ="";
                html +='<div class="col-md-6">';
                html +='<p>"'+response[i].name+'"</p>';

                html +='<span class="badge">'+response[i].rating+'</span>';
                //html += "<table style='color: #000;'><tr><td>"+response[i].rating+"</td><td>"+response[i].creativity+"</td><td>"+response[i].artistic+"</td><td>"+response[i].logic+"</td><td>"+response[i].problem_solved+"</td></tr></table>";
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe width="149" height="150" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
                html +='</a>';

                html +='</div>';

                $("#historyLinks").append(html);
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}



/* Round 3 */
function getChallengesR3(){

    $("#chng-list").html("");
    var html ="";
    html += "<tr><th>Challenge</th><th>Start Date</th><th>End Date</th><th>Challenge Text</th></tr>";
    for(var i in meta.challengesr3){
        //html +='<li id="'+meta.users[i].id+'"><span>'+meta.challenges[i].name+' Start Date :'+meta.challenges[i].startDate+' , End Date : '+meta.challenges[i].endDate+' <span> ';
        html +=  "<tr><td>"+meta.challengesr3[i].name + "</td><td> "+ meta.challengesr3[i].startDate+ "</td><td> "+ meta.challengesr3[i].endDate+  "</td><td>"+ meta.challengesr3[i].text+ "</td></tr>";


        //html +="</li>";
    }

    $("#chng-list").html(html);

}



function getVideosR3(){

    var data = { data :user.id} ;

    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "loadRatedLinksByAllJudgesR3",
            data : data
        },
        success : function(response) {

            var response = JSON.parse(response);
            for(var i in response){

                var url = response[i].url;
                var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
                if(videoid != null) {
                    console.log("video id = ",videoid[1]);
                } else {
                    console.log("The youtube url is not valid.");
                }
                var youtubevidid = videoid[1];

                var html ="";
                html +='<div class="col-md-6">';
                html +='<p>"'+response[i].name+'"</p>';

                html +='<span class="badge">'+response[i].rating+'</span>';
                //html += "<table style='color: #000;'><tr><td>"+response[i].rating+"</td><td>"+response[i].creativity+"</td><td>"+response[i].artistic+"</td><td>"+response[i].logic+"</td><td>"+response[i].problem_solved+"</td></tr></table>";
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe width="149" height="150" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
                html +='</a>';

                html +='</div>';

                $("#historyLinks").append(html);
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
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



function showWinnersR1(){
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


function getTeamRankingR2(){

    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    //var teamId = teamsidsr2.toString();
    var userstate = user.state;
    //alert(usercouty);
    var data = {userstate :userstate  } ;
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

                $("#standings").html(html)
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}


function leagueTeamByOrgR2(){

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


function showWinnersAllR2(){
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

            $("#winner-body").append(html);

        },
        error : function(data) {
            alert("Server Error please contact admin");
        }
    });



}


function getTeamRankingR3(){

    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    //var teamId = teamsidsr3.toString();

    var data = { } ;
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

                $("#standings").html(html)
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}



function leagueTeamByOrgR3(){

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


function showWinnersR3(){
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
            type : "showWinnersR3",
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

function lessionsList(category = ''){
	user = sessionStorage.getItem("user");
    

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;
	var data = { userid: userid, round: 1, category } ;
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "lessionsList",
            data : data
        },
        success : function(response) {
			console.log('response: ' + response);
            $("#lessionsList").html("");

            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){
					var stst = links[i].statusd;
                    $("#lessionsList").append("<tr><td>"+links[i].id+"</td><td>"+links[i].title+"</td><td><a target='_blank' href="+links[i].pdf+">"+links[i].pdf+"</a></td><td>"+links[i].statusd+"</td><td>"+ 
    (stst == "Passed" ? '': "<input type='checkbox' value='"+links[i].id+"' /><input type='button' value='Submit' onclick='pisavesubmitdf("+links[i].id+","+userid+")' />")+"</td></tr>");

                }
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}

function lessionsList2(){
	user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;
	
	var data = { userid: userid, round: 2 } ;
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "lessionsList",
            data : data
        },
        success : function(response) {
			console.log(response);
            $("#lessionsList2").html("");

            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){
					var stst = links[i].statusd;
                    $("#lessionsList2").append("<tr><td>"+links[i].id+"</td><td>"+links[i].title+"</td><td><a target='_blank' href="+links[i].pdf+">"+links[i].pdf+"</a></td><td>"+links[i].statusd+"</td><td>"+ 
    (stst == "Passed" ? '': "<input type='checkbox' value='"+links[i].id+"' /><input type='button' value='Submit' onclick='pisavesubmitdf("+links[i].id+","+userid+")' />")+"</td></tr>");

                }
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}

function lessionsList3(){
	user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;
	
	var data = { userid: userid, round: 3 } ;
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "lessionsList",
            data : data
        },
        success : function(response) {
			console.log(response);
            $("#lessionsList3").html("");

            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){
					var stst = links[i].statusd;
                    $("#lessionsList3").append("<tr><td>"+links[i].id+"</td><td>"+links[i].title+"</td><td><a target='_blank' href="+links[i].pdf+">"+links[i].pdf+"</a></td><td>"+links[i].statusd+"</td><td>"+ 
    (stst == "Passed" ? '': "<input type='checkbox' value='"+links[i].id+"' /><input type='button' value='Submit' onclick='pisavesubmitdf("+links[i].id+","+userid+")' />")+"</td></tr>");

                }
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}

function loadcompetition(element){
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;



    // var teamId = $(element).data("teamid");
    //  $("#addLinkBtn").data("teamid",teamId);
    //alert(teamId);

    var data = { userid: userid } ;
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "loadplayercompetition",
            data : data
        },
        success : function(response) {
            $("#video-list1").html("");

            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){

                    $("#video-list1").append("<tr><td><a target='_blank' href="+links[i].comp_link_url+">"+links[i].comp_link_title+"</a></td><td>"+links[i].comp_posting_date+"</td><td>"+links[i].name+"</td></tr>");

                }
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}


function loadLinks(element){
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;


    for(var i in meta.challengesr1){

        $("#chg-players").append("<option value="+meta.challengesr1[i].id+">"+meta.challengesr1[i].name+"</option>");
    }
    var teamId = $(element).data("teamid");
    $("#addLinkBtn").data("teamid",teamId);

    var data = { teamId :teamId, userid: userid } ;
    $.ajax({
        type : 'POST',
        url : 'player.php',
        data : {
            type : "loadLinks",
            data : data
        },
        success : function(response) {
            $("#video-list").html("");

            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){

                    $("#video-list").append("<tr><td><a target='_blank' href="+links[i].url+">"+links[i].title+"</a></td><td>"+links[i].posted_date+"</td><td>"+links[i].name+"</td></tr>");

                }
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}



function addLink(){
    alert('You will not be able to delete this video. This is your final submission!!!');
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;

    var data = {};
    var teamId =  $("#addLinkBtn").data("teamid");
    data.userid = userid;
    data.teamId = teamId ;
    data.challenge_id = meta.currentChallenge.id;
    data.videoTitle =  $("#videoTitle").val();
    data.url =  $("#url").val();
    //alert(teamId);
    if(data.videoTitle == "" && data.url == ""){
        return ;
    }


    $.ajax({
        type : 'POST',
        url : '/server/player.php',
        data : {
            type : "addLink",
            data : data
        },
        success : function(response) {

            alert(response);
            location.reload();


        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });


}

function addCompVideo(){
    alert('you will not be able to delete this video. This is your final submission!!!');
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;

    var data = {};

    data.userid = userid;
    data.comp_id = $("#comp-names").val();
    data.challenge_id = $("#compchlng-names").val();
    data.videoTitle =  $("#compvideoTitle").val();
    data.url =  $("#compurl").val();
    //alert(teamId);
    if(data.videoTitle == "" && data.url == ""){
        return ;
    }


    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "saveCompVideo",
            data : data
        },
        success : function(response) {

            alert(response);
            location.reload();


        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });


}



function isCaptain(func){

    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;
    var teamid = user.team_id;
    var data = {};
    data.userid = userid;
    data.teamid = teamid;
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "showCaptain",
            data : data
        },
        success : function(response) {
            
            // alert(response);
            //location.reload();
            if(response >= 1){
                func()
                // $('#showhidevideobtn').show();
            }else{
                // $('#showhidevideobtn').hide();
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });


}

function sendMessage(){
    user = sessionStorage.getItem("user");
    if(user != undefined && user != ""){
        user = JSON.parse(user);
        $msg = $('#msg-min').val();
        $.post('./server/chat.php?action=sendMessage&coach_id='+user.id+'&from_id='+user.id+'&msg='+$msg+'&player=1',function(data){
            // alert(data);
            $('#msg-min').val('');
            $('.direct-chat-messages').append('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 70%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+user.name+'_'+user.last_name+'</span> </div><!-- /.direct-chat-info --> <img class="direct-chat-img" src="http://buira.org/assets/images/shared/default-profile.png" alt="Message User Image"><div class="direct-chat-text">'+$msg+'</div></div></div>');
            $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
        });
    }
}


function pisavesubmitdf(less_is,userid){
	//alert(less_is);
	//alert(user_id);		
	var data = { less_is :less_is, userid: userid } ;
	//alert(data);
	console.log(data);
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "SaveLessionsData",
            data : data
        },
        success : function(response) {
			//alert(response);
			 console.log(response);
            // $("#video-list").html("");
			
            // if(response != ""){
            //     var links = JSON.parse(response);

            //     for(var i in links){

            //         $("#video-list").append("<tr><td><a target='_blank' href="+links[i].url+">"+links[i].title+"</a></td><td>"+links[i].posted_date+"</td><td>"+links[i].name+"</td></tr>");

            //     }
            // }
                user = sessionStorage.getItem("user");

                if(user != undefined && user != ""){
                    user = JSON.parse(user);
                }
                var userid = user.id;
                var data1 = { userid: userid, round: 1 } ;
	                $.ajax({
                    type : 'POST',
                    url : 'server/player.php',
                    data : {
                        type : "lessionsList",
                        data : data1
                    },
                    success : function(response) {
                        console.log("kkk: " + response);
                        $("#lessionsList").html("");

                        if(response != ""){
                            var links = JSON.parse(response);

                            for(var i in links){
                                var stst = links[i].statusd;
                                $("#lessionsList").append("<tr><td>"+links[i].id+"</td><td>"+links[i].title+"</td><td><a target='_blank' href="+links[i].pdf+">"+links[i].pdf+"</a></td><td>"+links[i].statusd+"</td><td>"+ 
                (stst == "Passed" ? '': "<input type='checkbox' value='"+links[i].id+"' /><input type='button' value='Submit' onclick='pisavesubmitdf("+links[i].id+","+userid+")' />")+"</td></tr>");

                            }
                        }

                    },
                    error : function(data) {
                        alert("Server Error please contact admin")
                    }
                });

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}

function PlayerBand(userdata){
	//user = sessionStorage.getItem("user");
	var data = { userId :  userdata} ;
	//alert(userdata);
	console.log(data);
    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "PlayerBand",
            data : data
        },
        success : function(response) {
			//alert(response);
			console.log(response);
			$('#player_band').html(response);
           // $("#video-list").html("");
			/*
            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){

                    $("#video-list").append("<tr><td><a target='_blank' href="+links[i].url+">"+links[i].title+"</a></td><td>"+links[i].posted_date+"</td><td>"+links[i].name+"</td></tr>");

                }
            }*/

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

    $.ajax({
        type : 'POST',
        url : 'server/player.php',
        data : {
            type : "totaldue",
            data : data
        },
        success : function(response) {
            let data = JSON.parse(response);
            let totaldue = (data[0]['current_due'] * (1 - data[0]['discount'] / 100) - Number(data[0]['balance']));
            if (totaldue > 0){
                $('#totaldue').html('DUE $' + totaldue);
                $('#totaldue').css('color', '#C60000');
            } else if (data[0]['paid']>0) {
                $('#totaldue').html('Paid');
            }
           // $("#video-list").html("");
			/*
            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){

                    $("#video-list").append("<tr><td><a target='_blank' href="+links[i].url+">"+links[i].title+"</a></td><td>"+links[i].posted_date+"</td><td>"+links[i].name+"</td></tr>");

                }
            }*/

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}

