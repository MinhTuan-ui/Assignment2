<?php
session_start();
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
    $desciption = $row[2];
    $image = $row[3];
    $price = $row[4];
    $categoryid = $row[5];
    $supplierid = $row[6];
    }
  else{
		// URL doesn't contain valid id parameter. Redirect to error page
		header("location: error.php");
		exit();
	}
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
    pg_close($link);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 700px;
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
                        <h2>Oredr Information</h2>
                    </div>
                    <p>Customer Information</p>
                    <div>
                    <form action="active-order.php" method="post" style="width:600px; margin: auto;">
                      <table id="table product">
                        <tbody>
			<tr>
                            <td>Order ID:</td>
                            <td><input type="number" name="orderid"></td>
                          </tr>
                          <tr>
                            <td>Date of Time:</td>
                            <td><input type="date" name="orderdate"></td>
                          </tr>
                          <tr>
                          <td>Name:</td>
                          <td><input type = "text" name="name" ></td>
                        </tr>

                          <tr>
                          <td>Email:</td>
                          <td><input type="text" name="email" ></td>
                          </tr>

                          <tr>
                            <td>Address:</td>
                            <td><textarea type="text" name="address" ></textarea></td>
                          </tr>
                          <tr>
                            <td>Phone Number:</td>
                            <td><input type="number" name="tel" ></td>
                          </tr>
                        </tbody>
                      </table>
                      <hr>
                      <table >
                        <thead>
                          <tr>
			     <th>image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
			    <td><img src="<?php echo $row[3] ?>" style="width:100px; height:100px;"></td>
                            <td><?php echo $row[1]?></td>
                            <td><?php echo $row[4]?></td>
                            <td><input type="number" name="quantity" style="width:50px;"></td>
                          </tr>
                        </tbody>
                      </table>
                    <hr>
                      <input type="submit" name submit class="btn btn-inline " value="Payment">
		      <a href="Product.php"class="btn btn-inline" >Cancel<a>
                  </form>
		</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
