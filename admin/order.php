<?php
include('partials/header.php');
?>

<div class="main">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <div class="btn-container">
            <a href="add-admin.php" class="link add-btn">Add</a>
        </div>
        <div style="overflow-x:auto;">
        <table class="tbl-full">
            <tr>
                <th>No.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_order";
            $result = $conn->query($sql);
            $no = 1;
            if ($result->num_rows > 0) {
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
            ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $food ?></td>
                        <td><?php echo $price ?></td>
                        <td><?php echo $qty ?></td>
                        <td><?php echo $total ?></td>
                        <td><?php echo $order_date ?></td>
                        <td><?php echo $status ?></td>
                        <td><?php echo $customer_name ?></td>
                        <td><?php echo $customer_contact ?></td>
                        <td><?php echo $customer_email ?></td>
                        <td><?php echo $customer_address ?></td>
                        <td>
                            <a href="<?php URL ?>update-order.php?id=<?php echo $id ?>" class="link update-btn">Update</a>
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