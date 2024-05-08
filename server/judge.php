<?php



include('db.php');
error_reporting(0);
ini_set('display_errors', 0);

$type = $_POST['type'];
$data = $_POST['data'];

if($type == "loadLinks")
{
	loadLinks($data);
}

if($type == "onJudgeDate")
{
	onJudgeDate();
}

if($type == "loadRankings")
{
	loadRankings($data);
}


if($type == "getSubmissionData")
{
	getSubmissionData($data);
}


if($type == "complinkhistory"){
  complinkhistory($data);	
}

if($type == "loadcometition")
{
	loadcometition($data);
}

if($type == "rateCompLink"){
	rateCompLink($data);
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
	global $con;
	$jid = $data["jid"];

	$rowStatus = 0;
	$array = array();
	$sql = "SELECT 
    l.url, 
    l.posted_date, 
    l.title, 
    vr.rating, 
    vr.creativity, 
    vr.artistic, 
    vr.logic, 
	vr.id,
	vr.date,
    vr.problem_solved,
    c.name AS challenge_name,
    c.round AS challenge_round,
	c.judge_by,
    t.name AS team_name
	FROM video_rating vr
	INNER JOIN links l ON vr.link_id = l.id
	INNER JOIN `challenge` c ON c.id = l.challenge_id
	INNER JOIN team t ON t.id = l.team_id
	WHERE vr.judge_id = '$jid'
	AND CURDATE() > c.judge_by
	ORDER BY vr.date desc;
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


function loadCoachRatedLinksByAllJudges($data){
	
	global $con;
	$coach_id = $data["coach_id"];
	
	$rowStatus = 0;
	$array = array();
	echo $sql = "SELECT *, t.name tname FROM video_rating vr INNER JOIN links l ON l.id = vr.link_id INNER JOIN team t ON t.id = l.team_id INNER JOIN challenge c ON c.id = l.challenge_id WHERE c.round = 1 and t.coach_id = $coach_id";
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
	global $con;
	
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
	
	global $con;
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

function complinkhistory($data){
  $user_id = $data["data"];
  global $con;
	$rowStatus = 0;
	$array = array();
	$sql = "SELECT l.comp_link_url ,c.m_comp_name, cc.name as challange, l.comp_posting_date, u.name ,t.name tname, l.comp_posting_date , l.comp_link_title , vr.comp_rating1, vr.comp_creativity,vr.comp_artistic,vr.comp_logic,
vr.comp_problem_solved FROM competition_ratings vr , users u, competition_link l INNER JOIN `competition_challenge` cc ON cc.id = l.m_comp_challenge_id INNER JOIN competition c on c.m_comp_id = cc.m_comp_id

 INNER JOIN team t ON t.id = l.comp_link_team_id where vr.comp_link_id = l.comp_link_id  and u.id = vr.comp_judge_id ";
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
	global $con;
	$rowStatus = 0;
	$array = array();
	$sql = "SELECT l.url , u.name ,t.name tname, l.posted_date , l.title , vr.rating, vr.creativity,vr.artistic,vr.logic,vr.problem_solved FROM video_rating vr , users u, links l INNER JOIN `challenge` c ON c.id = l.challenge_id INNER JOIN team t ON t.id = l.team_id where vr.link_id = l.id  and u.id = vr.judge_id and c.round = 1 and t.id = (select team_id from team_player where user_id = '$user_id')";
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

function getSubmissionData($data){
	
	$user_id = $data["user_id"];
	$challenge_id = $data["challenge_id"];
	$challenge_round = $data["challenge_round"];

	global $con;
	$rowStatus = 0;
	$array = array();
	$sql = "SELECT DISTINCT l.url, 
	u.name, 
	t.name AS tname, 
	l.posted_date, 
	l.title, 
	vr.rating, 
	vr.creativity, 
	vr.artistic, 
	vr.logic, 
	vr.problem_solved 
FROM links l 
LEFT JOIN video_rating vr ON vr.link_id = l.id 
INNER JOIN team t ON t.id = l.team_id 
INNER JOIN team_player tp ON t.id = tp.team_id AND tp.user_id = '$user_id'
LEFT JOIN users u ON u.id = vr.judge_id 
INNER JOIN `challenge` c ON c.id = l.challenge_id AND c.id = '$challenge_id' AND c.round = '$challenge_round' 
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

function loadRatedLinksByAllJudgesR2($data){
	
	$user_id = $data["data"];
	global $con;
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
	global $con;
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

function loadcometition($data){
	$rowStatus = 0;
	$array = array();
	$sql = "select cl.*,cc.endDate as link FROM competition_link cl INNER JOIN competition_challenge cc ON cc.id = cl.m_comp_challenge_id where cl.comp_link_id not IN ( SELECT cl.comp_link_id FROM competition_link cl JOIN competition_ratings vr ON cl.comp_link_id = vr.comp_link_id) ORDER BY RAND() LIMIT 9";
	global $con;
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

function onJudgeDate(){
	global $cn;
$mysqli = $cn;

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Start transaction
$mysqli->begin_transaction();

try {
    // 1. Select Challenges with judge_by date as today
    $todayChallengesResult = $mysqli->query("SELECT id, round, competition_id, judged FROM challenge WHERE judge_by = CURDATE() AND judged != 1");
    $todayChallenges = $todayChallengesResult->fetch_all(MYSQLI_ASSOC);

    foreach ($todayChallenges as $challenge) {

        $challengeId = $challenge['id'];

        // 2. Select and Sum Scores for each link, and get team_id
        $scoresStmt = $mysqli->prepare("
            SELECT 
                l.team_id, 
                SUM(vr.creativity + vr.artistic + vr.logic + vr.problem_solved) AS total_score
            FROM links l
            INNER JOIN video_rating vr ON l.id = vr.link_id
            WHERE l.challenge_id = ?
            GROUP BY l.team_id");
        $scoresStmt->bind_param("i", $challengeId);
        $scoresStmt->execute();
        $scoresResult = $scoresStmt->get_result();
        while ($result = $scoresResult->fetch_assoc()) {
            $teamId = $result['team_id'];
            $totalScore = $result['total_score'];

            // 3. Update Total Points in Teams
            $updateStmt = $mysqli->prepare("UPDATE team SET total_points = total_points + ? WHERE id = ?");
            $updateStmt->bind_param("ii", $totalScore, $teamId);
            $updateStmt->execute();

			  // 4. Calculate and Update Average Score
			$averageScoreStmt = $mysqli->prepare("
				UPDATE team t
				JOIN (
					SELECT l.team_id, COUNT(DISTINCT l.challenge_id) AS distinct_challenges
					FROM links l
					GROUP BY l.team_id
				) AS challenge_counts ON t.id = challenge_counts.team_id
				SET t.average_score = t.total_points / challenge_counts.distinct_challenges
				WHERE t.id = ?");
			$averageScoreStmt->bind_param("i", $teamId);
			$averageScoreStmt->execute();
        }

        // 5 & 6. Determine if Challenge is the Last in Round and Update Round for Winning Team
        $roundCheckStmt = $mysqli->prepare("
            SELECT COUNT(*) AS remaining_challenges 
            FROM challenge 
            WHERE competition_id = ? AND round = ? AND judge_by > CURDATE()");
        $roundCheckStmt->bind_param("ii", $challenge['competition_id'], $challenge['round']);
        $roundCheckStmt->execute();
        $roundCheckResult = $roundCheckStmt->get_result();
        $remainingChallenges = $roundCheckResult->fetch_assoc()['remaining_challenges'];

        if ($remainingChallenges == 0) { //it's the last challenge in a round
			$currentRound = $challenge['round'];
			$challengeId = $challenge['id'];
			
			if ($currentRound == 1) {
				// First round: Select one winner per organization
				$query = "
					SELECT t.id AS team_id, u.org_id, MAX(t.total_points) AS max_points
					FROM team t
					INNER JOIN users u ON t.coach_id = u.id
					WHERE t.id IN (
						SELECT team_id FROM links WHERE challenge_id = ?
					)
					GROUP BY u.org_id
					ORDER BY u.org_id, max_points DESC";
			} elseif ($currentRound == 2) {
				// Second round: Select one winner per state, from first-round organization winners
				$query = "
					SELECT t.id AS team_id, u.state, MAX(t.total_points) AS max_points
					FROM team t
					INNER JOIN users u ON t.coach_id = u.id
					WHERE t.round = 2 AND t.id IN (
						SELECT team_id FROM links WHERE challenge_id = ?
					)
					GROUP BY u.state
					ORDER BY u.state, max_points DESC";
			} elseif ($currentRound == 3) {
				// Third round: Select the overall winner from second-round state winners
				$query = "
					SELECT t.id AS team_id, MAX(t.total_points) AS max_points
					FROM team t
					WHERE t.round = 3 AND t.id IN (
						SELECT team_id FROM links WHERE challenge_id = ?
					)
					ORDER BY max_points DESC
					LIMIT 1";
			}
			
			// Prepare and execute the query
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("i", $challengeId);
			$stmt->execute();
			$result = $stmt->get_result();
			
			$winners = [];
			while ($row = $result->fetch_assoc()) {
				$winners[] = $row['team_id'];
			}
			
			
			// Process winners as needed
			foreach ($winners as $teamId) {
				// Update round for winners to progress them to the next round
				$updateRoundStmt = $mysqli->prepare("UPDATE team SET round = ? WHERE id = ?");
				$nextRound = $currentRound + 1;
				$updateRoundStmt->bind_param("ii", $nextRound, $teamId);
				$updateRoundStmt->execute();
			}
		
			
			
        }

		$updateJudgedFlagStmt = $mysqli->prepare("
                UPDATE challenge 
                SET judged = 1 
                WHERE id = ?");
		$updateJudgedFlagStmt->bind_param("i", $challengeId);
		$updateJudgedFlagStmt->execute();
    }

    $mysqli->commit();
} catch (Exception $e) {
    $mysqli->rollback();
    echo "Error: " . $e->getMessage();
}

$mysqli->close();



}

function loadLinks($data){
	global $con;
	$rowStatus = 0;
	$array = array();

	$competition_id = $data["competition_id"];
	$coachId = isset($data["coachId"]) ? $data["coachId"] : null;
	$teamId = isset($data["teamId"]) ? $data["teamId"] : null;

	if($coachId && $teamId){
		$sql = "SELECT l.*, c.endDate, c.judge_by, vr.date, vr.creativity, vr.artistic, vr.logic, vr.problem_solved
    FROM links l
    INNER JOIN `challenge` c ON c.id = l.challenge_id
    LEFT JOIN video_rating vr ON l.id = vr.link_id
    WHERE c.competition_id = (SELECT competition_id FROM users WHERE id = '$coachId') AND l.team_id = '$teamId'
    ";
	}else{
		$sql = "SELECT l.*, c.endDate, c.judge_by, vr.date, vr.creativity, vr.artistic, vr.logic, vr.problem_solved
    FROM links l
    INNER JOIN `challenge` c ON c.id = l.challenge_id
    LEFT JOIN video_rating vr ON l.id = vr.link_id
    WHERE (vr.date IS NULL OR vr.date < c.judge_by)
    AND l.posted_date < c.judge_by
    AND CURDATE() < c.judge_by
	AND c.competition_id = $competition_id
	";
	}
	
	$retval = mysqli_query( $con, $sql );

	if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		$current_date = strtotime(date('Y-m-d'));
		while($row = mysqli_fetch_assoc($retval)) {	
			
				$array[] = $row;
			
		}

	}



	echo json_encode($array);
}

function loadRankings($data){
	global $cn;
	$mysqli = $cn;
	$competitionId = $data['competitionId'];
	$org_id = $data['user_org_id'];
	$state = $data['user_state'];
	$array = [];
	

		$competitionStmt = $mysqli->prepare("SELECT * FROM competition_details WHERE id = ?");
		$competitionStmt->bind_param("i", $competitionId);
		$competitionStmt->execute();
		$competitionResult = $competitionStmt->get_result();
		$competitionRow = $competitionResult->fetch_assoc();



		$maxRoundQuery = "SELECT round, MAX(judge_by) AS max_judge_by FROM challenge WHERE competition_id = ? GROUP BY round ORDER BY round";
		$maxRoundStmt = $mysqli->prepare($maxRoundQuery);
		$maxRoundStmt->bind_param("i", $competitionId);
		$maxRoundStmt->execute();
		$maxRoundResult = $maxRoundStmt->get_result();
		
		// The result will be a set of rows with 'round' and 'max_judge_by' for each round
		$roundsData = [];
		while ($row = $maxRoundResult->fetch_assoc()) {
			$roundsData[$row['round']]['max_judge_by'] = $row['max_judge_by'];
		}
		
		// Now $roundsData contains the max judge_by dates for each round within the competition
		
        // Get all the team information in descending order by total_points
		//round 1 - all the teams within the NDC from the $data
		$teamsQueryR1 = "SELECT t.*, u.county, u.name as coach_name, u.last_name as coach_last_name FROM team t LEFT JOIN users u ON t.coach_id = u.id WHERE u.org_id = '$org_id' AND (t.round = 1 OR t.round = 2) ORDER BY t.total_points DESC, t.average_score DESC";
        $teamsResultR1 = $mysqli->query($teamsQueryR1);

		while ($team = $teamsResultR1->fetch_assoc()) {
            $roundsData['1']['teams'][] = $team;
        }

		//round 2 - all the teams within the state from the $data
        $teamsQueryR2 = "SELECT t.*, u.county, u.name as coach_name, u.last_name as coach_last_name FROM team t LEFT JOIN users u ON t.coach_id = u.id WHERE u.state = '$state' AND (t.round = 2 OR t.round = 3) ORDER BY t.total_points DESC, t.average_score DESC";
        $teamsResultR2 = $mysqli->query($teamsQueryR2);

		while ($team = $teamsResultR2->fetch_assoc()) {
            $roundsData['2']['teams'][] = $team;
        }
		
		//round 3 - all the teams from the different states
        $teamsQueryR3 = "SELECT t.*, u.county, u.name as coach_name, u.last_name as coach_last_name FROM team t LEFT JOIN users u ON t.coach_id = u.id WHERE u.state = '$state' AND (t.round = 3 OR t.round = 4) ORDER BY t.total_points DESC, t.average_score DESC";
        $teamsResultR3 = $mysqli->query($teamsQueryR3);

		while ($team = $teamsResultR3->fetch_assoc()) {
            $roundsData['3']['teams'][] = $team;
        }


        

        $array[] = [
            'competition' => $competitionRow,
            'roundsData' => $roundsData,

        ];
    

    echo json_encode( $array);
}

function rateCompLink($data){
	
	$linkId = $data["linkId"];
	$rating = $data["rating"];
	$userId = $data["userId"];
	$creativity = $data["creativity"];
	$artistic = $data["artistic"];
	$logic = $data["logic"];
	$problem_solved = $data["problem_solved"];
	global $con;
	$sql  = mysqli_query( $con,"INSERT INTO competition_ratings(comp_judge_id, comp_rating1, comp_link_id, comp_creativity, comp_artistic, comp_logic, comp_problem_solved)
			VALUES ('$userId','$rating','$linkId','$creativity','$artistic','$logic','$problem_solved'  )");
	if(! $sql )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		//mail($email,"Registration Confirmation","Thanks for registering  with us ");
		echo "Success";
	}
}


function rateLink($data){
	
	$linkId = $data["linkId"];
	$rating = $data["rating"];
	$userId = $data["userId"];
	$creativity = $data["creativity"];
	$artistic = $data["artistic"];
	$logic = $data["logic"];
	$problem_solved = $data["problem_solved"];
	global $cn;
	$mysqli = $cn;
	$insertOrUpdateQuery = "
    INSERT INTO video_rating (judge_id, rating, link_id, creativity, artistic, logic, problem_solved, date) 
    VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE()) 
    ON DUPLICATE KEY UPDATE 
        judge_id = VALUES(judge_id), 
        rating = VALUES(rating), 
        creativity = VALUES(creativity), 
        artistic = VALUES(artistic), 
        logic = VALUES(logic), 
        problem_solved = VALUES(problem_solved), 
        date = VALUES(date)";

	$stmt = $mysqli->prepare($insertOrUpdateQuery);

	// Bind parameters (assuming all are integers for this example)
	$stmt->bind_param("iiiiiii", $userId, $rating, $linkId, $creativity, $artistic, $logic, $problem_solved);

	// Execute the query
	$stmt->execute();

	if ($stmt->affected_rows > 0) {
		echo "Success";
	} else {
		echo "No changes were made";
	}

	// Close the statement
	$stmt->close();

}



?>