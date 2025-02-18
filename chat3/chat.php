<?php

	$myid = 2;
	$fid = 2;

$conn = mysql_connect("localhost", 'root', '');
$db = mysql_select_db("mychat", $conn);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Chat</title>
<script src="jquery.min.js"></script>
<script src="moment.min.js"></script>
<script src="livestamp.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="container">
      <div class="chat" id="chat">
        <div class="stream" id="cstream">

        </div>
      </div>
      <div class="msg">
          <form method="post" id="msenger" action="">
            <textarea name="msg" id="msg-min"></textarea>
            <input type="hidden" name="mid" value="<?php echo $myid;?>">
            <input type="hidden" name="fid" value="<?php echo $fid;?>">
            <input type="submit" value="Send" id="sb-mt">
          </form>
      </div>
      <div id="dataHelper" last-id=""></div>
  </div>
   
<script type="text/javascript">
$(document).keyup(function(e){
	if(e.keyCode == 13){
		if($('#msenger textarea').val().trim() == ""){
			$('#msenger textarea').val('');
		}else{
			$('#msenger textarea').attr('readonly', 'readonly');
			$('#sb-mt').attr('disabled', 'disabled');	// Disable submit button
			sendMsg();
		}		
	}
});	

$(document).ready(function() {
    $('#msg-min').focus();
	allMsg();
	//online_users();
	$('#msenger').submit(function(e){
		$('#msenger textarea').attr('readonly', 'readonly');
		$('#sb-mt').attr('disabled', 'disabled');	// Disable submit button
		sendMsg();
		e.preventDefault();	
	});
});



function sendMsg(){
	//alert('sf');
	$.ajax({
		type: 'post',
		url: 'chatM.php?rq=new',
		data: $('#msenger').serialize(),
		dataType: 'json',
		success: function(rsp){
		
				$('#msenger textarea').removeAttr('readonly');
				$('#sb-mt').removeAttr('disabled');	// Enable submit button
				if(parseInt(rsp.status) == 0){
					alert(rsp.msg);
				}else if(parseInt(rsp.status) == 1){
					$('#msenger textarea').val('');
					$('#msenger textarea').focus();
					//$design = '<div>'+rsp.msg+'<span class="time-'+rsp.lid+'"></span></div>';
					$design = '<div class="float-fix">'+
									'<div class="m-rply">'+
										'<div class="msg-bg">'+
											'<div class="msgA">'+
												rsp.msg+
												'<div class="">'+
													'<div class="msg-time time-'+rsp.lid+'"></div>'+
													'<div class="myrply-i"></div>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
					$('#cstream').append($design);

					$('.time-'+rsp.lid).livestamp();
					$('#dataHelper').attr('last-id', rsp.lid);
					$('#chat').scrollTop($('#cstream').height());
				}
			}
		});
}
function checkStatus(){
	$fid = '<?php echo $fid; ?>';
	$mid = '<?php echo $myid; ?>';
	//alert($fid);
	//alert('hi');
	$.ajax({
		type: 'post',
		url: 'chatM.php?rq=msg',
		data: {fid: $fid, mid: $mid, lid: $('#dataHelper').attr('last-id')},
		dataType: 'json',
		cache: false,
		success: function(rsp){
			//alert(rsp.status);
				if(parseInt(rsp.status) == 0){
					return false;
				}else if(parseInt(rsp.status) == 1){
					getMsg();
				}
			}
		});	
}

// Check for latest message
//setInterval("checkStatus()", 100);
setInterval(function(){ checkStatus() }, 100);
function getMsg(){
	$fid = '<?php echo $fid; ?>';
	$mid = '<?php echo $myid; ?>';
	//alert(mid);
	$.ajax({
		type: 'post',
		url: 'chatM.php?rq=NewMsg',
		data:  {fid: $fid, mid: $mid},
		dataType: 'json',
		success: function(rsp){
			//alert(rsp);
				if(parseInt(rsp.status) == 0){
					//alert(rsp.msg);
				}else if(parseInt(rsp.status) == 1){
					$design = '<div class="float-fix">'+
									'<div class="f-rply">'+
										'<div class="msg-bg">'+
											'<div class="msgA">'+
												rsp.msg+
												'<div class="">'+
													'<div class="msg-time time-'+rsp.lid+'"></div>'+
													'<div class="myrply-f"></div>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
					$('#cstream').append($design);
					$('#chat').scrollTop ($('#cstream').height());
					$('.time-'+rsp.lid).livestamp();
					$('#dataHelper').attr('last-id', rsp.lid);	
				}
			}
	});
}
function allMsg(){
	$fid = '<?php echo $fid; ?>';
	$mid = '<?php echo $myid; ?>';
	//alert(mid);
	$.ajax({
		type: 'post',
		url: 'allmessages.php',
		data:  {fid: $fid, mid: $mid},

		success: function(rsp){
			//alert(rsp);
			var design='';
			var arr= rsp;
			alert(arr.length);
			for (i in arr) {
			 design += '<div class="float-fix">'+
									'<div class="f-rply">'+
										'<div class="msg-bg">'+
											'<div class="msgA">'+
												arr[i].msg+
												'<div class="">'+
													'<div class="msg-time time-'+rsp.lid+'"></div>'+
													'<div class="myrply-f"></div>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
			}
				    $('#cstream').append(design);
					$('#chat').scrollTop ($('#cstream').height());
					$('.time-'+rsp.lid).livestamp();
					$('#dataHelper').attr('last-id', rsp.lid);	
			}
	});
}

</script>
</body>
</html>