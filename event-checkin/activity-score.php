<?php
$connection = mysqli_connect('localhost','root','root','event-checkin');
if (!$connection) {
	die('Could not connect to MySQL: ' . mysqli_error());
}
$id = (isset($_GET['id']))?$_GET['id']:'';
$score = (isset($_GET['score']))?$_GET['score']:'';

$sql = "UPDATE aisyc_delig SET score=score+".$score." WHERE slno=".$id;
$sql_result = mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
header('Location: activity-hub.php');
?>
