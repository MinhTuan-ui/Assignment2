<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$fullname = $email = $user = $passw = $address = $Tel = "";
$fullname_err = $email_err = $user_err = $passw_err = $address_err = $Tel_err = "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];

    // Validate name
    $input_fullname = trim($_POST["fullname"]);
    if(empty($input_fullname)){
        $fullname_err = "Please enter a full name.";
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
    if(empty($fullname_err) && empty($address_err) && empty($Tel_err)){
        // Prepare an update statement
        $sql = "UPDATE agency SET name='".$fullname."', email='".$email."', username='".$username."', pass='".$pass."', address='".$address."', tel=".$Tel." WHERE agencyid=".$id."";



		$results = pg_query($link, $sql) or die('Query failed: ' . pg_last_error());
		//$current_id = mysqli_insert_id($conn);
		if(!empty($results)) {
			header("location: info.php");
			exit();
		}
    }

    // Close connection
    pg_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM agency WHERE agencyid = ". $id;

		$result = pg_query($link, $sql) or die('Query failed: ' . pg_last_error());

		if(pg_num_rows($result) == 1){
			/* Fetch result row as an associative array. Since the result set
			contains only one row, we don't need to use while loop */
			$row = pg_fetch_array($result, 0, PGSQL_NUM);

			// Retrieve individual field value
			$fullname = $row[1];
			$email = $row[2];
			$user = $row[3];
			$passw = $row[4];
			$address = $row[5];
			$Tel = $row[6];
		} else{
			// URL doesn't contain valid id parameter. Redirect to error page
			header("location: Error.php");
			exit();
		}

        // Close connection
        pg_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: Error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
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
			  <input type="password" name="passw"  value=""<?php echo $passw; ?>"" placeholder="Password">
			  <span class="help-block"><?php echo $passw_err;?></span>
			</div>
			    
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
                            <span class="help-block"><?php echo $address_err;?></span>
                        </div>
			    
                        <div class="form-group <?php echo (!empty($Tel_err)) ? 'has-error' : ''; ?>">
                            <label>Telephone Number</label>
                            <input type="number" name="Tel" class="form-control" value="<?php echo $Tel; ?>">
                            <span class="help-block"><?php echo $Tel_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="info.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
