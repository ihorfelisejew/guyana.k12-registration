<?php

require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set("America/Chicago");
$time =  Date('Y-m-d h:i:s');

if(isset($_POST['type'])) {
	$type = $_POST['type'];
}
if(isset($_POST['data'])) {
	$data = $_POST['data'];
}

if($type == "calculate") {
	calculate();
}

if($type == "saveTeam")
{
	saveTeam($data);
}

if($type == "changeCoach")
{
	changeCoach($data);
}



if($type == "loadAllChallenges")
{
	loadAllChallenges($data);
}

if($type == "goRemove")
{
	goRemove($data);
}

if($type == "getPlayerDashboardData")
{
	getPlayerDashboardData($data);
}

if($type == "edittemapi")
{
	edittemapi($data);
}

if($type == "deleteTeamPI")
{
	deleteTeamPI($data);
}

if($type == "PlayerBand"){
    PlayerBand($data);
}
if($type == "getCompTeamRating"){
	getCompTeamRating($data);
}
if($type == "getTeamRanking_comp"){
	getTeamRanking_comp($data);
}
if($type == "check_decalre_winner"){
   check_decalre_winner($data);	
}
if($type == "declarewinners")
{
	declarewinners($data);
}

if($type == "loadCompchallenges1")
{
	loadCompchallenges1($data);
}


if($type == "getTeamCoach")
{
	getTeamCoach($data);
}


if($type == "loadCompchallenges")
{
	loadCompchallenges($data);
}

if($type == "saveComp")
{
	saveComp($data);
}

if($type == "saveComp1")
{
	saveComp1($data);
}

if($type == "loadCompetitionHistory")
{
	loadCompetitionHistory($data);
}

if($type == "getCompletedChallenges")
{
	getCompletedChallenges($data);
}

if($type == "loadscore")
{
	loadscore();
}

if($type == "payment_save") {
	loadPaymentSave();
}

if($type == "paid_save") {
	loadPaidSave();
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

if($type == "changePlayerStatus")
{
	changePlayerStatus($data);
}


if($type =="loadTeams"){

	loadTeams($data);

}
if($type =="ChallangeList"){

	ChallangeList();

}

if($type =="getMatches"){

	getMatches();

}

if($type =="invoice_details_fnc"){

	invoice_details_fnc($data);

}

if($type =="showAttendanceReport1"){

	showAttendanceReport1($data);

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

if($type =="loadAdminPlayersListAll"){

	loadAdminPlayersListAll($data);

}

if($type =="addPlayer"){

	addPlayer($data);

}

if($type =="removePlayer"){

	removePlayer($data);

}

if($type == "loadChalleneges"){

	loadChalleneges();

}
if($type == "loadChallenegesJudge"){

	loadChallenegesJudge();

}
if($type == "loadCompetitions"){
	
   loadCompetitions();	
  
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

if($type == "loadNDCandRegions"){

	loadNDCandRegions();

}

if($type == "getTeamRanking"){

	getTeamRanking($data);

}
if($type == "sendbulkemail"){

	sendbulkemail($data);

}
if($type == "sendInvitePeople"){

	sendInvitePeople($data);

}

if($type == "newstickertext"){

	newstickertext($data);

}
if($type == "newstickertext2"){

	newstickertext2($data);

}
if($type == "newstickertext3"){

	newstickertext3($data);

}
if($type == "getnewstickertext"){

	getnewstickertext($data);

}
if($type == "getnewstickertext2"){

	getnewstickertext2($data);

}
if($type == "getnewstickertext3"){

	getnewstickertext3($data);

}

if($type == "getTeamRatingR"){

	getTeamRatingR($data);

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
if($type == "loadTeamsR21"){
	loadTeamsR21($data);
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

	//ajaxgetTeamRankingR2($data);

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
if($type == "saveinvoicemain"){

	saveinvoicemain($data);
}

if($type == "changeinvoice_status"){

	changeinvoice_status($data);
}

if($type == "SaveLessionsData"){

	SaveLessionsData($data);
}

if($type == "lessionsList"){

	lessionsList($data);
}

if($type == "showAttendanceReport"){

	showAttendanceReport($data);
}

if($type == "Organization_Report"){

	Organization_Report($data);
}

function changeStatus($data){
	global $con;
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

function changePlayerStatus($data){
	global $con;
	$id = $data["id"];
	$s = $data["val"];
	
	$sql  = mysqli_query( $con," UPDATE  users SET status = '$s', `updated_date` = CURRENT_DATE  WHERE  id = '$id' ");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		echo 'Status Changed Successfully!';
	}
	
}

function loadscore(){
	global $con;
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

from team_player tp, links ln where ln.team_id = tp.team_id group by tname order by urate desc

 ";
 
 $sql2 = "SELECT t.name as tname,
(select org_name from users where id = u.org_id)orgname,
(select county from users where id = u.org_id)ucountry,
(select state from users where id = u.org_id)ustate,
SUM(v.rating) as urate,SUM(v.creativity) as ucreativity,SUM(v.problem_solved) as upsolved, COUNT(l.challenge_id) as uch FROM `team` as t INNER JOIN links as l ON l.team_id = t.id 
INNER JOIN video_rating as v ON v.link_id = l.id 
INNER JOIN users as u ON u.id = t.coach_id 
GROUP BY t.id ORDER BY `coach_id`  ASC";
	$retval = mysqli_query( $con, $sql2 );
	
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
	global $con;
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
	global $con;
	$coachId = $data["coachId"];
	$state = isset($data["state"]) ? $data["state"] : '' ;
	$county = isset($data["county"]) ? $data["county"] : '';

	$array = array();
	if($coachId == 'admin' && $state && $county){
		$sql = "SELECT t.*, u.name as userfname, u.last_name FROM `team` t INNER JOIN `users` u ON u.id = t.coach_id WHERE u.county = '$county' AND u.state = '$state'";

	}else if ($coachId == 'admin' ){
		$sql = "SELECT t.*, u.name as userfname, u.last_name FROM `team` t INNER JOIN `users` u ON u.id = t.coach_id";

	}else{
		$sql = "SELECT t.*, u.name as userfname, u.last_name FROM `team` t INNER JOIN `users` u ON u.id = t.coach_id WHERE t.coach_id = '$coachId'  ";

	}
	
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$idsg = 0;
		while($row = mysqli_fetch_assoc($retval))
		{
			$array[] = $row;
			
			$team_id = $row['id'];
			$sql12 = "SELECT * FROM `team_player` WHERE `team_id` = '$team_id'";
			$retval1323 = mysqli_query( $con, $sql12 );
			$rowcount=mysqli_num_rows($retval1323);
			$array[$idsg]['haveplayer'] = $rowcount;
			$idsg++;
		}
		
	}

	

	echo json_encode($array);
}



function loadChalleneges(){
	global $con;
	$sql = "SELECT * FROM `challenge` WHERE `round` = 1  ORDER BY `challenge`.`id` DESC";
	$retval = mysqli_query( $con, $sql );
	$array = array();
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($row = mysqli_fetch_assoc($retval))
		{
			if($row['text']){
				$row['text'] = html_entity_decode($row['text']);
			}
			
			$array[] = $row;
		}
		
	}

	

	echo json_encode($array);
}

function loadChallenegesJudge(){
	global $con;
	$sql = "SELECT * FROM `challenge` ORDER BY `challenge`.`id` DESC";
	$retval = mysqli_query( $con, $sql );
	$array = array();
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

function loadPaymentSave() {
	global $con;
	$id = $_POST['id'];
	$current_due = $_POST['current_due'];
	$discount = $_POST['discount'];
	if(isset($_POST['action'])) {
		$action = $_POST['action'];
		$count = count($id);
		for($i = 0; $i < $count; $i ++) {
			if(array_search($id[$i], $action) > -1){
				$status = mysqli_query($con, "SELECT id FROM payment WHERE user_id = '$id[$i]'");
				$cnt = mysqli_num_rows($status);
				if($cnt > 0) {
					$result  = mysqli_query( $con, "UPDATE payment SET current_due = '$current_due[$i]', discount = '$discount[$i]' WHERE  user_id = '$id[$i]' ");
				} else {
					$result = mysqli_query( $con, "INSERT INTO payment (user_id, balance, current_due, discount, paid) VALUES ('$id[$i]', 0, '$current_due[$i]', '$discount[$i]', 0)");
				}
			}
		}
		echo json_encode('Updated Successfully!');
	}else{
		echo json_encode('You have no checked!');
	}
}

function loadPaidSave() {
	global $con;
	$id = $_POST['id'];
	$paid = $_POST['paid'];
	if(isset($_POST['action'])) {
		$action = $_POST['action'];
		$count = count($id);
		for($i = 0; $i < $count; $i ++) {
			if(array_search($id[$i], $action) > -1){
				$sql = "SELECT id FROM payment WHERE user_id = $id[$i]";
				$status = mysqli_query($con, $sql);
				$cnt = mysqli_num_rows($status);
				if($cnt > 0) {
					$result  = mysqli_query( $con, "UPDATE payment SET paid = $paid[$i] WHERE  user_id = $id[$i] ");
				} else {
					$result = mysqli_query( $con, "INSERT INTO payment (user_id, balance, current_due, discount, paid) VALUES ($id[$i], 0, 0, 0, $paid[$i])");
				}
			}
		}
	//	echo json_encode('Updated Successfully!');
				//console.log(data);
				//alert('Updated successfully!!!');
				// location.reload();
				header('Location: http://devyouthcode.com/coach.html');
				//  if(isset($_GET['submit']) && $_GET['submit'] === 'true'){
				// 	echo 'alert("You\'ve been adfadadgfagadg!")';}
								

	}else{
		//echo json_encode('Warning! You have no checked!');
		header('Location: http://devyouthcode.com/coach.html');
		// location.reload();
	}
	
}







function loadCompchallenges1($data){
	global $con;
    $user_id = $data['userid'];
	$sql = "SELECT cc.*, c.m_comp_name FROM competition_challenge cc INNER JOIN  competition c on c.m_comp_id = cc.m_comp_id where cc.m_comp_coach = (select t.coach_id from team t INNER JOIN team_player tp on tp.team_id = t.id INNER JOIN users u on u.id = tp.user_id where u.id = '$user_id') ORDER BY cc.name ASC";
	$retval = mysqli_query( $con, $sql );
	$array = array();
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

function loadCompchallenges(){
	global $con;
	$sql = "SELECT cc.*, c.m_comp_name FROM competition_challenge cc INNER JOIN  competition c on c.m_comp_id = cc.m_comp_id ORDER BY cc.name ASC";
	$retval = mysqli_query( $con, $sql );
	$array = array();
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

function loadCompetitions(){
	global $con;
	$sql = "SELECT * FROM competition ORDER BY m_comp_name ASC";
	$retval = mysqli_query( $con, $sql );
	$array = array();
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
	global $con;
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
	global $con;
	$teamId = $data["teamId"];
	$coachId = isset($data["coachId"]) ? $data["coachId"] : null ;

	$array = array();

	if($coachId){
		$sql = "SELECT u.*, (SELECT org_id FROM users WHERE id = '$coachId') AS coach_org_id FROM `team_player` tp, `users` u WHERE u.id = tp.user_id AND tp.team_id = '$teamId'";

	}else{
		$sql = "SELECT u.* FROM `team_player` tp , `users` u   where u.id = tp.user_id   and tp.team_id = '$teamId'  ";

	}
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
	global $con;
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
	global $con;
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


function loadAdminPlayersListAll(){

	global $con;
	$array = array();
	$sql = "SELECT u.id, u.name, u.last_name, u.org_name, p.current_due, p.discount, p.balance, p.paid, p.user_id FROM users u LEFT JOIN payment p ON u.id = p.user_id WHERE u.role_id = 2";
	
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

	global $con;
	$array = array();
	$sql = "SELECT a.*, c.name as teamname, c.coach_id, d.balance, d.current_due, d.discount, d.paid FROM users a LEFT JOIN team_player b ON a.id = b.user_id LEFT JOIN team c ON b.team_id = c.id LEFT JOIN payment d ON a.id = d.user_id";
	
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


function saveComp1($data){
	global $con;
	$compname1 = $data["compname1"];
	$compchallenge = $data["compchallenge"];
	$coach = $data["coachid"];
	

 $sql1 = "select * from competition where m_comp_name='$compname1'";
 $rs = mysqli_query( $con,$sql1);
 
 $num_rows = mysqli_num_rows($rs); 
 if($num_rows > 1){
	echo"Competition Name already exists"; 
 }
 else{
	$sql  = mysqli_query( $con,"INSERT INTO competition (m_comp_coach_id,m_comp_name,m_comp_challenge) VALUES ('$coach','$compname1','$compchallenge')");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
	
		echo "Success";
	}
 }
}


function saveComp($data){
	global $con;	
	$compname = $data["compname"];
	$compsdate = $data["compsdate"];
	$compedate = $data["compedate"];
	$comptext = $data["comptext"];
	$compobj = $data["compobj"];
	$compurl = $data["compurl"];
	$compid = $data["compid"];
	$coachid = $data["coachid"];

 $sql1 = "select * from competition_challenge where name='$compname' and m_comp_id = '$compid' ";
 $rs = mysqli_query( $con,$sql1);
 
 $num_rows = mysqli_num_rows($rs); 
 if($num_rows > 1){
	echo"Challenge Name already exists in selected Competition"; 
 }
 else{
	$sql2 = "select count(id) as r from competition_challenge where m_comp_id = '$compid'";
	$rs2= mysqli_query( $con,$sql2);
	$val1 = mysqli_fetch_array($rs2);
	
	$sql3 = "select m_comp_challenge from competition where m_comp_id = '$compid'";
	$rs3= mysqli_query( $con,$sql3);
	$val2 = mysqli_fetch_array($rs3);
	
	 if($val1['r'] >= $val2['m_comp_challenge']){
		 echo"Max no of Challenges are created for this competition"; 
	 }else{
	$sql  = mysqli_query( $con,"INSERT INTO competition_challenge (m_comp_coach,m_comp_id,name,startDate, endDate, text, Learning_obj, Tutorial_url) VALUES ('$coachid','$compid','$compname','$compsdate', '$compedate', '$comptext', '$compobj', '$compurl')");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
	//  echo $val1['r']; echo $val2['m_comp_challenge'];
		echo "Success";
	}
	}
	
 }
}


function loadPlayersList(){
	global $con;
	//$team_id = $data['teamId'];
	$array = array();
	$sql = "SELECT * FROM users WHERE id NOT IN (SELECT user_id FROM team_player) AND `role_id` = 2 AND `status` = 1 ORDER BY `id` DESC";
	
	$sql = "SELECT * FROM users 
where NOT EXISTS (
 select team_player.user_id from team_player where users.id=team_player.user_id)
 AND role_id = 2
 AND `status` = 1
LIMIT 0,3000";
	
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


function saveTeam($data){
	global $con;
	$teamName = $data["teamName"];
	$coach_id = $data["coach_id"];
	$competition_id = $data["competition_id"];


 $sql1 = "select * from team where name='$teamName'";
 $rs = mysqli_query( $con,$sql1);
 
 $num_rows = mysqli_num_rows($rs); 
 if($num_rows > 1){
	echo"Team Name already exists"; 
 }
 else{
	$sql  = mysqli_query( $con,"INSERT INTO team (name,coach_id, competition_id) VALUES ('$teamName','$coach_id', '$competition_id' )");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
	
		echo "Success";
	}
 }
}



function addPlayer($data){
	 global $con;
    $teamId = mysqli_real_escape_string($con, $data["teamId"]);
    $user_id = mysqli_real_escape_string($con, $data["user_id"]);
	$coachId = mysqli_real_escape_string($con, $data["coachId"]);


    // Check if the player is already in the team
    $checkQuery = "SELECT * FROM team_player WHERE team_id = '$teamId' AND user_id = '$user_id'";
    $checkResult = mysqli_query($con, $checkQuery);

    if(mysqli_num_rows($checkResult) == 0) {
        // No existing entry found, proceed with insert
        $insertQuery = "INSERT INTO team_player (team_id, user_id) VALUES ('$teamId', '$user_id')";
        $insertResult = mysqli_query($con, $insertQuery);
		$updateQuery = "UPDATE users
		SET competition_id = (
		  SELECT competition_id
		  FROM users
		  WHERE id = $coachId
		)
		WHERE user.id = $user_id";
        $updateResult = mysqli_query($con, $updateQuery);
        
        if(!$insertResult) {
            die('Could not enter data: ' . mysqli_error($con));
        } else {
            echo "Success";
        }
    } else {
        // Entry already exists
        echo 0;
    }
}

function removePlayer($data) {
	global $con;
	$teamId = mysqli_real_escape_string($con, $data["teamId"]);
	$user_id = mysqli_real_escape_string($con, $data["user_id"]);

	// Check if the player is in the team
	$checkQuery = "SELECT * FROM team_player WHERE team_id = '$teamId' AND user_id = '$user_id'";
	$checkResult = mysqli_query($con, $checkQuery);
	if(mysqli_num_rows($checkResult) > 0) {
		// Player exists in the team, proceed with delete
		$sql = mysqli_query($con, "DELETE FROM team_player WHERE team_id = '$teamId' AND user_id = '$user_id'");
		if(!$sql) {
			die('Could not delete data: ' . mysqli_error($con));
		} else {
			echo "Success";
		}
	} else {
		// No such entry exists
		echo "Player is not in the team. ";
	}
}


function addPlayerCaptain($data){
	global $con;
	$teamId = $data["teamId"];
	$user_id = $data["user_id"];


	$sqlquery = "UPDATE `team` SET `captain_id`='$user_id' WHERE `id` = '$teamId'";
	
	$sql  = mysqli_query( $con,$sqlquery);
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
	
		echo 1;
	}
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

function addLink($data){
	global $con;
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
	
	
function getPlayerDashboardData($data){
	global $con;
	$user_id = $data["user_id"];
	$array = array();
	$team = array();
	$getTeamId = "SELECT team_id FROM team_player WHERE user_id = '$user_id'";
	$retval = mysqli_query($con, $getTeamId);
	if ($retval){
		$assoc = mysqli_fetch_assoc($retval);
		$team = array_merge($team, $assoc);
	}
	$getTeamData = "SELECT captain_id, total_points, average_score, name FROM team WHERE id = '$team[team_id]'";
	$retval = mysqli_query($con, $getTeamData);
	if ($retval){
		$assoc = mysqli_fetch_assoc($retval);
		$team = array_merge($team, $assoc);
	}
	

	$array['team'] = $team;
	echo json_encode($array);
}


function loadLinks($data){
	global $con;
	$teamId = $data["teamId"];
	$array = array();
	$sql = "SELECT l.*, vr.*, c.name FROM `links` l INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `challenge` c ON c.id = l.challenge_id LEFT JOIN `video_rating` vr on vr.link_id = l.id  where team_id = '$teamId' AND c.round = 1";
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
	global $con;
	$teamId = $data["teamId"];
	$totgrade = '';
	$array = array();
	//$sql = "SELECT (sum(vr.rating)+sum(vr.creativity)+sum(vr.artistic)+sum(vr.logic)) as rating FROM video_rating vr , links l where l.id = vr.link_id AND  l.team_id = '$teamId'  ";
	$sqlsocre = "SELECT * FROM `questions_score` WHERE `team_id` = '$teamId'";
	$retvalsocre = mysqli_query( $con, $sqlsocre );
	if(! $retvalsocre )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		while($rowsocre = mysqli_fetch_assoc($retvalsocre))
		{
			$totgrade += $rowsocre['grade'];
		}
		
	}
	
	
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
	
	$array[]['totgrade'] = $totgrade;
	
	

	echo json_encode($array);
}

function getCompTeamRating($data){	
	global $con;
	$teamId = $data["teamId"];
	$array = array();
	//$sql = "SELECT (sum(vr.rating)+sum(vr.creativity)+sum(vr.artistic)+sum(vr.logic)) as rating FROM video_rating vr , links l where l.id = vr.link_id AND  l.team_id = '$teamId'  ";
	
	$sql = "SELECT sum(vr.comp_rating1) as rating, sum(vr.comp_creativity) as creativity,sum(vr.comp_artistic) as artistic,sum(vr.comp_logic) as logic,sum(vr.comp_problem_solved) as problem_solved FROM competition_link l INNER JOIN competition_ratings vr ON vr.comp_link_id = l.comp_link_id INNER JOIN `competition_challenge` c ON c.id = l.m_comp_challenge_id WHERE l.comp_link_team_id
 = '$teamId'";
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

function loadCompetitionHistory(){
	global $con;
  	$array = array();
	$sql = "select c.*, t.name as teamname, u.name as fname, u.last_name as lname, cw.comp_total_score as score from competition c 
LEFT JOIN competition_winners cw on cw.competion_id = c.m_comp_id
 LEFT JOIN users u on u.id = cw.comp_user_id
 LEFT JOIN team_player tp on tp.user_id = u.id
 LEFT JOIN team t on t.id= tp.team_id ORDER BY c.m_comp_name ASC";

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
	global $con;
	$teamIds = $data["teamIds"];
	$in = $data["str"];
	$array = array();
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name,u.county,u.state,u.org_name FROM video_rating vr , links l , team t INNER JOIN users as u ON u.id = t.coach_id where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) AND t.name like '%$in%' GROUP by l.team_id ORDER BY rating DESC, name DESC";

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
	global $con;
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
	
	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state,u.org_name, l.challenge_id,c.round FROM video_rating vr , links l ,challenge c, team t INNER JOIN users u ON t.coach_id = u.id where t.id=l.team_id and  l.id = vr.link_id  and c.id =  l.challenge_id and c.round = 1 AND  l.team_id IN ($array1) GROUP by l.team_id ORDER BY rating DESC, name DESC";

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
	global $con;
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


function sendInvitePeople($data){
	global $con;
	//$Inviteemails = $data["emails"];
	//require '../PHPMailer-master/PHPMailerAutoload.php';

	$mail = new PHPMailer(true);
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose 
	//$headers = 'From: <k12youthcode@gmail.com>' . "\r\n";	
	$mail->isSMTP();   
	$mail->Host       = 'k12youthcode.com';         
	//Set SMTP host name                          
	//$mail->Host = "smtp.gmail.com";
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password     
	$mail->Username = "james";                 
	$mail->Password = "vJ28s98l~";                           
	//If SMTP requires TLS encryption then set it
	//$mail->SMTPSecure = "tls";                         
	//Set TCP port to connect to 
	$mail->Port = 25;                                   

	// $mail->From = "k12youthcode@gmail.com";
	// $mail->FromName = "STEMGuyana Administrator";

// $allemails = explode(',', $Inviteemails);
// 	foreach($allemails as $allemail){
// 		$mail->addCC($allemail);
// 	}
	$mail->setFrom('james@k12youthcode.com', 'james');
	$mail->addAddress('webmaster0407@gmail.com', 'ffff');
	$mail->addAddress('webmaster0407@gmail.com');
	$mail->Body = "Hello, you are receiving this message because your Administrator thought you would be ideal to serve as a coach or judge in the STEMGuyana league in which your organization [school] has just signed up.  Please be prepared to attend coach's training which will prepare you to manage teams in the Robotics, Maths or Scratch Programming Leagues";
	$mail->Subject = "Headteacher's Recommendation: Please Register As A Coach For The STEMGuyana League";
   $mail->isHTML(true);
	$mail->AltBody = "This is the plain text version of the email content";

	if(!$mail->send()) 
	{
		echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
		echo "Message has been sent successfully";
	}

	echo "Emails Sent";
}

function sendbulkemail($data){
	global $con;
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
			$mail->Password = "!Iluvlithonia123";  //aries123 **changed**                         
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tls";                           
			//Set TCP port to connect to 
			$mail->Port = 587;                                   

			$mail->From = "k12youthcode@gmail.com";
			$mail->FromName = "STEMGuyana Alert";

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


function newstickertext($data){
	global $con;
	$newstickertext = $data["newstickertext"];
	$sql = "UPDATE `news` SET `news` = '$newstickertext' WHERE `round` = '1'";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		echo 'News Updated Sucessfully';	
	}
}

function calculate() {
	global $con;
	$sql = "SELECT * FROM payment";
	$retval = mysqli_query( $con, $sql );
	while($row = mysqli_fetch_assoc($retval))
	{
		$balance = $row['current_due'] * (1 - $row['discount'] / 100) - $row['balance'];
		$id = $row['id'];
		$result  = mysqli_query( $con, "UPDATE payment SET balance = $balance, discount = 0, paid = 0 WHERE id = $id ");
	}
	echo 'Success';
}


function newstickertext2($data){
	global $con;
	$newstickertext = $data["newstickertext"];
	$sql = "UPDATE `news` SET `news` = '$newstickertext' WHERE `round` = '2'";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		echo 'News Updated Sucessfully';	
	}
}
function newstickertext3($data){
	global $con;
	$newstickertext = $data["newstickertext"];
	$sql = "UPDATE `news` SET `news` = '$newstickertext' WHERE `round` = '3'";
	$retval = mysqli_query( $con, $sql );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		echo 'News Updated Sucessfully';	
	}
}

function getnewstickertext($data){
	global $con;
	$sql = "SELECT * FROM `news` WHERE `round` = '1'";
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

function getnewstickertext2($data){
	global $con;
	$sql = "SELECT * FROM `news` WHERE `round` = '2'";
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

function getnewstickertext3($data){
	global $con;
	$sql = "SELECT * FROM `news` WHERE `round` = '3'";
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


function getTeamRanking($data){
	global $con;
	$teamIds = $data["teamIds"];
	$array = array();
	echo $sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id ORDER BY rating DESC, name DESC";

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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;

	$array = array();
	$sql = " SELECT * FROM `challenge` ORDER BY `id` DESC";
	$retval = mysqli_query( $con, $sql );
	//echo $retval;
	//$cnt=0;
	if(!$retval)
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		// $row = mysqli_fetch_array($retval);
		// $array[] = $row;
		// echo json_encode($array);
		while($row = mysqli_fetch_assoc($retval))
		{
			
			 $array[] = $row;
			 //$cnt++;
			 //echo json_encode($array);
			 
		}
		
		//echo json_encode($array);
	}
	echo json_encode($array);
}

function getMatches(){
	// global $con;

	// $array = array();
	// $sql = " SELECT * FROM `challenge` ORDER BY `id` DESC";
	// $retval = mysqli_query( $con, $sql );
	// //echo $retval;
	// //$cnt=0;
	// if(!$retval)
	// {
	// 	die('Could not enter data: ' . mysqli_error($con));
	// }else {
	// 	// $row = mysqli_fetch_array($retval);
	// 	// $array[] = $row;
	// 	// echo json_encode($array);
	// 	while($row = mysqli_fetch_assoc($retval))
	// 	{
			
	// 		 $array[] = $row;
	// 		 //$cnt++;
	// 		 //echo json_encode($array);
			 
	// 	}
		
	// 	//echo json_encode($array);
	// }
	// echo json_encode($array);
}

function getTodaysChallenge(){ 
	global $con;

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
	global $con;

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
	global $con;
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

function loadAllChallenges($data){
	global $con;
	$competition_id = $data['competition_id'];
	$team_id = isset($data['teamId'])? $data['teamId'] : null;

	$array = array();

	if($competition_id){
		$sql = "SELECT * FROM `challenge` WHERE competition_id = '$competition_id' ORDER BY `challenge`.`id` ASC";
	}else{
		$sql = "SELECT c.* 
        FROM `challenge` c
        WHERE c.competition_id = (
            SELECT u.competition_id 
            FROM `users` u
            INNER JOIN `team` t ON u.id = t.coach_id 
            WHERE t.id = '$team_id'
        ) 
        ORDER BY c.id ASC ";
	}
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
	global $con;
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
	global $con;
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

function loadTeamsR21($data){
	global $con;
	$coachId = $data["coachId"];
	$array = array();
	$sql = "SELECT tp.team_id,t.name as teamname, t.coach_id,u.name,u.last_name FROM `team_player` tp INNER JOIN `team` t ON t.id = tp.team_id INNER JOIN `users` as u ON u.id = t.coach_id WHERE tp.user_id = '$coachId'";
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
			   $array[] = $row;
			}
			
		}
		
	}

	$questions_score123 = "SELECT count(*) as total  FROM `questions_score` WHERE `user_id` = '$coachId'";
	$retvalquestions_score123 = mysqli_query( $con, $questions_score123 );
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}
	else {
	   $rowquestions_score = mysqli_fetch_assoc($retvalquestions_score123);
	   $array[0]['total_data'] = $rowquestions_score['total'];
	   
	}

	echo json_encode($array);
}

function loadTeamsR2($data){
	global $con;
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
	global $con;
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
	global $con;
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





function getTeamRanking_comp($data){
	global $con;
	$teamIds = $data["teamIds"];
//	$in = $data["str"];
	//$userorgid = $data['userorgid'];
	$usercouty = $data['usercouty'];
	$array = array();
	
	
	$array1  = "";
	echo $sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id WHERE u.role_id = 1 AND u.county = '$usercouty' ORDER BY `u`.`id`  DESC";
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
	
	$sql = "SELECT sum(vr.comp_rating1) as rating , l.comp_link_team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.m_comp_challenge_id,ou.org_name FROM competition_ratings vr , competition_link l , competition_challenge c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id where t.id=l.comp_link_team_id and  l.comp_link_id = vr.comp_link_id and c.id =  l.m_comp_challenge_id AND  l.comp_link_team_id IN ($array1) GROUP by l.comp_link_team_id ORDER BY comp_rating1 DESC, name DESC";
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




function getTeamRanking1($data){
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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
	global $con;
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


function changeCoach($data){
	global $con;
	$teamId = $data["teamId"];
	$coachId = $data["coachId"];
	$array = array();
	
	$sql = "UPDATE team SET coach_id = '$coachId' WHERE id = '$teamId'";

	$retval = mysqli_query( $con, $sql );
	
        
	if(!$retval) {
		die('Could not enter data: ' . mysqli_error($con));
	} else {
		echo "Success";
	}
    
}

function loadNDCandRegions() {
	global $con;

	if (!$con) {
        die('Connection failed: ' . mysqli_connect_error());
    }
    
	$data = array();
    
    // Query to get distinct counties for each state
    $sql = "SELECT state_abv, county FROM county_state GROUP BY state_abv, county ORDER BY state_abv, county";
    
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Could not retrieve data: ' . mysqli_error($con));
    } else {
        while ($row = mysqli_fetch_assoc($result)) {
            $state = $row['state_abv'];
            $county = $row['county'];

            // Initialize the state array if not already initialized
            if (!isset($data[$state])) {
                $data[$state] = array();
            }
            
            // Append the county to the state's array if not already included
            if (!in_array($county, $data[$state])) {
                $data[$state][] = $county;
            }
        }
    }
    
    echo json_encode($data);
}



function getTeamCoach($data) {
    global $con;
    $teamId = $data["teamId"];
    $array = array();
    $sql = "
    SELECT 
        main_coach.name as coach_name, 
        main_coach.last_name as coach_last_name, 
        main_coach.id as coach_id,
        other_coaches.name as other_coach_name,
        other_coaches.last_name as other_coach_last_name,
        other_coaches.id as other_coach_id,
        other_coaches.role_id as other_coach_role_id
    FROM 
        `team` t 
    INNER JOIN 
        `users` main_coach ON main_coach.id = t.coach_id 
    LEFT JOIN 
        `users` other_coaches ON other_coaches.org_id = main_coach.org_id AND other_coaches.id != main_coach.id AND other_coaches.role_id = 1 
    WHERE 
        t.id = '$teamId'";

    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {
        $main_coach = null;
        $other_coaches = array();
        while ($row = mysqli_fetch_assoc($retval)) {
            if (!$main_coach) { // Capture main coach details once
                $main_coach = [
                    'coach_name' => $row['coach_name'],
                    'coach_last_name' => $row['coach_last_name'],
                    'coach_id' => $row['coach_id']
                ];
            }
            if ($row['other_coach_id']) { // Add other coaches to an array
                $other_coaches[] = [
                    'coach_name' => $row['other_coach_name'],
                    'coach_last_name' => $row['other_coach_last_name'],
                    'coach_id' => $row['other_coach_id'],
                    'role_id' => $row['other_coach_role_id'] // Adding role_id to the data array
                ];
            }
        }
        $array = [
            'main_coach' => $main_coach,
            'other_coaches' => $other_coaches
        ];
    }

    echo json_encode($array);
}




function saveInvoice($data){
	global $con;
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
                                <img src="http://guyana.k12youthcode.com/registration/images/concert-one.regular-1.png" style="width:100%; max-width:300px;">
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
	global $con;
	require '../PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	
	$Org_name = $data["Org_name"];
	
	//$registrations_fee = $data['registrations_fee'];
//	$is_student = $data['is_student'];
	$fullName = $data['fullName'];
	$lastName = $data['lastName'];
	$user_id = $data['user_id'];
	$pay_student = explode(',',$data['payeestudent']);
	$no_students = $data['no_students'];
	$ttl = (intval($no_students) * 10);
	$registrations_fee = $data['clasnotot'];		
	$invoiceid = $data['invoice_id'];
	$getcurrdate = $data['getcurrdate'];
	$email_name = $data['email_name'];
	$org_id = $data['org_id'];
	
	$sql135 = "SELECT * FROM `users` WHERE id = '$org_id'";
	$retval534646 = mysqli_query( $con, $sql135 );
	$row3646 = mysqli_fetch_assoc($retval534646);
	$org_name_get = $row3646['org_name'];
	
	echo $fsdfdfsdfs = "INSERT INTO invoice (Org_Name, registrations_fee, date, student, org_email, invoiceNo, invoice_status)
			VALUES ('$org_name_get','$registrations_fee', '$getcurrdate','$no_students', '$email_name','$invoiceid','payment pending')";
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
                                <img src="http://guyana.k12youthcode.com/registration/images/concert-one.regular-1.png" style="width:100%; max-width:300px;">
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
                                K12youthcode Guyana<br>
                                Cliff Anderson Sports Hall<br>
                                Homestretch Avenue, Georgetown Guyana
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
                    5
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



function saveinvoicemain($data){
	global $con;
	$mobile_money = $data['mobile_money'];
	$mobile_amount = $data['mobile_amount'];
	$player_id = $data['player_id'];
	$player_idArray = explode(',', $player_id);
	
	foreach($player_idArray as $player_idArrays){
		$getusersql = "SELECT * from users WHERE id = '$player_idArrays'";
		$retval12 = mysqli_query( $con, $getusersql );
		$retval12fetc = mysqli_fetch_assoc($retval12);
		$retvalfirstname = $retval12fetc['name'];
		$retvallastname = $retval12fetc['last_name'];
		$retvalemail = $retval12fetc['email'];
		$fsdfdfsdfs1 = "INSERT INTO invoiceplayer (`player ID`, `Player First name`, `Player last name`, `player status`, `player email`,`MMConf`,`amount`)
			VALUES ('$player_idArrays','$retvalfirstname', '$retvallastname','paid', '$retvalemail','$mobile_money','$mobile_amount')";
		$sql1  = mysqli_query( $con,$fsdfdfsdfs1);
		if(! $sql1 )
		{
			die('Could not enter data: ' . mysqli_error($con));
		}else {
			$qry = "update users set status='1' where ID='$player_idArrays'";
			$sql  = mysqli_query( $con,$qry);
			echo 'Sucesss';
		}
	}
	
}

 function changeinvoice_status($data){
	global $con;
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
 
 function declarewinners($data){
	global $con;
	 $comp_id = $data['compid'];
	 
   	 $sql1 = "select sum(cr.comp_rating1), cl.comp_link_comptition_id,cl.comp_link_user_id from competition_ratings cr
 INNER JOIN competition_link cl on cl.comp_link_id = cr.comp_link_id 
where cr.comp_link_id in (select cl.comp_link_id from competition_link cl where cl.comp_link_id = cr.comp_link_id ) and cl.comp_link_comptition_id = '$comp_id' and cl.comp_link_comptition_id NOT IN (SELECT competion_id FROM competition_winners where competion_id = '$comp_id')  group by cr.comp_link_id";
	 $rs = mysqli_query( $con,$sql1);
	 
	 $num_rows = mysqli_num_rows($rs); 
	 if($num_rows > 0){
		//echo"Competition Name already exists"; 
		 $row = mysqli_fetch_array($rs);
		 
		$sql  = mysqli_query( $con,"INSERT INTO competition_winners (competion_id, comp_user_id, comp_total_score) VALUES ('$row[1]','$row[2]','$row[0]')");
		if(! $sql )
		{
			die('Could not enter data: ' . mysqli_error($con));
		}else {
			echo "Success";
		}
	 }
	 else{
		
		 
		echo"NO Competition Founds";
	    
	 }
 }
 
 function check_decalre_winner($data){
	global $con;
	 $compid = $data['comp'];
	 
	 $array = "";
   $qry = "SELECT cc.id, cl.comp_link_id FROM competition_challenge cc, competition_link cl where cc.id=cl.m_comp_challenge_id and cl.comp_link_id in (select comp_link_id from competition_ratings) and DATE(cc.endDate) <= CURDATE() and cc.m_comp_id = '$compid' and cc.m_comp_id NOT IN (select cw.competion_id from competition_winners cw where cw.competion_id = '$compid')";	
   
   $retval = mysqli_query( $con, $qry );
	
	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		$num_row = mysqli_num_rows($retval);
		$array = $num_row;
	}

	echo json_encode($array);    
 }
 
function invoice_details_fnc($data){
	global $con;
	$array = array();
	//$flag=$data;
	
	//echo 'hello';
	 $sql="";
	if($data=="status"){
			$sql = " SELECT * FROM invoice ORDER BY invoice_status";
			$sql.=" DESC";
	}
	if($data=="order"){
		$sql = " SELECT * FROM invoice ORDER BY date DESC";
	}
	// if($data=="status")
	// $sql = " SELECT * FROM invoice ORDER BY invoice_status";
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
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
function lessionsList($data){
	global $con;
	
	$userid = $data['userid'];
	$round = $data['round'];
	$category = isset($data['category']) ? $data['category'] : '';
    if($category != ''){
        $sql = "SELECT * FROM `lessions` WHERE `round` = '$round' AND `category` = '$category'";
    }else {
        $sql = "SELECT * FROM `lessions` WHERE `round` = '$round'";
    }
	$sqlcnt = "SELECT count(*) as cnt FROM `lessions` WHERE `round` = '$round'";
	$cntquery = mysqli_query( $con, $sqlcnt );
	$cnt = mysqli_fetch_assoc($cntquery);
//    echo $sql;return;
    $retval = mysqli_query( $con, $sql );
    //$fetchteamaid = mysqli_fetch_assoc($retval);
	$results = array();
    while($res = mysqli_fetch_assoc($retval)){
		$lession_id = $res['id'];
		 $sql2 = "SELECT count(*) as total FROM coach_attendance as ld WHERE ld.user_id = '$userid' AND ld.`lession_id` = '$lession_id'";
		$retval2 = mysqli_query( $con, $sql2 );
		$res2 = mysqli_fetch_assoc($retval2);
		$total = $res2['total'];	
		if($total > 0){
			$res['statusd'] = "Passed";	
		}else {
			$res['statusd'] = "Incomplete";
		}
		$res = utf8ize($res);
        array_push($results, $res);
    }
	echo json_encode($results);die;
}

function SaveLessionsData($data){
	global $con;
	$less_is = $data["less_is"];
    $userid = $data["userid"];
	$name = $data["name"];

	$abcddata= "INSERT INTO `coach_attendance`(`user_id`, `name`, `lession_id`, `status`, `date`) VALUES ('$userid', '$name', '$less_is','1', '".date('Y-m-d')."')";

   $sql  = mysqli_query( $con,$abcddata);
    if(! $sql )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {


        echo "Success";
    }
	
}



function PlayerBand($data){
	global $con;
	$userid = $data["userId"];
	$sql2 = "SELECT count(*) as total FROM coach_attendance as ld WHERE ld.user_id = '$userid'";
	$retval2 = mysqli_query( $con, $sql2 );
	$res2 = mysqli_fetch_assoc($retval2);
	$total = $res2['total'];
	if($total == '6'){
		echo 'Yellow';
	}elseif($total == '12'){
		echo 'Green';
	}elseif($total == '18'){
		echo 'Red';
	}else{
		echo 'No Band Yet';
	}
}

function showAttendanceReport($data){
	global $con;
	$result = array();
	$userid = $data["userId"];
	$sql = "SELECT * FROM `users` WHERE `user_master_account` = '$userid'";
	$retval = mysqli_query( $con, $sql );

	while($res = mysqli_fetch_assoc($retval)){
		$org_id = $res['id'];
		$org_name = $res['org_name'];
		
		 echo $sql2 = "SELECT * FROM `users` WHERE `org_id` = '$org_id'";
		$retval2 = mysqli_query( $con, $sql2 );
		while($res2 = mysqli_fetch_assoc($retval2)){
			$coach_name = $res2['name'];
			 $coach_id = $res2['id'];
			 echo $sql3 = "SELECT * FROM `team` WHERE `coach_id` = '$coach_id'";
			$retval3 = mysqli_query( $con, $sql3 );
			while($res3 = mysqli_fetch_assoc($retval3)){
				$teamname = $res3['name'];
				$teamid = $res3['id'];
				echo $sql4 = "SELECT * FROM `team_player` WHERE `team_id` = '$teamid'";
				$retval4 = mysqli_query( $con, $sql4 );
				while($res4 = mysqli_fetch_assoc($retval4)){
					$player_id = $res4['user_id'];
					echo $sql5 = "SELECT count(*) as total FROM `lessions_data` WHERE `user_id` = '$player_id'";
					$retval5 = mysqli_query( $con, $sql5 );
					$res5 = mysqli_fetch_assoc($retval5);
					$total = $res5['total'];
					if($total == '6'){
						$bandcolor = 'Yellow';
					}elseif($total == '12'){
						$bandcolor = 'Green';
					}elseif($total == '18'){
						$bandcolor = 'Red';
					}else{
						$bandcolor = 'No Band Yet';
					}	
					$result[] = array('org_name'=>$org_name, 'coach_name'=>$coach_name,
					'team_name'=>$teamname, 'team_name'=>$teamname, 'player_name'=>$player_id,
					'band_color' => $bandcolor
					);	
				}
			}
		}
		
		
	}
	echo json_encode($result);
}


function showAttendanceReport1($data){
	global $con;
	$result = array();
	if(!empty($data["userId"])){
		//echo $data["acctype"];
		if($data["acctype"] == 'master'){
			$userid = $data["userId"];
			$sqld = "select * from `users` u INNER JOIN `coach_organization` as co ON co.organization_id = u.id where u.user_master_account = '$userid'";
			$retvalss = mysqli_query( $con, $sqld );
			while($res12 = mysqli_fetch_assoc($retvalss)){
				$coachnameid = $res12['coach_id'];
				$sql = "SELECT u.name as coachname, l.title as lessionname, ca.date, t.name as teamname,
						(SELECT org_name FROM `users` WHERE `id` = u.org_id)orgname
						FROM `coach_attendance` as ca 
						INNER JOIN users as u ON u.id = ca.user_id
						INNER JOIN lessions as l ON l.id = ca.lession_id
						INNER JOIN team as t ON t.coach_id = ca.user_id 
						WHERE ca.`user_id` = '$coachnameid'";
				$retval = mysqli_query( $con, $sql );

				while($res = mysqli_fetch_assoc($retval)){
					$coachname = $res['coachname'];
					$lessionname = $res['lessionname'];
					$date = $res['date'];
					$teamname = $res['teamname'];
					$orgname = $res['orgname'];
					
					 $result[] = array('org_name'=>$orgname, 'coach_name'=>$coachname,
								'team_name'=>$teamname, 'lessionname'=>$lessionname,
								'date' => $date
								);
					
					
				}		
			}
		}else{
			$userid = $data["userId"];
			$sqld = "select * from `coach_organization` as co where co.organization_id = '$userid'";
			$retvalss = mysqli_query( $con, $sqld );
			while($res12 = mysqli_fetch_assoc($retvalss)){
				$coachnameid = $res12['coach_id'];
				$sql = "SELECT u.name as coachname, l.title as lessionname, ca.date, t.name as teamname,
						(SELECT org_name FROM `users` WHERE `id` = u.org_id)orgname
						FROM `coach_attendance` as ca 
						INNER JOIN users as u ON u.id = ca.user_id
						INNER JOIN lessions as l ON l.id = ca.lession_id
						INNER JOIN team as t ON t.coach_id = ca.user_id 
						WHERE ca.`user_id` = '$coachnameid'";
				$retval = mysqli_query( $con, $sql );

				while($res = mysqli_fetch_assoc($retval)){
					$coachname = $res['coachname'];
					$lessionname = $res['lessionname'];
					$date = $res['date'];
					$teamname = $res['teamname'];
					$orgname = $res['orgname'];
					
					 $result[] = array('org_name'=>$orgname, 'coach_name'=>$coachname,
								'team_name'=>$teamname, 'lessionname'=>$lessionname,
								'date' => $date
								);
					
					
				}		
			}
		}
	}
	
	echo json_encode($result);
}

function Organization_Report($data){
	global $con;
	$result = array();
	if(!empty($data["userId"])){
		$userid = $data["userId"];
	}
	$org_id = $data['orgId'];

		$sql = "SELECT u.org_name,u.county, u.id as organization_id,t.name,t.id, (SELECT name FROM `users` WHERE `id` = co.coach_id) coachname FROM `users` u INNER JOIN coach_organization as co ON co.organization_id = u.id INNER JOIN team as t ON t.coach_id = co.coach_id where u.user_master_account = '$userid' and u.id = '$org_id'";
 	echo "";
	$retval = mysqli_query( $con, $sql );
	
	while($res = mysqli_fetch_assoc($retval)){
		$org_name = $res['org_name'];
		$coachname = $res['coachname'];
		$county = $res['county'];
		$team = $res['name'];
		$teamid = $res['id'];
		
		$organization_id = $res['organization_id'];
		 $result[] = array('org_name'=>$org_name, 'coach_name'=>$coachname,
					'organization_id' => $organization_id,'county' => $county,
					'team_name' => $team, 'team_id' => $teamid
					);
	}
	echo json_encode($result);
		// global $con;
		// 	$teamIds = $data["teamIds"];
		// //	$in = $data["str"];
		// 	//$userorgid = $data['userorgid'];
		// 	$usercouty = $data['usercouty'];
		// 	//$name=$data['org_name'];
		// 	$array = array();
			
		// 	//echo $name;
		// 	$array1  = "";
		// 	$sql1 = "SELECT u.id,u.name,t.coach_id,t.id as teamid FROM `users` u INNER JOIN `team` t ON t.coach_id = u.id ";
		// 	$retval1 = mysqli_query( $con, $sql1 );
		// 	if(! $retval1 )
		// 	{
		// 		die('Could not enter data: ' . mysqli_error($con));
		// 	}else {
		// 		$totl = mysqli_num_rows($retval1);
		// 		$gh = 1;
		// 		while($row1 = mysqli_fetch_assoc($retval1))
		// 		{
					
		// 			$array1 .= $row1['teamid'].($gh == $totl ? '' : ',');
		// 			$gh++;
		// 		}
		// 	}
			
			
		// 	$sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name, u.name as userfname, u.last_name,u.county,u.state, l.challenge_id,c.round,ou.org_name FROM video_rating vr , links l , challeng c, team t INNER JOIN users u ON t.coach_id = u.id INNER JOIN users ou ON u.org_id = ou.id where t.id=l.team_id  ORDER BY u.county ASC";
		// 	$retval = mysqli_query( $con, $sql );
			
		// 	if(! $retval )
		// 	{
		// 		$array = array();
		// 		//die('Could not enter data: ' . mysqli_error($con));
				
		// 	}else {
				
		// 		while($row = mysqli_fetch_assoc($retval))
		// 		{
		// 			$array[] = $row;
		// 		}
				
		// 	}
		// 	echo json_encode($array);
}


function goRemove($data){
	global $con;
	$searchIDs = $data["searchIDs"];
	//echo $searchIDs;
    $coach_id = $data["coach_id"];
	//$myArray = explode(',', $searchIDs);
	
	foreach($searchIDs as $myArrays){
		$abcddata= "UPDATE `users` SET `status`='0' WHERE `id` = '$myArrays'";
		$sql  = mysqli_query( $con,$abcddata);
		if(! $sql )
		{
			die('Could not enter data: ' . mysqli_error($con));
		}else {
			echo "Success";
		}
	}
	
}

function edittemapi($data){
	global $con;
	$team = $data["team"];
	//echo $searchIDs;
    $teamidpi = $data["teamidpi"];
	//$myArray = explode(',', $searchIDs);
	
	
	 $abcddata= "UPDATE `team` SET `name`='$team' WHERE `id` = '$teamidpi'";
	$sql  = mysqli_query( $con,$abcddata);
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		echo "Success";
	}
	
}

function deleteTeamPI($data){
	global $con;
	$id = $data["id"];
	$abcddata= "DELETE FROM `team` WHERE `id` = '$id'";
	$sql  = mysqli_query( $con,$abcddata);
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$abcddata1= "DELETE FROM `team_player` WHERE `team_id` = '$id'";
		$sql1  = mysqli_query( $con,$abcddata1);
		if(! $sql1 )
		{
			die('Could not enter data: ' . mysqli_error($con));
		}else{
			echo "Success";
		}
	}
}

function getTeamRatingR($data){	
	global $con;
	$mastId = $data["mastId"];
	$teamid = $data["teamid"];
	$totgrade = 0;
	$array = array();
	//$sql = "SELECT (sum(vr.rating)+sum(vr.creativity)+sum(vr.artistic)+sum(vr.logic)) as rating FROM video_rating vr , links l where l.id = vr.link_id AND  l.team_id = '$teamId'  ";
	
	// $sqlsocre12 = "SELECT t.id as teamid  FROM `coach_organization` as co
	// 					INNER JOIN `team` t ON co.coach_id = t.coach_id 
	// 					WHERE co.organization_id LIKE '$mastId'";
	// $retvalsocre23d = mysqli_query( $con, $sqlsocre12 );
	// while($rowsocre34 = mysqli_fetch_assoc($retvalsocre23d)){
	// 		$teamid = $rowsocre34['teamid'];
		
		
		$sqlsocre = "SELECT * FROM `questions_score` WHERE `team_id` = '$teamid'";
		$retvalsocre = mysqli_query( $con, $sqlsocre );
		if(! $retvalsocre )
		{
			die('Could not enter data: ' . mysqli_error($con));
		}else {
			
			while($rowsocre = mysqli_fetch_assoc($retvalsocre))
			{
				$totgrade += $rowsocre['grade'];
			}
			
		}
		//echo $totgrade;
		//echo 'hello';
		
		$sql = "SELECT sum(vr.rating) as rating, sum(vr.creativity) as creativity,sum(vr.artistic) as artistic,sum(vr.logic) as logic,sum(vr.problem_solved) as problem_solved FROM links l INNER JOIN video_rating vr ON vr.link_id = l.id  WHERE  l.team_id = '$teamid'";
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
	
	//}
	$array[]['totgrade'] = $totgrade;
	
	

	echo json_encode($array);
}
?>
