<?php
include('partials/header.php');
?>

<div class="main">
       <div class="form-container">
              <h1 class="text-center">Update Admin</h1>
              
                     <?php echo $_SESSION['add'];
                     unset($_SESSION['add']);
                     ?>
              <?php
              $id = $_GET['id'];
              $sql = "SELECT * FROM tbl_admin WHERE id=$id";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                     // output data of each row
                     while ($row = $result->fetch_assoc()) {
                            $full_name = $row['full_name'];
                            $username = $row['username'];
                     }
              } else {
                     echo "0 results";
              }

              ?>

              <form action="" method="POST">
                     <table class="tbl-full update">
                            <tr class="input-container">
                                   <td> <label for="">Full Name:</label></td>
                                   <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                            </tr>
                            <tr class="input-container">
                                   <td> <label for="">Username:</label></td>
                                   <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                            </tr>
                            <tr class="input-container">
                                   <td colspan="2"><button type="submit" name="submit" class="link update-btn"> Update </button></td>
                            </tr>
                     </table>
              </form>
       </div>
       <?php
       if (isset($_POST["submit"])) {
              $full_name = $_POST["full_name"];
              $username = $_POST["username"];

              $sql = "UPDATE tbl_admin SET full_name='$full_name',username='$username' WHERE id=$id";

              if ($conn->query($sql) === TRUE) {
                     $_SESSION['update'] = "<p class='text-center success-msg'>Admin Updated Sucessfully!</p>";
                     header("location:" . URL . "admin/admin.php");
              } else {
                     $_SESSION['update'] = "<p class='text-center error-msg'>Admin Updated Sucessfully!</p>";
                     header("location:" . URL . "admin/update-admin.php");
              }
       }
       ?>
</div>

<?php include('partials/footer.php') ?>