<?php
error_reporting(0);
include("config.php");
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>IEDC Summit 2017 - Registration</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap4.min.css">
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
          <h3>Confirmed Participant List</h3>
          <br><br>
      </div>
    </div>

    <div class="row" id="second-container">
      <div class="col">
        <a href="index.html" class="btn btn-light btn-block">Home</a>
      </div>
      <div class="col">
        <a href="checkedlist.php" class="btn btn-light btn-block">Checked In List</a>
      </div>
      <div class="col">
        <a href="register.php" class="btn btn-light btn-block">New Registration</a>
      </div>
    </div>
    <hr>
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>College</th>
                <th>Email</th>
                <th>Score</th>
                <th>Add Score</th>
            </tr>
        </thead>
        <tbody>

          <?php
            if ($_REQUEST["name"]<>'') {
              $search_string = " AND name LIKE '%".$_REQUEST['name']."%'";
            $sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE slno>0 AND status='checkedin'" . $search_string;
            }

            elseif ($_REQUEST["college"]<>'') {
              $search_string = " AND college LIKE '%".$_REQUEST['college']."%'";
              $sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE slno>0 AND status='checkedin'" . $search_string;
            }

            else
            {
              $sql = "SELECT * FROM " . $SETTINGS['data_table'] . " WHERE status='checkedin'";
            }

            $sql_result = mysqli_query($connection,$sql) or die ('request "Could not execute SQL query" '.$sql);
            if (mysqli_num_rows($sql_result)>0) {
              while ($row = mysqli_fetch_assoc($sql_result)) {

            ?>
              <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['college']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['score']; ?></td>
                <td>
                  <?php echo "<form method='get' action='activity-score.php'><input type='hidden' name='id' value='".$row['slno']."'><input class='form-control' style='display:inline-block;width:100px;' type='text' name='score' value='' required><input class='btn btn-info' style='display:inline-block' type='submit'value='Add'></form>" ?>
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

        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>College</th>
                <th>Email</th>
                <th>Score</th>
                <th>Add Score</th>
            </tr>
        </tfoot>
    </table>

  </div>

<!-- Script starts -->
<!-- <script src="js/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
        initComplete: function () {
            this.api().columns([1]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>
<!-- Script ends -->

</body>
</html>
