<?php
include('config/constant.php');


if(isset($_GET['id']) && isset($_GET['image_name'])){
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name != ""){

       $remove = unlink("../images/category/".$image_name);
       if($remove == false){
        $_SESSION['delete'] = "<p class='text-center error-msg'>Failed to delete!</p>";
        header("location:".URL."admin/category.php");
        die();
       }
    }

    $sql = "DELETE FROM tbl_category WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['delete'] = "<p class='text-center success-msg'>Category Deleted Sucessfully!</p>";
        header("location:".URL."admin/category.php");
    }else{
        $_SESSION['delete'] = "<p class='text-center error-msg'>Category Deleted Failed!</p>";
        header("location:".URL."admin/category.php");
    }
}else{
    $_SESSION['delete'] = "<p class='text-center error-msg'>Failed to delete!</p>";
        header("location:".URL."admin/category.php");
}
