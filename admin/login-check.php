<?php 
include("config/constant.php");

if(!isset($_SESSION['user'])){
    header("location:".URL."admin/login.php");
}
?>