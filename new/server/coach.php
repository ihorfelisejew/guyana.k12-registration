<?php



include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("America/Chicago");
$time =  Date('Y-m-d h:i:s');

$type = $_POST['type'];
$data = $_POST['data'];

if($type == "saveTeam")
{
	saveTeam($data);
}

if($type == "getCompletedChallenges")
{
	getCompletedChallenges($data);
}

if($type == "loadscore")
{
	loadscore();
}



if($type == "loadRounds")
{
	loadRounds();
}

if($type == "changeChallangesNumber")
{
	changeChallangesNumber($data);
}

if($type == "changeStatus")
{
	changeStatus($data);
}

if($type =="loadTeams"){

	loadTeams($data);

}
if($type =="ChallangeList"){

	ChallangeList();

}

if($type =="invoice_details_fnc"){

	invoice_details_fnc();

}



if($type =="loadPlayers"){

	loadPlayers($data);

}

if($type =="loadUsers"){

	loadUsers();

}

if($type =="loadPlayersList"){

	loadPlayersList($data);

}

if($type =="loadPlayersListAll"){

	loadPlayersListAll($data);

}

if($type =="addPlayer"){

	addPlayer($data);

}

if($type == "loadChalleneges"){

	loadChalleneges();

}
if($type == "loadChallengeText"){

	loadChallengeText();

}

if($type == "addLink"){

	addLink($data);

}

if($type == "loadLinks"){

	loadLinks($data);

}


if($type == "ajaxgetTeamRanking"){

	ajaxgetTeamRanking($data);

}
if($type == "ajaxgetCoachRanking"){

	ajaxgetCoachRanking($data);

}

if($type == "getTeamRating"){

	getTeamRating($data);

}



if($type == "getTeamRanking"){

	getTeamRanking($data);

}
if($type == "sendbulkemail"){

	sendbulkemail($data);

}
if($type == "UserNameByID"){

	UserNameByID($data);

}
if($type == "showWinners"){
	showWinners($data);
}
if($type == "showWinnersR2"){
	showWinnersR2($data);
}
if($type == "showWinnersR3"){
	showWinnersR3($data);
}


if($type == "showWinnersAll"){
	showWinnersAll($data);
}
if($type == "showWinnersAllR2"){
	showWinnersAllR2($data);
}
if($type == "showWinnersAllAdminR2"){
	showWinnersAllAdminR2($data);
}
if($type == "showWinnersAllAdminR3"){
	showWinnersAllAdminR3($data);
}
if($type == "showWinnersAllCounty"){
	showWinnersAllCounty($data);
}

if($type == "getWinners"){

	getWinners($data);

}

if($type == "addPlayerCaptain"){

	addPlayerCaptain($data);

}


if($type == "getTodaysChallenge"){

	getTodaysChallenge($data);

}
if($type == "loadChallenegesR1"){
	loadChallenegesR1();
}
if($type == "loadChallenegesR2"){
	loadChallenegesR2();
}
if($type == "loadTeamsR2"){
	loadTeamsR2($data);
}
if($type == "loadLinksR2"){
	loadLinksR2($data);
}

if($type == "getTeamRatingR2"){
	getTeamRatingR2($data);
}

if($type == "getTeamRankingR2"){
	getTeamRankingR2($data);
}

if($type == "getTeamRankingAdminR1"){
	getTeamRankingAdminR1($data);
}

if($type == "getTeamRankingAdminR2"){
	getTeamRankingAdminR2($data);
}

if($type == "getTeamRankingAdminR3"){
	getTeamRankingAdminR3($data);
}

if($type == "ajaxgetTeamRankingR2"){

	ajaxgetTeamRankingR2($data);

}
if($type == "ajaxgetCoachRankingR2"){

	ajaxgetCoachRankingR2($data);

}

/* Round 3*/
if($type == "loadTeamsR3"){
	loadTeamsR3($data);
}
if($type == "loadChallenegesR3"){
	loadChallenegesR3();
}
if($type == "loadLinksR3"){
	loadLinksR3($data);
}
if($type == "getTeamRatingR3"){
	getTeamRatingR3($data);
}
if($type == "getTeamRankingR3"){
	getTeamRankingR3($data);
}
if($type == "ajaxgetTeamRankingR3"){

	ajaxgetTeamRankingR3($data);

}
if($type == "ajaxgetCoachRankingR3"){

	ajaxgetCoachRankingR3($data);
}

if($type == "getTeamRanking1"){

	getTeamRanking1($data);
}
if($type == "leagueTeamByOrg"){

	leagueTeamByOrg($data);
}
if($type == "leagueTeamByOrgR2"){

	leagueTeamByOrgR2($data);
}
if($type == "leagueTeamByOrgR3"){

	leagueTeamByOrgR3($data);
}
if($type == "saveInvoice"){

	saveInvoice($data);
}

if($type == "saveInvoice2"){

	saveInvoice2($data);
}

if($type == "changeinvoice_status"){

	changeinvoice_status($data);
}


function changeStatus($data){
	$id = $data["id"];
	$state = $data["state"];
	
	$sql  = mysqli_query( $con," UPDATE  users SET status = '$state'  WHERE  id = '$id' ");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		echo "Success";
		if($state == 0){
			$sql1  = mysqli_query( $con,"DELETE from team_player where user_id = '$id' ");
			if(! $sql ){
				die('Could not enter data: ' . mysqli_error($con));
			}else {
				echo "Success";
			}
		}
	}
}

function loadscore(){
	$sql = "select (select org_name from users where id = tp.user_id)orgname,
(select name from team where id = tp.team_id)tname,
(select county from users where id = tp.user_id)ucountry,
(select state from users where id = tp.user_id)ustate,
(select name from challenge where id = ln.challenge_id)uch,
(select rating from video_rating where link_id = ln.id)urate ,

(select creativity from video_rating where link_id = ln.id)ucreativity, 
(select artistic from video_rating where link_id = ln.id)uartistic, 
(select logic from video_rating where link_id = ln.id)ulogic, 
(select problem_solved from video_rating where link_id = ln.id)upsolved 

from team_player tp, links ln where ln.team_id = tp.team_id group by urate order by urate desc

 ";
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
function changeChallangesNumber($data){

	$id = $data["id"];
	$number = $data["number"];
	
	$sql  = mysqli_query( $con," UPDATE  rounds SET challenges = '$number'  WHERE  id = '$id' ");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		echo "Success";
	}
}


function updateCustomer($data){
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



function customerQuery($data){
	
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


function login($data){
	
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
			$array[] = $row;
			$check = 1 ;
		}
		
	}

	if($check == 1){
		echo json_encode($array);
	}else{
		echo $check = 0 ;
	}

	
}

function loadTeams($data){
	$coachId = $data["coachId"];
	$array = array();
	$sql = "SELECT t.*, u.name as userfname, u.last_name FROM `team` t INNER JOIN `users` u ON u.id = t.coach_id WHERE t.coach_id = '$coachId'   ";
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



function loadChalleneges(){
	
	$sql = "SELECT * FROM `challenge` WHERE `round` = 1  ORDER BY `challenge`.`id` DESC";
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



function loadChallengeText(){
	
	$sql = "SELECT * FROM `challenge_text`  WHERE DATE(deadline) >= CURDATE();    ";
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





function loadPlayers($data){
	$teamId = $data["teamId"];
	$array = array();
	$sql = "SELECT u.* FROM `team_player` tp , `users` u   where u.id = tp.user_id   and tp.team_id = '$teamId'  ";
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

function loadUsers(){

	$array = array();
	$sql = "SELECT * FROM `users`     ";
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

function UserNameByID($data){

	$userid = $data['userid'];
	$array = array();
	$sql = "SELECT * FROM users WHERE id = $userid";
	
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




function loadPlayersListAll(){

	
	$array = array();
	$sql = "SELECT a.*, c.name as teamname, c.coach_id FROM users a LEFT JOIN team_player b ON a.id = b.user_id LEFT JOIN team c ON b.team_id = c.id";
	
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


function loadPlayersList(){

	//$team_id = $data['teamId'];
	$array = array();
	$sql = "SELECT * FROM users WHERE id NOT IN (SELECT user_id FROM team_player) AND `role_id` = 2 AND `status` = 1 ORDER BY `id` DESC";
	
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


function saveTeam($data){
	
	$teamName = $data["teamName"];
	$coach_id = $data["coach_id"];

 $sql1 = "select * from team where name='$teamName'";
 $rs = mysqli_query( $con,$sql1);
 
 $num_rows = mysqli_num_rows($rs); 
 if($num_rows > 1){
	echo"Team Name already exists"; 
 }
 else{
	$sql  = mysqli_query( $con,"INSERT INTO team (name,coach_id) VALUES ('$teamName','$coach_id' )");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
	
		echo "Success";
	}
 }
}

function addPlayer($data){
	
	$teamId = $data["teamId"];
	$user_id = $data["user_id"];



	
	$sql  = mysqli_query( $con,"INSERT INTO team_player (team_id,user_id)
			VALUES ('$teamId','$user_id'  )");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
	
		echo "Success";
	}
}

function addPlayerCaptain($data){
	
	$teamId = $data["teamId"];
	$user_id = $data["user_id"];


	$sqlquery = "UPDATE `team` SET `captain_id`='$user_id' WHERE `id` = '$teamId'";
	
	$sql  = mysqli_query( $con,$sqlquery);
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
	
		echo "Success";
	}
}

function deleteCustomer($data){
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

function addLink($data){
	
	$teamId = $data["teamId"];
	$challenge_id = $data["challenge_id"];
	$videoTitle = $data["videoTitle"];
	$url = $data["url"];


	$sql1 = "SELECT Count(*) as tot FROM `links` where `team_id` = '$teamId' AND `challenge_id` = '$challenge_id'";
	$retval1 = mysqli_query( $con, $sql1 );
	$row1 = mysqli_fetch_assoc($retval1);
	
	$tot = $row1["tot"];
	
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		//echo $tot;	
		
		if($tot == 0){
			$sql  = mysqli_query( $con,"INSERT INTO links (url,title,team_id,challenge_id,posted_date)
				VALUES ('$url','$videoTitle','$teamId','$challenge_id',NOW()  )");
			if(! $sql )
			{
				die('Could not enter data: ' . mysqli_error($con));
			}else {
				
			
				echo "Success";
			}
		}else{
			echo 'Video Already Uploaded';	
		}
	}
		
}
	
	

function loadLinks($data){
	$teamId = $data["teamId"];
	$array = array();
	$sql = "SELECT * FROM `links` l INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `challenge` c ON c.id = l.challenge_id  where team_id = '$teamId' AND c.round = 1";
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

function getTeamRating($data){	
	$teamId = $data["teamId"];
	$array = array();
	//$sql = "SELECT (sum(vr.rating)+sum(vr.creativity)+sum(vr.artistic)+sum(vr.logic)) as rating FROM video_rating vr , links l where l.id = vr.link_id AND  l.team_id = '$teamId'  ";
	
	$sql = "SELECT sum(vr.rating) as rating, sum(vr.creativity) as creativity,sum(vr.artistic) as artistic,sum(vr.logic) as logic,sum(vr.problem_solved) as problem_solved FROM links l INNER JOIN video_rating vr ON vr.link_id = l.id INNER JOIN `challenge` c ON c.id = l.challenge_id WHERE c.round = 1 AND l.team_id = '$teamId'";
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

function ajaxgetTeamRanking($data){
	$teamIds = $data["teamIds"];
	$in = $data["str"];
	$array = array();
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) AND t.name like '%$in%' GROUP by l.team_id ORDER BY rating DESC, name DESC";

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

function ajaxgetCoachRanking($data){
	$teamIds = $data["teamIds"];
	$in = $data["str"];
	$userorgid = $data['userorgid'];
	$array = array();
	
	
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.org_id = '$userorgid' AND u.name like '%$in%' ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	//echo $array1;
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name, l.challenge_id,c.round FROM video_rating vr , links l ,challenge c, team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id  and c.id =  l.challenge_id and c.round = 1 AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";

	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		$array = array();
		//die('Could not enter data: ' . mysqli_error($con));
		
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$array[] = $row;
		}
		
	}

	

	echo json_encode($array);
}
function ajaxgetCoachRankingR2($data){
	$teamIds = $data["teamIds"];
	$in = $data["str"];
	$userorgid = $data['userorgid'];
	$array = array();
	
	
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.org_id = '$userorgid' AND u.name like '%$in%' ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	//echo $array1;
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name, l.challenge_id,c.round FROM video_rating vr , links l ,challenge c, team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id  and c.id =  l.challenge_id and c.round = 2 AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";

	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		$array = array();
		//die('Could not enter data: ' . mysqli_error($con));
		
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$array[] = $row;
		}
		
	}

	

	echo json_encode($array);
}



function sendbulkemail($data){
	
require '../PHPMailer-master/PHPMailerAutoload.php';



$mail = new PHPMailer;

//Enable SMTP debugging. 
//$mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.

	
	
	
	$role = $data["role"];
	$subject = $data["subject"];
	$meaasge = $data["meaasge"];
	//$headers = "From: k12youthcode@gmail.com"; .
	$headers = 'From: <k12youthcode@gmail.com>' . "\r\n";
	
	$array = array();
	if($role == 0){
		$sql = "SELECT * FROM `users`";
	}else
	{
		$sql = "SELECT * FROM `users` WHERE `role_id` = '$role'";
	}

	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$email_add = $row['email'];
			$email_name = $row['name'];
			
			//mail($email_add,$subject,$meaasge,$headers);
			//echo $row['email'];
			
			$mail->isSMTP();            
			//Set SMTP host name                          
			$mail->Host = "smtp.gmail.com";
			//Set this to true if SMTP host requires authentication to send email
			$mail->SMTPAuth = true;                          
			//Provide username and password     
			$mail->Username = "k12youthcode@gmail.com";                 
			$mail->Password = "aries123";                           
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tls";                           
			//Set TCP port to connect to 
			$mail->Port = 587;                                   

			$mail->From = "k12youthcode@gmail.com";
			$mail->FromName = "imaasha123";

			$mail->AddBCC($email_add, $email_name);

			$mail->isHTML(true);

			$mail->Subject = $subject;
			$mail->Body = $meaasge;
			$mail->AltBody = "This is the plain text version of the email content";

			if(!$mail->send()) 
			{
				echo "Mailer Error: " . $mail->ErrorInfo;
			} 
			else 
			{
				echo "Message has been sent successfully";
			}
		}
		
	}
	echo "Emails Sent";
}


function getTeamRanking($data){
	$teamIds = $data["teamIds"];
	$array = array();
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name DESC";

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
/*
function getTeamRanking($data){
	$teamIds = $data["teamIds"];
	$array = array();
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name DESC";

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
}*/

function showWinners($data){
	$array = array();
	$userstate = $data['userstate'];
	$usercounty = $data['usercounty'];
		
		

			//$sql = "SELECT w.*, t.name as teamname FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";			
			$sql = "SELECT w.*, t.name as teamname,t.coach_id,u.org_id,u.state,u2.org_name FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id INNER JOIN `users` u ON t.coach_id = u.id INNER JOIN `users` u2 ON u2.id = u.org_id WHERE w.`county` = '$usercounty' ORDER BY `w`.`score` DESC";
			$retval = mysqli_query( $con, $sql );
			
			if(! $retval )
			{
				die('Could not enter data: ' . mysqli_error($con));
			}else {
				
				while($row1 = mysqli_fetch_assoc($retval))
				{
					$array[] = $row1;
				}		
			}
				
	
	
	
		

	echo json_encode($array);
}

function showWinnersR2($data){
		
	$array = array();
	$userstate = $data['userstate'];
	$sql1 = "SELECT * FROM `users` WHERE state = '$userstate' GROUP BY `county`";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row = mysqli_fetch_assoc($retval1))
		{
			$statecounty = $row['county'];
			//$sql = "SELECT w.*, t.name as teamname FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";			
			$sql = "SELECT w.*, t.name as teamname,t.coach_id,u.org_id,u.state,u2.org_name FROM `winners2` w INNER JOIN `team` t ON t.id = w.team_id INNER JOIN `users` u ON t.coach_id = u.id INNER JOIN `users` u2 ON u2.id = u.org_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";
			$retval = mysqli_query( $con, $sql );
			
			if(! $retval )
			{
				die('Could not enter data: ' . mysqli_error($con));
			}else {
				
				while($row1 = mysqli_fetch_assoc($retval))
				{
					$array[] = $row1;
				}		
			}
		}		
	}
	
	
		

	echo json_encode($array);
}


function showWinnersR3($data){
	$array = array();
	$userstate = $data['userstate'];

			//$sql = "SELECT w.*, t.name as teamname FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";			
			$sql = "SELECT w.*, t.name as teamname,t.coach_id,u.org_id,u.state,u2.org_name FROM `winners3` w INNER JOIN `team` t ON t.id = w.team_id INNER JOIN `users` u ON t.coach_id = u.id INNER JOIN `users` u2 ON u2.id = u.org_id ORDER BY `w`.`score` DESC";
			$retval = mysqli_query( $con, $sql );
			
			if(! $retval )
			{
				die('Could not enter data: ' . mysqli_error($con));
			}else {
				
				while($row1 = mysqli_fetch_assoc($retval))
				{
					$array[] = $row1;
				}		
			}
	
	
		

	echo json_encode($array);
}

function showWinnersAll($data){
	$array = array();
	$userstate = $data['userstate'];
	$sql1 = "SELECT * FROM `users` WHERE state = '$userstate' GROUP BY `county`";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row = mysqli_fetch_assoc($retval1))
		{
			$statecounty = $row['county'];
			//$sql = "SELECT w.*, t.name as teamname FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";			
			$sql = "SELECT w.*, t.name as teamname,t.coach_id,u.org_id,u.state,u2.org_name FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id INNER JOIN `users` u ON t.coach_id = u.id INNER JOIN `users` u2 ON u2.id = u.org_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";
			$retval = mysqli_query( $con, $sql );
			
			if(! $retval )
			{
				die('Could not enter data: ' . mysqli_error($con));
			}else {
				
				while($row1 = mysqli_fetch_assoc($retval))
				{
					$array[] = $row1;
				}		
			}
		}		
	}
	
	
		

	echo json_encode($array);
}


function showWinnersAllAdminR2($data){
	$array = array();
			
	$statecounty = $data['userstate'];
	//$sql = "SELECT w.*, t.name as teamname FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";			
	$sql = "SELECT w.*, t.name as teamname,t.coach_id,u.org_id,u.state,u2.org_name FROM `winners2` w INNER JOIN `team` t ON t.id = w.team_id INNER JOIN `users` u ON t.coach_id = u.id INNER JOIN `users` u2 ON u2.id = u.org_id WHERE w.`state` LIKE '%$statecounty%' ORDER BY `w`.`score` DESC";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row1 = mysqli_fetch_assoc($retval))
		{
			$array[] = $row1;
		}		
			}
		
	
	
	
		

	echo json_encode($array);
}

function showWinnersAllAdminR3($data){
	$array = array();
			
	//$sql = "SELECT w.*, t.name as teamname FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";			
	$sql = "SELECT w.*, t.name as teamname,t.coach_id,u.org_id,u.state,u2.org_name FROM `winners3` w INNER JOIN `team` t ON t.id = w.team_id INNER JOIN `users` u ON t.coach_id = u.id INNER JOIN `users` u2 ON u2.id = u.org_id ORDER BY `w`.`score` DESC";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row1 = mysqli_fetch_assoc($retval))
		{
			$array[] = $row1;
		}		
			}
		
	
	
	
		

	echo json_encode($array);
}


function showWinnersAllR2($data){
	$array = array();
	$userstate = $data['userstate'];

	//$sql = "SELECT w.*, t.name as teamname FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";			
	$sql = "SELECT w.*, t.name as teamname,t.coach_id,u.org_id,u.state,u2.org_name FROM `winners2` w INNER JOIN `team` t ON t.id = w.team_id INNER JOIN `users` u ON t.coach_id = u.id INNER JOIN `users` u2 ON u2.id = u.org_id WHERE w.state = '$userstate' ORDER BY `w`.`score` DESC";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row1 = mysqli_fetch_assoc($retval))
		{
			$array[] = $row1;
		}		
	}
	echo json_encode($array);
}




function showWinnersAllCounty($data){
	$array = array();
	$userstate = $data['userstate'];

	$statecounty = $data['usercounty'];
	//$sql = "SELECT w.*, t.name as teamname FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id WHERE w.`county` = '$statecounty' ORDER BY `w`.`score` DESC";			
	$sql = "SELECT w.*, t.name as teamname,t.coach_id,u.org_id,u.state,u2.org_name FROM `winners` w INNER JOIN `team` t ON t.id = w.team_id INNER JOIN `users` u ON t.coach_id = u.id INNER JOIN `users` u2 ON u2.id = u.org_id WHERE w.`county` LIKE '%$statecounty%' AND u.state LIKE '%$userstate%' ORDER BY `w`.`score` DESC";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row1 = mysqli_fetch_assoc($retval))
		{
			$array[] = $row1;
		}		
	}
			
	echo json_encode($array);
}



function getWinners($data){
	
	$cid = $data["cid"];
	$groupBy = $data["groupBy"];
	$array = array();
	$sql = "SELECT MAX(rating) AS rating ,   teamId   ,   teamName, county , state  ";
	$sql .= " FROM  ";
	$sql .= "  (SELECT  SUM(vr.rating) AS rating ,     l.team_id AS teamId , t.name AS teamName , u.`county` AS county , ";
	$sql .= "   u.`state` AS state FROM  ";
	$sql .= " video_rating vr ,  links l , team t ,  users u    ";
	$sql .= "  WHERE t.id = l.team_id AND u.id = t.`coach_id`  AND l.id = vr.link_id AND l.`challenge_id` = '$cid'     ";
	$sql .= "   GROUP BY l.team_id ) AS temp   ";
	$sql .= "  GROUP BY ";
	$sql .= $groupBy  ;
	
	
	
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

function ChallangeList(){
	

	$array = array();
	$sql = " SELECT * FROM `challenge` ORDER BY `id` DESC";
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

function getTodaysChallenge(){
	

	$array = array();
	$sql = " SELECT * FROM `challenge` WHERE DATE(endDate) = CURDATE()  ";
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

function loadRounds(){
	

	$array = array();
	$sql = " SELECT * FROM rounds";
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

function getCompletedChallenges(){

	$array = array();
	$sql = " SELECT  COUNT(c.id) AS counter , c.`round` FROM   challenge c  WHERE DATE(c.endDate) <= CURDATE() GROUP BY c.round   ";
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
/* Round 1*/
function loadChallenegesR1(){
	$array = array();
	$sql = "SELECT * FROM `challenge` WHERE `round` = 1 ORDER BY `challenge`.`id` DESC";
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

/* Round 2*/
function loadChallenegesR2(){
	$array = array();
	$sql = "SELECT * FROM `challenge` WHERE `round` = 2 ORDER BY `challenge`.`id` DESC";
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


function loadTeamsR2($data){
	$coachId = $data["coachId"];
	$array = array();
	$sql = "SELECT t.*, u.name as userfname, u.last_name FROM `team` t INNER JOIN `users` u ON u.id = t.coach_id WHERE t.coach_id = '$coachId'";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$sqljkk = "SELECT * FROM `winners`";
			$retvaljkk = mysqli_query( $con, $sqljkk );
			if(! $retval )
			{
				die('Could not enter data: ' . mysqli_error($con));
			}
			else {
			   while($rowjkk = mysqli_fetch_assoc($retvaljkk))
				{
					if($rowjkk['team_id'] == $row['id']){
						$array[] = $row;
					}	
				}
			}
			
		}
		
	}

	

	echo json_encode($array);
}


function loadLinksR2($data){
	$teamId = $data["teamId"];
	$array = array();
	$sql = "SELECT l.*,t.*, c.round FROM `links` l INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `challenge` c ON c.id = l.challenge_id where l.team_id = '$teamId' AND c.round = 2";
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



function getTeamRatingR2($data){	
	$teamId = $data["teamId"];
	$array = array();
	//$sql = "SELECT (sum(vr.rating)+sum(vr.creativity)+sum(vr.artistic)+sum(vr.logic)) as rating FROM video_rating vr , links l where l.id = vr.link_id AND  l.team_id = '$teamId'  ";
	
	$sql = "SELECT sum(vr.rating) as rating, sum(vr.creativity) as creativity,sum(vr.artistic) as artistic,sum(vr.logic) as logic,sum(vr.problem_solved) as problem_solved FROM links l INNER JOIN video_rating vr ON vr.link_id = l.id INNER JOIN `challenge` c ON c.id = l.challenge_id AND l.team_id = '$teamId' AND c.round = '2'";
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










function getTeamRanking1($data){
	$teamIds = $data["teamIds"];
//	$in = $data["str"];
	//$userorgid = $data['userorgid'];
	$usercouty = $data['usercouty'];
	$array = array();
	
	
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.county = '$usercouty' ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	//echo $array1;
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name FROM video_rating vr , links l , team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '1' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		$array = array();
		//die('Could not enter data: ' . mysqli_error($con));
		
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$array[] = $row;
		}
		
	}

	

	echo json_encode($array);
}

function getTeamRankingR2($data){
	//$teamIds = $data["teamIds"];
//	$in = $data["str"];
	//$userorgid = $data['userorgid'];
	$userstate = $data['userstate'];
	
	$array = array();
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.state = '$userstate' ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	
	
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, l.challenge_id,c.round FROM video_rating vr , links l , team t,challenge c where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '2' AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name";
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '2' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
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

function getTeamRankingR3($data){
	$array = array();
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	
	
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, l.challenge_id,c.round FROM video_rating vr , links l , team t,challenge c where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '2' AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name";
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '3' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
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


function getTeamRankingAdminR1($data){

//	$in = $data["str"];
	//$userorgid = $data['userorgid'];
	$usercounty = $data['usercounty'];
	
	$array = array();
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.county LIKE '%$usercounty%' ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	
	
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, l.challenge_id,c.round FROM video_rating vr , links l , team t,challenge c where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '2' AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name";
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '1' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
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

function getTeamRankingAdminR2($data){

//	$in = $data["str"];
	//$userorgid = $data['userorgid'];
	$userstate = $data['userstate'];
	
	$array = array();
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.state LIKE '%$userstate%' ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	
	
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, l.challenge_id,c.round FROM video_rating vr , links l , team t,challenge c where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '2' AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name";
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '2' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
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

function getTeamRankingAdminR3($data){

//	$in = $data["str"];
	//$userorgid = $data['userorgid'];
	$userstate = $data['userstate'];
	
	$array = array();
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.state LIKE '%$userstate%' ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	
	
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, l.challenge_id,c.round FROM video_rating vr , links l , team t,challenge c where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '2' AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name";
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '3' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
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

function leagueTeamByOrg($data){
	$teamIds = $data["teamIds"];
//	$in = $data["str"];
	$userorgid = $data['userorgid'];
	//$usercouty = $data['usercouty'];
	$array = array();
	
	
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.org_id = '$userorgid' ORDER BY `u`.`id`  DESC";
	//$sql1 ="SELECT u.id,u.name,t.coach_id,t.id as teamid,ou.org_name FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id INNER JOIN `users` ou ON ou.id = u.org_id  WHERE u.role_id = 1 AND u.org_id = '$userorgid' ORDER BY `u`.`id`  DESC";
	
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	//echo $array1;
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name FROM video_rating vr , links l , team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name, l.challenge_id,c.round FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '1' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	$sql ="SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id  where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '1' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		$array = array();
		//die('Could not enter data: ' . mysqli_error($con));
		
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$array[] = $row;
		}
		
	}

	

	echo json_encode($array);
}


function leagueTeamByOrgR2($data){
	$teamIds = $data["teamIds"];
//	$in = $data["str"];
	$userorgid = $data['userorgid'];
	//$usercouty = $data['usercouty'];
	$array = array();
	
	
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.org_id = '$userorgid' ORDER BY `u`.`id`  DESC";
	//$sql1 ="SELECT u.id,u.name,t.coach_id,t.id as teamid,ou.org_name FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id INNER JOIN `users` ou ON ou.id = u.org_id  WHERE u.role_id = 1 AND u.org_id = '$userorgid' ORDER BY `u`.`id`  DESC";
	
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	//echo $array1;
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name FROM video_rating vr , links l , team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name, l.challenge_id,c.round FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '1' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	$sql ="SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id  where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '2' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		$array = array();
		//die('Could not enter data: ' . mysqli_error($con));
		
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$array[] = $row;
		}
		
	}

	

	echo json_encode($array);
}
function leagueTeamByOrgR3($data){
	$teamIds = $data["teamIds"];
//	$in = $data["str"];
	$userorgid = $data['userorgid'];
	//$usercouty = $data['usercouty'];
	$array = array();
	
	
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.org_id = '$userorgid' ORDER BY `u`.`id`  DESC";
	//$sql1 ="SELECT u.id,u.name,t.coach_id,t.id as teamid,ou.org_name FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id INNER JOIN `users` ou ON ou.id = u.org_id  WHERE u.role_id = 1 AND u.org_id = '$userorgid' ORDER BY `u`.`id`  DESC";
	
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	//echo $array1;
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name FROM video_rating vr , links l , team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name, l.challenge_id,c.round FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '1' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	$sql ="SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id  where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '3' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		$array = array();
		//die('Could not enter data: ' . mysqli_error($con));
		
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$array[] = $row;
		}
		
	}

	

	echo json_encode($array);
}

/* Round 3 */
function loadTeamsR3($data){
	$coachId = $data["coachId"];
	$array = array();
	$sql = "SELECT t.*, u.name as userfname, u.last_name FROM `team` t INNER JOIN `users` u ON u.id = t.coach_id WHERE t.coach_id = '$coachId'   ";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$sqljkk = "SELECT * FROM `winners2`";
			$retvaljkk = mysqli_query( $con, $sqljkk );
			if(! $retval )
			{
				die('Could not enter data: ' . mysqli_error($con));
			}else {
				
				while($rowjkk = mysqli_fetch_assoc($retvaljkk))
				{
					if($rowjkk['team_id'] == $row['id']){
						$array[] = $row;
					}	
				}
			}
			
		}
		
	}
	

	echo json_encode($array);
}

function loadChallenegesR3(){
	$array = array();
	$sql = "SELECT * FROM `challenge` WHERE `round` = 3 ORDER BY `challenge`.`id` DESC";
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


function loadLinksR3($data){
	$teamId = $data["teamId"];
	$array = array();
	$sql = "SELECT l.*,t.*, c.round FROM `links` l INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `challenge` c ON c.id = l.challenge_id where l.team_id = '$teamId' AND c.round = 3";
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


function getTeamRatingR3($data){	
	$teamId = $data["teamId"];
	$array = array();
	//$sql = "SELECT (sum(vr.rating)+sum(vr.creativity)+sum(vr.artistic)+sum(vr.logic)) as rating FROM video_rating vr , links l where l.id = vr.link_id AND  l.team_id = '$teamId'  ";
	
	$sql = "SELECT sum(vr.rating) as rating, sum(vr.creativity) as creativity,sum(vr.artistic) as artistic,sum(vr.logic) as logic,sum(vr.problem_solved) as problem_solved FROM links l INNER JOIN video_rating vr ON vr.link_id = l.id INNER JOIN `challenge` c ON c.id = l.challenge_id AND l.team_id = '$teamId' AND c.round = '3'";
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







function ajaxgetTeamRankingR3($data){
	$teamIds = $data["teamIds"];
	$in = $data["str"];
	$array = array();
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) AND t.name like '%$in%' GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name , l.challenge_id,c.round FROM video_rating vr , links l ,challenge c, team t	 where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '3' AND  l.team_id IN ($teamIds) AND t.name like '%$in%' GROUP by l.team_id ORDER BY rating DESC, name DESC";

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


function ajaxgetCoachRankingR3($data){
	$teamIds = $data["teamIds"];
	$in = $data["str"];
	$userorgid = $data['userorgid'];
	$userstate = $data['userstate'];
	$array = array();
	
	
	$array1  = "";
	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.state = '$userstate' AND u.name like '%$in%' ORDER BY `u`.`id`  DESC";
	$retval1 = mysqli_query( $con, $sql1 );
	if(! $retval1 )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$totl = mysqli_num_rows($retval1);
		$gh = 1;
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			
			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
			$gh++;
		}
	}
	//echo $array1;
	
	//$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name FROM video_rating vr , links l , team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name, l.challenge_id,c.round FROM video_rating vr , links l , challenge c, team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id and c.id =  l.challenge_id and c.round = '3' AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		$array = array();
		//die('Could not enter data: ' . mysqli_error($con));
		
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			$array[] = $row;
		}
		
	}

	

	echo json_encode($array);
}



function saveInvoice($data){

	require '../PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	
	$Org_name = $data["Org_name"];
	
	//$registrations_fee = $data['registrations_fee'];
//	$is_student = $data['is_student'];
	$fullName = $data['fullName'];
	$lastName = $data['lastName'];
	
	$no_students = $data['no_students'];
	$ttl = (intval($no_students) * 10);
	$registrations_fee = $data['clasnotot'];
	$email_name = $data['email_name'];
	$getcurrdate = $data['getcurrdate'];
	
	echo $fsdfdfsdfs = "INSERT INTO invoice (Org_Name, registrations_fee, date, student, org_email, invoice_status)
			VALUES ('$Org_name','$registrations_fee', '$getcurrdate','$no_students', '$email_name','payment pending')";
	$sql  = mysqli_query( $con,$fsdfdfsdfs);
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		$last_id = mysqli_insert_id($con);
		echo "Success";
		
		$email_add = $data['email_name'];
		$email_name = $data['Org_name'];
		
		$subject = "Invoice Generated Sucessfully";
		$meaasge = '<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="http://k12youthcode.com/registration/images/concert-one.regular-1.png" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice #: '.$last_id.'<br>
                                Created: '.date("Y-m-d h:i:sa").'<br>                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td colspan="2">
                                K12youthcode<br>
                                2520 Park Central Blvd., C4<br>
                                Decatur, GA 30035
                            </td>
                            <td></td><td></td>
                            <td colspan="2">
                                '.$email_name.'<br>
                                '.$fullName.' '.$lastName.'<br>
                                '.$email_add.'
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            
            <tr class="heading">
                <td>
                    Item Description
                </td>
                
                <td>
                   Unit Price
                </td>
				 <td>
                   Qty
                </td>
				 <td>
                  Amount
                </td>
            </tr>
            
            <tr class="item last">
                <td>
                   Organisation Registration
                </td>
                
                <td>
                    20
                </td>
				<td>
                    1
                </td>
				<td>
                    20
                </td>
            </tr>';
			//<tr class="item last">
            //    <td>
              //    Student Fee
               // </td>
                
              //  <td>
             //       10
              //  </td>
			//	<td>
                //    '.$no_students.'
              //  </td>
				
				//<td>
               //     '.$ttl.'
                //</td>
            //</tr>
            
            echo'<tr class="total">
                <td></td>
				<td></td>
                
                <td>
                   Total: '.$registrations_fee.'
                </td>
            </tr>
        </table>
    </div>
</body>
</html>';
		//mail($email_add,$subject,$meaasge,$headers);
		//echo $row['email'];
		
	$mail->isSMTP();            
		//Set SMTP host name                          
		$mail->Host = "smtp.gmail.com";
		//Set this to true if SMTP host requires authentication to send email
		$mail->SMTPAuth = true;                          
		//Provide username and password     
		$mail->Username = "k12youthcode@gmail.com";                 
		$mail->Password = "imaasha123";                           
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = "tls";                           
		//Set TCP port to connect to 
		$mail->Port = 587;                                   

		$mail->From = "k12youthcode@gmail.com";
		$mail->FromName = "k12youthcode";

		$mail->AddBCC($email_add, $email_name);

		$mail->isHTML(true);

		$mail->Subject = $subject;
		$mail->Body = $meaasge;
		$mail->AltBody = "This is the plain text version of the email content";

		if(!$mail->send()) 
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
			echo "Message has been sent successfully";
		}
	}
	
}



function saveInvoice2($data){

	require '../PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	
	$Org_name = $data["Org_name"];
	
	//$registrations_fee = $data['registrations_fee'];
//	$is_student = $data['is_student'];
	$fullName = $data['fullName'];
	$lastName = $data['lastName'];
	$pay_student = explode(',',$data['payeestudent']);
	$no_students = $data['no_students'];
	$ttl = (intval($no_students) * 10);
	$registrations_fee = $data['clasnotot'];
	
	$email_name = $data['email_name'];
	$getcurrdate = $data['getcurrdate'];
	
	echo $fsdfdfsdfs = "INSERT INTO invoice (Org_Name, registrations_fee, date, student, org_email, invoice_status)
			VALUES ('$Org_name','$registrations_fee', '$getcurrdate','$no_students', '$email_name','payment pending')";
	$sql  = mysqli_query( $con,$fsdfdfsdfs);
	
	foreach($pay_student as $row){
	  echo $qry = "update users set status=1 where id='$row'";
	  $sql  = mysqli_query( $con,$qry);
    }
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		$last_id = mysqli_insert_id($con);
		echo "Success";
		
		$email_add = $data['email_name'];
		$email_name = $data['Org_name'];
		
		$subject = "Invoice Generated Sucessfully";
		$meaasge = '<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>A simple, clean, and responsive HTML invoice template</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="http://k12youthcode.com/registration/images/concert-one.regular-1.png" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice #: '.$last_id.'<br>
                                Created: '.date("Y-m-d h:i:sa").'<br>                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td colspan="2">
                                K12youthcode<br>
                                2520 Park Central Blvd., C4<br>
                                Decatur, GA 30035
                            </td>
                            <td></td><td></td>
                            <td colspan="2">
                                '.$email_name.'<br>
                                '.$fullName.' '.$lastName.'<br>
                                '.$email_add.'
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            
            <tr class="heading">
                <td>
                    Item Description
                </td>
                
                <td>
                   Unit Price
                </td>
				 <td>
                   Qty
                </td>
				 <td>
                  Amount
                </td>
            </tr>
            
           
			<tr class="item last">
                <td>
                 Student Fee
                </td>
                
                <td>
                    10
                </td>
				<td>
                   '.$no_students.'
                </td>
				
				<td>
                    '.$ttl.'
                </td>
            </tr>
            
            <tr class="total">
                <td></td>
				<td></td>
                
                <td>
                   Total: '.$registrations_fee.'
                </td>
            </tr>
        </table>
    </div>
</body>
</html>';
		//mail($email_add,$subject,$meaasge,$headers);
		//echo $row['email'];
		
	$mail->isSMTP();            
		//Set SMTP host name                          
		$mail->Host = "smtp.gmail.com";
		//Set this to true if SMTP host requires authentication to send email
		$mail->SMTPAuth = true;                          
		//Provide username and password     
		$mail->Username = "k12youthcode@gmail.com";                 
		$mail->Password = "imaasha123";                           
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = "tls";                           
		//Set TCP port to connect to 
		$mail->Port = 587;                                   

		$mail->From = "k12youthcode@gmail.com";
		$mail->FromName = "k12youthcode";

		$mail->AddBCC($email_add, $email_name);

		$mail->isHTML(true);

		$mail->Subject = $subject;
		$mail->Body = $meaasge;
		$mail->AltBody = "This is the plain text version of the email content";

		if(!$mail->send()) 
		{
			echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
			echo "Message has been sent successfully";
		}
	}
	
}

 function changeinvoice_status($data){
	 
	 $invoice_id = $data['id'];
	 $chknum = $data['check_num'];
	 if(!empty($chknum)){
		 $sql = " update invoice set invoice_status='paid', Check_num='$chknum' where id='$invoice_id'";
		 $retval = mysqli_query( $con, $sql );
		
		if(! $retval )
		{
			die('Could not enter data: ' . mysqli_error($con));
		}else {
			echo 'Invoice Detail Updated';
		}
	 }
	 else{
	  	 echo 'Please Enter Check No';
	 }
	 
 }

function invoice_details_fnc(){
	$array = array();
	$sql = " SELECT * FROM invoice ORDER BY id DESC";
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
?>