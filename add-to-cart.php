<?php
require "db.inc.php";
require "validation.inc.php";
session_start();
if (isset($_SESSION['email'])) {
  $email = setup_input($_SESSION['email']);
  $result = fetchUser("email", $email, "user_table");
  if ($result->num_rows > 0){
    
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
    $product_id = $_GET['product_id'];
    // Assuming you have the user ID in the $user_id variable
    $query = "INSERT INTO user_carted_product (user_id, carted_product_id) VALUES ('$user_id', '$product_id')";
    $result = $conn->query($query);

    // Check if the insertion was successful
    if ($result) {
        // Redirect to the cart page
        header("Location: cart.php");
        exit();
    } else {
        // Handle the case when the insertion fails
        echo "Failed to add the product to the cart.";
    }
  }
} else{
  header("Location: animatedLogin.php");
}
?>