<?php
// Connection
include('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$json = '';
if(isset($_GET['rq'])):
	switch($_GET['rq']):
		case 'new':
			$msg = $_POST['msg'];
			$team_id = $_POST['tid'];
			$user_id = $_POST['uid'];
			if(empty($msg)){
				//$json = array('status' => 0, 'msg'=> 'Enter your message!.');
			}else{
				$qur = mysqli_query( $con,'insert into chat_msg set `team_id`="'.$team_id.'", `from_id`="'.$user_id.'", `msg`="'.$msg.'", `status`="1"');
				if($qur){
					$qurGet = mysqli_query( $con,"SELECT c.*, t.name teamname, u.name fname, u.last_name lname FROM chat_msg c INNER JOIN team t ON t.id = c.team_id INNER JOIN users u ON u.id = c.from_id where c.id='".mysqli_insert_id($con)."'");
					while($row = mysqli_fetch_array($qurGet)){
						$json = array('status' => 1, 'teamname' => $row['teamname'], 'fname' => $row['fname'], 'lname' => $row['lname'], 'msg' => $row['msg'], 'lid' => mysqli_insert_id($con), 'time' => $row['time']);
					}
				}else{
					$json = array('status' => 0, 'msg'=> 'Unable to process request.');
				}
			}
		break;
		case 'msg':
			$myid = $_POST['mid'];
			$team_id = $_POST['tid'];
			$user_id = $_POST['uid'];
			if(empty($myid)){

			}else{
				//print_r($_POST);
				$qur = mysqli_query( $con,"select * from chat_msg where `team_id`='$team_id' && `status`=1");
				if(mysqli_num_rows($qur) > 0){
					$json = array('status' => 1);
				}else{
					$json = array('status' => 0);
				}
			}
		break;
		case 'NewMsg':
			$myid = $_POST['msg'];
			$team_id = $_POST['tid'];
            $user_id = $_POST['uid'];
			$qur = mysqli_query( $con,"select * from chat_msg where `team_id`='$team_id' && from_id='$user_id', `status`=1 order by id desc limit 1");
			while($rw = mysqli_fetch_array($qur)){
				$json = array('status' => 1, 'msg' => '<div>'.$rw['msg'].'</div>', 'lid' => $rw['id'], 'time'=> $rw['time']);
			}
			// update status
			$up = mysqli_query( $con,"UPDATE `chat_msg` SET  `status` = '0' WHERE `team_id`='$team_id' ");
		break;
	endswitch;
endif;

@mysqli_close($conn);
header('Content-type: application/json');
echo json_encode($json);
?>