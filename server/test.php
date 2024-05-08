<?php

	//You can also use $stamp = strtotime ("now"); But I think date("Ymdhis") is easier to understand.
$stamp = date("Ymdhis");
$ip = $_SERVER['REMOTE_ADDR'];
$orderid = "$stamp$ip";
$orderid = str_replace(".", "", "$orderid");
echo($orderid);
echo "<br>";

exit;
	
require 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


$type = $_POST['type'];
$data = $_POST['data'];
if($type == "loadStates")
{
    loadStates($data);
}
if($type == "submitsupport")
{
    submitsupport($data);
}
if($type == "loadCounties")
{
    loadCounties($data);
}

if($type == "loadCity")
{
    loadCity($data);
}

if($type == "registerUser")
{
    registerUser($data);
}


if($type == "login")
{
    login($data);
}

if($type == "curentuserdetail")
{
    curentuserdetail($data);
}

if($type == "forgotpass")
{
    forgotpass($data);
}


if($type == "loadOrganization")
{
    loadOrganization($data);
}
if($type == "saveOrganization")
{
    saveOrganization($data);
}

if($type == "saveCoachOrganization")
{
    saveCoachOrganization($data);
}

if($type == "loadCoachOrganization")
{
    loadCoachOrganization($data);
}


if($type == "saveChallenge")
{
    saveChallenge($data);
}

if($type == "saveChallengeText")
{
    saveChallengeText($data);
}

if($type == "loadLeague")
{
    loadLeague($data);
}

if($type == "searchLeague")
{
    searchLeague($data);
}
if($type == "updateLeagueName")
{
    updateLeagueName($data);
}

if($type == "searchTeam")
{
    searchTeam($data);
}



function curentuserdetail($data){
    global $con;
    $user_email = $data["umail"];

    $array = array();
    $sql = "SELECT * FROM `users` where email = '$user_email'  ";
    $retval = mysqli_query( $con, $sql );
    $exist = false ;
    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }
    echo json_encode($array);
}

function loadLeague($data){
    global $con;
    $state = $data["state"];
    $county = $data["county"];
    $city = $data["city"];
    $league = $state.'_'.$county;
    $array = array();
    $sql = "SELECT id as id FROM `league` where name = '$league'  ";
    $retval = mysqli_query( $con, $sql );
    $exist = false ;

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
            $exist = true ;
        }

        if($exist){

            echo json_encode($array);

        }else{

            $sql  = mysqli_query( $con,"INSERT INTO league (name,city,county,state)
			VALUES ('$league' , '$city' , '$county' , '$state'  )");


            $sql = "SELECT Max(id) as id FROM `league`    ";
            $retval = mysqli_query( $con, $sql );

            if(! $retval )
            {
                die('Could not enter data: ' . mysqli_error($con));
            }else {

                while($row = mysqli_fetch_assoc($retval))
                {
                    $array[] = $row;
                }

            }
            echo json_encode($array);
        }

    }



}


function updateCustomer($data){
    global $con;
    $id = $data["id"];
    $firstname = $data["firstname"];
    $lastname = $data["lastname"];
    $phone= $data["phone"];
    $address= $data["address"];
    $rowStatus = 0;
    $phone2 = null;
    $distance = null;

    if(isset($data["phone_2"])){
        $phone2 = $data["phone_2"] ;
    }
    if(isset($data["distance"])){
        $distance = $data["distance"] ;
    }

    $sql  = mysqli_query( $con," UPDATE  customer SET distance = '$distance' ,firstname = '$firstname' , lastname = '$lastname' ,phone = '$phone' ,address = '$address' , phone_2 ='$phone2' WHERE  id = '$id' ");
    if(! $sql )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {
        echo "Success";
    }
}
function updateLeagueName($data){
    global $con;
    $id = $data["id"];
    $txt = $data["txt"];



    $sql  = mysqli_query( $con," UPDATE  league SET name = '$txt'  WHERE  id = '$id' ");
    if(! $sql )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {
        echo "Success";
    }
}




function customerQuery($data){
    global $con;
    $rowStatus = 0;
    $array = array();
    $sql = "SELECT id as id , concat(firstname, ' ', lastname) as label , concat(firstname, ' ', lastname) as value , phone , address  FROM customer where rowStatus = '$rowStatus'  AND  ( firstname LIKE '%$data%' OR phone LIKE '%$data%'  OR lastname LIKE '%$data%' )  ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function forgotpass($data){
    global $con;
    $email = $data["email"];

    $check = 0 ;

    $array = array();
    $sql = "SELECT * FROM `users` where email = '$email' ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        $fectpassg = mysqli_fetch_assoc($retval);
        $yourpasworis = $fectpassg['password'];
        $headers = "From: k12youthcode@k12youthcode.com" . "\r\n" ;

        mail($email,"Password Recovered","Your password is $yourpasworis",$headers);
        echo 'recovered';
    }




}


function login($data){
    global $con;
    $email = $data["email"];
    $password = $data["password"];
    $check = 0 ;

    $array = array();
    $sql = "SELECT * FROM `users` where email = '$email' and password = '$password'   ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $check_role_id = $row['role_id'];
            $check_role_status = $row['status'];
            if($check_role_id == 4 && $check_role_status == 0){
                $check = 2 ;
            }else{
                $array[] = $row;
                $check = 1 ;
            }
        }

    }

    if($check == 1){
        echo json_encode($array);
    }elseif($check == 2){
        echo $check = 2 ;
    }
    else{
        echo $check = 0 ;
    }


}




function loadStates(){
    global $con;
    $array = array();
    $sql = "SELECT DISTINCT (`state_abv`) FROM `county_state`   ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function loadCounties($data){
    global $con;
    $state = $data["state"];
    $array = array();
    $sql = "SELECT DISTINCT (`county`) FROM `county_state` where state_abv = '$state'  ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function countyID($countynm){
    global $con;
    $sql = "SELECT id FROM `county_state` where county = '$countynm'  ";
    $retval = mysqli_query( $con, $sql );
    $returnval = mysqli_fetch_assoc($retval);

    return $returnval['id'];;
}

function loadCity($data){
    global $con;
    $county = $data["county"];
    $getcountyid = countyID($county);

    $array = array();
    $sql = "SELECT * FROM `city` where county_id = '$getcountyid'  ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function loadOrganization($data){
    $state = $data["state"];
    $county = $data["county"];
    global $con;
    $array = array();
    $sql = "SELECT * FROM `users` where role_id = '4' AND state = '$state' AND county = '$county' ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}




function registerUser($data){
    global $con;
    $fullName = $data["fullName"];
    $lastName = $data["lastName"];
    $email = $data["email"];
    $password= $data["password"];
    $role_id= $data["role_id"];
    $state = $data["state"];
    $county = $data["county"];
    $city = $data["city"];
    $league_id = $data["league_id"];
    $org_id = null ;

    $feild = null;
    $zip = null;
    $parent_email = null;
    $parent_consent = null;
    $league = $state.'_'.$county;
    $grade = null;
    $enterorg = null;

    $school_type = $data["school_type"];
    $orgphoneno = $data["orgphoneno"];

    if(isset($data["zip"])){
        $zip = $data["zip"] ;
    }

    if(isset($data['feild'])){
        $feild = $data['feild'];
    }

    if(isset($data["org_id"])){
        $org_id = $data["org_id"];
    }

    if(isset($data["enterorg"])){
        $enterorg = $data["enterorg"];
    }
    if($role_id == '2'){
        $status = '0';
    }else{
        $status = '0';
    }

    if(isset($data["grade"])){
        $grade = $data["grade"];
    }



    if(isset($data["parent_email"])){
        $parent_email = $data["parent_email"] ;
    }

    if(isset($data["parent_consent"])){
        $parent_consent = $data["parent_consent"] ;
        if($parent_consent == "1"){
            $parent_consent = '1' ;
        }else {
            $parent_consent = '0';
        }
    }


//    $sql  = mysqli_query( $con,"INSERT INTO users (name,last_name,email,password,role_id,affiliate_org,county,city,state,feild,grade,zip,school_type,phone,parent_email,parent_consent,league,league_id,org_id,status)
//			VALUES ('$fullName','$lastName','$email','$password','$role_id','$enterorg','$county','$city','$state' ,'$feild', '$grade','$zip', '$school_type','$orgphoneno', '$parent_email' , '$parent_consent' ,'$league','$league_id','$org_id',$status  )");
    $sql = 1;
    if(! $sql )
    {
        die('Could not enter data: ' . mysqli_error($con));
        echo 'Could not enter data: ' . mysqli_error($con);
    }else {

        $email_add = $data['email'];
        $email_name = $data['fullName'].' '.$data['lastName'];

        $subject = 'Registration Confirmation';
        $txtMessage = "Thanks for registering  with us, username is ".$email_add;
        sendEmail($parent_email,$subject,$txtMessage,$email_add,$email_name);

        //mail($email,"Registration Confirmation","Thanks for registering  with us ");
        mail($parent_email,"New Child Registered","Dear Parent, your child just completed registration");

        $array = array();
        $sql = "SELECT Max(id) as id FROM `users`    ";
        $retval = mysqli_query( $con, $sql );

        if(! $retval )
        {
            die('Could not enter data: ' . mysqli_error($con));
            echo 'Could not enter data: ' . mysqli_error($con);
        }else {

            while($row = mysqli_fetch_assoc($retval))
            {
                $array[] = $row;
            }

        }
        echo json_encode($array);
    }
}

function deleteCustomer($data){
    $id = $data;
    $rowStatus = 1;
    global $con;
    $sql  = mysqli_query( $con,"DELETE FROM customer WHERE id = '$id'   ");

    if(! $sql )
    {
        echo 'ERROR ' . mysqli_error($con);

    }else {
        echo "Success";
    }



}

function saveOrganization($data){
    session_start();
    global $con;
    $orgstate = $data["orgstate"];
    $orgcounty = $data["orgcounty"];
    $zip = $data["zip"];
    $school_type = $data["school_type"];
    $orgname = $data["orgname"];
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $orgemail = $data["orgemail"];
    $orgpass = $data["orgpass"];
    $orgphoneno = $data["orgphoneno"];


    $checkorgname = "SELECT * FROM `users` where role_id = '4' AND org_name = '$orgname' ";
    $retvalssa = mysqli_query( $con, $checkorgname );
    $check_exist = mysqli_num_rows($retvalssa);

    if($check_exist < 1){
        $sql_qii = "INSERT INTO users (`name`, `last_name`, `email`, `password`, `role_id`, `org_name`, `county`, `city`, `state`, `school_type`, `phone`, `parent_consent`, `parent_email`, `zip`, `league`, `picUrl`, `league_id`, `status`, `org_id`)
								VALUES ('$firstname', '$lastname','$orgemail','$orgpass', '4', '$orgname', '$orgcounty', '', '$orgstate', '$school_type', '$orgphoneno', '0', '' ,'$zip', '', '', '','0','0' )";
        $sql  = mysqli_query( $con,$sql_qii);
        if(! $sql )
        {
            die('Could not enter data: ' . mysqli_error($con));
        }else {

            $_SESSION['orgemail'] = $orgemail;
            echo "Success".$sql_qii;
        }
    }else{
        echo "987321";

    }

}

function saveCoachOrganization($data){
    global $con;
    $userId = $data["userId"];
    $orgId = $data["orgId"];


    $sql  = mysqli_query( $con,"INSERT INTO coach_organization (coach_id,organization_id)
			VALUES ('$userId','$orgId'  )");
    if(! $sql )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {


        echo "Success";
    }

}
/*
function saveCoachOrganization($data){

	$userId = $data["userId"];
	$orgId = $data["orgId"];


	$sql  = mysqli_query( $con,"INSERT INTO coach_organization (coach_id,organization_id)
			VALUES ('$userId','$orgId'  )");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {


		echo "Success";
	}

}*/

function saveChallenge($data){
    global $con;
    $name = $data["name"];
    $startDate = $data["startDate"];
    $endDate = $data["endDate"];
    $text = $data["text"];
    $round = $data["round"];
    $lern_obj = $data["lobj"];
    $tut_url = $data["turl"];
    $intro_video = $data["intrvideo"];
    $sql  = mysqli_query( $con,"INSERT INTO challenge (name,startDate,endDate,text,round, Learning_obj, Tutorial_url, intro_video)
			VALUES ('$name','$startDate','$endDate','$text','$round','$lern_obj','$tut_url', '$intro_video')");
    if(! $sql )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {


        echo $sql;
    }

}

function saveChallengeText($data){
    global $con;
    $text = $data["text"];
    $deadline = $data["deadline"];
    $createdBy = $data["createdBy"];

    $sql  = mysqli_query( $con,"INSERT INTO challenge_text (text,deadline,createdBy)
			VALUES ('$text','$deadline','$createdBy'  )");
    if(! $sql )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {


        echo $sql;
    }

}



function loadCoachOrganization($data){
    $array = array();
    global $con;
    $orgId = $data["orgId"];


    $sql = "SELECT u.*  FROM `users` u , coach_organization co where co.coach_id = u.id and co.organization_id = '$orgId'  ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }
    echo json_encode($array);

}

function searchLeague($data){

    global $con;
    $leagueName = $data["leagueName"];


    $sql = "SELECT l.*  FROM `league` l  where  l.name LIKE '%$leagueName%'  ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }
    echo json_encode($array);

}

function searchTeam($data){

    global $con;
    $teamName = $data["teamName"];


    $sql = "SELECT l.*  FROM `team` l  where  l.name LIKE '%$teamName%'  ";
    $retval = mysqli_query( $con, $sql );

    if(! $retval )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {

        while($row = mysqli_fetch_assoc($retval))
        {
            $array[] = $row;
        }

    }
    echo json_encode($array);

}

function submitsupport($data){
    $cname = $data['uName'];
    $cemail = $data['email'];
    $csub = $data['subject'];
    $cmnt = $data['comment'];
    global $con;
    if(!empty($cname) && !empty($cemail) && !empty($csub)){
        $query="Insert into Support (cust_name, cust_email, subject, question) values('$cname', '$cemail', '$csub', '$cmnt')";
        $result = mysqli_query( $con,$query);
        if(! $result )
        {
            die('Could not enter data: ' . mysqli_error($con));
        }else {

            require '../PHPMailer-master/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $email_add = "k12youthcode@gmail.com";
            $custname = $data['uName'];
            $custemail = $data['email'];
            $custsub = $data['subject'];
            $custcomment = $data['comment'];

            $subject = 'Support Email';

            $mail->isSMTP();
            //Set SMTP host name
            $mail->Host = "smtp.gmail.com";
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password
            $mail->Username = "k12youthcode@gmail.com";
            $mail->Password = "Imaasha123";
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = "tls";
            //Set TCP port to connect to
            $mail->Port = 587;

            $mail->From = "k12youthcode@gmail.com";
            $mail->FromName = "k12youthcode";

            $mail->AddBCC($email_add);

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $custname ." raised a support request with subject " . $custsub ."<br/> Here are Details <br/> Name: ". $custname
                ."<br/> Email ID: ". $custemail ."<br/> SUbject: ".$custsub. "Comments:" . $custcomment;


            if(!$mail->send())
            {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            else
            {
                //echo "Message has been sent successfully";
            }
            echo"Thanks for contacting us";
        }
    }
    else{
        echo"Missing Some Values";
    }

}

function sendEmail($recepient,$subject,$txtEmail,$bcc_email_add,$bcc_email_name){
    //PHPMailer Object
    require '../PHPMailer-master/PHPMailerAutoload.php';
    global $con;
    $mail = new PHPMailer;

    $mail->isSMTP();
//Set SMTP host name
    $mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;

    $mail->Username = "k12youthcode@gmail.com";
    $mail->Password = "Imaasha123";

//From email address and name
    $mail->From = "k12youthcode@gmail.com";
    $mail->FromName = "k12youthcode";

    $mail->AddBCC($bcc_email_add, $bcc_email_name);

//To address and name
    $mail->addAddress($recepient);

//Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = "<i>Mail body in HTML</i>";
    $mail->AltBody = "This is the plain text version of the email content";

    if(!$mail->send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        //echo "Message has been sent successfully";
    }
}


?>