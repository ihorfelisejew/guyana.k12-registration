<?php

include('db.php');
// error_reporting(0);
// ini_set('display_errors', 0);

/*
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; // upload directory
if(!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image'])
{
$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = rand(1000,1000000).$img;
// check's valid format
if(in_array($ext, $valid_extensions)) 
{ 
$path = $path.strtolower($final_image); 
if(move_uploaded_file($tmp,$path)) 
{

$lession_name = $_POST['lession_name'];
$uploadImage_text = $_POST['uploadImage_text'];

$fsdfdfsdfs = "INSERT INTO `lessions`(`title`, `pdf`) VALUES ('$lession_name','$uploadImage_text')";
$retval  = mysqli_query( $con,$fsdfdfsdfs);
if(! $retval )
{
	die('Could not enter data: ' . mysqli_error($con));
	echo 'Error';
}else {
	echo 'Pdf Saved';
}

}
} 
else 
{
echo 'invalid';
}
}
*/


$lession_name = $_POST['lession_name'];
$uploadImage_text = $_POST['uploadImage_text'];
$lession_round = $_POST['lession_round'];

$fsdfdfsdfs = "INSERT INTO `lessions`(`title`, `pdf`, `round`) VALUES ('$lession_name','$uploadImage_text', '$lession_round')";
$retval  = mysqli_query( $con,$fsdfdfsdfs);
if(! $retval )
{
	die('Could not enter data: ' . mysqli_error($con));
	echo 'Error';
}else {
	echo 'Pdf Saved';
}

?>