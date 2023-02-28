<?php
include('config/constant.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<style>
    .login-pw{
        position : absolute;
        top: 10%;
        right: 5%;
        background-color: grey;
        padding: 10px;
        border-radius: 10px;
        color: white;
    }
</style>
<body>
    <div class="main">
        <div class="login-pw">
            <p>Username : admin</p>
            <p>Password : admin</p>
        </div>
        <div class="form-container">
            <h1 class="text-center">Login</h1>
                <?php
            if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
            <form action="" method="POST">
                <table class="tbl-full">
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

    </div>
</body>

</html>

<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
       $_SESSION['login'] = "<p class='text-center success-msg'>Login Sucessfully!</p>";
       $_SESSION['user'] = $username ;
       header("location:".URL."admin/index.php");
    } else {
        $_SESSION['login'] = "<p class='text-center error-msg'>Incorrect Username or Password!</p>";
       header("location:".URL."admin/login.php");
    }
}
?>