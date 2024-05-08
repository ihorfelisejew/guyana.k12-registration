
<?php 
error_reporting(0);
//ini_set('display_errors', 0);

session_start();
include('server/db.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Payment Confimation</title>
<link rel="stylesheet" href="css/app.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<meta http-equiv="refresh" content="5;url=social.html" />
</head>
	
<?php


// The custom hidden field (user id) sent along with the button is retrieved here. 
if($_GET['cm']) $user=$_GET['cm']; 
// The unique transaction id. 
if($_GET['tx']) $tx= $_GET['tx'];
 $identity = '5adU6-cR2ub-y89DsvnI9PxLhGxsKfrR6QAYwGW-yiKKegvNP3KokvqRxy8'; 
// Init curl
 $ch = curl_init(); 
// Set request options 
curl_setopt_array($ch, array ( CURLOPT_URL => 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=PNYA7ZDGZPWAG',
  CURLOPT_POST => TRUE,
  CURLOPT_POSTFIELDS => http_build_query(array
    (
      'cmd' => '_notify-synch',
      'tx' => $tx,
      'at' => $identity,
    )),
  CURLOPT_RETURNTRANSFER => TRUE,
  CURLOPT_HEADER => FALSE,
  // CURLOPT_SSL_VERIFYPEER => TRUE,
  // CURLOPT_CAINFO => 'cacert.pem',
));
// Execute request and get response and status code
$response = curl_exec($ch);
$status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// Close connection
curl_close($ch);
if($status == 200 AND strpos($response, 'SUCCESS') === 0)
{
	$orgemail = $_SESSION['orgemail'];	
    $sql  = mysqli_query( $con,"UPDATE `users` SET `status`= '1' WHERE `email` = '$orgemail'");

	if(! $sql )
	{
		echo 'ERROR ' . mysqli_error($con);
		
	}else {
		echo '	<div class="container" style="text-align:center">
					<div class="row">
						<img src="images/checked.png" />
						<h1>Your payment is successfully processed</h1>
						<p>If you dont redirect automatically,  
							<a href="social.html">Click Here</a>
							to Continue
						</p>
					</div>
				</div>';
	}
	
}

?>

</body>
</html>