<?php include('partials-front/header.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h1>Discover Your Next Meal with Ease</h1>
        <p>Find your favorite dishes, explore new cuisines, and order food online with just a few clicks. With our easy-to-use search bar, satisfy your cravings and enjoy delicious meals delivered straight to your door.</p>
        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section>

    <!-- Food Section -->
<section class="food text-center">
    <h1>Food Menu</h1>
    <div class="food-container">
    <?php
            $sql = "SELECT * FROM tbl_food WHERE featured='yes' AND active='yes'";
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

    <?php include('partials-front/footer.php'); ?>