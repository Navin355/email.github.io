<?php
session_start();
$db_host = "localhost";
$db_root = "root";
$db_pass = "";
$db_name = "test";

$conn = mysqli_connect($db_host,$db_root,$db_pass,$db_name) or die('Connection Failed');


?>