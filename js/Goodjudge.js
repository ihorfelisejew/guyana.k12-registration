var user  = null ;
var team_players = [] ;
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
		$("#user").val(user.id);
      	
		
		var data = { jid : user.id}
		$.ajax({
			type : 'POST',
			url : 'server/judge.php',
			data : {
				type : "loadLinks",
				data : data
			},
			success : function(response) {
				loadRatedLinks(user.id);
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
					html +='<div class="col-md-6" id="video-'+response[i].id+'" style="padding-bottom:10px;padding-top:10px;border-bottom:1px solid #c1c1c1">';
						html +='<a href="'+response[i].url+'" class="thumbnail" target="_blank">';

						//html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
						html +='<p>"'+response[i].title+' l '+response[i].endDate+'" <span style="float: right;">View in Full Screen</span></p>';
						html += '<iframe width="530" height="280" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';		
						html +='</a>';
									
						html +='<input id="rate-art-'+response[i].id+'" type="number" min="1" max="100" style="width: 100px;" placeholder="Artistic" />';
						html +='<input id="rate-cret-'+response[i].id+'" type="number" min="1" max="100" style="width: 100px;" placeholder="Creativity" />';
						html +='<input id="rate-logic-'+response[i].id+'" type="number" min="1" max="100" style="width: 100px;" placeholder="logic" />';
						html +='<input id="rate-problemSolved-'+response[i].id+'" type="number" min="1" max="100" style="width: 125px;" placeholder="Problem solved" />';
						html +='<input type="button" style="margin-left:12px" class="btn btn-primary" value="Rate" placeholder="1-100" onclick="rateLink(this,'+response[i].id+','+user.id+')"/>';
					html +='</div>';
					
					$("#links").append(html);
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



function loadRatedLinks(jid){
	
	
	var data = { jid :jid } ;
	$.ajax({
		type : 'POST',
		url : 'server/judge.php',
		data : {
			type : "loadRatedLinks",
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
				html +='<div class="col-md-4">';
					html +='<span class="badge">'+response[i].rating+'</span>';
					html +='<a href="'+response[i].url+'" class="thumbnail">';
					html +='<p>"'+response[i].title+'"</p>';
					//html +='<img src="https://www.youtube.com/yt/brand/media/image/YouTube-icon-full_color.png" style="width: 150px; height: 150px"></img>';
					//html += '<iframe width="420" height="315"src="'+response[i].url+'"></iframe>';					
					html += '<iframe width="340" height="190" src="https://www.youtube.com/embed/'+youtubevidid+'"></iframe>';		
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

function switchView(id){
	if(id == "history"){
		$("#historyLinks").show();
		$("#links").hide();
		$("#links-title").hide();
		$("#history-title").show();
		$("#history-btn").show();
		$("#link-btn").hide();
	}else{
		
		$("#historyLinks").hide();
		$("#links").show();
		$("#links-title").show();
		$("#history-title").hide();
		$("#link-btn").show();
		$("#history-btn").hide();
	}
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
			
				
			$("#video-"+id).remove();
			alert("Added Successfully");
			location.reload();

		},
		error : function(data) {
			alert("Server Error please contact admin")
		}
	});
}


function sendInvitePeople(){

	var emails  = $("#inviteemails").val();
	var message  = "Test Message";
	//alert(emails);
	var data = { emails : emails, message : message };
	
	$.ajax({
		type : 'POST',
		url : 'server/coach.php',
		data : {
			type : "sendInvitePeople",
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
