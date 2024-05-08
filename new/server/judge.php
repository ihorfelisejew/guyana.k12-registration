<?php



include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$type = $_POST['type'];
$data = $_POST['data'];

if($type == "loadLinks")
{
	loadLinks($data);
}

if($type =="loadRatedLinks"){

	loadRatedLinks($data);

}

if($type =="rateLink"){

	rateLink($data);

}

if($type =="loadCoachRatedLinksByAllJudges"){

	loadCoachRatedLinksByAllJudges($data);

}

if($type =="loadCoachRatedLinksByAllJudgesR2"){

	loadCoachRatedLinksByAllJudgesR2($data);

}

if($type =="loadCoachRatedLinksByAllJudgesR3"){

	loadCoachRatedLinksByAllJudgesR3($data);

}

if($type =="loadRatedLinksByAllJudges"){

	loadRatedLinksByAllJudges($data);

}

if($type =="loadRatedLinksByAllJudgesR2"){

	loadRatedLinksByAllJudgesR2($data);

}
if($type =="loadRatedLinksByAllJudgesR3"){

	loadRatedLinksByAllJudgesR3($data);

}

function loadRatedLinks($data){
	
	$jid = $data["jid"];

	$rowStatus = 0;
	$array = array();
	$sql = "SELECT l.url  , l.posted_date , l.title , vr.rating   FROM video_rating vr , links l where vr.link_id = l.id  AND   vr.judge_id = '$jid'   ";
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


function loadCoachRatedLinksByAllJudges($data){
	
	
	$coach_id = $data["coach_id"];
	
	$rowStatus = 0;
	$array = array();
	$sql = "SELECT *, t.name tname FROM video_rating vr INNER JOIN links l ON l.id = vr.link_id INNER JOIN team t ON t.id = l.team_id INNER JOIN challenge c ON c.id = l.challenge_id WHERE c.round = 1 and t.coach_id = $coach_id";
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

function loadCoachRatedLinksByAllJudgesR2($data){
	
	
	$coach_id = $data["coach_id"];
	
	$rowStatus = 0;
	$array = array();
	$sql = "SELECT *, t.name tname FROM `video_rating` vr INNER JOIN `links` l ON l.id = vr.link_id INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `challenge` c ON c.id = l.challenge_id WHERE c.round = 2 and t.coach_id = $coach_id";
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
function loadCoachRatedLinksByAllJudgesR3($data){
	
	
	$coach_id = $data["coach_id"];
	
	$rowStatus = 0;
	$array = array();
	$sql = "SELECT *, t.name tname FROM `video_rating` vr INNER JOIN `links` l ON l.id = vr.link_id INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `challenge` c ON c.id = l.challenge_id WHERE c.round = 3 and t.coach_id = $coach_id";
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


function loadRatedLinksByAllJudges($data){
	
	$user_id = $data["data"];

	$rowStatus = 0;
	$array = array();
	$sql = "SELECT l.url , u.name ,t.name tname, l.posted_date , l.title , vr.rating, vr.creativity,vr.artistic,vr.logic,vr.problem_solved FROM video_rating vr , users u, links l INNER JOIN `challenge` c ON c.id = l.challenge_id INNER JOIN team t ON t.id = l.team_id where vr.link_id = l.id  and u.id = vr.judge_id and c.round = 1 and t.id = (select team_id from team_player where user_id = $user_id)";
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

function loadRatedLinksByAllJudgesR2($data){
	
	$user_id = $data["data"];

	$rowStatus = 0;
	$array = array();
	$sql = "SELECT l.url , u.name , t.name tname, l.posted_date , l.title , vr.rating, vr.creativity,vr.artistic,vr.logic,vr.problem_solved,c.round   FROM video_rating vr , users u  , links l INNER JOIN `challenge` c ON c.id = l.challenge_id INNER JOIN team t ON t.id = l.team_id where vr.link_id = l.id  and u.id = vr.judge_id and c.round = 2 and t.id = (select team_id from team_player where user_id = $user_id)";
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

function loadRatedLinksByAllJudgesR3($data){
	
	$user_id = $data["data"];

	$rowStatus = 0;
	$array = array();
	$sql = " SELECT l.url , u.name , l.posted_date , l.title , vr.rating, vr.creativity,vr.artistic,vr.logic,vr.problem_solved   FROM video_rating vr , users u  , links l INNER JOIN `challenge` c ON c.id = l.challenge_id INNER JOIN team t ON t.id = l.team_id where vr.link_id = l.id  and u.id = vr.judge_id and c.round = 3 and t.id = (select team_id from team_player where user_id = $user_id) ";
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

function loadLinks($data){
	
	$jid = $data["jid"];

	$rowStatus = 0;
	$array = array();
	$sql = "select l.*,c.endDate FROM links l INNER JOIN `challenge` c ON c.id = l.challenge_id where l.id not IN ( SELECT l.id FROM links l JOIN video_rating vr ON l.id = vr.link_id) ORDER BY RAND() LIMIT 9  ";
	$retval = mysqli_query( $con, $sql );

	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
	
		while($row = mysqli_fetch_assoc($retval))
		{	
			$databsedate = $row['endDate'];
			//$databsedate = "2016-11-2 18:30:00";
			$mdate = strtotime($databsedate);
			$databsedate = date('Y-m-d', $mdate);
			$getdbdate =  date( strtotime('-2 day', strtotime($databsedate)));
			
			$getdbdatefinaldate =   date(strtotime($databsedate));
			
			
			$date1 = date('Y-m-d');
			$current_date = date(strtotime($date1));
			
			if($current_date >= $getdbdate && $current_date <= $getdbdatefinaldate){
				//echo $row['id'].'<br/>';
				//echo $row['endDate'].'<br/>';
				$array[] = $row;
			}
		}

	}



	echo json_encode($array);
}

function rateLink($data){
	
	$linkId = $data["linkId"];
	$rating = $data["rating"];
	$userId = $data["userId"];
	$creativity = $data["creativity"];
	$artistic = $data["artistic"];
	$logic = $data["logic"];
	$problem_solved = $data["problem_solved"];

	$sql  = mysqli_query( $con,"INSERT INTO video_rating (judge_id,rating,link_id,creativity,artistic,logic,problem_solved)
			VALUES ('$userId','$rating','$linkId','$creativity','$artistic','$logic','$problem_solved'  )");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		mail($email,"Registration Confirmation","Thanks for registering  with us ");
		echo "Success";
	}
}



?>