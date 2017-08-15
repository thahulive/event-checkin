<h2>Register New Participant</h2>
<a href="search.php">Check In</a>
<br>
<a href="checkedlist.php">Checked In List</a>
<br>
<a href="index.html">Home</a>
<br><br>

<form action="register.php" method="post">
	<label for="name">Name</label>
	<input type="text" name="name">
	<br><br>
	<label for="mobile">Mobile</label>
	<input type="text" name="contact">
	<br><br>
	<label for="email">Email</label>
	<input type="email" name="email">
	<br><br>
	<label for="college">College</label>
	<select name="college">
		<option>Kolkata</option>
		<option>Bangalore</option>
		<option>Pune</option>
		<option>Other</option>
	</select>
	<br><br>
	<label for="status">Check In</label>
	<input type="checkbox" name="status" checked="true">
	<br><br>
	<input type="submit" name="submit">
</form>

<?php
error_reporting(0);
include("config.php");
if (isset($_POST["submit"])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$college = $_POST['college'];
	$status = ($_POST['status'] == 'on') ? "checkedin" : "confirmed";
	$sql = "INSERT INTO ". $SETTINGS['data_table'] ." (`name`, `email`, `contact`, `college`, `status`) VALUES ('".$name."', '".$email."', '".$contact."', '".$college."', '".$status."')";
	mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
}
?>