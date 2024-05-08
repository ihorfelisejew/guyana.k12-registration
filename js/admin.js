var user  = null ;
var team_players = [] ;
var sort = "order";
var teamsids = [];
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
		if(user.role_id =="5"){
			$("#role").html("Admin");
		}
		$("#user").val(user.id);
	
		
		var data = { jid : user.id}

	}
	
	
	/* Save Lessions */
	 $("#formpidata").on('submit',(function(e) {
		
		  e.preventDefault();
		  $.ajax({
				 url: "server/ajaxupload.php",
		   type: "POST",
		   data:  new FormData(this),
		   contentType: false,
				 cache: false,
		   processData:false,
		   beforeSend : function()
		   {
			//$("#preview").fadeOut();
			$("#err").fadeOut();
		   },
		   success: function(data)
			  {
				  
				 // console.log(data);
			if(data=='invalid')
			{
			 // invalid file format.
			 $("#err").html("Invalid File !").fadeIn();
			}
			else
			{
			 // view uploaded file.
			 $("#preview").html(data).fadeIn();
			 $("#formpidata")[0].reset(); 
			}
			  },
			 error: function(e) 
			  {
			$("#err").html(e).fadeIn();
			  }          
			});
 }));
 
	$('#orderBtn').click(function(){
		sort="order";
		invoice_details_fnc();
		//flag_order=!flag_order;
	});

	$('#statusBtn').click(function(){
		sort="status";
		invoice_details_fnc();
	});
	
	getChallenges();
	
	invoice_details_fnc();
	
});

function saveChallengeText(){
	
	

	
	var data = {};
	data.text = $("#chalng-txt").val();
	data.deadline = new Date($("#deadline").val()).toISOString();
	data.createdBy =user.id;
	
	
	
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "saveChallengeText",
			data : data
		},
		success : function(response) {
			
			alert("Successfully added");
			 $("#chalng-txt").val("");
			$("#deadline").val("");
	
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	

}

function saveChallenge(){
	
	var data = {};
	data.name = $("#chalng-name").val();
	data.lobj = $("#learning-obj").val();
	data.turl = $("#tutorial-url").val();
	data.intrvideo = $("#intro-video").val();
	data.startDate = new Date($("#startDate").val()).toISOString();
	data.endDate =   new Date($("#endDate").val()).toISOString();
	data.round = $("#round-dd").val();
	
	
	data.text = $("#chalng-txt").val();
	
	
	
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "saveChallenge",
			data : data
		},
		success : function(response) {
			
			alert("Successfully added");
			$("#chalng-name").val("");
			$("#startDate").val("");
			$("#endDate").val("");
			$("#chalng-txt").val("");
			$("#tutorial-url").val("");
			$("#learning-obj").val("");
			$("#intro-video").val("");
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	

}
function showChangeName(element){
	$("#txt-league"+$(element).data("id")).show();
	$("#btn-txt-league"+$(element).data("id")).show();
}

function editLeague(element){
	
	
	var txt = $("#txt-league"+$(element).data("id")).val();
	if(txt == ""){
		return ;
	}
	var data = { txt :txt ,id :$(element).data("id")  };
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "updateLeagueName",
			data : data
		},
		success : function(response) {
			$("#label-league"+$(element).data("id")).html(txt);
			
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
}

function searchLeague(){
	
	var leagueName = $("#league-name").val();
	var data = { leagueName : leagueName };
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "searchLeague",
			data : data
		},
		success : function(response) {
			var html ="";
			$("#league-list").html("");
			try{
				
				response = JSON.parse(response);
				for(var i in response){
					html +="<li ><span id='label-league"+response[i].id+"'>"+response[i].name+" <span> ";
						html +="<input id='txt-league"+response[i].id+"' style='display:none;' type='text'></input>";
						html +="<button id='btn-txt-league"+response[i].id+"' data-id='"+response[i].id+"' style='display:none;' class='btn btn-default dropdown-toggle' data-id='"+response[i].id+"' onclick='editLeague(this)'>Save</button>";
						html +="<button class='btn btn-default dropdown-toggle' data-id='"+response[i].id+"' onclick='showChangeName(this)'>Change name</button>";
					html +="</li>";
				}
			
				$("#league-list").html(html);
				
			}catch(e){
				alert("Not found");
			}
		
			
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
}

function loadChallenge(){
	

	
	
	
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "loadChallenge",
			data : data
		},
		success : function(response) {
			
			
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}


function convertUTCDateToLocalDate(date) {
    var newDate = new Date(date.getTime()+date.getTimezoneOffset()*60*1000);

    var offset = date.getTimezoneOffset() / 60;
    var hours = date.getHours();

    newDate.setHours(hours - offset);

    return newDate;   
}

function searchTeam(){
	
	var teamName = $("#team-name").val();
	var data = { teamName : teamName };
	$.ajax({
		type : 'POST',
		url : 'server/user.php',
		data : {
			type : "searchTeam",
			data : data
		},
		success : function(response) {
			var html ="";
			$("#team-list").html("");
			try{
				
				response = JSON.parse(response);
				for(var i in response){
					html +="<li ><span id='label-league"+response[i].id+"'>"+response[i].name+" <span> ";
					
					html +="</li>";
				}
			
				$("#team-list").html(html);
				
			}catch(e){
				alert("Not found");
			}
		
			
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
}

function loadAllUser(){
	
	$("#user-list").html("");
	var html ="";
	for(var i in meta.users){
		
		 html ="";
		
		html +='<li id="'+meta.users[i].id+'"><span>'+meta.users[i].name+' <span> ';
		html +='<select id="user-select-'+meta.users[i].id+'" data-id="'+meta.users[i].id+'" data-state="'+meta.users[i].status+'" onchange="changeStatus(this)"> ';
			html +='<option value="0">Active</option> ';
			html +='<option value="1">In Active</option> ';
			html +='<option value="2">Suspeneded</option> ';
		html +='</select> ';
	//	html +="<button class='btn btn-primary btn-lg' data-state='"+state+"' data-index='"+i+"' onclick='changeStatus(this)'>"+status+"</button>";
		
		html +="</li>";
		$("#user-list").append(html);
		$("#user-select-"+meta.users[i].id).val(meta.users[i].status);
		
	}
	
	//$("#user-list").html(html);	
	
	
}


function changeStatus(element){
	
	var id = $(element).data("id");
	var state = $(element).data("state");

	state = $("#user-select-"+id).val();
	var data = {state : state , id :id};
	
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

function openRoundsPopup(){

	var result  = meta.rounds;
	//alert(result);
	var html = "";
	for(var i in result){
		
		html += '<tr>';
	    	html += '<td> '+result[i].round+' </td> ';

	    	html += '<td> <input data-id='+result[i].id+' value='+result[i].challenges+' onchange="changeChallanges(this)" / >  </td> ';

	  	html += '</tr>';
		
	}
	
	$("#round-body").html(html);
	
	
}

$('#payment_save').on('submit',(function(e) {
	e.preventDefault();
	var formData = new FormData(this);
	$.ajax({
        type:'POST',
        url: 'server/coach.php',
        data:formData,
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        success:function(data){
			console.log(data);
			alert('Updated successfully!!!');
			location.reload();
        },
        error: function(data){
			console.log(data);
			alert('You have no checked!');
            location.reload();
        }
      });
  }));

  $('#csv_download_all').on('submit',(function(e) {
	  e.preventDefault();
	var formData = new FormData(this);
	$.ajax({
        type:'POST',
        url: 'server/csv_download.php',
        data : {
            type : "csv_download_all",
            data : formData
        },
        dataType: 'json',
        cache:false,
        contentType: false,
        processData: false,
        // success:function(data){
		// 	console.log(data);
		// 	alert('Updated successfully!!!');
		// 	location.reload();
        // },
        // error: function(data){
		// 	console.log(data);
		// 	alert('You have no checked!');
        //     // location.reload();
        // }
      });
    }));

	$('#csv_download_out').on('submit',(function(e) {
		e.preventDefault();
	  var formData = new FormData(this);
	  $.ajax({
		  type:'POST',
		  url: 'server/csv_download1.php',
		  data : {
			  type : "csv_download_all",
			  data : formData
		  },
		  dataType: 'json',
		  cache:false,
		  contentType: false,
		  processData: false,
		//   success:function(data){
		// 	  console.log(data);
		// 	  alert('Updated successfully!!!');
		// 	  location.reload();
		//   },
		//   error: function(data){
		// 	  console.log(data);
		// 	  alert('You have no checked!');
		// 	  // location.reload();
		//   }
		});
	  }));


function getPlayersForPayment() {
	
    $("#playersForPayment").html("");
    var html ="";
    //alert(meta.playerlistall);
	let users = meta.adminplayerlistall;
    for(var i in users){
        let status =  'Outstanding';
        if(users[i].balance >= 0) status = 'Paid';
        html +='<tr id="'+users[i].id+'"><td><input type = "hidden" name = "name[]" value="'+ users[i].name + ' ' + users[i].last_name +'">'+users[i].name + ' ' + users[i].last_name+'</td><td><input type = "hidden" name = "balance[]" value="'+ Number(users[i].balance) +'">$' + Number(users[i].balance) + '</td><td><input type = "hidden" name = "status[]" value="'+status +'">' + status + '</td></tr>';
    }

    $("#playersForPayment").html(html);
}

function getPlayersForPaymentBalance() {
	
    $("#playersForPaymentBalance").html("");
    var html ="";
    //alert(meta.playerlistall);
	let users = meta.adminplayerlistall;
    for(var i in users){
        if(users[i].balance < 0){
			html +='<tr id="'+users[i].id+'"><td><input type = "hidden" name = "name[]" value="'+ users[i].name + ' ' + users[i].last_name +'">'+users[i].name + ' ' + users[i].last_name+'</td><td><input type = "hidden" name = "balance[]" value="'+ Number(users[i].balance) +'">$' + Number(users[i].balance) + '</td><td>Outstanding</td></tr>';
		}
    }

    $("#playersForPaymentBalance").html(html);
}

function getPlayers() {
	
	$('#searchUser').val("");
    $("#players").html("");
    var html ="";
    //alert(meta.playerlistall);
	let users = meta.adminplayerlistall;
    for(var i in users){
		// if(users[i].current_due == null) users[i].current_due = 0;
		// if(users[i].discount == null) users[i].discount = 0;
        html +='<tr><td><input type="hidden" name="id[]" value="'+ users[i].id +'" >'+users[i].name + ' ' + users[i].last_name + ' ( ' + users[i].org_name + ' ) ' + '</td><td><input name="current_due[]" value="' + Number(users[i].current_due) + '"></td><td><input name="discount[]" value="' + Number(users[i].discount) + '"></td><td>'+ "<input type='checkbox' name='action[]' value='" + users[i].id + "' style='width: 100px !important;'>" +'</td></tr>';
    }

    $("#players").html(html);
}

$('#searchUser').keyup(function(event) {
	let term = event.target.value;
	let users = meta.adminplayerlistall;
	let filtered_users = users.filter(checkUsers);

	function checkUsers(user) {
		let username = user.name + ' ' + user.last_name + ' ' + user.org_name;
		username = username.toLowerCase();
	    return username.indexOf(term) > -1;
	}
    $("#players").html("");
    var html ="";
    //alert(meta.playerlistall);
    for(var i in filtered_users){
        html +='<tr><td><input type="hidden" name="id[]" value="'+ filtered_users[i].id +'" >'+filtered_users[i].name + ' ' + filtered_users[i].last_name + ' ( ' + filtered_users[i].org_name + ' ) ' + '</td><td><input name="current_due[]" value="' + Number(filtered_users[i].current_due) + '"></td><td><input name="discount[]" value="' + Number(filtered_users[i].discount) + '"></td><td>'+ "<input type='checkbox' name='action[]' value='" + filtered_users[i].id + "' style='width: 100px !important;'>" +'</td></tr>';
    }

    $("#players").html(html);
});

$('#ok-cal-btn').click(function() {
	$.ajax({
		url: 'server/coach.php',
		type: 'post',
		data: {
			type: 'calculate',
			data: 'data'
		},
		success:function(res) {
			location.reload();
		},
		error:function(err) {
			console.log(err);
		}
	})
});

function openEmailPopup(){

	var role  = $("#email-role").val();
	var subject  = $("#email-subject").val();
	var meaasge  = $("#email-meaasge").val();
	var data = { role : role,subject : subject,meaasge : meaasge };
	alert(role+subject+meaasge);
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "sendbulkemail",
			data : data
		},
		success : function(response) {
			alert(response);
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}

function newsticker(){

	var newstickertext  = $("#newstickertext").val();
	var data = { newstickertext : newstickertext};
	//alert(role+subject+meaasge);
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "newstickertext",
			data : data
		},
		success : function(response) {
			alert(response);
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}
function newsticker2(){

	var newstickertext  = $("#newstickertext2").val();
	var data = { newstickertext : newstickertext};
	//alert(role+subject+meaasge);
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "newstickertext2",
			data : data
		},
		success : function(response) {
			alert(response);
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}
 
function newsticker3(){

	var newstickertext  = $("#newstickertext3").val();
	var data = { newstickertext : newstickertext};
	//alert(role+subject+meaasge);
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "newstickertext3",
			data : data
		},
		success : function(response) {
			alert(response);
		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}


function getChallenges(){
	
	$("#chng-list").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "ChallangeList",
			data : "hello"
		},
		success : function(response) {
			
		
		var html = "<tr><th style='background:#4BADC8'>Challenge</th><th style='background:#4BADC8'>Start Date</th><th style='background:#4BADC8'>End Date</th><th style='background:#4BADC8'>Challenge Text</th></tr>";
		$("#chng-list").html(html);
		var response = JSON.parse(response);
		for(var i in response){
		//html +='<li id="'+meta.users[i].id+'"><span>'+meta.challenges[i].name+' Start Date :'+meta.challenges[i].startDate+' , End Date : '+meta.challenges[i].endDate+' <span> ';
		html +=  "<tr><td>"+response[i].name + "</td><td> "+ response[i].startDate+ "</td><td> "+ response[i].endDate+  "</td><td>"+ response[i].text+ "</td></tr>";

		}
	
		$("#chng-list").html(html);

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
	
	
}
function changeChallanges(element){
	
	var id = $(element).data("id");
	var number =  Number($(element).val());
	var data = { id : id , number : number} ;
	// update meta 
	
	for(var i in meta.rounds){
		
		if(meta.rounds[i].id == id ){
			meta.rounds[i].challenges = number ;
		}
	}
	
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "changeChallangesNumber",
			data : data
		},
		success : function(response) {
			
			
		

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
	
}

function openCreateChallengePP(){
	var html = "";
	for(var i in meta.rounds){
		
		html += '<option value='+meta.rounds[i].id+'>'+meta.rounds[i].round+'</option>' ;
	
	}
	
	$("#round-dd").html(html);
}


function getTeamRankingAdminR1(str){
	

	var usercounty = str;
	//alert(usercounty);
	var data = {  usercounty :usercounty  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTeamRankingAdminR1",
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
				
				$("#standingsR1").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}


function getTeamRankingAdminR2(str){
	

	var userstate = str;
	//alert(usercouty);
	var data = {  userstate :userstate  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTeamRankingAdminR2",
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
function SearchFunction(){
// Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("txt_search_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("invoice-table");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
	 td1 = tr[i].getElementsByTagName("td")[1];
    if (td || td1) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
	
  }	
}

function getTeamRankingAdminR3(str){
	

	var userstate = str;
	//alert(usercouty);
	var data = {  userstate :userstate  } ;
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "getTeamRankingAdminR3",
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
				
				$("#standingsR3").html(html)
			}

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

function UpdateInvoiceData(){
	var imagesource  = $("#invoice_id").val();
	var check_num  = $("#check_num").val();
		 
         var data = { id : imagesource, check_num: check_num } ;
		 $.ajax({
			type : 'POST',
			url : 'server/coach.php',
			data : {
				type : "changeinvoice_status",
				data : data
			},
			success : function(response) {
				//alert(response);
				alert(response);
			   location.reload();
	
			},
			error : function(data) {
				alert("Server Error please contact admin");
			}
		});	
}

function invoice_details_fnc(){
	
	$("#invoice_details").html("");
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "invoice_details_fnc",
			data : sort
		},
		success : function(response) {
			
			
		var html ="";
		//html += "<tr><th>Challenge</th><th>Start Date</th><th>End Date</th><th>Challenge Text</th></tr>";
		var response = JSON.parse(response);
		for(var i in response){
			if(response[i].invoice_status == "paid"){
				var invc_option = "<td></td>";  
				}else{
				 var invc_option = "<td><a data-toggle='modal' class='change_invc_status' data-target='#invoiceUpdate' data-id='"+response[i].id+"'>edit</a></td>";	
				}
		//html +='<li id="'+meta.users[i].id+'"><span>'+meta.challenges[i].name+' Start Date :'+meta.challenges[i].startDate+' , End Date : '+meta.challenges[i].endDate+' <span> ';
		html +=  "<tr><td>"+response[i].id + "</td><td>"+response[i].Org_Name + "</td><td> "+ response[i].date+  "</td><td>"+ response[i].registrations_fee+ "</td><td>"+ response[i].invoice_status+ "</td><td>"+ response[i].Check_num+ "</td>"+ invc_option +"</tr>";

		}
	
	$("#invoice_details").html(html);

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
	
}

