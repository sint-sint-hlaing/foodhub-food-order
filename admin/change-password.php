<?php
include('partials/header.php');
?>

<div class="main">
    <div class="form-container">
        <h1 class="text-center">Change Password</h1>
        <?php if (isset($_SESSION['admin_pw'])) {
            echo $_SESSION['admin_pw'];
            unset($_SESSION['admin_pw']);
        }
        if (isset($_SESSION['pw_not_match'])) {
            echo $_SESSION['pw_not_match'];
            unset($_SESSION['pw_not_match']);
        }
        ?>
        <p class="text-center error-msg">
            <?php echo $_SESSION['add'];
            unset($_SESSION['add']);
            ?></p>
        <form action="" method="POST">
            <table class="tbl-full update">
                <tr class="input-container">
                    <td> <label for="">Current Password:</label></td>
                    <td><input type="text" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">New Password:</label></td>
                    <td><input type="text" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Confirm Password:</label></td>
                    <td><input type="text" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr class="input-container">
                    <td colspan="2"><button type="submit" name="submit" class="link add-btn"> Change </button></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php

if (isset($_POST["submit"])) {
    $id = $_GET['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
    $sql = "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        if ($new_password == $confirm_password) {
            $sql1 = "UPDATE tbl_admin SET password='$new_password' WHERE id='$id'";
            if ($conn->query($sql1) === TRUE) {

                echo "changed";
                $_SESSION['admin_pw'] = "<p class='text-center success-msg'>Password has changed sucessfully!</p>";
                header("location:" . URL . "admin/admin.php");
            } else {

                echo "failed";
                $_SESSION['admin_pw'] = "<p class='text-center error-msg'>Failed to change password!</p>";
                header("location:" . URL . "admin/admin.php");
            }
        } else {
            echo "no match";
            $_SESSION['admin_pw'] = "<p class='text-center error-msg'>Password Not Match!</p>";
            header("location:" . URL . "admin/admin.php");
        }
    } else {
        echo "not found";
        $_SESSION['admin_pw'] = "<p class='text-center error-msg'>Your Password is incorrect!</p>";
        header("location:" . URL . "admin/admin.php");
    }
}
?>