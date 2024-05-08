$(document).ready(function() {

	$.ajax({
			type : 'POST',
			url : '../registration/server/coach.php',
			data : {
				type : "loadscore",
				data:''
			},
			success : function(response) {
			//alert(response);
               var html="";
			 html += "<table id='example' class='table-hover table table-bordered'>";
	html += "<thead><th>Org Name</th><th>Team Name</th><th>Country</th><th>State</th><th>Challenge</th><th>Rating</th></thead><tbody>";
	
	var response = JSON.parse(response);
				for(var i in response){
					
					 html += "<tr>";
						
						html +="<td>"+response[i].orgname+"</td>";
						//html +="<td>"+user.name+"</td>";
						html +='<td>'+response[i].tname+'</td>';
						html +='<td>'+response[i].ucountry+'</td>';
						html +='<td>'+response[i].ustate+'</td>';
						
						html +='<td>'+response[i].uch+'</td>';
						html +='<td>'+response[i].urate+'</td>';

						
						html += "</tr>";
				}
	//  alert(html);
	html +="<tbody></table>"
	
	
	$("#scorelist").html(html);
	$('#example').DataTable();
				
			},
			error : function(data) {
				alert("Server Error please contact admin")
			}
		});
	
	
});

function scoring_creativity(){
	$.ajax({
			type : 'POST',
			url : '../registration/server/coach.php',
			data : {
				type : "loadscore",
				data:''
			},
			success : function(response) {
			
               var html="";
			 html += "<table id='example' class='table-hover table table-bordered'>";
	html += "<thead><th>Org Name</th><th>Team Name</th><th>Country</th><th>State</th><th>Challenge</th><th>Creativity</th></thead><tbody>";
	
	var response = JSON.parse(response);
				for(var i in response){
					
					 html += "<tr>";
						
						html +="<td>"+response[i].orgname+"</td>";
						//html +="<td>"+user.name+"</td>";
						html +='<td>'+response[i].tname+'</td>';
						html +='<td>'+response[i].ucountry+'</td>';
						html +='<td>'+response[i].ustate+'</td>';
						
						html +='<td>'+response[i].uch+'</td>';
						html +='<td>'+response[i].ucreativity+'</td>';

						
						html += "</tr>";
				}
	//  alert(html);
	html +="<tbody></table>"
	
	
	$("#scorelist").html(html);
	$('#example').DataTable();
				
			},
			error : function(data) {
				alert("Server Error please contact admin")
			}
		});
	
}

function scoring_problemsolved(){
  $.ajax({
			type : 'POST',
			url : '../registration/server/coach.php',
			data : {
				type : "loadscore",
				data:''
			},
			success : function(response) {
			
               var html="";
			 html += "<table id='example' class='table-hover table table-bordered'>";
	html += "<thead><th>Org Name</th><th>Team Name</th><th>Country</th><th>State</th><th>Challenge</th><th>Problem Solving</th></thead><tbody>";
	
	var response = JSON.parse(response);
				for(var i in response){
					
					 html += "<tr>";
						
						html +="<td>"+response[i].orgname+"</td>";
						//html +="<td>"+user.name+"</td>";
						html +='<td>'+response[i].tname+'</td>';
						html +='<td>'+response[i].ucountry+'</td>';
						html +='<td>'+response[i].ustate+'</td>';
						
						html +='<td>'+response[i].uch+'</td>';
						html +='<td>'+response[i].upsolved+'</td>';

						
						html += "</tr>";
				}
	//  alert(html);
	html +="<tbody></table>"
	
	
	$("#scorelist").html(html);
	$('#example').DataTable();
				
			},
			error : function(data) {
				alert("Server Error please contact admin")
			}
		});
	
}
// JavaScript Document