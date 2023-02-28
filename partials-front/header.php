<?php include('./admin/config/constant.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
       <div class="logo">
        <a href="index.php">Food<span>Hub</span></a>
       </div>

        <ul class="menu">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="categories.php">Categories</a>
            </li>
            <li>
                <a href="foods.php">Foods</a>
            </li>
            <li>
                <a href="admin">Dashboard</a>
            </li>
        </ul>
        <div class="bar-btn"><i class="fa-solid fa-bars"></i></div>
        <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
    </section>
    <!-- Navbar Section Ends Here -->