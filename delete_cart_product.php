<?php
// Assuming you have established a database connection
require "db.inc.php";
require "validation.inc.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
  $productId = $_POST['productId'];

  // Perform the deletion query on the user_carted_product table
  $sql = "DELETE FROM user_carted_product WHERE carted_product_id = '$productId'";
  $result = $conn->query($sql);

  if ($result) {
    echo 'Product deleted successfully';
  } else {
    echo 'Failed to delete product';
  }
}
?>
