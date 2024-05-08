<?php

$conn = mysql_connect("localhost", 'root', '');
$db = mysql_select_db("mychat", $conn);
$json = '';


$query="select * from online_users where team_id = 2";
$rs= mysqli_query( $con,$query);

while($row=mysqli_fetch_array($rs,MYSQL_ASSOC)){
 $json[] = $row;	
}

header('Content-type: application/json');
echo json_encode($json);
?>