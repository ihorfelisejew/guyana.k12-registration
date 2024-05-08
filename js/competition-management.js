let activeCompetition;
let activeChallengeOrMatchInstance;
let competitions;

$(document).ready(()=>{

    // //modal
    // $("#open_competition_settings").click(function(){
    //     $(".competition-settings-modal").css("display", "block");
    // });
        
    //     // When the user clicks anywhere outside of the modal, close it
    // $(window).click(function(event) {
    //     if ($(event.target).is(".competition-settings-modal")) {
    //     $(".competition-settings-modal").css("display", "none");
    //     }
    // });

    // $('#save_competition_settings').click(()=>{
    //     $(".competition-settings-modal").css("display", "none");
    // })

	loadCompetitionSelect();
})

function loadCompetitionSelect(){
	$.ajax({
		type : 'POST',
		url : 'server/competition.php',
		data : {
			type : "loadCompetitions",
			data : 1
		},
		success : function(response) {
			
			let res = JSON.parse(response)
			
			res.forEach((el, index) => {
				$('#competitions_select').append(`
				<option value="${index}">${el.name}</option>
			`)
				
			
			});
			$('#competitions_select').val(0)
			
			updateUI();

			
		},
		error : function(data) {
			alert("Server Error in updateUI() - please contact admin")
		}
	});
}
function updateUI(){

    $.ajax({
		type : 'POST',
		url : 'server/competition.php',
		data : {
			type : "loadCompetitions",
			data : 1
		},
		success : function(response) {
			

			competitions = JSON.parse(response)
			console.log(competitions)
			competitionChange()
			

			
		},
		error : function(data) {
			alert("Server Error in updateUI() - please contact admin")
		}
	});
}


function competitionChange(){
	activeCompetition = competitions[$('#competitions_select').val()]
	$('.manage-competitions-column:first-child').html('')

	if (activeCompetition.type == 'Submission'){
		
	}
	for (const round in activeCompetition.challengesOrMatches) {
		$('.manage-competitions-column:first-child').append(
			` <div id="round-${round}" class="round section">
				<h3>Round ${round}</h3>
				<hr>
				<div class="challenges">
					
				</div>
				<button onclick="addNewChallenge(${round})" class="blue-button rounded-button">
                    Add new challenge 
                </button>
			</div>`
		)

		activeCompetition.challengesOrMatches[round].forEach((el, index) => {
			if(activeCompetition.type == 'Submission'){
				$(`#round-${round} .challenges`).append(
					` 
					<div id="challenge-${index}">
						<span>${el.name}</span>
						<div>
						<a onclick="deleteChallenge(${round},${index})" class="delete-link" href="javascript:void(0)">Delete</a>
							<a onclick="editChallenge(${round},${index})" href="javascript:void(0)">Edit</a>
							
						</div>
					</div>
					`
				)
			} else if (activeCompetition.type == 'Match'){
				$(`#round-${round} .challenges`).append(
					` 
					<div id="challenge-${index}">
						<span>${el.name}</span>
						
					</div>
					`
				)
			}
			
		});
	}

	if(activeCompetition.type == 'Submission'){
	$('.manage-competitions-column:first-child').append(`
	<button onclick="addRound()" class="rounded-button black-button">Add round</button>
	`)}

}


function editChallenge(round, index){
	if(!$('.edit-challenge').is(':visible')){
		$('.edit-challenge').css('display', 'flex')
	}

	$('.edit-challenge').removeClass().addClass(`edit-challenge-${round}-${index} edit-challenge section`)

	activeChallengeOrMatchInstance = activeCompetition.challengesOrMatches[round][index]

	$('#edit_round_number').html('Round #' + round)
	$('#edit_challenge_name').html(activeChallengeOrMatchInstance.name)


	$('#challenge_name').val(activeChallengeOrMatchInstance.name)
	$('#challenge_text').val(activeChallengeOrMatchInstance.text)
	$('#challenge_learning_obj').val(activeChallengeOrMatchInstance.Learning_obj)
	$('#challenge_start_date').val(activeChallengeOrMatchInstance.startDate)
	$('#challenge_end_date').val(activeChallengeOrMatchInstance.endDate)
	$('#challenge_tutorial_link').val(activeChallengeOrMatchInstance.Tutorial_url)
	$('#challenge_intro_video_link').val(activeChallengeOrMatchInstance.intro_video)
	$('#challenge_judge_by').val(activeChallengeOrMatchInstance.judge_by)

}

function saveEditChanges(){
	let edited = activeChallengeOrMatchInstance;
	edited.name = $('#challenge_name').val()
	edited.text = $('#challenge_text').val()
	edited.Learning_obj = $('#challenge_learning_obj').val()
	edited.startDate = $('#challenge_start_date').val()
	edited.endDate = $('#challenge_end_date').val()
	edited.Tutorial_url = $('#challenge_tutorial_link').val()
	edited.intro_video = $('#challenge_intro_video_link').val()
	edited.judge_by = $('#challenge_judge_by').val()


	$.ajax({
		type : 'POST',
		url : 'server/competition.php',
		data : {
			type : "saveEditChanges",
			data : edited
					
		},
		success : function(response) {
			alert('Saved!')
			updateUI()
		},
		error : function(data) {
			alert("Server Error in saveEditChanges() - please contact admin")
		}
	});
}

function deleteChallenge(round, index){
	$.ajax({
		type : 'POST',
		url : 'server/competition.php',
		data : {
			type : "deleteChallenge",
			data : activeCompetition.challengesOrMatches[round][index]
					
		},
		success : function(response) {
			$(`#round-${round} #challenge-${round}`).remove()
			$(`.edit-challenge-${round}-${index}`).hide()
			updateUI()
		},
		error : function(data) {
			alert("Server Error in deleteChallenge() - please contact admin")
		}
	});
}

function addNewChallenge(round){
	$.ajax({
		type : 'POST',
		url : 'server/competition.php',
		data : {
			type : "addNewChallenge",
			data : { id: activeCompetition.id, round}
					
		},
		success : function(response) {
			console.log(response)
			updateUI()
		},
		error : function(data) {
			alert("Server Error in deleteChallenge() - please contact admin")
		}
	});
}


function addRound(){
	
	const keys = Object.keys(activeCompetition.challengesOrMatches).map(Number).sort((a, b) => a - b);

	// Start checking from 1 onwards to find the smallest missing key
	let missingKey = 1;

	for (let key of keys) {
	if (key === missingKey) {
		// If current key matches the missingKey, increment missingKey to find the next potential missing key
		missingKey++;
	} else if (key > missingKey) {
		// If we find a key greater than missingKey, we've found our gap
		break;
	}
	// No need to check for key < missingKey, as the keys are sorted
	}


	addNewChallenge(missingKey)
}