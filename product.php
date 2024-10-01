<?php
session_start();
include "Models/Product.php";
include "Database.php";

$db = new Database();
$db_conn = $db->connect();
$product = new Product($db_conn);

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
  $product_id = $_POST['product_id'];
  print_r($product_id);
  $product_data = $product->getProductById($product_id);

  if ($product_data) {
      if (isset($_SESSION['cart'][$product_id])) {
          $_SESSION['cart'][$product_id]++;
      } else {
          $_SESSION['cart'][$product_id] = 1;
      }
  }
}

$products = $product->getAllProducts();
print_r($products);
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

    <div class="grid-container">
        <?php foreach ($products as $product) { ?>
            <div class="card">
                <img src="Assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p class="price"><?php echo "$" . number_format($product['price'], 2); ?></p>
                <p><?php echo htmlspecialchars($product['product_id']); ?></p>

                <form method="POST" action="product.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>
