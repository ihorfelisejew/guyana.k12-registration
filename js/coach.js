var user  = null ;
var team_players = [] ;
var teamsids =[];
var teamsidsr2 = [];
var teamsidsr3 = [];
$(document).ready(function() {
   loadCompLinks();            
   
   getcomphistory();

    // setInterval(function(){
    //     // $('.direct-chat-messages').html('');
    //     $.get('server/chat.php?action=getHistoryChat&coach_id='+user.id,function(data){
    //         // console.log($.parseJSON(data));
    //    		 console.log(data);
    //         $arrobj = $.parseJSON(data);
    //         $i=1;
    //         for(var key in $arrobj){
    //             console.log($arrobj[key]['from_id']);

    //             if($i > 1){
    //                 if(user.id != $arrobj[key]['from_id']){
    //                     $('.direct-chat-messages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left" style="width:100%">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text" style="width:55%">'+$arrobj[key]['msg']+'</div></div>');
    //                     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    //                 }else{
    //                     $('.direct-chat-messages').append('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 55%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text">'+$arrobj[key]['msg']+'</div></div></div>');
    //                     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    //                 }
    //             }else{
    //                 if(user.id != $arrobj[key]['from_id']){
    //                     $('.direct-chat-messages').html('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left" style="width:100%">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text" style="width:55%">'+$arrobj[key]['msg']+'</div></div>');
    //                     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    //                 }else{
    //                     $('.direct-chat-messages').html('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 55%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text">'+$arrobj[key]['msg']+'</div></div></div>');
    //                     $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
    //                 }
    //             }
    //             $i++;
    //         }
    //     });
    // },4000);

    user = sessionStorage.getItem("user");
    if(user != undefined && user != ""){
        user = JSON.parse(user);
        //alert(user);
        //console.log(user);
        $("#name").html(user.name);
		$("#last_name").html(user.last_name);		
        $("#email").html(user.email);
        $("#league").html(user.league);
		$("#org_name").html(user.org_name);
        $("#org_name_c").html(user.org_name_c);        
		$("#teamName").val(user.org_name_c+'_');
		
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
                type : "loadscore",

            },
            success : function(response) {
                //alert('sdggds');
            },
            error : function(data) {
                alert("Server Error please contact admin")
            }
        });

        $.get('server/chat.php?action=getHistoryChat&coach_id='+user.id,function(data){
            // console.log($.parseJSON(data));
            // console.log(data);
            $arrobj = $.parseJSON(data);
            for(var key in $arrobj){
                console.log($arrobj[key]['from_id']);
                if(user.id != $arrobj[key]['from_id']){
                    $('.direct-chat-messages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left" style="width:100%">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="http://bootdey.com/img/Content/user_1.jpg" alt="Message User Image"><div class="direct-chat-text" style="width:55%">'+arrobj[key]['msg']+'</div></div>');
                }else{
                    $('.direct-chat-messages').append('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 55%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="http://buira.org/assets/images/shared/default-profile.png" alt="Message User Image"><div class="direct-chat-text">'+$arrobj[key]['msg']+'</div></div></div>')
                }
            }
        });

// $.ajax({
//             type : 'POST',
//             url : 'server/coach.php',
//             data : {
//                 type : "loadTeams",
//                 data : data
//             },
//             success : function(response) {

//                 var response = JSON.parse(response);
//                 for(var i in response){

//                     var html= "<tr>";
//                     //html +="<td>"+response[i].id+"</td>";
//                     html +="<td>"+response[i].name+"</td>";
//                     //html +="<td>"+user.name+"</td>";
//                     html +='<td><button onclick="loadPlayers(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addPlayer" type="button" class="btn btn-warning" > Players</button></td>';
                   
//                     html +='<td><button onclick="loadCaptain(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addCaptain" type="button" class="btn btn-warning" > Captain</button></td>';
//                     //html +='<td><button onclick="loadScore(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#scorePP" type="button" class="btn btn-default" >Team Average Score</button></td>';
//                     html +='<td><p id="score'+response[i].id+'"  onclick="loadScorecomp(this)" data-teamId="'+response[i].id+'" >View Score</p></td>';


//                     html += "</tr>";

//                     teamsids.push(response[i].id);
//                     $("#coachcompList").append(html);
//                 }



//             },
//             error : function(data) {
//                 alert("Server Error please contact admin")
//             }
//         });

        
        loadTeams();
		


        $.ajax({
            type : 'POST',
            url : 'server/coach.php',
            data : {
                type : "loadTeamsR2",
                data : data
            },
            success : function(response) {

                var response = JSON.parse(response);
                for(var i in response){

                    var html= "<tr>";
                    //html +="<td>"+response[i].id+"</td>";
                    html +="<td>"+response[i].name+"</td>";
                    //html +="<td>"+user.name+"</td>";
                    html +='<td><button onclick="loadPlayers(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addPlayer" type="button" class="btn btn-warning" > Players</button></td>';
                    html +='<td><button onclick="loadLinksR2(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addVideos" type="button" class="btn btn-warning" >Upload Videos.</button></td>';
                    //html +='<td><button onclick="loadScoreR2(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#scorePP" type="button" class="btn btn-default" >Team Average Score</button></td>';
                    html +='<td><p id="score'+response[i].id+'" class="label label-danger" onclick="loadScoreR2(this)" data-teamId="'+response[i].id+'" >View Score</p></td>';


                    html += "</tr>";

                    teamsidsr2.push(response[i].id);
                    $("#coachListR2").append(html);
                }



            },
            error : function(data) {
                alert("Server Error please contact admin")
            }
        });

        $.ajax({
            type : 'POST',
            url : 'server/coach.php',
            data : {
                type : "loadTeamsR3",
                data : data
            },
            success : function(response) {

                var response = JSON.parse(response);
                for(var i in response){

                    var html= "<tr>";
                    //html +="<td>"+response[i].id+"</td>";
                    html +="<td>"+response[i].name+"</td>";
                    //html +="<td>"+user.name+"</td>";
                    html +='<td><button onclick="loadPlayers(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addPlayer" type="button" class="btn btn-warning" > Players</button></td>';
                    html +='<td><button onclick="loadLinksR3(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addVideos" type="button" class="btn btn-warning" >Upload Videos.</button></td>';
                    //html +='<td><button onclick="loadScoreR2(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#scorePP" type="button" class="btn btn-default" >Team Average Score</button></td>';
                    html +='<td><p id="score'+response[i].id+'" class="label label-danger" onclick="loadScoreR3(this)" data-teamId="'+response[i].id+'" >View Score</p></td>';


                    html += "</tr>";

                    teamsidsr3.push(response[i].id);
                    $("#coachListR3").append(html);
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


	// lessionsList();
	lessionsList2();
	lessionsList3();
	PlayerBand(user.id);
    addUpdateUIListener();


});
edittemapi();

function updateUI(teamId){
    // getLoggedInUser().then(()=>{
    //     console.log(1111111111111111111111111111111111111111111111111111111111111111111111111111111111111111111)
    //     loadTeams()
    //      getPlayers()
    // })
    
    
    getLoggedInUser()
    loadTeams()
    // setTimeout(()=>getPlayers(), 600)
    getPlayers()

}

function addUpdateUIListener(){
   
    $(".modal-footer button[data-dismiss='modal']").on('click', ()=>{
        
        if(typeof searchTeams == 'function'){
            searchTeams()
        }else{updateUI()}
    })
    $('#manageTeam').on('hidden.bs.modal', function () {
        if(typeof searchTeams == 'function'){
            searchTeams()
        }else{updateUI()}

    });
}

function loadTeams(callback, r, ndc){
    var data = { coachId : user.id}
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadTeams",
            data : data
        },
        success : function(response) {
            //alert(response);
            var response = JSON.parse(response);
            $("#coachList").html('');
            for(var i in response){
                
                
                // ${response[i].haveplayer > 0 ? '<td><button onclick="loadLinks(this)" data-teamId="${response[i].id}" data-toggle="modal" data-target="#addVideos" type="button" class="btn btn-warning" >Upload Videos</button></td>' : '<td><button onclick="loadLinks1(this)" data-teamId="${response[i].id}" data-toggle="modal" data-target="#addVideos1" type="button" class="btn btn-warning" >Upload Videos</button></td>'}
                // <td><button onclick="loadPlayers(this)" data-teamId="${response[i].id}" data-toggle="modal" data-target="#addPlayer" type="button" class="btn btn-warning" > Players</button></td>
                // <td><button onclick="loadCaptain(this)" data-teamId="${response[i].id}" data-toggle="modal" data-target="#addCaptain" type="button" class="btn btn-warning" > Captain</button></td>
                //					<td><a href="javscript:void(0)" onclick="changeNmaeidB('nameform${response[i].id}')">Edit</a> <div style="display:none" class="nameform${response[i].id}"><form class="edittemapi"><input type="text" value="${response[i].name}" class="dardkiska" /><input type="hidden" value="${response[i].id}" class="teamidpi" /><input type="submit" /></form></div> | <a href="javscript:void(0)" onclick="deleteTeamPI('${response[i].id}'')">Delete</a> </td>

                var html = `<tr>
                
                <td id="team-name-${response[i].id}" data-coach-id = "${response[i].coach_id}">${response[i].name}</td>
                
                <td id="captain-team-${response[i].id}"></td>

                <td id="players-team-${response[i].id}"></td>
                <td id="score${response[i].id}"></td>
                 <td><button onclick="manageTeams(${response[i].id})" data-toggle="modal" data-target="#manageTeam" type="button" class="manageTeam-button btn btn-warning" > Manage Team</button></td>

                </tr>`;

                

                teamsids.push(response[i].id);
                $("#coachList").append(html);
                loadCaptain(response[i].id)
                loadPlayers(response[i].id)
                loadScore(response[i].id)
                if (typeof loadCoach === "function" ) { 
                    loadCoach(response[i].id)
                    
                }
            }

            if (callback) callback()

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
}


function loadScore(teamId){

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
            $("#video-list").html("");

            if(response != ""){
                var data = JSON.parse(response);
                if( data[0].rating == null){
                    $("#score"+teamId).html(""+0);
                }else{
                    var rating = data[0].rating ;
                    var creativity = data[0].creativity ;
                    var artistic = data[0].artistic ;
                    var logic = data[0].logic ;
                    var problem_solved = data[0].problem_solved ;

                    $("#score"+teamId).html(`
                        <div class="score-table">
                            <div>
                                <span>Rating</span>
                                <span>${rating}</span>
                            </div>
                            <div>
                                <span>Creativity</span>
                                <span>${creativity}</span>
                            </div>
                            <div>
                                <span>Artistic</span>
                                <span>${artistic}</span>
                            </div>
                            <div>
                                <span>Logic</span>
                                <span>${logic}</span>
                            </div>
                            <div>
                                <span>Problem Solving</span>
                                <span>${problem_solved}</span>
                            </div>
                        </div>
                    `)
                        
                        
                        
                }

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

    $("#chng-list").html("");
    var html ="";
    html += "<tr><th>Challenge</th><th>Start Date</th><th>End Date</th><th>Challenge Text</th></tr>";
    for(var i in meta.challenges){



        //html +='<li id="'+meta.users[i].id+'"><span>'+meta.challenges[i].name+' Start Date :'+meta.challenges[i].startDate+' , End Date : '+meta.challenges[i].endDate+' <span> ';
        html +=  "<tr><td>"+meta.challenges[i].name + "</td><td> "+ meta.challenges[i].startDate+ "</td><td> "+ meta.challenges[i].endDate+  "</td><td>"+ meta.challenges[i].text+ "</td></tr>";


        //html +="</li>";
    }

    $("#chng-list").html(html);

}

function getcomphistory(){
     var data = { data :"test."} ;

    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "complinkhistory",
            data : data
        },
        success : function(response) {
          $("#history-title").css("display", "block");
		  $("#comphistoryLinks").css("display", "block");
            var response = JSON.parse(response);
            for(var i in response){

                var url = response[i].comp_link_url;
                var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
                if(videoid != null) {
                    console.log("video id = ",videoid[1]);
                } else {
                    console.log("The youtube url is not valid.");
                }
                var youtubevidid = videoid[1];

                var html = "<table class='table-hover table-striped table-bordered'>";
	html += "<tr><th class='col-md-1' style='background:#4BADC8'>Date Submitted</th><th class='col-md-1' style='background:#4BADC8'>Competition Title</th><th class='col-md-1' style='background:#4BADC8'>Challenge Title</th><th style='background:#4BADC8' class='col-md-1'>Rating</th><th class='col-md-2' style='background:#4BADC8'>Video</th></tr>";
				
				html +=  "<tr><td>"+ response[i].comp_posting_date + "</td><td>"+ response[i].m_comp_name + "</td><td>"+ response[i].challange + "</td><td> "+ response[i].comp_rating1 + "</td><td><iframe width='100%' height='150' src='https://www.youtube.com/embed/"+youtubevidid+"'></iframe></td></tr>";
				
				
                
            }
			html +="</table>"
          $("#comphistoryLinks").append(html);
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
	
}
function getVideos(){

    var data = { data :"test."} ;

    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "loadRatedLinksByAllJudges",
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
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe width="100%" height="150" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
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

function loadCompLinks(){
	
		$.ajax({
			type : 'POST',
			url : 'server/judge.php',
			data : {
				type : "loadcometition",
				data : ""
			},
			success : function(response) {
			$("#links-title").css("display", "block");
			$("#complinks").css("display", "block");
			//	alert(response);
			//	loadRatedLinks(user.id);
				var response = JSON.parse(response);
				for(var i in response){
					
					var url = response[i].comp_link_url;
					var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
					if(videoid != null) {
					   console.log("video id = ",videoid[1]);
					} else { 
						console.log("The youtube url is not valid.");
					}
					var youtubevidid = videoid[1];
					var html ="";
					html +='<div class="col-md-6" id="video-'+response[i].comp_link_id+'" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #c1c1c1">';
						html +='<a href="'+response[i].comp_link_url+'" class="thumbnail" target="_blank">';

						//html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
						html +='<p>"'+response[i].comp_link_title+' l '+response[i].endDate+'" <span style="float: right;">View in Full Screen</span></p>';
						html += '<iframe width="530" height="280" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';		
						html +='</a>';
									
						html +='<input id="rate-art-'+response[i].comp_link_id+'" type="number" min="1" max="100" style="width: 100px;" placeholder="Artistic" />';
						html +='<input id="rate-cret-'+response[i].comp_link_id+'" type="number" min="1" max="100" style="width: 100px;" placeholder="Creativity" />';
						html +='<input id="rate-logic-'+response[i].comp_link_id+'" type="number" min="1" max="100" style="width: 100px;" placeholder="logic" />';
						html +='<input id="rate-problemSolved-'+response[i].comp_link_id+'" type="number" min="1" max="100" style="width: 125px;" placeholder="Problem solved" />';
						html +='<input type="button" style="margin-left:12px" class="btn btn-primary" value="Rate" placeholder="1-100" onclick="rateCompLink(this,'+response[i].comp_link_id+','+user.id+')"/>';
						
						
					html +='</div>';
					
					$("#complinks").append(html);
				}
				
				

			},
			error : function(data) {
				alert("Server Error please contact admin")
			}
		});
		

}

function rateCompLink(element,id,userId){
	
	 $(element).prop('disabled', true);
	 
	 var creativity =$("#rate-cret-"+id).val();
 	 var art =$("#rate-art-"+id).val();
	 var problemSolved =$("#rate-problemSolved-"+id).val();
	 var logic =$("#rate-logic-"+id).val();
	
	rating = Number(creativity) + Number(art) + Number(problemSolved) + Number(logic) ;
	var data = { linkId :id ,rating :rating,userId:userId ,creativity:creativity,logic:logic ,artistic:art ,problem_solved:problemSolved } ;
	$.ajax({
		type : 'POST',
		url : 'server/judge.php',
		data : {
			type : "rateCompLink",
			data : data
		},
		success : function(response) {
		
			$("#video-"+id).remove();
			alert("Added Successfully");
			location.reload();

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
}


function getCoachVideos(){

	$("#historyLinks").html(''); 
    var user = sessionStorage.getItem("user");
    user = JSON.parse(user);
    var coach_id = user.id;
    var data = { coach_id :coach_id} ;
    //	alert(coach_id);
    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "loadCoachRatedLinksByAllJudges",
            data : data
        },
        success : function(response) {
            //alert(response);
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
                html +='<p>"'+response[i].tname+'"</p>';

                // this
                html +='<span class="badge">'+response[i].rating+'</span>';
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe width="100%" height="150" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
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


function getCoachVideosR2(){


    var user = sessionStorage.getItem("user");
    user = JSON.parse(user);
    var coach_id = user.id;
    var data = { coach_id :coach_id} ;
    //alert(coach_id);
    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "loadCoachRatedLinksByAllJudgesR2",
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
                html +='<p>"'+response[i].tname+'"</p>';
                html +='<span class="badge">'+response[i].rating+'</span>';
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe width="100%" height="150" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
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


function getCoachVideosR3(){


    var user = sessionStorage.getItem("user");
    user = JSON.parse(user);
    var coach_id = user.id;
    var data = { coach_id :coach_id} ;
    //alert(coach_id);
    $.ajax({
        type : 'POST',
        url : 'server/judge.php',
        data : {
            type : "loadCoachRatedLinksByAllJudgesR3",
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
                html +='<p>"'+response[i].tname+'"</p>';
                html +='<span class="badge">'+response[i].rating+'</span>';
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe width="100%" height="150" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
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
        data.competition_id = user.competition_id;



        $.ajax({
            type : 'POST',
            url : 'server/coach.php',
            data : {
                type : "saveTeam",
                data : data
            },
            success : function(response) {

                alert(response);
                updateUI()



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
    data.coachId = user.id;
    if(data.user_id  == "-1"){
        return ;
    }
   

    var temp = "";






    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "addPlayer",
            data : data
        },
        success : function(response) {
            console.log(response)
            $('#upload-videos-note').remove()

            if (response != 0){
                var oldL = team_players.length;
                for(var i in meta.users){
                    if(data.user_id == meta.users[i].id){
                        team_players.push(meta.users[i]);
                        $("#players-list").append("<li>"+meta.users[i].name+" "+meta.users[i].last_name+"</li>");
                        $("#dd-playersC").append("<option value="+meta.users[i].id+">"+meta.users[i].name+" " +meta.users[i].last_name+"</option>");
                    }
                }
                
                if(team_players.length < 1){
                    $('#upload-videos').hide()
                    
                    $('#upload-videos').before('<div id="upload-videos-note"><h4>Team must have players before upload video</h4></div>')
                    $('#upload-videos').after('<div id="upload-videos-blank" style="padding: 0;"></div>')
                   
                } else if (oldL == 0) {
                    loadLinks(teamId)
                }
            } else {
                alert('Player is already added.')
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });


}

function removePlayer(){
    var data = {};
    var teamId =  $("#addPlayerBtn").data("teamid");
    data.teamId = teamId ;
    data.user_id = $("#dd-players").val();
    if(data.user_id  == "-1"){
        return ;
    }
    var temp = "";

   





    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "removePlayer",
            data : data
        },
        success : function(response) {
            alert(response)
           
            $('#upload-videos-note').remove()


            if (response != 'Player is not in the team. '){
                var oldL = team_players.length;
                for(var i in team_players){
                    if(data.user_id == team_players[i].id){
                        team_players.splice(i, 1);
                        $("#players-list").html('')
                        $("#dd-playersC").html('')
                        for(var i in team_players){
                            console.log(team_players)
                            $("#players-list").append("<li>" + team_players[i].name + " " +  team_players[i].last_name + "</li>")
                            $("#dd-playersC").append("<option value="+team_players[i].id+">"+team_players[i].name+" " +team_players[i].last_name+"</option>");

                        }
                         // Remove user from team_players
                        //  $("#players-list").
                        // $("#players-list li").filter(function() {
                        //     return $(this).text() == team_players[i].name + ' ' +  team_players[i].last_name;
                        // }).remove(); // Remove <li> by user name
                       
                        
                        break; // Exit loop after removal
                    }
                }
                if(team_players.length < 1){
                    $('#upload-videos').hide()
                    $('#upload-videos').before('<div id="upload-videos-note"><h4>Team must have players before upload video</h4></div>')
                    $('#upload-videos').after('<div id="upload-videos-blank" style="padding: 0;"></div>')
                    
                } else if (oldL == 0) {
                    loadLinks(teamId)
                }
            } 


        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });


}


function addCaptain(){
    var data = {};
    var teamId =  $("#addCaptainBtn").data("teamid");
    //alert(teamId);
    data.teamId = teamId ;
    data.user_id = $("#dd-playersC").val()

    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "addPlayerCaptain",
            data : data
        },
        success : function(response) {
            
            if (response == 1){
                alert('Captain Added');
                for(var i in meta.teamsc){
                    if(meta.teamsc[i].id == teamId){

                        for (var j in team_players){
                            if (team_players[j].id == data.user_id){
                                meta.teamsc[i].capname = team_players[j].name + ' ' + team_players[j].last_name;
                            }
                        }
                       

                        $("#players-listC").html("<li>"+meta.teamsc[i].capname+"</li>");
                    }
                }
                // updateUI()
            }


        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });


}

function UserNameByID(userid){

    data = {userid : userid};
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "UserNameByID",
            data : data
        },
        success : function(response) {
            var resultsass  = JSON.parse(response);

            var html = "";
            for(var i in resultsass){
                //return resultsass[i].name;
                html += resultsass[i].name;
            }
            return html;
            //alert(html);

        },
        error : function(data) {
            alert("Server Error please contact admin");
        }
    });

}


function getPlayers(){

    $("#player-list-st").html("");
    //alert(meta.playerlistall);
    for(var i in meta.playerlistall) {
        var html ="";
        if(meta.playerlistall[i].role_id !="2"){
            continue ;
        }

        if(user.role_id == '5'){//if it's admin page - then we list all the players, regardless the ndc

        }else{
            if(meta.playerlistall[i].org_id != user.org_id){
                continue ;
            }
        }
        console.log(meta.playerlistall[i])
        const d= new Date();
        let totaldue = Number(meta.playerlistall[i].current_due) * (1 - Number(meta.playerlistall[i].discount) / 100) - Number(meta.playerlistall[i].balance);
        let status =  'Outstanding';
        if((Number(totaldue) - Number(meta.playerlistall[i].paid)) <= 0) status = 'Paid';
                // <td>${ d.getDate() }/${ (d.getMonth() + 1) }/${ d.getFullYear() }</td>

        html += `<tr>
        <td><input type="hidden" name="id[]" value="${ meta.playerlistall[i].id }">${meta.playerlistall[i].name } ${ meta.playerlistall[i].last_name}</td>
        <td>${ meta.playerlistall[i].teamname }</td>
        <td>$${ totaldue}</td>
        <td>
        <select id="select-player-status-${ meta.playerlistall[i].id }" class="new-select">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
        </select>
        <td>
        ${ meta.playerlistall[i].updated_date }
        </td>
        
        </tr>`;
        $("#player-list-st").append(html);
        $(`#select-player-status-${ meta.playerlistall[i].id }`).val( meta.playerlistall[i].status);
        $(`#select-player-status-${ meta.playerlistall[i].id }`).on('change', function() {
            const selectedValue = $(this).val();
            const playerId = $(this).attr('id').replace(/\D/g,''); 
            
            // console.log(playerId);
            changePlayerStatus(playerId, selectedValue)
            
          });
    }


}

function changePlayerStatus(id, val){
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "changePlayerStatus",
            data : {id, val}
        },
        success : function(response) {

            $(`#select-player-status-${ id }`).val( val);
            alert(response);
            updateUI()
            
        },
        error : function(data) {
            alert(data);
            alert("Server Error please contact admin")
        }
    });
}

$('#paid_save').on('submit',(function(e) {
	e.preventDefault();
 
	var formData = new FormData(this);
	$.ajax({
        type:'POST',
        url: 'server/coach.php',
        data:{
            type:"paid_save",
            data:formData,
        },
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        // success:function(data){
        
		//  console.log(data);
		//  	alert('Updated successfully!!!');
		//  	location.reload();
        //  },
        //  error: function(data){
		//  	console.log(data);
		// 	alert('You have no checked!');
        //     location.reload();
        //}
      });
  }));

 
  

  function function_alert($msg) {
  alert($msg);
  }
   






function changeStatus(element){

    var index = $(element).data("index");
    var user = $(element).data("uid") ;
    var state = $(element).data("state");

    var data = {state : state , id :user };
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
            alert(data);
            alert("Server Error please contact admin")
        }
    });


}

function loadPlayers(teamId){

    $("#addPlayerBtn").data("teamid",teamId);
    let coachId =  $(`#team-name-${teamId}`).attr('data-coach-id');

    var data = { teamId :teamId,   coachId : coachId} ;
    console.log(data)

    return $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadPlayers",
            data : data
        },
        success : function(response) {            


            
            // console.log(JSON.parse(response));
            //alert(JSON.stringify(meta.playerlist));
            $("#dd-players").html("<option selected>Select Player</option>")
            
            response = JSON.parse(response)

            if(user.role_id == '5'){
                console.log(response)
                for(var i in meta.playerlist){
                    if(meta.playerlist[i].org_id == response[0]?.coach_org_id){
                        $("#dd-players").append("<option value="+meta.playerlist[i].id+">"+meta.playerlist[i].name + ' ' + meta.playerlist[i].last_name+"</option>");
    
                    }
                    
    
                }
            }else{
                console.log(88)

                for(var i in meta.playerlist){
                    if(meta.playerlist[i].org_id == user.org_id){
                        $("#dd-players").append("<option value="+meta.playerlist[i].id+">"+meta.playerlist[i].name + ' ' + meta.playerlist[i].last_name+"</option>");
    
                    }
    
                }
            }
                    
                    $("#players-list").html("");
                    $(`#players-team-${teamId}`).html("");  
    
                    var players = response;
                    if(players.hasOwnProperty('name')){
                        alert('hiii');
                    }
                    team_players=players;
                    for(var i in players){
    
    
                        $("#players-list").append("<li>"+players[i].name+" "+players[i].last_name+"</li>");
                        $(`#players-team-${teamId}`).append("<li>"+players[i].name+" "+players[i].last_name+"</li>");
                        $("#dd-players").append("<option value="+players[i].id+">"+players[i].name+" " +players[i].last_name+"</option>");
                        
                    }
                
            
            

        },
        error : function(data) {
            alert(data);
            alert("Server Error please contact admin")
        }
    });




}

function saveComp1(){
	var data = {};
    var compname1 = $("#compname1").val();
	var compchallenge = $("#compchallenge").val();
	var user = sessionStorage.getItem("user");
    user = JSON.parse(user);
   
    if(compname1 != ""){
        data.compname1 = compname1 ;
		data.compchallenge = compchallenge ;
		data.coachid = user.id ;
		
        $.ajax({
            type : 'POST',
            url : 'server/coach.php',
            data : {
                type : "saveComp1",
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
}
function saveComp(){
	var user = sessionStorage.getItem("user");
    user = JSON.parse(user);
	
    var data = {};
    var compname = $("#compname").val();
	var compid = $("#comp-names").val();
	var compsdate = $("#compsdate").val();
	var compedate = $("#compedate").val();
	var comptext = $("#comptext").val();
	var compobj = $("#compobj").val();
	var compurl = $("#compurl").val();
	
	
    if(compname != ""){
        data.compname = compname ;
		data.compsdate = compsdate ;
		data.compedate = compedate ;
		data.comptext = comptext ;
		data.compobj = compobj ;
		data.compurl = compurl ;
		data.compid = compid ;
        data.coachid = user.id;

        $.ajax({
            type : 'POST',
            url : 'server/coach.php',
            data : {
                type : "saveComp",
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
}



function loadCaptain(teamId){

    $("#addCaptainBtn").data("teamid",teamId);

    //alert(teamId);

    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadPlayers",
            data : data
        },
        success : function(response) {


            $("#dd-playersC").html("<option value='-1'>Select Player</option>");
            $("#players-listC").html("");

            //alert(meta.playerlist);
            //alert(JSON.stringify(meta.teamsc));
            //alert(teamId);
            $("#players-listC").html("");
            $(`#captain-team-${teamId}`).html("");
            for(var i in meta.teamsc){
                if(meta.teamsc[i].id == teamId){
                    //alert(meta.teamsc[i].capname);
                    $("#players-listC").append("<b>Captain:</b> "+meta.teamsc[i].capname+"");
                    $(`#captain-team-${teamId}`).html("<li>"+meta.teamsc[i].capname+"</li>");
                }

                //if(meta.users[i].role_id == "2"){
                //$("#dd-playersC").append("<option value="+meta.playerlist[i].id+">"+meta.playerlist[i].name+"</option>");
                //}
            }

            if(response != ""){
                $("#dd-playersC").html("<option selected>Select Player</option>");
                var players = JSON.parse(response);
                if(players.hasOwnProperty('name')){
                    alert('hiii');
                }
                for(var i in players){

                    //team_players.push(players[i]);
                    //$("#players-listC").append("<li>"+players[i].name+"</li>");
                    $("#dd-playersC").append("<option value="+players[i].id+">"+players[i].name+" " +players[i].last_name+"</option>");
                }
            }

        },
        error : function(data) {
            alert(data);
            alert("Server Error please contact admin")
        }
    });




}

function manageTeams(teamId){
    loadPlayers(teamId).then(()=>{
        loadRenameDelete(teamId)
        loadCaptain(teamId)
        if (typeof loadAllChallengesAdmin === "function" && typeof loadTeamLinks === "function") { 
            loadAllChallengesAdmin(teamId).then(()=>{loadLinks(teamId); loadTeamLinks(teamId)})
            loadCoach(teamId)
        }else{
            loadLinks(teamId)
        }
        

    })
    
}

function loadRenameDelete(teamId){
    $('#rename-delete').html(`
    <h3 class="modal-title"> Rename
            </h3>
            <br>
   <strong>Change team name: </strong>
    <div  class="nameform${teamId}">
      <form class="edittemapi">
        <input type="text" value="" class="dardkiska" />
        <input type="hidden" value="${teamId}" class="teamidpi" />
        <input class=" btn-primary" type="submit" /></form>
      </div> 
      <br>

      <h3 class="modal-title"> Delete
            </h3>
            <br>
      <strong>Delete team: </strong>
       <button class="btn btn-primary" onclick="deleteTeamPI(${teamId})">Delete</button> 
    `)
}


function loadLinks(teamId){
    console.log($('#players-list').html())
    $('#upload-videos-note').remove()

    if(team_players.length < 1){
        $('#upload-videos').hide()
                    $('#upload-videos').before('<div id="upload-videos-note"><h4>Team must have players before upload video</h4></div>')
                    $('#upload-videos').after('<div id="upload-videos-blank" style="padding: 0;"></div>')
        return
    }
    $('#upload-videos').show()
    $('#upload-videos-blank').remove()
    console.log(meta.allChallenges)

    for(var i in meta.allChallenges){
        $("#chg-players").append("<option value="+meta.allChallenges[i].id+">"+meta.allChallenges[i].name+ ' Round:' + +meta.allChallenges[i].round+"</option>");
    }
    $("#addLinkBtn").data("teamid",teamId);

    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadLinks",
            data : data
        },
        success : function(response) {
            $("#video-list").html("");

            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){
                    $("#video-list").append(`<tr><td>
                    <td><a target='_blank' href="${links[i].url}">${links[i].title}</a></td>
                    <td>${links[i].posted_date}</td>
                    <td>${links[i].name}</td></tr>
                    <tr></tr> <tr>
                    <th>Total Score</th>
                    <th>Artistic</th>
                    <th>Creativity</th>
                    <th>Logic</th>
                    <th>Problem Solved</th>
                </tr>
                <tr>
                    <td>${links[i].rating}</td>
                    <td>${links[i].artistic}</td>
                    <td>${links[i].creativity}</td>
                    <td>${links[i].logic}</td>
                    <td>${links[i].problem_solved}</td>
                </tr>`)

                }
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}



function loadScorecomp(element){

    var teamId = $(element).data("teamid");
    //alert(teamId);
    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getCompTeamRating",
            data : data
        },
        success : function(response) {
            $("#video-list").html("");

            if(response != ""){
                var data = JSON.parse(response);
                if( data[0].rating == null){
                    $("#score"+teamId).html(""+0);
                }else{
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

/* Ajax Search */
function ajaxSearchTeamRanking(str){
    //alert(str);
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsids.toString();

    var data = { teamIds :teamId, str: str } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "ajaxgetTeamRanking",
            data : data
        },
        success : function(response) {

            //alert(response);
            if(response != ""){
                var data = JSON.parse(response);
                var html ="";
                for(var i in data){
                    html+="<tr>"
                    html+="<td>"+data[i].name+"</td>"
                    html+="<td>"+data[i].rating+"</td>"
                    html+="<td>"+user.name+"</td>"
					 html+="<td>"+data[i].county+"</td>"
					  html+="<td>"+data[i].state+"</td>"
					   html+="<td>"+data[i].org_name+"</td>"
                    html+="</tr>"


                }

                $("#standings").html(html)
            }

        },
        error : function(data) {
            alert("Server Error please contact admin1")
        }
    });

}

function ajaxSearchCoachRanking(str){
    //alert(str);
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsids.toString();
    var userorgid = user.org_id;
    var data = { teamIds :teamId, str: str, userorgid: userorgid  } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "ajaxgetCoachRanking",
            data : data
        },
        success : function(response) {

            //alert(response);
            if(response != ""){
                var data = JSON.parse(response);
                var html ="";
                for(var i in data){

                    html+="<tr>"
                    html+="<td>"+data[i].name+"</td>"
                    html+="<td>"+data[i].rating+"</td>"
                    html+="<td>"+data[i].userfname+" "+data[i].last_name+"</td>"
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


function getTeamRanking2(){

    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsids.toString();
	
    var usercouty = user.county;
  //  alert(teamId);
    var data = { teamIds :teamId, usercouty :usercouty  } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getTeamRanking_comp",
            data : data
        },
        success : function(response) {
//alert(response);

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

			//alert(response);
			//console.log(response);
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

function getTeamRankingR2(){

    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsidsr2.toString();
    var userstate = user.state;
    //alert(usercouty);
    var data = { teamIds :teamId, userstate :userstate  } ;
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


function getTeamRankingR3(){

    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsidsr3.toString();

    var data = { teamIds :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getTeamRankingR3",
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


function addLink(){
    alert('You will not be able to delete this video. This is your final submission!!!');
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


function loadLinksR2(element){

    for(var i in meta.challengesr2){

        $("#chg-players").append("<option value="+meta.challengesr2[i].id+">"+meta.challengesr2[i].name+"</option>");
    }
    var teamId = $(element).data("teamid");
    $("#addLinkBtn").data("teamid",teamId);

    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadLinksR2",
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




function getVideosR2(){

    var data = { data :"test."} ;

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
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe width="100%" height="150" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
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


function loadScoreR2(element){

    var teamId = $(element).data("teamid");
    //alert(teamId);
    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getTeamRatingR2",
            data : data
        },
        success : function(response) {
            $("#video-list").html("");

            if(response != ""){
                var data = JSON.parse(response);
                if( data[0].rating == null){
                    $("#score"+teamId).html(""+0);
                }else{
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






/* Ajax Search */
function ajaxSearchTeamRankingR2(str){
    //alert(str);
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsids.toString();

    var data = { teamIds :teamId, str: str } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "ajaxgetTeamRankingR2",
            data : data
        },
        success : function(response) {

            //alert(response);
            if(response != ""){
                var data = JSON.parse(response);
                var html ="";
                for(var i in data){
                    html+="<tr>"
                    html+="<td>"+data[i].name+"</td>"
                    html+="<td>"+data[i].rating+"</td>"
                    html+="<td>"+user.name+"</td>"
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



function ajaxSearchCoachRankingR2(str){
    //alert(str);
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsids.toString();
    var userorgid = user.org_id;

    var userstate = user.state;
    var data = { teamIds :teamId, str: str, userorgid: userorgid, userstate : userstate  } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "ajaxgetCoachRankingR2",
            data : data
        },
        success : function(response) {

            //alert(response);
            if(response != ""){
                var data = JSON.parse(response);
                var html ="";
                for(var i in data){

                    html+="<tr>"
                    html+="<td>"+data[i].name+"</td>"
                    html+="<td>"+data[i].rating+"</td>"
                    html+="<td>"+data[i].userfname+" "+data[i].last_name+"</td>"
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
function ajaxSearchCoachRankingR3(str){
    //alert(str);
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsids.toString();
    var userorgid = user.org_id;

    var userstate = user.state;
    var data = { teamIds :teamId, str: str, userorgid: userorgid, userstate : userstate  } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "ajaxgetCoachRankingR3",
            data : data
        },
        success : function(response) {

            //alert(response);
            if(response != ""){
                var data = JSON.parse(response);
                var html ="";
                for(var i in data){

                    html+="<tr>"
                    html+="<td>"+data[i].name+"</td>"
                    html+="<td>"+data[i].rating+"</td>"
                    html+="<td>"+data[i].userfname+" "+data[i].last_name+"</td>"
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

/* Round 3 */
function loadLinksR3(element){

    for(var i in meta.challengesr3){

        $("#chg-players").append("<option value="+meta.challengesr3[i].id+">"+meta.challengesr3[i].name+"</option>");
    }
    var teamId = $(element).data("teamid");
    $("#addLinkBtn").data("teamid",teamId);

    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadLinksR3",
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


function loadScoreR3(element){

    var teamId = $(element).data("teamid");
    //alert(teamId);
    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getTeamRatingR3",
            data : data
        },
        success : function(response) {
            $("#video-list").html("");

            if(response != ""){
                var data = JSON.parse(response);
                if( data[0].rating == null){
                    $("#score"+teamId).html(""+0);
                }else{
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

    var data = { data :"test."} ;

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
                html +='<a href="'+response[i].url+'" class="thumbnail">';
                html +='<p>"'+response[i].title+'"</p>';
                //html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
                html += '<iframe width="100%" height="150" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';
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







/* Ajax Search */
function ajaxSearchTeamRankingR3(str){
    //alert(str);
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var teamId = teamsids.toString();

    var data = { teamIds :teamId, str: str } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "ajaxgetTeamRankingR3",
            data : data
        },
        success : function(response) {

            //alert(response);
            if(response != ""){
                var data = JSON.parse(response);
                var html ="";
                for(var i in data){
                    html+="<tr>"
                    html+="<td>"+data[i].name+"</td>"
                    html+="<td>"+data[i].rating+"</td>"
                    html+="<td>"+user.name+"</td>"
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

function sendMessage(){
    user = sessionStorage.getItem("user");
    if(user != undefined && user != ""){
        user = JSON.parse(user);
        $msg = $('#msg-min').val();
        $.post('server/chat.php?action=sendMessage&coach_id='+user.id+'&from_id='+user.id+'&msg='+$msg,function(data){
            // alert(data);
            $('#msg-min').val('');
            $('.direct-chat-messages').append('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 55%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+user.name+'_'+user.last_name+'</span></div><!-- /.direct-chat-info --><img class="direct-chat-img" src="http://buira.org/assets/images/shared/default-profile.png" alt="Message User Image"><div class="direct-chat-text">'+$msg+'</div></div></div>');
            $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
        });
    }
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
        url : 'server/coach.php',
        data : {
            type : "lessionsList",
            data : data
        },
        success : function(response) {
			console.log("response:" + response);
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
	
	var data2 = { userid: userid, round: 2 } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "lessionsList",
            data : data2
        },
        success : function(response2) {
			console.log(response2);
            $("#lessionsList2").html("");

            if(response2 != ""){
                var links2 = JSON.parse(response2);

                for(var i in links2){
					var stst = links2[i].statusd;
                    $("#lessionsList2").append("<tr><td>"+links2[i].id+"</td><td>"+links2[i].title+"</td><td><a target='_blank' href="+links2[i].pdf+">"+links2[i].pdf+"</a></td><td>"+links2[i].statusd+"</td><td>"+ 
    (stst == "Passed" ? '': "<input type='checkbox' value='"+links2[i].id+"' /><input type='button' value='Submit' onclick='pisavesubmitdf("+links2[i].id+","+userid+")' />")+"</td></tr>");

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
	
	var data2 = { userid: userid, round: 3 } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "lessionsList",
            data : data2
        },
        success : function(response3) {
			console.log(response3);
            $("#lessionsList3").html("");

            if(response3 != ""){
                var links2 = JSON.parse(response3);

                for(var i in links2){
					var stst = links2[i].statusd;
                    $("#lessionsList3").append("<tr><td>"+links2[i].id+"</td><td>"+links2[i].title+"</td><td><a target='_blank' href="+links2[i].pdf+">"+links2[i].pdf+"</a></td><td>"+links2[i].statusd+"</td><td>"+ 
    (stst == "Passed" ? '': "<input type='checkbox' value='"+links2[i].id+"' /><input type='button' value='Submit' onclick='pisavesubmitdf("+links2[i].id+","+userid+")' />")+"</td></tr>");

                }
            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });
	
}




function pisavesubmitdf(less_is,userid){
	//alert(less_is);
	//alert(user_id);		
	name = user.name;
	var data = { less_is :less_is, userid: userid, name:name } ;
	//alert(data);
	console.log(data);
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "SaveLessionsData",
            data : data
        },
        success : function(response) {
			//alert(response);
			console.log(response);
           // $("#video-list").html("");
			/*
            if(response != ""){
                var links = JSON.parse(response);

                for(var i in links){

                    $("#video-list").append("<tr><td><a target='_blank' href="+links[i].url+">"+links[i].title+"</a></td><td>"+links[i].posted_date+"</td><td>"+links[i].name+"</td></tr>");

                }
            }*/
                user = sessionStorage.getItem("user");

                if(user != undefined && user != ""){
                    user = JSON.parse(user);
                }
                var userid = user.id;
                var data1 = { userid: userid, round: 1 } ;
                $.ajax({
                    type : 'POST',
                    url : 'server/coach.php',
                    data : {
                        type : "lessionsList",
                        data : data1
                    },
                    success : function(response) {
                        console.log(response);
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
        url : 'server/coach.php',
        data : {
            type : "PlayerBand",
            data : data
        },
        success : function(response) {
			//alert(response);
			console.log(response);
			$('#coach_band').html(response);
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
			//alert(response);
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


function goRemove(){

    var searchIDs = $("input:checkbox:checked").map(function(){
        return this.value;
    }).toArray();
	alert(searchIDs);
	
    
	var user = sessionStorage.getItem("user");
    user = JSON.parse(user);
    var coach_id = user.id;
	
	
    var data = {searchIDs : searchIDs , coach_id :coach_id };
    
	

    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "goRemove",
            data : data
        },
        success : function(response) {
			//alert(response);		
            alert('Removed');
            //location.reload();

        },
        error : function(data) {
            alert(data);
            alert("Server Error please contact admin")
        }
    });


}

function changeNmaeidB(name){
	$(document).ready(function(){
	
		$("."+name).show();
	});
}


function edittemapi(){
	
	
	$(document).on('submit','form.edittemapi',function(){	
		event.preventDefault();
		var user = sessionStorage.getItem("user");
		user = JSON.parse(user);
		var myVar = $(this).find('.dardkiska').val();
		//alert( "Handlerdsdssd for .submit() called."+myVar );
		var teamidpi = $(this).find('.teamidpi').val();
		
		var data = {team : myVar , teamidpi :teamidpi };
 
		$.ajax({
			type : 'POST',
			url : 'server/coach.php',
			data : {
				type : "edittemapi",
				data : data
			},
			success : function(response) {
				//alert(response);		
				alert('Team Name Changed Successfully');


			},
			error : function(data) {
				alert(data);
				alert("Server Error please contact admin")
			}
		});
		

	});
}

function deleteTeamPI(id){
	var data = {id : id};
 
		$.ajax({
			type : 'POST',
			url : 'server/coach.php',
			data : {
				type : "deleteTeamPI",
				data : data
			},
			success : function(response) {
				//alert(response);		
				alert('Team Deleted Successfully');
                updateUI()
			},
			error : function(data) {
				alert(data);
				alert("Server Error please contact admin")
			}
		});
		
	
}