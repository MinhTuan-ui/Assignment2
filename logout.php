<?php
session_start();
unset($_SESSION["customerid"]);
unset($_SESSION["name"]);
header("Location:index.php");
?>
