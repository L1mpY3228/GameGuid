<?php  
$server = "localhost";
$name = "tipkil8o_root";
$password = "Root123";
$dbname = "tipkil8o_root";
$connect = mysqli_connect($server, $name, $password, $dbname);

if (!$connect) {
  die("Ошибка в подключении!!! " . mysqli_connect_error());
} 
?>