<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM product WHERE productid = ".trim($_GET["id"])."";

	$result = pg_query($link, $sql) or die('Query failed: ' . pg_last_error());

	if(pg_num_rows($result) == 1){
		/* Fetch result row as an associative array. Since the result set
		contains only one row, we don't need to use while loop */
		$row = pg_fetch_array($result, 0, PGSQL_NUM);

		// Retrieve individual field value
		$name = $row[1];
		$desn = $row[2];
		$image = $row[3];
		$price = $row[4];
		$catid = $row[5];
		$suppid = $row[6];
	} else{
		// URL doesn't contain valid id parameter. Redirect to error page
		header("location: error.php");
		exit();
	}

    // Close connection
    pg_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
                        <h1>View Product Detail</h1>
                    </div>
                    	<table>
                        <img src="<?php echo $row[3]; ?>" alt="Product">
                      <tbody>
			 <tr>
                        <td><p class="form-control-static"><?php echo $row[1]; ?></p></td>
                        <td><p class="form-control-static"><?php echo $row[4]; ?></p></td>
                      	</tr>
			<tr>
                        <td><label>Deprition</label></td>
                        <td><p class="form-control-static"><?php echo $row[2]; ?></p></td>
                      	</tr>
			<tr>
                        <td><p>Category ID: </p></td>
                        <td> <p class="form-control-static"><?php echo $row[5]; ?></p></td>
                        </tr>
			<tr>
			<td><p>Supplier ID: </p></td>
                        <td><p class="form-control-static"><?php echo $row[6]; ?></p></td>
                      	</tr>
                    <tbody>
		    </table>
                    <a href="Product.php" class="btn btn-primary">Back Product</a>
                    <a href="login-user.php" class="btn btn-primary">Back Home</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
