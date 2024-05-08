var regionsAndNDCs = []
$(document).ready(function() {

    


    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadNDCandRegions",
            data : ''
        },
        success : function(response) {
            var response = JSON.parse(response);
            console.log(response);


            $('#search_region').html('<option selected disabled>SELECT REGION</option>')
            $('#search_ndc').html('<option selected disabled>SELECT NDC</option>')
            regionsAndNDCs = response
            for(st in response){
                $('#search_region').append(`
                    <option value="${st}">${st}</option>
                `)
            }

           
    
    
        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

    $('#search_region').on('change', function(){
        $('#search_ndc').html('<option selected disabled>SELECT NDC</option>')
        let r = $('#search_region').val()
        regionsAndNDCs[r].forEach(ndc => {
            $('#search_ndc').append(`
            <option value="${ndc}">${ndc}</option>
        `)
        });
    })

// loadTeams()
// loadAccounts()





})
function loadTeams  (state, county){
    if ($('#search_region').val() == ''||$('#search_region').val() == null||$('#search_ndc').val() == ''||$('#search_ndc').val() == null) {
        return
    }
    var data = { coachId : 'admin',
    state, county}
    console.log(data)
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadTeams",
            data : data
        },
            success : function(response) {
                //alert(response);
                console.log(response);
                var response = JSON.parse(response);
                $("#teamsList").html('');
                for(var i in response){
                

                    
                    // ${response[i].haveplayer > 0 ? '<td><button onclick="loadLinks(this)" data-teamId="${response[i].id}" data-toggle="modal" data-target="#addVideos" type="button" class="btn btn-warning" >Upload Videos</button></td>' : '<td><button onclick="loadLinks1(this)" data-teamId="${response[i].id}" data-toggle="modal" data-target="#addVideos1" type="button" class="btn btn-warning" >Upload Videos</button></td>'}
                    // <td><button onclick="loadPlayers(this)" data-teamId="${response[i].id}" data-toggle="modal" data-target="#addPlayer" type="button" class="btn btn-warning" > Players</button></td>
                    // <td><button onclick="loadCaptain(this)" data-teamId="${response[i].id}" data-toggle="modal" data-target="#addCaptain" type="button" class="btn btn-warning" > Captain</button></td>
                    //					<td><a href="javscript:void(0)" onclick="changeNmaeidB('nameform${response[i].id}')">Edit</a> <div style="display:none" class="nameform${response[i].id}"><form class="edittemapi"><input type="text" value="${response[i].name}" class="dardkiska" /><input type="hidden" value="${response[i].id}" class="teamidpi" /><input type="submit" /></form></div> | <a href="javscript:void(0)" onclick="deleteTeamPI('${response[i].id}'')">Delete</a> </td>

                    var html = `<tr>
                    
                    <td id="team-name-${response[i].id}" data-coach-id = "${response[i].coach_id}">${response[i].name}</td>
                    
                    <td id="coach-team-${response[i].id}"></td>

                    <td><button onclick="manageTeams(${response[i].id})" data-toggle="modal" data-target="#manageTeam" type="button" style="width: 106px !important" class="manageTeam-button btn btn-warning" > Manage Team</button></td>

                    </tr>`;
                


                    teamsids.push(response[i].id);
                    $("#teamsList").append(html);
                    loadCaptain(response[i].id)
                    loadPlayers(response[i].id)
                    // loadScore(response[i].id)
                    loadCoach(response[i].id)
                }


            },
            error : function(data) {
                alert("Server Error please contact admin")
            }
    });
}



const loadAllChallengesAdmin = (teamId) => {
    return $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "loadAllChallenges",
            data : {competition_id: user.competition_id,
                teamId}
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
}

const loadCoach = function (teamId){

    //alert(teamId);
    var data = { teamId :teamId } ;
    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "getTeamCoach",
            data : data
        },
        success : function(response) {
            $("#change-coach").html('');
            if(response != ""){
                var data = JSON.parse(response);

                if( data){

                    $("#coach-team-"+teamId).html(data.main_coach.coach_name + ' ' + data.main_coach.coach_last_name ).attr('coachid', data.main_coach.coach_id);
                    $("#team-coach").html(data.main_coach.coach_name + ' ' + data.main_coach.coach_last_name )

                    $("#change-coach").append('<option selected disabled>Select User</option>');  

                    data.other_coaches.forEach(coach => {
                        $("#change-coach").append('<option value='+coach.coach_id +'>'+coach.coach_name + ' ' + coach.coach_last_name + '</option>');  
                    });


                }

            }

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });

}

const loadTeamLinks = function (teamId){
    let coachId = $(`#team-name-${teamId}`).data('coach-id')

	var data = { competition_id : user.competition_id,
    teamId, coachId}
		$.ajax({
			type : 'POST',
			url : 'server/judge.php',
			data : {
				type : "loadLinks",
				data : data
			},
			success : function(response) {
				
				$("#links").html('');
				var response = JSON.parse(response);
				for(var i in response){
					var url = response[i].url;
					var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
					if(videoid != null) {
					   console.log("video id = ",videoid[1]);
					} else { 
						console.log("The youtube url is not valid.");
					}
					console.log(response[i])
					var youtubevidid = videoid ? videoid[1] : "The youtube url is not valid.";
					
					var html ="";
					html +='<div class="video" id="video-'+response[i].id+'" >';
						// html +='<a href="'+response[i].url+'" class="thumbnail" target="_blank">';

						//html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
						// html +='<p>"'+response[i].title+' l '+response[i].endDate+'" <span style="float: right;">View in Full Screen</span></p>';
						html += '<iframe width="530" height="280" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';		
						// html +='</a>';
						html += '<div class="rated-inputs">';		
						html +=`<input  id="rate-art-${response[i].id}" type="number" min="1" max="100" value="${response[i].artistic ? response[i].artistic: ''}" placeholder="Artistic" />`;
						html +=`<input  id="rate-cret-${response[i].id}" type="number" min="1" max="100" value="${response[i].creativity ? response[i].creativity: ''}" placeholder="Creativity" />`;
						html +=`<input  id="rate-logic-${response[i].id}" type="number" min="1" max="100" value="${response[i].logic ? response[i].logic : ''}" placeholder="Logic" />`;
						html +=`<input  id="rate-problemSolved-${response[i].id}" type="number" min="1" max="100" value="${response[i].problem_solved ? response[i].problem_solved : ''}" placeholder="Problem Solving" />`;
						html += '</div>';
						html +=`<input type="button"  value="SUBMIT RATING" class="submit-rating-${+response[i].id}" placeholder="1-100" onclick="rateLink(this,${response[i].id},${user.id})"/>`;
					html +='</div>';
					
					$("#links").append(html);
				}
				
				

			},
			error : function(data) {
				alert("Server Error please contact admin")
			}
		});
}


const changeCoach = function (){
    var teamId =  $("#addPlayerBtn").data("teamid");

    let coachId = $('#change-coach').val()
    var data = { teamId :teamId, coachId} ;

    $.ajax({
        type : 'POST',
        url : 'server/coach.php',
        data : {
            type : "changeCoach",
            data : data
        },
        success : function(response) {
            alert(response)
            loadCoach(teamId)
            

        },
        error : function(data) {
            alert("Server Error please contact admin")
        }
    });


}

function rateLink(element,id,userId){
	
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
           type : "rateLink",
           data : data
       },
       success : function(response) {
           
               
           
           alert("Added Successfully");
           loadLinks()

       },
       error : function(data) {
           alert("Server Error please contact admin")
       }
   });
}


const searchTeams = ()=>{
    if($('#search_region').val() == '' || $('#search_region').val() == null){
        alert('Select Region')
        return
    }else if($('#search_ndc').val() == '' || $('#search_ndc').val() == null){
        alert('Select NDC')
        return
    }
    let r = $('#search_region').val()
    let ndc =  $('#search_ndc').val()
    

    loadTeams(r, ndc)
}

function loadAccounts(phone = null, fullname = null){
	
	
	var data = { phone:phone, fullname:fullname } ;
    console.log(data)
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "loadAccounts",
			data : data
		},
		success : function(response) {
            $("#manage-accounts").html(`
            <div class="column-names inside-container">
                <div>
                  <span>Name</span>
                </div>
                <div>
                  <span>Phone Number</span>
                </div>
                <div>
                  <span>Password</span>
                </div>
                <div>
                  <span>Role</span>
                </div>
                <div>
                  <span>Status</span>
                </div>
                <div></div>
              </div>
            `)
			var response = JSON.parse(response);
			console.log(response)
			for(var i in response){
                let status = ''
                switch(response[i].role_id){
                    case 1:
                        status = 'Coach'
                        break
                    case 2:
                        status = 'Player'
                        break
                    case 3:
                        status = 'Judge'
                        break
                    case 4:
                        status = 'Organization'
                        break
                    case 6:
                        status = 'Master Account'
                        break
                    case 7:
                        status = 'Volunteer'
                        break

                }
				var html ="";

				html += `
				<div class="account inside-container">
					<div>
						<input class="rounded-button" value="${response[i].name} ${response[i].last_name}" id="account-name-${response[i].id}">
						
					</div>
					<div>
                        <input class="rounded-button" value="${response[i].phone}" id="account-phone-${response[i].id}">
					</div>
					<div>
                        <input class="rounded-button" value="${response[i].password}" id="account-password-${response[i].id}">
						
					</div>
                    <div>
                    
                        <span  value="${response[i].role_id}" id="account-role-${response[i].id}">${status}</span>
						
					</div>
                    <div>
                        ${response[i].role_id == 2 ? `
                        <input class="rounded-button" value="${response[i].status}" id="account-status-${response[i].id}">
                        ` : ''}
                        </div>
                    <div>
                        <button class="black-button rounded-button" onclick="updateAccount(${response[i].id})">Update</button>
					</div>
				</div>`
				
				$("#manage-accounts").append(html);
			}

			
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

function updateAccount(id){
	var status, phone, fullname;

	status = $(`#account-status-${id}`).val()
    phone = $(`#account-phone-${id}`).val()
	fullname = $(`#account-name-${id}`).val()
    password = $(`#account-password-${id}`).val()


	var data = { id, status, phone, fullname, password } ;
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "updateAccountData",
			data : data
		},
		success : function(response) {
			
			alert(response)
			
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

function searchAccounts(){
    // if(($('#search_phone').val() == null && $('#search_name').val() == null)|| ($('#search_phone').val() == '' && $('#search_name').val() == '') ){
    //     alert('Enter Phone Number or Full Name ')
    //     return
    // }
    let phone = $('#search_phone').val()
    let fullname =  $('#search_name').val()
    

    loadAccounts(phone, fullname)
}