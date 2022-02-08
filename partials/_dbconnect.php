<?php
// To connect database

// $servername = "sql201.epizy.com";
// $username = "epiz_30847136";
// $password ="bqgQiMvjMEq";
// $database = "epiz_30847136_ecourse";

$servername = "localhost";
$username = "root";
$password ="";
$database = "ecourse";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Fail to connect:" . mysqli_connect_error());
    exit;
}
?>