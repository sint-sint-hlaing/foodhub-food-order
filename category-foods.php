<?php include('partials-front/header.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        $category_id = $_GET['category_id'];
        $sql = "SELECT * FROM tbl_category WHERE id='$category_id'";
        $result = $conn->query($sql);
        $no = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $title = $row["title"];
        ?>
                <h2>Foods on <a href="#" class="text-white">"<?php echo $title ?>"</a></h2>
        <?php }
        } ?>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food text-center">
    <h1>Food Menu</h1>
    <div class="food-container">
        <?php
        $category_id = $_GET['category_id'];
        $sql = "SELECT * FROM tbl_food WHERE category_id='$category_id' ";
        $result = $conn->query($sql);
        $no = 1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $title = $row["title"];
                $description = $row["description"];
                $price = $row["price"];
                $image_name = $row["image_name"];
                $featured = $row["featured"];
                $active = $row["active"];
        ?>
                <div href="" class="card">
                        <img src="./images/food/<?php echo $image_name ?>" alt="">
                        <h3><?php echo $title ?></h3>
                        <p><?php echo $description ?></p>
                        <h5>$<?php echo $price ?></h5>
                        <a href="/food-order/order.php?food_id=<?php echo $id ?>" class="menu-btn btn-primary">Order Now</a>
                </div>
        <?php
            }
        } else {
            echo "0 results";
        }
        ?>
    </div>
</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>