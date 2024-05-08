<?php


$con = mysql_connect("localhost","registration","aries123");
if (!$con)
{
	die('Could not connect: ' . mysqli_error($con));
}
mysql_select_db("inclass_league",$con);

 

 



?>

