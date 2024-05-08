<?php

require 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);


$type = $_POST['type'];
$data = $_POST['data'];
if($type == "loadCompetitions")
{
    loadCompetitions();
}

if($type == "saveEditChanges")
{
    saveEditChanges($data);
}

if($type == "deleteChallenge")
{
    deleteChallenge($data);
}

if($type == "addNewChallenge")
{
    addNewChallenge($data);
}


function loadCompetitions(){
    global $cn;
    $result = [];
	if($stmt = $cn->prepare("SELECT * FROM `competition_details`")){
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()){
            $result[] = [ 
                'id' => $row['id'],
                'name' => $row['competition_name'],
                'startDate' => $row['start_date'],
                'endDate' => $row['end_date'],
                'type' => $row['competition_type'],
                'challengesOrMatches' => loadChallengesOrMatches($row['competition_type'], $row['id'])
            ];
        }

        $stmt->close();
    }
    
    
	echo json_encode($result);
}


function loadChallengesOrMatches($type, $id){
    global $cn;
    $challenges = [];
    $sorted = [];
    if ($type == 'Submission'){
        
        if($stmt = $cn->prepare("SELECT ch.* FROM `challenge` as ch INNER JOIN `competition_details` as comp on ch.competition_id = comp.id WHERE ch.competition_id = $id")){
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_assoc()){

                    $round = intval($row['round']);
                
                    // If there's not already an array for this round, create one
                    if (!isset($sorted[$round])) {
                        $sorted[$round] = [];
                    }
                
                    // Append the item to the array for its round
                    $sorted[$round][] = $row;
                
            }

            

            $stmt->close();
        }
    } else if ($type == 'Match'){
        if($stmt = $cn->prepare("SELECT m.* FROM `match_details` as m INNER JOIN `competition_details` as comp on m.competition_id = comp.id WHERE m.competition_id = $id")){
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_assoc()){

                    $round = intval($row['round']);
                
                    // If there's not already an array for this round, create one
                    if (!isset($sorted[$round])) {
                        $sorted[$round] = [];
                    }
                
                    // Append the item to the array for its round
                    $sorted[$round][] = $row;
                
            }

            

            $stmt->close();
        }
    }
    

    return $sorted;
}


function saveEditChanges($data){
    global $cn;
    if($stmt = $cn->prepare("UPDATE `challenge` SET `name` = ?, `text` = ?, `startDate` = ?, `endDate` = ?, `Tutorial_url` = ?, `Learning_obj` = ?, `intro_video` = ?, `judge_by` = ? WHERE id = ?")){
        $stmt->bind_param("ssssssssi", $data['name'], $data['text'], $data['startDate'], $data['endDate'], $data['Tutorial_url'], $data['Learning_obj'], $data['intro_video'], $data['judge_by'], $data['id']);
        $stmt->execute();

        $stmt->close();
    }

}

function deleteChallenge($data){
    global $cn;
    if($stmt = $cn->prepare("DELETE FROM `challenge` WHERE id = ?")){
        $stmt->bind_param("i", $data['id']);
        $stmt->execute();

        $stmt->close();
    }

}

function addNewChallenge($data){
    global $cn;
    $text = $startDate = $endDate = $tutorialLink = $Learning_obj = $intro_video= '';
    $name = 'New challenge';
    if($stmt = $cn->prepare("INSERT INTO `challenge` (`name`, `text`, `startDate`, `endDate`, `Tutorial_url`, `Learning_obj`, `intro_video`, `competition_id`, `round`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")){
        $stmt->bind_param("sssssssii", $name, $text, $startDate, $endDate, $tutorialLink , $Learning_obj, $intro_video, $data['id'], $data['round']);

        if($stmt->execute()){
            $stmt->close();
            echo 'Success';
        } else{
            echo 'Error ' . $cn->error;
        }
        
       
    } 
    
}