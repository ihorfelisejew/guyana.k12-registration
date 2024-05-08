<?php
// Connection
$conn = mysql_connect("localhost", 'k12youthcode', 'aries123');
$db = mysql_select_db("chat", $conn);
$json = '';
if(isset($_GET['rq'])):
	switch($_GET['rq']):
		case 'new':
			$msg = $_POST['msg'];
			$myid = 2;
			$fid = 2;
			if(empty($msg)){
				//$json = array('status' => 0, 'msg'=> 'Enter your message!.');
			}else{
				$qur = mysqli_query( $con,'insert into chat_msg set `team_id`="'.$fid.'", `from_id`="'.$myid.'", `msg`="'.$msg.'", `status`="1"');
				if($qur){
					$qurGet = mysqli_query( $con,"select * from chat_msg where id='".mysqli_insert_id($con)."'");
					while($row = mysqli_fetch_array($qurGet)){
						$json = array('status' => 1, 'msg' => $row['msg'], 'lid' => mysqli_insert_id($con), 'time' => $row['time']);
					}
				}else{
					$json = array('status' => 0, 'msg'=> 'Unable to process request.');
				}
			}
		break;
		case 'msg':
			$myid = $_POST['mid'];
			$fid = 2;
			$lid = 2;
			if(empty($myid)){

			}else{
				//print_r($_POST);
				$qur = mysqli_query( $con,"select * from chat_msg where `team_id`='$fid' && `status`=1");
				if(mysqli_num_rows($qur) > 0){
					$json = array('status' => 1);
				}else{
					$json = array('status' => 0);
				}
			}
		break;
		case 'NewMsg':
			$myid = 2;
			$fid = $_POST['fid'];

			$qur = mysqli_query( $con,"select * from chat_msg where `team_id`='$myid' && from_id='$myid', `status`=1 order by id desc limit 1");
			while($rw = mysqli_fetch_array($qur)){
				$json = array('status' => 1, 'msg' => '<div>'.$rw['msg'].'</div>', 'lid' => $rw['id'], 'time'=> $rw['time']);
			}
			// update status
			$up = mysqli_query( $con,"UPDATE `chat_msg` SET  `status` = '0' WHERE `team_id`='$myid' ");
		break;
	endswitch;
endif;

@mysql_close($conn);
header('Content-type: application/json');
echo json_encode($json);
?>