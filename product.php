<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {
  include "Models/Product.php";
  include "Database.php";

  $db = new Database();
  $db_conn = $db->connect();
  $product = new Product($db_conn);
  print_r($product->getAllProducts());

  // $products = $product->getAllProducts();

  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Page</title>
    <link rel="stylesheet" type="text/css" href="Assets/css/product.css">
  </head>

  <body>
    <?php include 'navbar.php'; ?>

  </body>

  </html>
  <?php
} else {
  $em = "First login ";
  Util::redirect("login.php", "error", $em);
}
