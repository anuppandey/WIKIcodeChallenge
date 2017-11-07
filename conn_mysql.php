<?php
$username="branchcu_anuppan";
$password="prec1ou5s";
$database="branchcu_anupp";

$mysqli = new mysqli("localhost", $username, $password, $database);
$mysqli->select_db($database) or die( "Unable to select database");
# $mysqli->close();
