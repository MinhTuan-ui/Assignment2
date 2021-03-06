<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$fullname = $email = $user = $passw = $address = $Tel = "";
$fullname_err = $email_err = $user_err = $passw_err = $address_err = $Tel_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate full name
    $input_fullname = trim($_POST["fullname"]);
    if(empty($input_fullname)){
        $fullname_err = "Please enter your full name.";
    } elseif(!filter_var($input_fullname, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fullname_err = "Please enter a valid full name.";
    } else{
        $fullname = $input_fullname;
    }

    //Validate Email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter your email.";
    } else{
        $email = $input_email;
    }

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
        $passw_err = "Please enter an address.";
    } else{
        $passw = $input_passw;
    }

    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";
    } else{
        $address = $input_address;
    }

    // Validate Telephone number
    $input_Tel = trim($_POST["Tel"]);
    if(empty($input_Tel)){
        $Tel_err = "Please enter the telephone number.";
    } elseif(!ctype_digit($input_Tel)){
        $Tel_err = "Please enter a positive integer value.";
    } else{
        $Tel = $input_Tel;
    }

    // Check input errors before inserting in database
    if(empty($fullname_err) && empty($email_err) && empty($user_err) && empty($passw_err) && empty($address_err) && empty($Tel_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO agency ( name, email, username, pass, address, tel) VALUES ('".$fullname."','".$email."', '".$user."', '".$passw."', '".$address."', '".$Tel."')";

    $results = pg_query($link, $sql) or die('Query failed: ' . pg_last_error());
    if(!empty($results)) {
      header("location: index.php");
    }
    }

    // Close connection
    pg_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($fullname_err)) ? 'has-error' : ''; ?>">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>">
                            <span class="help-block"><?php echo $fullname_err;?></span>
                        </div>
			<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
			    <label>Email:</label>
			    <input type="text" name="email"value=""<?php echo $email; ?>"" >
			    <span class="help-block"><?php echo $email_err;?></span>
			  </div>

			  <div class="form-group <?php echo (!empty($user_err)) ? 'has-error' : ''; ?>">
			    <label>Username:</label>
			    <input type="text" name="user" value=""<?php echo $user; ?>"" >
			    <span class="help-block"><?php echo $user_err;?></span>
			  </div>

			  <div class="form-group <?php echo (!empty($passw_err)) ? 'has-error' : ''; ?>">
			    <label>Password:</label>
			    <input type="text" name="passw"  value=""<?php echo $passw; ?>"" placeholder="Password">
			    <span class="help-block"><?php echo $passw_err;?></span>
			  </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Tel_err)) ? 'has-error' : ''; ?>">
                            <label>Telephone Number</label>
                            <input type="text" name="Tel" class="form-control" value="<?php echo $Tel; ?>">
                            <span class="help-block"><?php echo $Tel_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
