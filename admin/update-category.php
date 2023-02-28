<?php
include('partials/header.php');
?>

<div class="main">
    <div class="form-container">
        <h1 class="text-center">Update Category</h1>
       <?php echo $_SESSION['update'];
                                            unset($_SESSION['update']);
                                            ?>
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_category WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $title = $row["title"];
                $current_image = $row["image_name"];
                $featured = $row["featured"];
                $active = $row["active"];
            }
        } else {
            echo "0 results";
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full update">
                <tr class="input-container">
                    <td> <label for="">Title:</label></td>
                    <td><input type="text" name="title" value="<?php echo $title ?>"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Current Image:</label></td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img width="100px" height="100px" style="object-fit: cover;" src="../images/category/<?php echo $current_image ?>" alt="" />
                        <?php
                        } else {
                            echo "No image";
                        }
                        ?>
                    </td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">New Image:</label></td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Featured:</label></td>
                    <td>
                        <input <?php if ($featured == "yes") {
                                    echo "checked";
                                } ?> style="width:10%" type="radio" name="featured" value="yes" id="">Yes
                        <input <?php if ($featured == "no") {
                                    echo "checked";
                                } ?> style="width:10%" type="radio" name="featured" value="no" id="">No
                    </td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Active:</label></td>
                    <td>
                        <input <?php if ($active == "yes") {
                                    echo "checked";
                                } ?> style="width:10%" type="radio" name="active" value="yes" id="">Yes
                        <input <?php if ($active == "no") {
                                    echo "checked";
                                } ?> style="width:10%" type="radio" name="active" value="no" id="">No
                    </td>
                </tr>
                <tr class="input-container">
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <button type="submit" name="submit" class="link update-btn"> Update </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $title = $_POST["title"];
        $current_image = $_POST["current_image"];
        $featured = $_POST["featured"];
        $active = $_POST["active"];

        if (isset($_FILES['image'])) {
            $image_name = $_FILES["image"]["name"];
            $target_dir = "../images/category/";

            if ($image_name != "") {
                //Rename image name
                $extension = strtolower(pathinfo($target_dir . basename($image_name), PATHINFO_EXTENSION));
                $image_name = "food_category_" . rand(000, 999) . "." . $extension;

                $target_file = $target_dir . basename($image_name);

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                } else {
                    $_SESSION['upload'] = "<p class='text-center error-msg'>Category Failed to upload image!</p>";
                    header("location:" . URL . "admin/update-category.php");
                    die();
                }
                $remove = unlink("../images/category/".$current_image);
                if($remove == false){
                 $_SESSION['delete'] = "<p class='text-center error-msg'>Failed to delete!</p>";
                 header("location:".URL."admin/category.php");
                 die();
                }
            }else{
                $image_name = $current_image;
            }
        } else {
            $image_name = $current_image;
        }

        $sql = "UPDATE tbl_category SET title='$title',image_name='$image_name',featured='$featured',active='$active' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['update'] = "<p class='text-center success-msg'>Category Updated Sucessfully!</p>";
            header("location:" . URL . "admin/category.php");
        } else {
            $_SESSION['update'] = "<p class='text-center error-msg'>Category Updated Sucessfully!</p>";
            header("location:" . URL . "admin/update-category.php");
        }
    }
    ?>
</div>

<?php include('partials/footer.php') ?>