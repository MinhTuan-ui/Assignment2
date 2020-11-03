<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Registasion Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery.mobile-1.4.5.min.css" />
  	<script src="jquery-1.11.1.min.js"></script>
  	<script src="jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 80%;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

  </head>
  <body>
      <div data-role="page" id="User">
        <div data-role="header">
          <div data-role="navbar">
            <ul>
              <li><a href="#home">Home</a></li>
              <li><a href="#" >About</a></li>
              <li><a href="#" >Contract</a></li>
              <li><a href="logout.php" data-ajax="false">Logout</a></li>
            </ul>
          </div>
          <h1>ATN System</h1>
        </div>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                      <h1>Product List</h1>
          <?php
          // Include config file
          require_once "config.php";

          // Attempt select query execution
          $sql = "SELECT * FROM product";
          if($result = pg_query($link, $sql)){
              if(pg_num_rows($result) > 0){
                  echo "<table class='table table-bordered table-striped'>";
                      echo "<thead>";
                          echo "<tr>";
                              echo "<th>ID</th>";
                              echo "<th>Image</th>";
                              echo "<th>Name</th>";
                              echo "<th>Description</th>";
                              echo "<th>Price ($)</th>";
                              echo "<th>Category ID</th>";
                              echo "<th>Supplier ID</th>";
                              echo "<th>Action</th>";
                          echo "</tr>";
                      echo "</thead>";
                      echo "<tbody>";
                      while($row = pg_fetch_array($result)){
                          echo "<tr>";
                              echo "<td>" . $row['productid'] . "</td>";
                              echo "<td> <img src='". $row['image']."' style='width:100px;height:100px;'> </td>";
                              echo "<td>" . $row['name'] . "</td>";
                              echo "<td>" . $row['description'] . "</td>";
                              echo "<td>" . $row['price'] . "</td>";
                              echo "<td>" . $row['categoryid'] . "</td>";
                              echo "<td>" . $row['supplierid'] . "</td>";
                              echo "<td>";
                                  echo "<a href='View.php?id=". $row['productid'] ."'  data-toggle='tooltip'>View</a>";
                                  echo "<a href='order.php?id=". $row['productid'] ."' data-toggle='tooltip'>Order</a>";
                              echo "</td>";
                          echo "</tr>";
                      }
                      echo "</tbody>";
                  echo "</table>";
                  // Free result set
                  pg_free_result($result);
              } else{
                  echo "<p class='lead'><em>No records were found.</em></p>";
              }
          } else{
              echo "ERROR: Could not able to execute $sql. " . pg_last_error($link);
          }

          // Close connection
          pg_close($link);
          ?>
        </div>
    </div>
</div>
</div>
        <div data-role="footer" data-position="fixed">
          <h1>Footer</h1>
        </div>
  	</div><!-- /page -->
  </body>
</html>
