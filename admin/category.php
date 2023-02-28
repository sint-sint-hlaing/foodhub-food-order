<?php
include('partials/header.php');
?>

<div class="main">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>

        <div class="btn-container">
            <a href="add-category.php" class="link add-btn">Add</a>
        </div>
        <div style="overflow-x:auto;">
        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_category";
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
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $title ?></td>
                        <td><img width="70px" height="50px" style="object-fit: cover;" src="../images/category/<?php echo $image_name ?>" alt="" /></td>
                        <td><?php echo $featured ?></td>
                        <td><?php echo $active ?></td>
                        <td>
                            <a href="<?php URL ?>update-category.php?id=<?php echo $id ?>" class="link update-btn">Update</a>
                            <a href="<?php URL ?>delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="link delete-btn">Delete</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                echo "0 results";
            }
            ?>

        </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php') ?>