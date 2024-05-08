<?php

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
if($type == "loadCoachOrganizationMaster")
{
    loadCoachOrganizationMaster($data);
}

if($type == "loadCoachOrganizationM")
{
    loadCoachOrganizationM($data);
}

if($type == "loadAccounts")
{
    loadAccounts($data);
}

if($type == "updateAccountData")
{
    updateAccountData($data);
}


if($type == "loadCoachOrganizationMaster1")
{
    loadCoachOrganizationMaster1($data);
}

if($type == "loadMasterAccount")
{
    loadMasterAccount($data);
}


if($type == "loadCity")
{
    loadCity($data);
}

if($type == "registerUser")
{
    registerUser($data);
}

if($type == "getCompetitionTypes")
{
    getCompetitionTypes();
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

if($type == "saveMasterAccount")
{
    saveMasterAccount($data);
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
        $headers = "From: k12youthcode@gmail.com" . "\r\n" ;

        mail($email,"Password Recovered","Your password is $yourpasworis",$headers);
        echo 'recovered';
    }




}


function login($data){
    global $con; 
    $name = $data["name"];
    $password = $data["password"];
    $phone = $data["phone"];
    $role_id = $data["role_id"];
    $check = 0 ;

    $array = array();


    if($name != ''){
        $sql = "SELECT users.*, t.team_id FROM `users` LEFT JOIN `team_player` AS t ON users.id = t.user_id where users.name = '$name' and users.phone = '$phone' and users.role_id = '2'";
    }else{
        $sql = "SELECT * FROM `users` where phone = '$phone' and password = '$password' and (role_id = '$role_id' OR role_id = '5') ";
    }
    $retval = mysqli_query( $con, $sql );
       // print_r($retval);
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
            
			
            $org_id= $row['org_id'];
            $sql2sasa = "SELECT * FROM `users` where id = '$org_id'";
            $retval2assasa = mysqli_query( $con, $sql2sasa );
            while($row2asassa = mysqli_fetch_assoc($retval2assasa))
            {
                $array[0]['org_name_c'] = $row2asassa['org_name']; 
            }

			$userid= $row['id'];
			$sql1query = "SELECT * FROM `team_player` as tp INNER JOIN `team` as t ON t.id = tp.team_id WHERE tp.`user_id` = '$userid'";
			$retval1query = mysqli_query( $con, $sql1query );
			if(! $retval1query )
			{
				die('Could not enter data: ' . mysqli_error($con));
			}else {

				while($row1 = mysqli_fetch_assoc($retval1query))
				{
					$array[]['coach_id'] = $row1['coach_id'];
					$coach_id = $row1['coach_id'];
					$sql2 = "SELECT * FROM `users` where id = '$coach_id'";
					$retval2 = mysqli_query( $con, $sql2 );
					while($row2 = mysqli_fetch_assoc($retval2))
					{
						$array[0]['coach_name'] = $row2['name'].' '.$row2['last_name']; 
					}
				}

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
    global $con; 
    $state = $data["state"];
    $county = $data["county"];

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

function getCompetitionTypes(){
    global $con;
    $array = [];

    $query = mysqli_query($con, 'SELECT * FROM competition_details ORDER BY id');
    while ($row = mysqli_fetch_assoc($query)){
        $array[] = $row;
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
	//$leaguedata = $data["league"];
	//echo 'hiiiiiiiiii';
	//print_r($league);
    $org_id = null ;

    $feild = null;
    $zip = null;
    $parent_email = null;
    $parent_consent = null;
    $league = $state.'_'.$county;
    $grade = null;
    $enterorg = null;

    $school_type = $data["school_type"];
    $orgphoneno = null;

    if($data["role_id"] != 2){
        if (is_numeric($data["orgphoneno"])){
            $orgphoneno = $data["orgphoneno"];
        } else {
            die('In Phone Number only numbers are allowed');
            echo 'In Phone Number only numbers are allowed';
        }
    } else{
        $orgphoneno = $data["orgphoneno"];

    }

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
	
	if(isset($data["masteraccount"])){
        $masteraccount = $data["masteraccount"];
    }else{
		$masteraccount = '';
	}
    if($role_id == '2'){
		
        $status = '1';
    }else{
        $status = '1';
    }

    if(isset($data["grade"])){
        $grade = $data["grade"];
    }

    $competition_type = null;
    if(isset($data["competition_type"])){
        $competition_type = $data["competition_type"];
    }


    $total_volunteer_hours = null;
    if(isset($data["total_volunteer_hours"])){
        $total_volunteer_hours = $data["total_volunteer_hours"];
    }

    $volunteer_progress_made = null;
    if(isset($data["volunteer_progress_made"])){
        $volunteer_progress_made = $data["volunteer_progress_made"];
    }

    $volunteer_weekly_availability = null;
    if(isset($data["volunteer_weekly_availability"])){
        $volunteer_weekly_availability = $data["volunteer_weekly_availability"];
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

    if($role_id != 2){
        $query = "SELECT * FROM users WHERE phone = '$orgphoneno'";
        $sql  = mysqli_query( $con,$query);
        $num = mysqli_num_rows($sql);
        if ($num > 0){

            die('Phone Number is already registered');
        }
    }


    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable strict error reporting
mysqli_begin_transaction($con); // Begin transaction

try {
    $abdata = "INSERT INTO users (name, last_name, email, password, role_id, org_name, master_account, user_master_account, affiliate_org, county, city, state, grade, zip, school_type, phone, parent_email, parent_consent, league, picurl, league_id, org_id, competition_id, volunteer_weekly_availability, volunteer_progress_made, total_volunteer_hours, status, updated_date) 
    VALUES ('$fullName','$lastName','$email','$password','$role_id', '', '$masteraccount', '', '$enterorg', '$county', '$city', '$state', '$grade', '$zip', '$school_type', '$orgphoneno', '$parent_email', $parent_consent, '$league', '', '$league_id', '$org_id', '$competition_type', '$volunteer_weekly_availability', '$volunteer_progress_made', '$total_volunteer_hours', '$status', NOW())";
    $sql = mysqli_query($con, $abdata);

    if (!$sql) {
        throw new Exception('MySQL Error: ' . mysqli_error($con));
    }

    $last_insert_id = mysqli_insert_id($con); // Get the last inserted ID correctly

    mysqli_commit($con); // Commit the transaction

     
    $email_add = $data['email'];
    $email_name = $data['fullName'].' '.$data['lastName'];

    $subject = 'Registration Confirmation';
    $txtMessage = "K12youthcode.com, an international coding league, is sending this email on behalf of our client STEMGuyana.  You are receiving this confirmation because your child has been registered to participate in this year's national STEM competition.  Please feel to log in to guyana.k12youthcode.com/registration to check out the latest challenge.  The account's username is ".$email_add;
    //sendEmail($parent_email,$subject,$txtMessage,$email_add,$email_name);

    //mail($email,"Registration Confirmation","Thanks for registering  with us ");
    //mail($parent_email,"New Child Registered","Dear Parent, your child just completed registration.  Please contact your organization's coach for next steps");

    $array = array();
    $array[]=$last_insert_id;
   
    echo json_encode($array);
    // Additional queries can be placed here, using $last_insert_id as needed
} catch (Exception $e) {
    mysqli_rollback($con); // Roll back the transaction on error
    echo "Error: " . $e->getMessage(); // Display error message
}

	// $abdata = "INSERT INTO users (name,last_name,email,password,role_id,org_name,master_account,user_master_account,affiliate_org,county,city,state,feild,grade,zip,school_type,phone,parent_email,parent_consent,league,picurl,league_id,org_id,competition_id, volunteer_weekly_availability, volunteer_progress_made, total_volunteer_hours, status, updated_date)
    // VALUES ('$fullName','$lastName','$email','$password','$role_id','','$masteraccount','','$enterorg','$county','$city','$state' ,'$feild', '$grade','$zip', '$school_type','$orgphoneno', '$parent_email' , $parent_consent ,'$league','','$league_id','$org_id','$competition_type', '$volunteer_weekly_availability','$volunteer_progress_made', '$total_volunteer_hours', '$status', NOW() )";
    // $sql  = mysqli_query( $con,$abdata);
	
	// $sql3423432 = "SELECT Max(id) as id FROM `users`";
    // $retvalasdas42 = mysqli_query( $con, $sql3423432 );
	// $row3423432 = mysqli_fetch_array($retvalasdas42);
	// $last_insert_id = $row3423432['id'];
	//$last_insert_id = mysqli_insert_id($con);
   
	/*
    foreach($leaguedata as $leaguedatas){
		$sql123  = "INSERT INTO leaguelevel (userid,role,levelleague) VALUES ('$last_insert_id','$role_id','$leaguedatas')";
		mysqli_query( $con,$sql123);
	}
	*/
    // if(! $sql )
    // {
    //     echo 'Could not enter data78: ' . $abdata;
    //     die('Email is already registered: ' . mysqli_error($con));

    // }else {
		 
    //     $email_add = $data['email'];
    //     $email_name = $data['fullName'].' '.$data['lastName'];

    //     $subject = 'Registration Confirmation';
    //     $txtMessage = "K12youthcode.com, an international coding league, is sending this email on behalf of our client STEMGuyana.  You are receiving this confirmation because your child has been registered to participate in this year's national STEM competition.  Please feel to log in to guyana.k12youthcode.com/registration to check out the latest challenge.  The account's username is ".$email_add;
    //     //sendEmail($parent_email,$subject,$txtMessage,$email_add,$email_name);

    //     //mail($email,"Registration Confirmation","Thanks for registering  with us ");
    //     //mail($parent_email,"New Child Registered","Dear Parent, your child just completed registration.  Please contact your organization's coach for next steps");

    //     $array = array();
    //     $sql = "SELECT Max(id) as id FROM `users`    ";
    //     $retval = mysqli_query( $con, $sql );

    //     if(! $retval )
    //     {
    //         die('Could not enter data: ' . mysqli_error($con));
    //         echo 'Could not enter data45: ' . mysqli_error($con);
    //     }else {

    //         while($row = mysqli_fetch_assoc($retval))
    //         {
    //             $array[] = $row;
    //         }

    //     }
    //     echo json_encode($array);
    // }
}

function deleteCustomer($data){
    global $con; 
    $id = $data;
    $rowStatus = 1;
    $sql  = mysqli_query( $con,"DELETE FROM customer WHERE id = '$id'   ");

    if(! $sql )
    {
        echo 'ERROR ' . mysqli_error($con);

    }else {
        echo "Success";
    }



}


function saveMasterAccount($data){
    global $con; 
    session_start();

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


    $checkorgname = "SELECT * FROM `users` where role_id = '4' AND master_account = '$orgname' ";
    $retvalssa = mysqli_query( $con, $checkorgname );
    $check_exist = mysqli_num_rows($retvalssa);

    if($check_exist < 1){
        $sql_qii = "INSERT INTO users (`name`, `last_name`, `email`, `password`, `role_id`, `master_account`, `county`, `city`, `state`, `school_type`, `phone`, `parent_consent`, `parent_email`, `zip`, `league`, `picUrl`, `league_id`, `status`, `org_id`)
								VALUES ('$firstname', '$lastname','$orgemail','$orgpass', '6', '$orgname', '$orgcounty', '', '$orgstate', '$school_type', '$orgphoneno', '0', '' ,'$zip', '', '', '','1','0' )";
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


function saveOrganization($data){
    global $con; 
    session_start();

    $orgstate = $data["orgstate"];
    $orgcounty = $data["orgcounty"];
    //$zip = $data["zip"];
	$zip = '';
    $school_type = $data["school_type"];
    $orgname = $data["orgname"];
    $firstname = $data['firstname'];
    $lastname = $data['lastname'];
    $orgemail = $data["orgemail"];
    $orgpass = $data["orgpass"];
    $orgphoneno = $data["orgphoneno"];
	$masteraccount = $data["masteraccount"];


    $checkorgname = "SELECT * FROM `users` where role_id = '4' AND org_name = '$orgname' ";
    $retvalssa = mysqli_query( $con,$checkorgname );
    $check_exist = mysqli_num_rows($retvalssa);

    $checkorgemail = "SELECT * FROM `users` where email='$orgemail' ";
    $check_email = mysqli_query( $con,$checkorgemail );
    $email_num = mysqli_num_rows($check_email);
    //echo $check_exist;
    if($email_num<1){
        if($check_exist < 1){
            $sql_qii = "INSERT INTO users (`name`, `last_name`, `email`, `password`, `role_id`, `org_name`,`master_account`,`user_master_account`, `affiliate_org`,`county`, `city`, `state`, `school_type`, `phone`,`feild`,`grade` ,`parent_consent`, `parent_email`, `zip`, `league`, `picUrl`, `league_id`, `status`, `org_id`)
                                    VALUES ('$firstname', '$lastname','$orgemail','$orgpass', '4', '$orgname','','$masteraccount','', '$orgcounty', '', '$orgstate', '$school_type', '$orgphoneno',' ',2,'0', '' ,'', '', '', 0,'1','0' )";
            $sql  = mysqli_query($con,$sql_qii);
            //echo $sql;
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
    else echo '987322';

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

}*/

function saveChallenge($data){
    global $con; 
    $name = $data["name"];
    $startDate = $data["startDate"];
    $endDate = $data["endDate"];
    $text = htmlentities($data["text"]);
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
    global $con; 
    $array = array();

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








function loadCoachOrganizationM($data){
    global $con; 
    $array = array();

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

function loadCoachOrganizationMaster($data){
    $array = array();
    global $con; 
    $orgId = $data["orgId"];

	 $sql2 = "SELECT u.*  FROM `users` u where u.user_master_account = '$orgId'  ";
    $retval2 = mysqli_query( $con, $sql2 );
	while($row2 = mysqli_fetch_assoc($retval2))
    {
         $user_id = $row2['id'];
		 
		 $sql = "SELECT u.*  FROM `users` u , coach_organization co where co.coach_id = u.id and co.organization_id = '$user_id'  ";
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
	}
    echo json_encode($array); 

}


function loadCoachOrganizationMaster1($data){
    $array = array();
    global $con; 
    $orgId = $data["orgId"];

	$sql2 = "SELECT u.*  FROM `users` u where u.user_master_account = '$orgId'  ";
    $retval2 = mysqli_query( $con, $sql2 );
	while($row2 = mysqli_fetch_assoc($retval2))
    {

		$array[] = $row2;
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
            $mail->Password = "Ariespinetart123";
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
    global $con; 
    require '../PHPMailer-master/PHPMailerAutoload.php';

    $mail = new PHPMailer;

    $mail->isSMTP();
//Set SMTP host name
    $mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;

    $mail->Username = "k12youthcode@gmail.com";
    $mail->Password = "Ariespinetart123";

//From email address and name
    $mail->From = "k12youthcode@gmail.com";
    $mail->FromName = "k12youthcode";

    $mail->AddBCC($bcc_email_add, $bcc_email_name);

//To address and name
    $mail->addAddress($recepient);

//Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $txtEmail;
    $mail->AltBody = $txtEmail;

    if(!$mail->send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        //echo "Message has been sent successfully";
    }
}

function loadMasterAccount(){
    global $con; 
	$sql = "SELECT * FROM `users` WHERE `role_id` = '6'";
//    echo $sql;return;
    $retval = mysqli_query( $con, $sql );
    //$fetchteamaid = mysqli_fetch_assoc($retval);
   
    while($res = mysqli_fetch_assoc($retval)){
		$result[] = $res;
	}
	echo json_encode($result);
}


function loadAccounts($data){
    global $con;
    $fullname = $data['fullname'] ?? '';
    $phone = $data['phone'] ?? '';
        if (!$con) {
            die('Connection failed: ' . mysqli_connect_error());
        }
        
          // Split the full name into first name and last name
            $names = explode(' ', trim($fullname));
            $firstName = $names[0] ?? '';
            $lastName = $names[1] ?? '';

            $data = array();

            // Prepare the SQL query
            $sql = "SELECT * FROM users";
            $conditions = array();
            
            // Conditions for first name and last name
            if (!empty($firstName)) {
                $conditions[] = "name LIKE CONCAT('%', ?, '%')";
            }
            if (!empty($lastName)) {
                $conditions[] = "last_name LIKE CONCAT('%', ?, '%')";
            }

            // Condition for phone number
            if (!empty($phone)) {
                $conditions[] = "phone LIKE CONCAT('%', ?, '%')";
            }

            // Append conditions to SQL query if any conditions exist
            if (!empty($conditions)) {
                $sql .= " WHERE " . implode(' OR ', $conditions);
            }

            if (!empty($conditions)){
                $sql .= " AND role_id != 5";
            }else{
                $sql .= " WHERE role_id != 5 ";
            }

            

            $stmt = mysqli_prepare($con, $sql);

            // Bind parameters dynamically based on the input
            $types = '';
            $bind_params = [];
            
            if (!empty($firstName)) {
                $types .= 's';
                $bind_params[] = &$firstName;
            }
            if (!empty($lastName)) {
                $types .= 's';
                $bind_params[] = &$lastName;
            }
            if (!empty($phone)) {
                $types .= 's';
                $bind_params[] = &$phone;
            }

            if (!empty($bind_params)) {
                mysqli_stmt_bind_param($stmt, $types, ...$bind_params);
            }

            // Execute the query
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                die('Could not retrieve data: ' . mysqli_error($con));
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            
            mysqli_stmt_close($stmt);
            

        echo json_encode($data);
}

function updateAccountData($data){
global $con;
 $userId = $data['id'] ?? '';
 $status = isset($data['status'])? $data['status'] : ''; 
 $phone = $data['phone'] ?? ''; 
 $fullname = $data['fullname'] ?? '';
 $password = $data['password'] ?? '';

    if (!$con) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Split the full name into first name and last name
    $names = explode(' ', trim($fullname));
    $firstName = $names[0] ?? '';
    $lastName = $names[1] ?? '';

    // Prepare the SQL query dynamically
    $sql = "UPDATE users SET ";
    $params = [];
    $types = '';

    if (!empty($status) || $status === 0) {
        $sql .= "status = ?, ";
        $params[] = &$status;
        $types .= 's';
    }
    if (!empty($phone)) {
        $sql .= "phone = ?, ";
        $params[] = &$phone;
        $types .= 's';
    }
    if (!empty($password)) {
        $sql .= "password = ?, ";
        $params[] = &$password;
        $types .= 's';
    }
    if (!empty($firstName)) {
        $sql .= "name = ?, ";
        $params[] = &$firstName;
        $types .= 's';
    }
    if (!empty($lastName)) {
        $sql .= "last_name = ?, ";
        $params[] = &$lastName;
        $types .= 's';
    }

    // Remove the last comma and space
    $sql = rtrim($sql, ', ');

    // Continue the SQL command with the WHERE clause
    $sql .= " WHERE id = ?";
    $params[] = &$userId;
    $types .= 'i'; // 'i' is used for integer data type

    // Prepare the statement
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        die('MySQL prepare error: ' . mysqli_error($con));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        echo "Account updated successfully.";
    } else {
        die('Error updating account: ' . mysqli_error($con));
    }

    mysqli_stmt_close($stmt);

}
