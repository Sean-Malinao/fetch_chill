<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "userdb";

//connection
$con = new mysqli($host, $db_user, $db_pass, $db_name);

//check for connection

if($con->connect_error){
    die("Failed to connect" . $con->connect_error);
}
?>