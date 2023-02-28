<?php include('partials-front/header.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $_POST['search']; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- Food Section -->
    <section class="food text-center">
    <h1>Food Menu</h1>
    <div class="food-container">
    <?php
    $search = $_POST['search'];
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";
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