if(isset($_POST["submit"])){
    // Include config file
    require_once "config.php";
    if (empty($orderid) && empty($orderdate) && empty($address) && empty($name) && empty($email)) && empty($tel) && empty($quantity) {
        echo "Please Enter Full Information";
        header("Location:order.php");
    }else{
      $sql = "SELECT agencyid FROM agency WHERE email= '".$email."'";
      $results = pg_query($link, $sql) or die('Query failed: ' . pg_last_error());
      $agencyid = 'agencyid';
  
    $customerid = 1;
    $sql1 = "INSERT INtO bill (orderid, orderdate, addressshippng, agencyid, customerid) VALUES ('".$orderid."', '".$orderdate."', '".$address."', '".$agencyid."', '".$customerid."')";
    $results1 = pg_query($link, $sql1) or die('Query failed: ' . pg_last_error());

    $totalcost = $quntity*$_SESSION['price'];
    $sql3 = "INSERT INtO orderdetail (orderid, customerid, quantity, totalcost) VALUES ('".$orderid."', '".$customerid."',  '".$quantity."', '".$totalcost."') ";
    $results3 = pg_query($link, $sql3) or die('Query failed: ' . pg_last_error());
    header("Product.php")
    }
    pg_close($link);
  }
  ?>
