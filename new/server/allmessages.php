<?php
include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

  $team_id = $_POST['tid'];

			$qur = mysqli_query( $con,"select c.*, t.name teamname, u.name fname, u.last_name lname from chat_msg c INNER JOIN users u ON u.id = c.from_id INNER JOIN team t ON t.id = c.team_id where c.team_id ='$team_id'");
			while($rw = mysqli_fetch_array($qur)){
				$json[] = $rw;
			}
			
			header('Content-type: application/json');
            echo json_encode($json);
?>