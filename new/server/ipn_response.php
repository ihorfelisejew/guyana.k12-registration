<?php

echo 'hiii';
include('server/db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);



// Send an empty HTTP 200 OK response to acknowledge receipt of the notification
header('HTTP/1.1 200 OK');




// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}

// post back to PayPal system to validate

$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";

// If testing on Sandbox use: 
// production www.paypal.com:443\r\n";
 $header .= "Host: www.paypal.com:443\r\n";
//$header .= "Host: www.sandbox.paypal.com:443\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

// If testing on Sandbox use:
//production ('ssl://www.paypal.com', 443, $errno, $errstr, 30);
//$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);




// assign posted variables to local variables
if(!empty($_POST['item_name'])){
  $item_name = $_POST['item_name'];
}else{
	$item_name='';
}

if(!empty($_POST['item_number'])){
  $item_number = $_POST['item_number'];
}else{
	$item_number='';
}

if(!empty($_POST['payment_status'])){
  $payment_status = $_POST['payment_status'];
}else{
	$payment_status='';
}

if(!empty($_POST['mc_gross'])){
  $payment_amount = $_POST['mc_gross'];
}else{
	$payment_amount='';
}

if(!empty($_POST['mc_currency'])){
  $payment_currency = $_POST['mc_currency'];
}else{
	$payment_currency='';
}

//transaction ID
if(!empty($_POST['txn_id'])){
  $txn_id = $_POST['txn_id'];
}else{
 $txn_id='';	
}

//ATEKDesign
if(!empty($_POST['business'])){
$business = $_POST['business'];
}
else{
	$business='';
}
//payer email
if(!empty($_POST['payer_email'])){
$payer_email = $_POST['payer_email'];
}
else{
	$payer_email='';
}
//create payer name
if(!empty($_POST['first_name'])){
$payer_firstname = $_POST['first_name'];
}else{
	$payer_firstname='';
}

if(!empty($_POST['last_name'])){
$payer_lastname = $_POST['last_name'];
}
else{
$payer_lastname='';	
}


$payer_name = $payer_firstname . " " . $payer_lastname;

//create payer address
if(!empty($_POST['address_name'])){
$name = $_POST['address_name'];
}
else{
	$name='';
}

if(!empty($_POST['address_street'])){
$street = $_POST['address_street'];
}
else{
  $street ='';	
}

if(!empty($_POST['address_city'])){
$city = $_POST['address_city'];
}else{
$city='';	
}

if(!empty($_POST['address_state'])){
$state = $_POST['address_state'];
}
else{
 $state='';	
}

if(!empty($_POST['address_zip'])){
$zip = $_POST['address_zip'];
}else{
	$zip='';
}

$address = "$name \n $street \n $city $state $zip";

if(!empty($_POST['email'])){
 $email = $_POST['email'];
}
else{
  $email='';	
}




if (!$fp) 
{
    // HTTP ERROR
} 

else 
{
    fputs ($fp, $header . $req);
        while (!feof($fp)) 
            {
                $res = fgets ($fp, 1024);
                    if (strcmp ($res, "VERIFIED") == 0) 
                        {
                            // check the payment_status is Completed
                            // check that txn_id has not been previously processed
                            // check that receiver_email is your Primary PayPal email
                            // check that payment_amount/payment_currency are correct
                            // process payment

							mysqli_query( $con,"UPDATE `users` SET `status` = '1' WHERE `email` = '$payer_email' ");
							
                            $mail_From = "divya.aza1@gmail.com";
                            $mail_To = "rohitshkl63@gmail.com";
                            $mail_Subject = "VERIFIED IPN";
                            $mail_Body = "Hello $payer_ name , thank you for purchasing the $item_name from $buisness , your order ID is as follows: $txn_id; . \n We will be using $payer_email to contact you and will be sending you item to $address";
                            $emailtext = blank;



                            mail($mail_To, $mail_Subject, $emailtext . "\n\n" . $mail_Body, $mail_From);

                        }

			}
}
?>