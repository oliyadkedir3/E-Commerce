<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the necessary data is received
include "db.inc.php";
include "validation.inc.php";
session_start();
if (isset($_SESSION['email'])) {
  $email = setup_input($_SESSION['email']);
  $result = fetchUser("email", $email, "user_table");
  if ($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
  }
}

if (isset($_POST['productIdss']) && isset($_POST['quantitiess']) && isset($_POST['productNamess']) && isset($_POST['productPricess'])) {
    // Retrieve the passed data
    $productIds = explode(",", $_POST['productIdss'][0]);
    $quantities = explode(",", $_POST['quantitiess'][0]);
    $prodnames = explode(",", $_POST['productNamess'][0]);
    $prices = explode(",", $_POST['productPricess'][0]);
    echo $prodnames[1];
    $status = "pending";

    // Prepare and execute the SQL statement to insert the data
    $sql = 'INSERT INTO checkout_products (user_id, product_id, product_name, quantity, total_price, status) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);
    
    for ($i = 0; $i < count($productIds); $i++) {
        $productId = $productIds[$i];
        $quantity = $quantities[$i];
        $productName = $prodnames[$i];
        $totalPrice = $prices[$i] * $quantity;
        $stmt->bind_param('iisiis', $user_id, $productId, $productName, $quantity, $totalPrice, $status);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
          $message = "Data inserted successfully.";
          echo $message;
        } else {
          echo "Failed to insert data.";
        }
    }

    $stmt->close();
    $conn->close();       
} else {
    // Handle the case when the necessary data is not received
    echo 'Failed to receive data.';
}
?>
<script>
  // Redirect to the checkout page after processing the data
  setTimeout(function() {
    window.location.href = 'checkout.php';
  }, 10000); // 10 seconds delay
</script>
