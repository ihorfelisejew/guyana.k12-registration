<?php

include ('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
$type = $_POST['type'];
$data = $_POST['data'];

if ($type == "getTeamMembers") {
    $intUserId = $_GET['userId'];
    getTeamMembers($intUserId);
}
if ($type == "saveTeam") {
    saveTeam($data);
}
if ($type == "saveCompVideo") {
    saveCompVideo($data);
}

if ($type == "loadplayercompetition") {
    loadplayercompetition($data);
}

if ($type == "getLessonCategories") {
    getLessonCategories();
}


if ($type == "loadCompTeam") {
    loadCompTeam($data);
}

if ($type == "loadCompPlayer") {
    loadCompPlayer($data);
}

if ($type == "getCompletedChallenges") {
    getCompletedChallenges($data);
}
if ($type == "chatusers") {
    chatusers($data);
}

if ($type == "loadquestion") {
    loadquestion($data);
}
if ($type == "loadquestionagain") {
    loadquestionagain($data);
}

if ($type == "answerQuestion") {
    answerQuestion($data);
}


if ($type == "loadRounds") {
    loadRounds();
}

if ($type == "changeChallangesNumber") {
    changeChallangesNumber($data);
}

if ($type == "changeStatus") {
    changeStatus($data);
}

if ($type == "loadTeams") {

    loadTeams($data);

}

if ($type == "loadPlayers") {

    loadPlayers($data);

}

if ($type == "lessionsList") {
    lessionsList($data);
}


if ($type == "loadTeammate") {

    loadTeammate($data);

}


if ($type == "loadUsers") {

    loadUsers();

}
if ($type == "addPlayer") {

    addPlayer($data);

}

if ($type == "loadChalleneges") {

    loadChalleneges();

}
if ($type == "loadChallengeText") {

    loadChallengeText();

}

if ($type == "addLink") {

    addLink($data);

}

if ($type == "loadLinks") {

    loadLinks($data);

}

if ($type == "getTeamRating") {

    getTeamRating($data);

}
if ($type == "getTeamRanking") {

    getTeamRanking($data);

}

if ($type == "getWinners") {

    getWinners($data);

}

if ($type == "getTodaysChallenge") {

    getTodaysChallenge($data);

}



if ($type == "showCaptain") {

    showCaptain($data);

}
if ($type == "loadTeamsC") {

    loadTeamsC($data);

}

if ($type == "SaveLessionsData") {
    SaveLessionsData($data);
}

if ($type == "PlayerBand") {
    PlayerBand($data);
}

if ($type == "totaldue") {
    TotalDue($data);
}

if ($type == "addLession") {
    addLession($data);
}

if ($type == "editLession") {
    editLession($data);
}

function addLession($data)
{
    global $con;
    $title = $data["title"];
    $pdf = $data["pdf"];
    $round = $data["round"];
    $category = $data["category"];


    $sql = mysqli_query($con, "INSERT INTO lessions (title, pdf, round, category)
			VALUES ('$title','$pdf', '$round', '$category')");
    if (!$sql) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {
        echo "Success";
    }
}

function editLession($data)
{
    global $con;
    $id = $data["id"];
    $title = $data["title"];
    $pdf = $data["pdf"];
    $round = $data["round"];
    $category = $data["category"];


    $sql = mysqli_query(
        $con,
        "UPDATE lessions SET title='$title', pdf='$pdf', round='$round', category='$category' 
        WHERE id = $id"
    );

    if (!$sql) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {
        echo "Success";
    }
}

function changeStatus($data)
{
    global $con;
    $id = $data["id"];
    $state = $data["state"];




    $sql = mysqli_query($con, " UPDATE  users SET status = '$state'  WHERE  id = '$id' ");
    if (!$sql) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {
        echo "Success";
    }
}

function changeChallangesNumber($data)
{
    global $con;
    $id = $data["id"];
    $number = $data["number"];

    $sql = mysqli_query($con, " UPDATE  rounds SET challenges = '$number'  WHERE  id = '$id' ");
    if (!$sql) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {
        echo "Success";
    }
}

function loadCompTeam($data)
{
    global $con;
    $array = array();
    $sql = "SELECT *,t.name as teamname FROM competition_link cl  INNER JOIN `team` t ON t.id = cl.comp_link_team_id";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);

}

function loadCompPlayer($data)
{
    global $con;
    $array = array();
    $sql = "SELECT *,u.name as firstname, u.last_name as lastname, t.name as teamname FROM competition_link cl  INNER JOIN `team` t ON t.id = cl.comp_link_team_id INNER JOIN users u on u.id = cl.comp_link_user_id";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);

}

function updateCustomer($data)
{
    global $con;
    $id = $data["id"];
    $firstname = $data["firstname"];
    $lastname = $data["lastname"];
    $phone = $data["phone"];
    $address = $data["address"];
    $rowStatus = 0;
    $phone2 = null;
    $distance = null;

    if (isset($data["phone_2"])) {
        $phone2 = $data["phone_2"];
    }
    if (isset($data["distance"])) {
        $distance = $data["distance"];
    }

    $sql = mysqli_query($con, " UPDATE  customer SET distance = '$distance' ,firstname = '$firstname' , lastname = '$lastname' ,phone = '$phone' ,address = '$address' , phone_2 ='$phone2' WHERE  id = '$id' ");
    if (!$sql) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {
        echo "Success";
    }
}



function customerQuery($data)
{
    global $con;
    $rowStatus = 0;
    $array = array();
    $sql = "SELECT id as id , concat(firstname, ' ', lastname) as label , concat(firstname, ' ', lastname) as value , phone , address  FROM customer where rowStatus = '$rowStatus'  AND  ( firstname LIKE '%$data%' OR phone LIKE '%$data%'  OR lastname LIKE '%$data%' )  ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}


function login($data)
{
    global $con;
    $email = $data["email"];
    $password = $data["password"];
    $check = 0;

    $array = array();
    $sql = "SELECT * FROM `users` where email = '$email' and password = '$password'   ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
            $check = 1;
        }

    }

    if ($check == 1) {
        echo json_encode($array);
    } else {
        echo $check = 0;
    }


}

function loadTeams($data)
{
    global $con;
    $coachId = $data["coachId"];
    $array = array();
    $sql = "SELECT * FROM `team` where coach_id = '$coachId'   ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function loadChalleneges()
{
    global $con;
    $sql = "SELECT * FROM `challenge`     ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function loadChallengeText()
{
    global $con;
    $sql = "SELECT * FROM `challenge_text`  WHERE DATE(deadline) >= CURDATE();    ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}





function loadPlayers($data)
{
    global $con;
    $teamId = $data["teamId"];
    $array = array();
    $sql = "SELECT u.* FROM `team_player` tp , `users` u   where u.id = tp.user_id   and tp.team_id = '$teamId'  ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function chatusers($data)
{
    global $con;
    $userid = $data["user_id"];
    $array = array();
    $sql = "SELECT * FROM team_player WHERE user_id = $userid";
    $retval = mysqli_query($con, $sql);
    $fetchteamaid = mysqli_fetch_assoc($retval);
    $teamaid = $fetchteamaid['team_id'];

    $sqlqury = "SELECT us.name,us.last_name,t.name as teamname,u.org_name as orgname, t.id as teamid FROM `users` us INNER JOIN `team_player` tm ON tm.user_id = us.id INNER JOIN `team` t ON t.id = tm.team_id INNER JOIN `users` u ON u.id = us.org_id WHERE tm.team_id = $teamaid";
    $sqlquryret = mysqli_query($con, $sqlqury);

    if (!$sqlquryret) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($sqlquryret)) {
            $array = $row;
        }

    }



    echo json_encode($array);
}

function loadTeammate($data)
{
    global $con;
    $userid = $data["userid"];
    $array = array();
    $sql = "SELECT * FROM `team_player` WHERE `user_id` = $userid";
    $retval = mysqli_query($con, $sql);
    $fetchteamaid = mysqli_fetch_assoc($retval);
    $teamaid = $fetchteamaid['team_id'];

    $sqlqury = "SELECT us.name,us.last_name,t.name as teamname,u.org_name FROM `users` us INNER JOIN `team_player` tm ON tm.user_id = us.id INNER JOIN `team` t ON t.id = tm.team_id INNER JOIN `users` u ON u.id = us.org_id WHERE tm.team_id = $teamaid";
    $sqlquryret = mysqli_query($con, $sqlqury);

    if (!$sqlquryret) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($sqlquryret)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function getLessonCategories()
{
    global $con;

    $array = array();
    $sql = "SELECT DISTINCT category FROM `lessions`";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }
    echo json_encode($array);
}

function loadCounties($data)
{
    global $con;
    $state = $data["state"];
    $array = array();
    $sql = "SELECT DISTINCT (`county`) FROM `county_state` where state_abv = '$state'  ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}


function saveTeam($data)
{
    global $con;
    $teamName = $data["teamName"];
    $coach_id = $data["coach_id"];




    $sql = mysqli_query($con, "INSERT INTO team (name,coach_id)
			VALUES ('$teamName','$coach_id'  )");
    if (!$sql) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {


        echo "Success";
    }
}

function addPlayer($data)
{
    global $con;
    $teamId = $data["teamId"];
    $user_id = $data["user_id"];




    $sql = mysqli_query($con, "INSERT INTO team_player (team_id,user_id)
			VALUES ('$teamId','$user_id'  )");
    if (!$sql) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {


        echo "Success";
    }
}

function deleteCustomer($data)
{
    global $con;
    $id = $data;
    $rowStatus = 1;
    $sql = mysqli_query($con, "DELETE FROM customer WHERE id = '$id'   ");

    if (!$sql) {
        echo 'ERROR ' . mysqli_error($con);

    } else {
        echo "Success";
    }
}

/*
function addLink($data){
 global $con;
    $teamId = $data["teamId"];
    $challenge_id = $data["challenge_id"];
    $videoTitle = $data["videoTitle"];
    $url = $data["url"];




    $sql  = mysqli_query( $con,"INSERT INTO links (url,title,team_id,challenge_id,posted_date)
            VALUES ('$url','$videoTitle','$teamId','$challenge_id',NOW()  )");
    if(! $sql )
    {
        die('Could not enter data: ' . mysqli_error($con));
    }else {


        echo "Success";
    }
}
*/
function loadplayercompetition($data)
{
    global $con;
    $userid = $data['userid'];
    $array = array();
    $sql = "SELECT cl.*,c.name FROM `competition_link` cl INNER JOIN `competition_challenge` c ON c.id = cl.m_comp_challenge_id where `comp_link_user_id` = '$userid'  ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function loadLinks($data)
{
    global $con;
    $userid = $data['userid'];
    $sql1 = "SELECT * FROM `team` where `captain_id` = '$userid'  ";
    $retval1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($retval1);

    $teamId = $row1["id"];

    $array = array();
    $sql = "SELECT l.*,c.name FROM `links` l INNER JOIN `challenge` c ON c.id = l.challenge_id where c.round = 1 AND `team_id` = '$teamId'  ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}


function loadquestion($data)
{
    global $con;
    $userid = $data['userId'];
    $teamId = $data['teamId'];

    $getsql = "SELECT * FROM `questions_score` WHERE `team_id` = '$teamId' AND `user_id` = '$userid'";
    $retvalques = mysqli_query($con, $getsql);
    if (!$retvalques) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($rowques = mysqli_fetch_assoc($retvalques)) {
            $question_id[] = $rowques['question_id'];
        }
        if (empty($question_id)) {
            $question_id = array('0');
        }
        $question_ids = implode(",", $question_id);
    }


    $sql = "SELECT * FROM `questions` WHERE id NOT IN ($question_ids) ORDER BY `questions`.`id` DESC";
    $retval = mysqli_query($con, $sql);
    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }
    echo json_encode($array);
}

function loadquestionagain($data)
{
    global $con;
    $userid = $data['userId'];
    $teamId = $data['teamId'];
    $piclick = $data['piclick'];

    $getsql = "SELECT * FROM `questions_score` WHERE `team_id` = '$teamId' AND `user_id` = '$userid'";
    $retvalques = mysqli_query($con, $getsql);
    if (!$retvalques) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($rowques = mysqli_fetch_assoc($retvalques)) {
            $question_id[] = $rowques['question_id'];
        }
        if (empty($question_id)) {
            $question_id = array('0');
        }
        $question_ids = implode(",", $question_id);
    }


    $sql = "SELECT * FROM `questions` WHERE id NOT IN ($question_ids) ORDER BY `questions`.`id` DESC LIMIT 600 OFFSET $piclick";
    $retval = mysqli_query($con, $sql);
    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {
        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }
    echo json_encode($array);
}



function answerQuestion($data)
{
    global $con;
    $userid = $data['userId'];
    $your_answer = $data['your_answer'];
    $questionid = $data['questionid'];
    $teamIdPI = $data['teamIdPI'];
    $sql = "SELECT count(*) as `total`, grade FROM `questions` WHERE `id` = '$questionid' AND `answer` = '$your_answer'";
    $retval = mysqli_query($con, $sql);
    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;

            $total = $row['total'];
            $grade = $row['grade'];
            if ($total > 0) {
                $sql1 = "INSERT INTO `questions_score`(`question_id`, `team_id`, `user_id`, `grade`) VALUES ('$questionid','$teamIdPI','$userid','$grade')";
                $retval1 = mysqli_query($con, $sql1);
            }
        }

    }
    echo json_encode($array);
}

function getTeamRating($data)
{
    global $con;
    $teamId = $data["teamId"];
    $array = array();
    $sql = "SELECT sum(vr.rating) as rating FROM video_rating vr , links l where l.id = vr.link_id AND  l.team_id = '$teamId'  ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function getTeamRanking($data)
{
    global $con;
    $teamIds = $data["teamIds"];
    $array = array();
    $sql = "SELECT sum(vr.rating) as rating , l.team_id , t.name FROM video_rating vr , links l , team t	 where t.id=l.team_id and  l.id = vr.link_id AND  l.team_id IN ($teamIds) GROUP by l.team_id  ";

    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function getWinners($data)
{
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
    $sql .= $groupBy;



    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function getTodaysChallenge()
{

    global $con;
    $array = array();
    $sql = " SELECT * FROM challenge WHERE DATE(endDate) = CURDATE()  ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function loadRounds()
{
    global $con;

    $array = array();
    $sql = " SELECT * FROM rounds   ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function getCompletedChallenges()
{
    global $con;
    $array = array();
    $sql = " SELECT  COUNT(c.id) AS counter , c.`round` FROM   challenge c  WHERE DATE(c.endDate) <= CURDATE() GROUP BY c.round   ";
    $retval = mysqli_query($con, $sql);

    if (!$retval) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($retval)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);

}

function saveCompVideo($data)
{
    global $con;
    $userid = $data['userid'];
    $sql = "select tp.team_id as teamid,t.coach_id as coachid  from team_player tp INNER JOIN team t on t.id = tp.team_id where tp.user_id = '$userid'";
    $retval1 = mysqli_query($con, $sql);
    $row1 = mysqli_fetch_assoc($retval1);

    $teamId = $row1["teamid"];

    $coachid = $row1["coachid"];
    $comp = $data["comp_id"];
    $comp_id = $data["challenge_id"];
    $videoTitle = $data["videoTitle"];
    $url = $data["url"];

    $sql2 = "SELECT Count(*) as tot FROM `competition_link` where `comp_link_user_id` = '$userid' AND `comp_link_comptition_id` = '$comp' and m_comp_challenge_id = '$comp_id'";
    $retval2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($retval2);

    $tot = $row2["tot"];


    if (!$retval2) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        //echo $tot;

        if ($tot == 0) {
            $sql = mysqli_query($con, "INSERT INTO competition_link (comp_link_url, comp_link_title, comp_link_coach_id, comp_link_comptition_id
			,m_comp_challenge_id, comp_link_user_id, comp_link_team_id, comp_posting_date)
				VALUES ('$url', '$videoTitle', '$coachid', '$comp', '$comp_id','$userid','$teamId',NOW()  )");
            if (!$sql) {
                die('Could not enter data: ' . mysqli_error($con));
            } else {


                echo "Success";
            }
        } else {
            echo 'Video Already Uploaded';
        }
    }
}

function addLink($data)
{

    global $con;
    $userid = $data['userid'];
    $sql1 = "SELECT * FROM `team` where `captain_id` = '$userid'  ";
    $retval1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($retval1);

    $teamId = $row1["id"];
    //$teamId = $data["teamId"];
    $challenge_id = $data["challenge_id"];
    $videoTitle = $data["videoTitle"];
    $url = $data["url"];

    $sql2 = "SELECT Count(*) as tot FROM `links` where `team_id` = '$teamId' AND `challenge_id` = '$challenge_id'";
    $retval2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($retval2);

    $tot = $row2["tot"];


    if (!$retval2) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        echo $tot;

        if ($tot == 0) {
            $sql = mysqli_query($con, "INSERT INTO links (url,title,team_id,challenge_id,posted_date)
				VALUES ('$url','$videoTitle','$teamId','$challenge_id',NOW()  )");
            if (!$sql) {
                die('Could not enter data: ' . mysqli_error($con));
            } else {


                echo "Success";
            }
        } else {
            echo 'Video Already Uploaded';
        }
    }
}


function showCaptain($data)
{
    global $con;
    $userid = $data['userid'];
    $teamid = $data['teamid'];
    $sql1 = "SELECT Count(*) as tot FROM `team` where `captain_id` = '$userid' and `id` = '$teamid'";
    $retval1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($retval1);

    $tot = $row1["tot"];

    if (!$retval1) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        echo $tot;

    }

}


function loadTeamsC()
{
    global $con;
    $sqlqury = "SELECT t.*,
    u.name as capname FROM `team` t INNER JOIN `users` u ON u.ID = t.captain_id";
    $sqlquryret = mysqli_query($con, $sqlqury);

    if (!$sqlquryret) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {

        while ($row = mysqli_fetch_assoc($sqlquryret)) {
            $array[] = $row;
        }

    }



    echo json_encode($array);
}

function getTeamMembers($intUserId)
{
    global $con;
    $sql = "SELECT * FROM `team_player` WHERE `user_id` =" . $intUserId;
    //    echo $sql;return;
    $retval = mysqli_query($con, $sql);
    $fetchteamaid = mysqli_fetch_assoc($retval);
    $teamaid = $fetchteamaid['team_id'];

    $strSql = "select u.id,u.name,u.last_name,t.name as team_name,u.grade from users u JOIN team_player tp ON (u.id = tp.user_id) JOIN team t ON (t.id = tp.team_id) where tp.team_id = $teamaid and u.role_id = 2";
    $row = mysqli_query($con, $strSql);

    $results = array();
    while ($res = mysqli_fetch_assoc($row)) {
        $results[] = $res;
    }
    echo json_encode($results);
}
function utf8ize($d)
{
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string($d)) {
        return utf8_encode($d);
    }
    return $d;
}
function lessionsList($data)
{
    global $con;

    $userid = $data['userid'];
    $round = $data['round'];
    $category = $data['category'];
    if ($category != '') {
        $sql = "SELECT * FROM `lessions` WHERE `round` = '$round' AND `category` = '$category'";
    } else {
        $sql = "SELECT * FROM `lessions` WHERE `round` = '$round'";
    }

    $sqlcnt = "SELECT count(*) as cnt FROM `lessions` WHERE `round` = '$round'";
    $cntquery = mysqli_query($con, $sqlcnt);
    $cnt = mysqli_fetch_assoc($cntquery);
    //    echo $sql;return;
    $retval = mysqli_query($con, $sql);
    //$fetchteamaid = mysqli_fetch_assoc($retval);
    $results = array();
    while ($res = mysqli_fetch_assoc($retval)) {
        $lession_id = $res['id'];
        $sql2 = "SELECT count(*) as total FROM lessions_data as ld WHERE ld.user_id = '$userid' AND ld.`lession_id` = '$lession_id'";
        $retval2 = mysqli_query($con, $sql2);
        $res2 = mysqli_fetch_assoc($retval2);
        $total = $res2['total'];
        if ($total > 0) {
            $res['statusd'] = "Passed";
        } else {
            $res['statusd'] = "Incomplete";
        }
        $res = utf8ize($res);
        array_push($results, $res);
    }
    echo json_encode($results);
    die;
}


function SaveLessionsData($data)
{
    global $con;
    $less_is = $data["less_is"];
    $userid = $data["userid"];


    $abcddata = "INSERT INTO `lessions_data`(`user_id`, `lession_id`, `status`, `date`) VALUES ('$userid','$less_is','1', '" . date('Y-m-d') . "')";

    $sql = mysqli_query($con, $abcddata);
    if (!$sql) {
        die('Could not enter data: ' . mysqli_error($con));
    } else {


        echo "Success";
    }

}

function PlayerBand($data)
{
    global $con;
    $userid = $data["userId"];
    $sql2 = "SELECT count(*) as total FROM lessions_data as ld WHERE ld.user_id = '$userid'";
    $retval2 = mysqli_query($con, $sql2);
    $res2 = mysqli_fetch_assoc($retval2);
    $total = $res2['total'];
    if ($total == '6') {
        echo 'Yellow';
    } elseif ($total == '12') {
        echo 'Green';
    } elseif ($total == '18') {
        echo 'Red';
    } else {
        echo 'No Band Yet';
    }
}

function TotalDue($data)
{
    global $con;
    $userid = $data["userId"];
    $sql2 = "SELECT * FROM payment WHERE user_id = '$userid'";
    $result = mysqli_query($con, $sql2);
    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }
    echo json_encode($array);
}
?>