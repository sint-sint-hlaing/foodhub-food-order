<?php
include('partials/header.php');
?>

<div class="main">
    <div class="wrapper">
        <h1>Manage Admin</h1>
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
        if (isset($_SESSION['admin_pw'])) {
            echo $_SESSION['admin_pw'];
            unset($_SESSION['admin_pw']);
        }
        ?>

        <div class="btn-container">
            <a href="add-admin.php" class="link add-btn">Add</a>
        </div>
        <div style="overflow-x:auto;">
        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_admin";
            $result = $conn->query($sql);
            $no = 1;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $full_name = $row["full_name"];
                    $username = $row["username"];
            ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $full_name ?></td>
                        <td><?php echo $username ?></td>
                        <td>
                        <a href="<?php URL ?>change-password.php?id=<?php echo $id ?>" class="link pw-btn">Change PW</a>
                            <a href="<?php URL ?>update-admin.php?id=<?php echo $id ?>" class="link update-btn">Update</a>
                            <a href="<?php URL ?>delete-admin.php?id=<?php echo $id ?>" class="link delete-btn">Delete</a>
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