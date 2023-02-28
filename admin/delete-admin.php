<?php
include('config/constant.php');


$id = $_GET['id'];
$sql = "DELETE FROM tbl_admin WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    $_SESSION['delete'] = "<p class='text-center success-msg'>Admin Deleted Sucessfully!</p>";
    header("location:".URL."admin/admin.php");
}else{
    $_SESSION['delete'] = "<p class='text-center error-msg'>Admin Deleted Failed!</p>";
    header("location:".URL."admin/admin.php");
}
?>