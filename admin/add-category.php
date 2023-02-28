<?php
include('partials/header.php');
?>

<div class="main">
    <div class="form-container">
        <h1 class="text-center">Add Category</h1>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr class="input-container">
                    <td> <label for="">Title:</label></td>
                    <td><input type="text" name="title" placeholder="Title"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Image:</label></td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Featured:</label></td>
                    <td>
                        <input style="width:10%" type="radio" name="featured" value="yes" id="">Yes
                        <input style="width:10%" type="radio" name="featured" value="no" id="">No
                    </td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Active:</label></td>
                    <td>
                        <input style="width:10%" type="radio" name="active" value="yes" id="">Yes
                        <input style="width:10%" type="radio" name="active" value="no" id="">No
                    </td>
                </tr>
                <tr class="input-container">
                    <td colspan="2"><button type="submit" name="submit" class="link add-btn"> Add </button></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $title = $_POST["title"];

        if (isset($_POST['featured'])) {
            $featured = $_POST["featured"];
        } else {
            $featured = "no";
        }

        if (isset($_POST['active'])) {
            $active = $_POST["active"];
        } else {
            $active = "no";
        }
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
                    header("location:" . URL . "admin/add-category.php");
                    die();
                }
            }
        }
        $sql = "INSERT INTO tbl_category SET title='$title',image_name='$image_name',featured='$featured',active='$active'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['add'] = "<p class='text-center success-msg'>Category Added Sucessfully!</p>";
            header("location:" . URL . "admin/category.php");
        } else {
            $_SESSION['add'] = "<p class='text-center error-msg'>Category Added Failed!</p>";
            header("location:" . URL . "admin/add-category.php");
        }
    }
    ?>
</div>

<?php include('partials/footer.php') ?>