<?php
include('partials/header.php');
?>

<div class="main">
    <div class="form-container">
        <h1 class="text-center">Add Admin</h1>
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
                    <td> <label for="">Description:</label></td>
                    <td><textarea rows="3" type="text" name="description" placeholder="Description"></textarea></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Price:</label></td>
                    <td><input type="text" name="price" placeholder="Price"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Image:</label></td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Category:</label></td>
                    <td>
                        <select name="category">
                        <?php
            $sql = "SELECT * FROM tbl_category WHERE active='yes'";
            $result = $conn->query($sql);
            $no = 1;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $title = $row["title"];
                    $image_name = $row["image_name"];
                    $featured = $row["featured"];
                    $active = $row["active"];
            ?>
<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
            <?php
                }}
            ?>
                            
                           
                        </select>
                    </td>
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
        $description = $_POST["description"];
        $price = $_POST["price"];
        $category = $_POST["category"];

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
            $target_dir = "../images/food/";

            if ($image_name != "") {
                //Rename image name
                $extension = strtolower(pathinfo($target_dir . basename($image_name), PATHINFO_EXTENSION));
                $image_name = "food_" . rand(000, 999) . "." . $extension;

                $target_file = $target_dir . basename($image_name);

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                } else {
                    $_SESSION['upload'] = "<p class='text-center error-msg'>Food Failed to upload image!</p>";
                    header("location:" . URL . "admin/add-food.php");
                    die();
                }
            }
        }


        $sql = "INSERT INTO tbl_food SET title='$title',description='$description',price='$price',category_id='$category',image_name='$image_name',featured='$featured',active='$active'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['add'] = "<p class='text-center success-msg'>Food Added Sucessfully!</p>";
            header("location:" . URL . "admin/food.php");
        } else {
            $_SESSION['add'] = "<p class='text-center error-msg'>Food Added Sucessfully!</p>";
            header("location:" . URL . "admin/add-food.php");
        }
    }
    ?>
</div>

<?php include('partials/footer.php') ?>