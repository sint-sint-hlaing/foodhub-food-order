<?php
include('partials/header.php');
?>

<div class="main">
    <div class="form-container">
        <h1 class="text-center">Update Order</h1>
        <?php echo $_SESSION['add'];
        unset($_SESSION['add']);
        ?>
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_order WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $food = $row["food"];
                $qty = $row["qty"];
                $price = $row["price"];
                $total = $row["total"];
                $order_date = $row["order_date"];
                $status = $row["status"];
                $customer_name = $row["customer_name"];
                $customer_contact = $row["customer_contact"];
                $customer_email = $row["customer_email"];
                $customer_address = $row["customer_address"];
            }
        } else {
            echo "0 results";
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-full update">
                <tr class="input-container">
                    <td> <label for="">Food:</label></td>
                    <td><?php echo $food; ?></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Price:</label></td>
                    <td><?php echo $price; ?></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Quantity:</label></td>
                    <td><input type="number" name="qty" value="<?php echo $qty ?>"></td>
                </tr>

                <tr class="input-container">
                    <td> <label for="">Status:</label></td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    } ?> value="<?php echo "Ordered"; ?>">Ordered</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?> value="<?php echo "Delivered"; ?>">Delivered</option>
                            <option <?php if ($status == "Canceled") {
                                        echo "selected";
                                    } ?> value="<?php echo "Canceled"; ?>">Canceled</option>

                        </select>
                    </td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Customer Name:</label></td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name ?>"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Customer Contact:</label></td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact ?>"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Customer Email:</label></td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email ?>"></td>
                </tr>
                <tr class="input-container">
                    <td> <label for="">Customer Address:</label></td>
                    <td><textarea rows="3" type="text" name="customer_address" value=""><?php echo $customer_address ?></textarea></td>
                </tr>

                <tr class="input-container">
                    <td colspan="2"><button type="submit" name="submit" class="link update-btn"> Update </button></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $qty = $_POST["qty"];
        $total = $price * $qty;
        $status = $_POST['status'];
        $customer_name = $_POST["customer_name"];
        $customer_contact = $_POST["customer_contact"];
        $customer_email = $_POST["customer_email"];
        $customer_address = $_POST["customer_address"];

        $sql = "UPDATE tbl_order SET qty='$qty', total='$total', status='$status',customer_name='$customer_name',customer_contact='$customer_contact',customer_email='$customer_email',customer_address='$customer_address' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['update'] = "<p class='text-center success-msg'>Order Updated Sucessfully!</p>";
            header("location:" . URL . "admin/order.php");
        } else {
            $_SESSION['update'] = "<p class='text-center error-msg'>Order Updated Failed!</p>";
            header("location:" . URL . "admin/update-order.php");
        }
    }
    ?>
</div>

<?php include('partials/footer.php') ?>