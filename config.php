<?php
define('DB_SERVER', 'ec2-35-169-254-43.compute-1.amazonaws.com');
define('DB_USERNAME', 'dazeirjoefhoff');
define('DB_PASSWORD', '734442ea98536d24bbdfa5a79537c6ee81f2b35674045a4ea084a541f3d13320');
define('DB_NAME', 'd5qncfmsqo2iav');

/* Attempt to connect to MySQL database */
$link = pg_connect("host=".DB_SERVER." dbname=". DB_NAME ." user=" . DB_USERNAME . " password=" .DB_PASSWORD. "")
		or die('Could not connect1: ' . pg_last_error());
?>
