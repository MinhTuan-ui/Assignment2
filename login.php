<?php
session_start();
$message="";
require_once"config.php";

$user = $passw = "";
$user_err = $passw_err =  "";

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Validate UserName
        $input_user = trim($_POST["user"]);
        if(empty($input_user)){
            $user_err = "Please enter your Username.";
        } else{
            $user = $input_user;
        }
        // Validate Password
        $input_passw = trim($_POST["passw"]);
        if(empty($input_passw)){
            $passw_err = "Please enter your password.";
        } else{
            $passw = $input_passw;
        }
        if (empty($user_err) && empty($passw_err)) {

        $sql = "SELECT * FROM agency WHERE username = '".$user."' AND pass = '".$passw."'";

      $result = pg_query($link, $sql) or die('Query failed: ' . pg_last_error());

      if(pg_num_rows($result) == 1){
        /* Fetch result row as an associative array. Since the result set
        contains only one row, we don't need to use while loop */
        $row = pg_fetch_array($result, 0, PGSQL_NUM);

        // Retrieve individual field value
        $_SESSION['name'] = $row[1];
        $_SESSION['email'] = $row[2];
        $_SESSION['user'] = $row[3];
        $_SESSION['pass'] = $row[4];
        $_SESSION['address'] = $row[5];
        $_SESSION['tel'] = $row[6];
      } else{
        // URL doesn't contain valid id parameter. Redirect to error page
        header("location: error-index.php");
        exit();
      }
              header("Location:login-user.php");
    }
    pg_close($link);
    
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="jquery.mobile-1.4.5.min.css" />
  	<script src="jquery-1.11.1.min.js"></script>
  	<script src="jquery.mobile-1.4.5.min.js"></script>
  </head>
  <body>
    <div data-role="page" id="login">
      <div data-role="header">
        <h1>Login</h1>
      </div><!-- /header -->

      <div data-role="main" class="ui-content">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($user_err)) ? 'has-error' : ''; ?>">
          <label>Username:</label>
          <input type="text" name="user" value=""<?php echo $user; ?>"" >
          <span class="help-block"><?php echo $user_err;?></span>
        </div>

        <div class="form-group <?php echo (!empty($passw_err)) ? 'has-error' : ''; ?>">
          <label>Password:</label>
          <input type="password" name="passw"  value=""<?php echo $passw; ?>"" placeholder="Password">
          <span class="help-block"><?php echo $passw_err;?></span>
        </div>
        <input type="submit" name="login" class="btn btn-primary" value="Login">
        <a href="register.php" data-ajax="false" class="ui-btn">Register</a>
          <a href="index.php" data-ajax="false" class="ui-btn ui-btn-b">Cancel</a>
        
        </form>
      </div><!-- /content -->
      <div data-role="footer" data-position="fixed">
        <h4>Page Footer</h4>
      </div>
    </div>
  </body>
</html>
