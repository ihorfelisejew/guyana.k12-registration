<?php
$conn = mysql_connect("localhost", 'k12youthcode', 'aries123');
$db = mysql_select_db("chat", $conn);


			$qur = mysqli_query( $con,"select * from chat_msg where `team_id`='2' && from_id='2'");
			while($rw = mysqli_fetch_array($qur)){
				$json[] = $rw;
			}
			
			header('Content-type: application/json');
            echo json_encode($json);
?>