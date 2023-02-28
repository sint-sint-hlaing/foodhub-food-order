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
        ?>
              <form action="" method="POST">
                     <table class="tbl-full">
                            <tr class="input-container">
                                   <td> <label for="">Full Name:</label></td>
                                   <td><input type="text" name="full_name" placeholder="Full Name"></td>
                            </tr>
                            <tr class="input-container">
                                   <td> <label for="">Username:</label></td>
                                   <td><input type="text" name="username" placeholder="Username"></td>
                            </tr>
                            <tr class="input-container">
                                   <td> <label for="">Password:</label></td>
                                   <td><input type="text" name="password" placeholder="Password"></td>
                            </tr>
                            <tr class="input-container">
                                   <td colspan="2"><button type="submit" name="submit" class="link add-btn"> Add </button></td>
                            </tr>
                     </table>
              </form>
       </div>
       <?php
       if (isset($_POST["submit"])) {
              $full_name = $_POST["full_name"];
              $username = $_POST["username"];
              $password = md5($_POST["password"]);

              $sql = "INSERT INTO tbl_admin SET full_name='$full_name',username='$username',password='$password'";
              
              if ($conn->query($sql) === TRUE) {
                     $_SESSION['add'] = "<p class='text-center success-msg'>Admin Added Sucessfully!</p>";
                     header("location:" . URL . "admin/admin.php");
              } else {
                     $_SESSION['add'] = "<p class='text-center error-msg'>Admin Added Sucessfully!</p>";
                     header("location:" . URL . "admin/add-admin.php");
              }
       }
       ?>
</div>

<?php include('partials/footer.php') ?>