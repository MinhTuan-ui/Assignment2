<?php
define('DB_SERVER', 'ec2-54-237-155-151.compute-1.amazonaws.com');
define('DB_USERNAME', 'hdjogbillqqnyb');
define('DB_PASSWORD', '80c00ced55a1bae1f3877ede69f6450f4f939fcd4de5b3de0f574a95225caecc');
define('DB_NAME', 'd9mpedeea8avbs');

/* Attempt to connect to MySQL database */
$link = pg_connect("host=".DB_SERVER." dbname=". DB_NAME ." user=" . DB_USERNAME . " password=" .DB_PASSWORD. "")
		or die('Could not connect1: ' . pg_last_error());
?>
