<?php
//Session start
session_start();

define('URL','http://localhost:8080/food-order/');

//Db Connect 
$conn = new mysqli('localhost', 'root', '', 'food-order');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>