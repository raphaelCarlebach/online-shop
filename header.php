<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">

<title>Shop Homepage - Start Bootstrap Template</title>

<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="css/shop-homepage.css" rel="stylesheet">

<script src="vendor/jquery/jquery.min.js"></script>
<script src="review.js"></script>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>



<?php require 'dbcon.php'; ?>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
<a class="navbar-brand" href="#">Start Bootstrap</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
<ul class="navbar-nav ml-auto">
    <li class="nav-item active">
    <a class="nav-link" href="#">Home
        <span class="sr-only">(current)</span>
    </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">About</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">Services</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#">Contact</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="checkout.php"> <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>
</a>
    </li>
</ul>
</div>
</div>
</nav>

<!-- Page Content -->
<div class="container">

<div class="row">

<div class="col-lg-3">

<h1 class="my-4">Shop Name</h1>
<div class="list-group">
    <?php
        $categories = mysqli_query($conn, 'SELECT ID, Title FROM categories');

        foreach ($categories as $category) {
    ?>
            <a href="category.php?cat=<?php echo $category['ID']; ?>" class="list-group-item"><?php echo $category['Title']; ?></a>
    <?php
        }
    ?>
</div>

</div>
<!-- /.col-lg-3 -->