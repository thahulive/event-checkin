<?php
###########################################################
/*
GuestBook Script
Copyright (C) 2012 StivaSoft ltd. All rights Reserved.


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

For further information visit:
http://www.phpjabbers.com/
info@phpjabbers.com

Version:  1.0
Released: 2012-03-18
*/
###########################################################

error_reporting(0);
include("config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MySQL table search</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<style>
BODY, TD {
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
</head>


<body>
<h2> Confirmed Participant List</h2>
<form id="form1" name="form1" method="post" action="search.php">
<label for="name">Name</label>
<input name="name" type="text" id="name" size="15" value="<?php echo $_REQUEST['name']; ?>" />

<input type="submit" name="button" id="button" value="Find" />
  </label>
  <a href="search.php"> 
  reset</a>
</form>
<br /><br />
<table width="700" border="1" cellspacing="0" cellpadding="4">
  <tr>
    <td width="90" bgcolor="#CCCCCC"><strong>Name</strong></td>
    <td width="95" bgcolor="#CCCCCC"><strong>Email</strong></td>
    <td width="159" bgcolor="#CCCCCC"><strong>Mobile</strong></td>
    <td width="191" bgcolor="#CCCCCC"><strong>College</strong></td>
    <td width="113" bgcolor="#CCCCCC"><strong>Check In</strong></td>
  </tr>
<?php
if ($_REQUEST["name"]<>'') {
	$search_string = " AND name LIKE '%".$_REQUEST['name']."%'";	
$sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE slno>0 AND status='confirmed'" . $search_string;

}
else
{
	$sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE status='confirmed'";
}
$sql_result = mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
if (mysqli_num_rows($sql_result)>0) {
	while ($row = mysqli_fetch_assoc($sql_result)) {

?>
  <tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['contact']; ?></td>
    <td><?php echo $row['college']; ?></td>
    <td>
      <?php echo "<form action='checkin.php'><input type='hidden' name='id' value='".$row['slno']."'><input type='submit'value='Check In'></form>" ?>        
    </td>
  </tr>
<?php
	}
} else {
?>
<tr><td colspan="5">No results found.</td>
<?php	
}
?>
</table>

</body>
</html>