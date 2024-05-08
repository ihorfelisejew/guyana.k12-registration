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
// $header .= "Host: www.sandbox.paypal.com:443\r\n";
$header .= "Host: www.paypal.com:443\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

// If testing on Sandbox use:
//$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);
$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);




// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];


//transaction ID
$txn_id = $_POST['txn_id'];


//ATEKDesign
$business = $_POST['business'];

//payer email
$payer_email = $_POST['payer_email'];

//create payer name
$payer_firstname = $_POST['first_name'];
$payer_lastname = $_POST['last_name'];
$payer_name = $payer_firstname . " " . $payer_lastname;

//create payer address
$name = $_POST['address_name'];
$street = $_POST['address_street'];
$city = $_POST['address_city'];
$state = $_POST['address_state'];
$zip = $_POST['address_zip'];

$address = "$name \n $street \n $city $state $zip";


$email = $_POST['email'];






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

							mysqli_query( $con," UPDATE `users` SET `status` = '1' WHERE `email` = '$email' ");
							
                            $mail_From = "From: me@mybiz.com";
                            $mail_To = "k12youthcode@gmail.com";
                            $mail_Subject = "VERIFIED IPN";
                            $mail_Body = "Hello $payer_ name , thank you for purchasing the $item_name from $buisness , your order ID is as follows: $txn_id; . \n We will be using $payer_email to contact you and will be sending you item to $address";
                            //$emailtext = blank;



                            mail($mail_To, $mail_Subject, $emailtext . "\n\n" . $mail_Body, $mail_From);

                        }

			}
}
?>