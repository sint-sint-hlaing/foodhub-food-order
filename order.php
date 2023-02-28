<?php include('partials-front/header.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="order-container">

    <h2 class="text-center">Fill this form to confirm your order</h2>
    <?php
    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>
    <form action="" method="POST" class="order">
        <?php
        $food_id = $_GET['food_id'];
        $sql = "SELECT * FROM tbl_food WHERE id='$food_id'";
        $result = $conn->query($sql);
        $no = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $title = $row["title"];
                $price = $row["price"];
                $image_name = $row["image_name"];
        ?>
                <div class="food-order">
                    <div class="food-menu-img">
                        <img src="./images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza">
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price ">$<?php echo $price; ?></p>

                        <div class="order-detail">
                            <label>Quantity :</label>
                            <input type="number" name="qty" class="input-responsive" value="1" required>
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <h3 class="text-center">Delivery Details</h3>
        <div class="order-detail">
            <label>Full Name :</label>
            <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>
        </div>
        <div class="order-detail">
            <label>Phone Number :</label>
            <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>
        </div>

        <div class="order-detail">
            <label>Email :</label>
            <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>
        </div>

        <div class="order-detail">
            <label>Address :</label>
            <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
        </div>
        <div class="btn-container">
            <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
        </div>
    </form>

</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
if (isset($_POST["submit"])) {
    $qty = $_POST["qty"];
    $total = $price * $qty;
    $order_date = date("Y-m-d h:i:s");
    $status = "Ordered";
    $customer_name = $_POST["full-name"];
    $customer_contact = $_POST["contact"];
    $customer_email = $_POST["email"];
    $customer_address = $_POST["address"];

    $sql = "INSERT INTO tbl_order SET food='$title', price='$price' , qty='$qty' , total='$total',order_date='$order_date', status='$status',customer_name='$customer_name',customer_contact='$customer_contact',customer_email='$customer_email',customer_address='$customer_address'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['order'] = "<p class='text-center success-msg'>Order Added Sucessfully!</p>";
        header("location:" . URL . "index.php");
    } else {
        $_SESSION['order'] = "<p class='text-center error-msg'>Failed to order!</p>";
        header("location:" . URL . "order.php");
    }
}
?>

<?php include('partials-front/footer.php'); ?>