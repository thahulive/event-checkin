<?php
$connection = mysqli_connect('localhost','root','root','event-checkin');
if (!$connection) {
	die('Could not connect to MySQL: ' . mysqli_error());
} 

$id=$_REQUEST['id'];
$sql = "UPDATE aisyc_delig SET status='checkedin' WHERE slno=".$id;
$sql_result = mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
header('Location: search.php');
?>
