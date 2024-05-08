<?php
// $row=mysqli_fetch_array($result,MYSQLI_NUM);
function connect(){
    //$conn = mysqli_connect("localhost","root","","guyana");
	$conn =  mysqli_connect("localhost","guyana","!Iluvlithonia123","guyana");
	
// Check connection
    if (mysqli_connect_error())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    return $conn;
}


if(isset($_GET['action'])){
    if($_GET['action'] == 'getHistoryChat'){
        if($_GET['player'] == 1){
            $conn 		= connect();
            $coach_id 	= $_GET['coach_id'];
            $strSql 	= "select chat_msg.msg,chat_msg.from_id,u.name,u.last_name,t.name as team_name,u.role_id,u.picUrl from chat_msg JOIN team t ON (chat_msg.coach_id = t.coach_id) JOIN team_player tp ON (tp.team_id = t.id AND tp.user_id = $coach_id) JOIN users u ON (u.id = chat_msg.from_id)";
            $myArray1 	= array();
            $result 	= mysqli_query($conn,$strSql);
            $i = 0;
            while($row = mysqli_fetch_assoc($result)) {
				$from_id = $row['from_id'];
				$strSql312 	= "SELECT t.name as team_name  FROM `team_player` as tp INNER JOIN `team` as t ON t.id = tp.team_id WHERE `user_id` = $from_id";
				$result234 	= mysqli_query($conn,$strSql312);
				$row2123=mysqli_fetch_assoc($result234);
				
                $myArray1[$i]['from_id'] = $row['from_id'];
                $myArray1[$i]['msg']     = $row['msg'];
                $myArray1[$i]['pic']     = 'server/uploads/' . $row['picUrl'];

                if($row['picUrl'] == '' || $myArray1[$i]['pic'] == null){
                    $myArray1[$i]['pic'] = 'http://www.ewaybetterenglish.com/pub/images/user.png';
                }

                if($row['role_id'] == '1'){
                    $myArray1[$i]['name'] = 'Coach_'.substr($row['name'],0,1).'_'.$row['last_name'];
                }else{
                    $myArray1[$i]['name'] = $row2123['team_name'].'_'.substr($row['name'],0,1).'_'.$row['last_name'];
                }
			
                $i++;
            echo json_encode('kkkk');
				 
            }
        }else{
            $conn 		= connect();
            $coach_id 	= $_GET['coach_id'];
            $strSql 	= "select cm.from_id,cm.msg,u.name,u.last_name,u.role_id,u.picUrl from chat_msg cm JOIN users u ON (u.id = cm.from_id) where cm.coach_id IN (select t.coach_id from team t JOIN team_player tp ON (t.id = tp.team_id) JOIN users u ON (u.id = tp.user_id) where cm.coach_id = $coach_id)";
            //$strSql     = "select cm.from_id,cm.msg,u.name,u.last_name,u.role_id,u.picUrl from chat_msg cm JOIN users u ON u.id = cm.from_id where cm.coach_id = $coach_id";
            $myArray 	= array();
            $result 	= mysqli_query($conn,$strSql);
            $i = 0;
            while($row = mysqli_fetch_assoc($result)) {

                $myArray[$i]['from_id'] = $row['from_id'];
                $myArray[$i]['msg']     = $row['msg'];
                $myArray[$i]['pic']     = 'server/uploads/' . $row['picUrl'];

                if($row['picUrl'] == '' || $myArray[$i]['pic'] == null){
                    $myArray[$i]['pic'] = 'http://www.ewaybetterenglish.com/pub/images/user.png';
                }

                if ($row['role_id'] == '1') {
                    $myArray[$i]['name'] = 'Coach_' . substr($row['name'],0,1) . '_' . $row['last_name'];
                } else {
                    $strSql = "select t.name from team t JOIN team_player tp ON (tp.team_id = t.id) JOIN users u ON (u.id = tp.user_id) where u.id = " . $row['from_id'];
                    $result1 = mysqli_query($conn, $strSql);
                    $row1 = mysqli_fetch_assoc($result1);
                    $myArray[$i]['name'] = $row1['name'] . '_' . substr($row['name'],0,1) . '_' . $row['last_name'];
                }
                $i++;
				
            }
            echo json_encode($myArray);
        }

    }

    if($_GET['action'] == 'sendMessage'){
        $conn 		= connect();
        $coach_id 	= $_GET['coach_id'];
        $from_id 	= $_GET['from_id'];
        $msg 		= $_GET['msg'];
        if(isset($_GET['player']) && $_GET['player'] == '1'){
            $strSql = "select t.coach_id from team t JOIN team_player tp ON (tp.team_id = t.id) where tp.user_id = $coach_id";
            $result = mysqli_query($conn,$strSql);
            $row = mysqli_fetch_array($result);
            $main_coach_id =$row['coach_id'];
            //echo $main_coach_id;
            $strSql 	= "insert into chat_msg(coach_id,from_id,msg,status,time) values('$main_coach_id','$from_id','$msg','','".date('Y-m-d')."')";
            mysqli_query($conn,$strSql) or die(mysqli_error($conn));
        }else{
            $strSql 	= "insert into chat_msg(coach_id,from_id,msg) values('$coach_id','$from_id','$msg')";
            mysqli_query($conn,$strSql) or die(mysqli_error($conn));
        }

    }

}