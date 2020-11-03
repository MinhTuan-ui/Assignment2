<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery.mobile-1.4.5.min.css" />
  	<script src="jquery-1.11.1.min.js"></script>
  	<script src="jquery.mobile-1.4.5.min.js"></script>

  </head>
  <body>
      <div data-role="page" id="User">
        <div data-role="header">
          <div data-role="navbar">
            <ul>
              <li><a href="#home">Home</a></li>
              <li><a href="#" >About</a></li>
              <li><a href="#" >Contract</a></li>
              <li><a href="logout.php" data-ajax="false">logout</a></li>
              <li><a href="#"><?php echo $_SESSION['email']?></a></li>
            </ul>
          </div>
          <h1>ATN System</h1>
        </div>
        <div data-role="main" class="ui-content">
          <a href="Product.php" class="ui-btn" data-ajax="false">Product List</a>
          <a href="#" class="ui-btn" data-ajax="false">My Order List</a>
          <a href="#" class="ui-btn" data-ajax="false">My Information Account</a>
        </div>
        <div data-role="footer" data-position="fixed">
          <h1>Footer</h1>
        </div>
  	</div><!-- /page -->
  </body>
</html>
