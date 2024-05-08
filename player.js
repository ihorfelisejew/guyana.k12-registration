var user  = null ;
var team_players = [] ;
var teamsids =[];
$(document).ready(function() {

    setInterval(function(){
        // $('.direct-chat-messages').html('');
        $.get('server/chat.php?action=getHistoryChat&coach_id='+user.id+'&player=1',function(data){
            // console.log($.parseJSON(data));
            // console.log(data);
            $arrobj = $.parseJSON(data);
            $i=1;
            for(var key in $arrobj){

                if($i > 1){
                    if(user.id != $arrobj[key]['from_id']){
                        $('.direct-chat-messages').append('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left" style="width:100%">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text" style="width:55%">'+$arrobj[key]['msg']+'</div></div>');
                        $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
                    }else{
                        $('.direct-chat-messages').append('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 70%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text">'+$arrobj[key]['msg']+'</div></div></div>');
                        $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
                    }
                }else{
                    if(user.id != $arrobj[key]['from_id']){
                        $('.direct-chat-messages').html('<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left" style="width:100%">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text" style="width:55%">'+$arrobj[key]['msg']+'</div></div>');
                        $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
                    }else{
                        $('.direct-chat-messages').html('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 70%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+$arrobj[key]['name']+'</span></div><img class="direct-chat-img" src="'+$arrobj[key]['pic']+'" alt="Message User Image"><div class="direct-chat-text">'+$arrobj[key]['msg']+'</div></div></div>');
                        $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
                    }
                }
                $i++;
            }
        });
    },4000);

    user = sessionStorage.getItem("user");
    if(user != undefined && user != ""){
        user = JSON.parse(user);
        $("#name").html(user.name);
		$("#last_name").html(user.last_name);
        $("#email").html(user.email);
        $("#league").html(user.league);
		$("#org_name").html(user.org_name);
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
                type : "loadTeamsR2",
                data : data
            },
            success : function(response) {
                //alert(response);
                var response = JSON.parse(response);
                for(var i in response){

                    var html= "<tr>";
                    html +="<td>"+response[i].id+"</td>";
                    html +="<td>"+response[i].name+"</td>";
                    html +="<td>"+user.name+"</td>";
                    html +='<td><button onclick="loadPlayers(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addPlayer" type="button" class="btn btn-default" > Players</button></td>';
                    html +='<td><button onclick="loadLinks(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addVideos" type="button" class="btn btn-default" >Upload Videos.</button></td>';
                    //html +='<td><button onclick="loadScore(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#scorePP" type="button" class="btn btn-default" >Team Average Score</button></td>';
                    html +='<td><p id="score" class="label label-danger" onclick="loadScore(this)" data-teamId="'+response[i].id+'" >View Score</p></td>';
                    html += "</tr>";

                    teamsids.push(response[i].id);
                    $("#coachList").append(html);
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


    showCaptain();


});

function loadRankings(){
    var data = { coachId : user.id}
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadRankings",
            data : data
        },
        success : function(response) {
            //alert(response);
            var response = JSON.parse(response);
            // for(var i in response){

            //     var html= "<tr>";
            //     html +="<td>"+response[i].id+"</td>";
            //     html +="<td>"+response[i].name+"</td>";
            //     html +="<td>"+user.name+"</td>";
            //     html +='<td><button onclick="loadPlayers(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addPlayer" type="button" class="btn btn-default" > Players</button></td>';
            //     html +='<td><button onclick="loadLinks(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#addVideos" type="button" class="btn btn-default" >Upload Videos.</button></td>';
            //     //html +='<td><button onclick="loadScore(this)" data-teamId="'+response[i].id+'" data-toggle="modal" data-target="#scorePP" type="button" class="btn btn-default" >Team Average Score</button></td>';
            //     html +='<td><p id="score" class="label label-danger" onclick="loadScore(this)" data-teamId="'+response[i].id+'" >View Score</p></td>';
            //     html += "</tr>";

            //     teamsids.push(response[i].id);
            //     $("#coachList").append(html);
            // }



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
    console.log('user id: '+user.id);
    $("#player-list-st").html("");
    var html ="";
    $.post('server/player.php',{'type':'getTeamMembers','data':user.id},function(data){
        $objJson = $.parseJSON(data);
        // console.log($objJson);
        for(var key in $objJson){
            html+="<tr>"
            html+="<td>"+$objJson[key]['name']+"</td>"
            html+="<td>"+$objJson[key]['last_name']+"</td>"
            html+="<td>"+$objJson[key]['team_name']+"</td>"
            html+="<td>"+$objJson[key]['org_name']+"</td>"
            html+="</tr>"
            $("#player-list-st").html(html);
        }
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
            $("#video-list").html("");

            if(response != ""){
                var data = JSON.parse(response);
                if( data[0].rating == null){
                    $("#score").html(""+0);
                }else{
                    var score = data[0].rating / meta.challenges.length ;

                    $("#score").html(""+score);
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
                    html+="<td>"+data[i].name+"</td>"
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
    alert('you will not be able to delete this video. This is your final submission!!!');
    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;

    var data = {};
    var teamId =  $("#addLinkBtn").data("teamid");
    data.userid = userid;
    data.teamId = teamId ;
    data.challenge_id = $("#chg-players").val();
    data.videoTitle =  $("#videoTitle").val();
    data.url =  $("#url").val();
    //alert(teamId);
    if(data.videoTitle == "" && data.url == ""){
        return ;
    }


    $.ajax({
        type : 'POST',
        url : 'player.php',
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



function showCaptain(){

    user = sessionStorage.getItem("user");

    if(user != undefined && user != ""){
        user = JSON.parse(user);
    }
    var userid = user.id;
    var data = {};
    data.userid = userid;
    $.ajax({
        type : 'POST',
        url : 'player.php',
        data : {
            type : "showCaptain",
            data : data
        },
        success : function(response) {

            //alert(response);
            //location.reload();
            if(response >= 1){
                $('#showhidevideobtn').show();
            }else{
                $('#showhidevideobtn').hide();
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
        $.post('server/chat.php?action=sendMessage&coach_id='+user.id+'&from_id='+user.id+'&msg='+$msg+'&player=1',function(data){
            // alert(data);
            $('#msg-min').val('');
            $('.direct-chat-messages').append('<div id="fetch_msg"><div class="direct-chat-msg right" style="width: 70%;float: right;"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">'+user.name+'_'+user.last_name+'</span> </div><!-- /.direct-chat-info --> <img class="direct-chat-img" src="http://buira.org/assets/images/shared/default-profile.png" alt="Message User Image"><div class="direct-chat-text">'+$msg+'</div></div></div>');
            $('.direct-chat-messages').scrollTop($('.direct-chat-messages')[0].scrollHeight);
        });
    }
}

