<?php
error_reporting(0);
include("config.php");
if (isset($_POST["submit"])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$college = (!empty($_POST['college_new'])) ? $_POST['college_new']:$_POST['college'];
	$status = ($_POST['status'] == 'on') ? "checkedin" : "confirmed";
	$sql = "INSERT INTO ". $SETTINGS['data_table'] ." (`name`, `email`, `contact`, `college`, `status`) VALUES ('".$name."', '".$email."', '".$contact."', '".$college."', '".$status."')";
	mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
}
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>IEDC Summit 2017 - Registration</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <style>
    BODY, TD {
      font-family:Arial, Helvetica, sans-serif;
      font-size:12px;
    }
  </style>
</head>
<body>

  <div class="container">

    <div class="row" id="first-container-normal">
      <div class="col">
          <br><br><br>
          <h3>Register New Participant</h3>
          <br><br>
      </div>
    </div>

    <div class="row" id="second-container">
      <div class="col">
        <a href="index.html" class="btn btn-light btn-block">Home</a>
      </div>
      <div class="col">
        <a href="search.php" class="btn btn-light btn-block">Check In</a>
      </div>
      <div class="col">
        <a href="checkedlist.php" class="btn btn-light btn-block">Checked In Lis</a>
      </div>
    </div>
    <hr>

    <form action="register.php" method="post">
	    <div class="form-group row">
	      <label for="name" class="col-sm-2 col-form-label">Name</label>
	      <div class="col-sm-10">
	        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
	      </div>
	    </div>
	    <div class="form-group row">
	      <label for="email" class="col-sm-2 col-form-label">Email</label>
	      <div class="col-sm-10">
	        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
	      </div>
	    </div>
	    <div class="form-group row">
	      <label for="contact" class="col-sm-2 col-form-label">Contact</label>
	      <div class="col-sm-10">
	        <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact">
	      </div>
	    </div>
	    <div class="form-group row">
	      <label for="college" class="col-sm-2 col-form-label">College</label>
	      <div class="col-sm-10">
	      	<select name="college" class="form-control" id="college">
						<?php
							$sql = "SELECT DISTINCT college FROM aisyc_delig order By college";
							$sql_result = mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
							if (mysqli_num_rows($sql_result)>0) {
								while ($row = mysqli_fetch_assoc($sql_result)) {
									echo "<option>".$row['college']."</option>";
								}
							}
							?>
	      	</select>
	      </div>
	    </div>
			<div class="form-group row">
	      <label for="contact" class="col-sm-2 col-form-label"></label>
	      <div class="col-sm-10">
	        <input type="text" class="form-control" id="contact" name="college_new" placeholder="Contact">
	      </div>
	    </div>
	    <div class="form-group row">
	      <div class="col-sm-2">Check In</div>
	      <div class="col-sm-10">
	        <div class="form-check">
	          <label class="form-check-label">
	            <input class="form-check-input" name="status" checked="true" type="checkbox"> Check In
	          </label>
	        </div>
	      </div>
	    </div>
	    <div class="form-group row">
	      <div class="col-sm-10">
	        <button type="submit" name="submit" class="btn btn-primary">Register</button>
	      </div>
	    </div>
  </form>



  </div>

<!-- Script starts -->
<!-- <script src="js/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Script ends -->

</body>
</html>
