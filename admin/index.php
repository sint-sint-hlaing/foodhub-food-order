<?php include('partials/header.php') ?>

<div class="main">
    <?php
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    ?>
    <div class="wrapper">

        <h1>Dashboard</h1>

        <div class="grid">
            <div class="box-container text-center">
                <?php
                $sql1 = "SELECT * FROM tbl_category";
                $result1 = $conn->query($sql1);
                $count1 = $result1->num_rows;
                ?>
                <p><?php echo $count1; ?></p>
                <p>Total Categories</p>
            </div>
            <div class="box-container text-center">
                <?php
                $sql2 = "SELECT * FROM tbl_food";
                $result2 = $conn->query($sql2);
                $count2 = $result2->num_rows;
                ?>
                <p><?php echo $count2; ?></p>
                <p>Total Foods</p>
            </div>
            <div class="box-container text-center">
                <?php
                $sql3 = "SELECT * FROM tbl_order";
                $result3 = $conn->query($sql3);
                $count3 = $result3->num_rows;
                ?>
                <p><?php echo $count3; ?></p>
                <p>Ttoal Orders</p>
            </div>
            <div class="box-container text-center">
                <?php
                $sql4 = "SELECT SUM(total) As Total FROM tbl_order WHERE status='Delivered'";
                $result4 = $conn->query($sql4);
                if ($result4->num_rows > 0) {
                    while ($row = $result4->fetch_assoc()) {
                        $total = $row["Total"];
                ?>
                        <p>$<?php echo $total; ?></p>

                <?php
                    }
                }
                ?>
                <p>Revenue Generated</p>
            </div>
        </div>
    </div>
</div>

<?php include('partials/footer.php') ?>