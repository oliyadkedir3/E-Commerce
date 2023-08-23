<?php
include "db.inc.php";
include "validation.inc.php";
session_start();
$isLoggedIn = isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == true;
if (isset($_SESSION['email'])) {
  $email = setup_input($_SESSION['email']);
  $result = fetchUser("email", $email, "user_table");
  if ($result->num_rows > 0){
    
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
    $sql = "SELECT p.product_id, p.product_name, p.product_image_url, p.product_price, p.quantity
          FROM user_carted_product uc
          INNER JOIN product_table p ON uc.carted_product_id = p.product_id
          WHERE uc.user_id = $user_id";
    $result1 = $conn->query($sql);

    if ($result1 === false) {
      die("Query failed: " . $conn->error);
    }
    $sql = "SELECT p.product_id, p.product_name, p.product_price, p.product_image_url
    FROM product_table p
    INNER JOIN user_carted_product uc ON p.product_id = uc.carted_product_id
    WHERE uc.user_id = $user_id";
    ;
    $products = $conn->query($sql);
  }
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>EDF</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i"
      rel="stylesheet"
    />
    <!-- CSS
	============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/ionicons.min.css" />
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="css/plugins.css" />
    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css" />
    <!-- Modernizer JS -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
  </head>

  <body>
    <!-- Main Wrapper Start -->
    <div id="main-wrapper" class="section">
      <!-- Header Section Start -->
      <div class="header-section section">
        <!-- Header Top Start -->
        <div class="header-top">
          <div class="container">
            <div class="row">
              <div class="col">
                <!-- Header Top Wrapper Start -->
                <div class="header-top-wrapper">
                  <div class="row">
                    <!-- Header Social -->
                    <div class="header-social col-md-4 col-12">
                      <a href="#"><i class="fa fa-telegram"></i></a>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-linkedin"></i></a>
                      <a href="#"><i class="fa fa-instagram"></i></a>
                      <a href="#"><i class="fa fa-facebook"></i></a>
                    </div>

                    <!-- Header Logo -->
                    <div class="header-logo col-md-4 col-12">
                      <a href="index.php" class="logo"
                        ><img src="img/logo.png" alt="logo"
                      /></a>
                    </div>

                    <!-- Account Menu -->
                    <div class="account-menu col-md-4 col-12">
                    <?php
                    if($isLoggedIn){
                      $num = $result1->num_rows;
                    }
                      ?>
                      <ul>
                        <li><a href="index.php">My Account</a></li>
                        <li><a href="wishlist.php">Wishlist</a></li>
                        <li>
    <a href="#" data-toggle="dropdown">
        <i class="fa fa-shopping-cart"></i>
        <?php 
        if ($isLoggedIn) {
            echo '<span class="num">' . $num . '</span>';
        } else {
            echo '<span class="num">0</span>';
        }
        ?>
    </a>

    <!-- Mini Cart -->
    <div class="mini-cart-brief dropdown-menu text-left">
        <!-- Cart Products -->
        <div class="all-cart-product clearfix">
        <?php
        if ($isLoggedIn) {
            while ($row1 = $result1->fetch_assoc()) {
                $product_name = $row1['product_name'];
                $product_image_url = $row1['product_image_url'];
                $product_price = $row1['product_price'];
                $quantity = $row1['quantity'];

                // Generate a unique ID for the <span> tag
                $span_id = 'prodquantity_' . $row1['product_id'];
                ?>
                <div class="single-cart clearfix">
                    <div class="cart-image">
                        <a href="product-details.php"><img src="<?php echo $product_image_url; ?>" alt="" /></a>
                    </div>
                    <div class="cart-info">
                        <h5><a href="product-details.php"><?php echo $product_name; ?></a></h5>
                        <span id="<?php echo $span_id; ?>"><?php echo $quantity; ?></span> x <?php echo '$'.$product_price; ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="single-cart clearfix">
                <div class="cart-image">
                    <a href="product-details.html"><img src="img/product/man.jpg" alt="" /></a>
                </div>
                <div class="cart-info">
                    <h5><a href="product-details.html">Mango</a></h5>
                    <p>1 x 90.00</p>
                    <a href="#" class="cart-delete" title="Remove this item"><i class="fa fa-trash-o"></i></a>
                </div>
            </div>
            <div class="single-cart clearfix">
                <div class="cart-image">
                    <a href="product-details.html"><img src="img/product/avo.jpg" alt="" /></a>
                </div>
                <div class="cart-info">
                    <h5><a href="product-details.html">Avocado</a></h5>
                    <p>1 x 39.00</p>
                    <a href="#" class="cart-delete" title="Remove this item"><i class="fa fa-trash-o"></i></a>
                </div>
            </div>
            <?php
        }
        ?>

        <!-- Cart Total -->
        <div class="cart-totals">
            <h5>Total <span id="aboveCartTotal"><?php echo ($isLoggedIn) ? '$0' : '120$'; ?></span></h5>
        </div>
        <!-- Cart Button -->
        <div class="cart-bottom clearfix">
            <a href="<?php echo ($isLoggedIn) ? 'cart.php' : 'checkout.html'; ?>">
                <?php echo ($isLoggedIn) ? 'Go to Cart Page' : 'Check out'; ?>
            </a>
        </div>
    </div>
</li>

<?php
if ($isLoggedIn) {
    echo '<li><a href="logoutlogic.php">Logout</a></li>';
} else {
    echo '<li><a href="animatedLogin.php">Login</a></li>';
}
?>

                      </ul>
                    </div>
                  </div>
                </div>
                <!-- Header Top Wrapper End -->
              </div>
            </div>
          </div>
        </div>
        <!-- Header Top End -->

        <!-- Header Bottom Start -->
        <div class="header-bottom section">
          <div class="container">
            <div class="row">
              <!-- Header Bottom Wrapper Start -->
              <div class="header-bottom-wrapper text-center col">
                <!-- Header Bottom Logo -->
                <div class="header-bottom-logo">
                  <a href="index.php" class="logo"
                    ><img src="img/logo.png" alt="logo"
                  /></a>
                </div>

                <!-- Main Menu -->
                <nav id="main-menu" class="main-menu">
                  <ul>
                    <li><a href="index.php">home</a></li>
                    <li>
                      <a href="shop.php">shop</a>
                    </li>
                    <li><a href="about.php">about</a></li>
                    <li class="active"><a href="cart.php">cart</a></li>
                    <li><a href="checkout.php">checkout</a></li>
                    <li><a href="contact.php">contact</a></li>
                  </ul>
                </nav>

                <!-- Header Search -->
                <div class="header-search">
                  <!-- Search Toggle -->
                  <button class="search-toggle">
                    <i class="ion-ios-search-strong"></i>
                  </button>

                  <!-- Search Form -->
                  <div class="header-search-form">
                    <form action="#">
                      <input type="text" placeholder="Search..." />
                      <button><i class="ion-ios-search-strong"></i></button>
                    </form>
                  </div>
                </div>

                <!-- Mobile Menu -->
                <div class="mobile-menu section d-md-none"></div>
              </div>
              <!-- Header Bottom Wrapper End -->
            </div>
          </div>
        </div>
        <!-- Header Bottom End -->
      </div>
      <!-- Header Section End -->

      <!-- Page Banner Section Start-->
      <div
        class="page-banner-section section"
        style="background-image: url(img/bg/hjk.jpg)"
      >
        <div class="container">
          <div class="row">
            <!-- Page Title Start -->
            <div class="page-title text-center col">
              <h1>Cart</h1>
            </div>
            <!-- Page Title End -->
          </div>
        </div>
      </div>
      <!-- Page Banner Section End-->

      <!-- Cart Section Start-->
      <?php if (!$isLoggedIn): ?>
  <section class="cartparagraph"><p>No products found.</p></section>
<?php else: ?>
  <div class="cart-section section pt-120 pb-90">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="table-responsive mb-30">
            <table class="table cart-table text-center">
              <!-- Table Head -->
              <thead>
                <tr>
                  <th class="number">#</th>
                  <th class="image">image</th>
                  <th class="name">product name</th>
                  <th class="qty">quantity</th>
                  <th class="price">price</th>
                  <th class="total">total</th>
                  <th class="remove">remove</th>
                </tr>
              </thead>

              <!-- Table Body -->
              <tbody>
                <?php
                while ($row = $products->fetch_assoc()) {
                  $productId = $row['product_id'];
                  $productImage = $row['product_image_url'];
                  $productName = $row['product_name'];
                  $productPrice = $row['product_price'];

                  echo '<tr>';
                  echo '<td><span class="cart-number">' . $productId . '</span></td>';
                  echo '<td><a href="#" class="cart-pro-image"><img src="' . $productImage . '" alt=""></a></td>';
                  echo '<td><a href="#" class="cart-pro-title">' . $productName . '</a></td>'; 
                  echo '<td><div class="product-quantity"><input type="text" value="" name="qtybox" data-product-id="' . $productId . '" data-productName="' . $productName . '" data-price="' . $productPrice . '"></div></td>';
                  echo '<td><p class="cart-pro-price">$' . $productPrice . '</p></td>';
                  echo '<td><p class="cart-price-total">$' . $productPrice . '</p></td>';
                  echo '<td><button class="cart-pro-remove" data-product-id="' . $productId . '"><i class="fa fa-trash-o"></i></button></td>';
                  echo '</tr>';
                }
                ?>
              </tbody>

            </table>
          </div>
          <div class="row">
            <!-- Cart Action -->
            <div class="cart-action col-lg-4 col-md-6 col-12 mb-30">
              <a href="index.php" class="button">Continue Shopping</a>
              <button class="button">Update Cart</button>
            </div>

            <!-- Cart Cuppon -->
            <div class="cart-cuppon col-lg-4 col-md-6 col-12 mb-30">
              <h4 class="title">Discount Code</h4>
              <p>Enter your coupon code if you have</p>
              <form action="#" class="cuppon-form">
                <input type="text" placeholder="Coupon Code" />
                <button class="button">Apply Coupon</button>
              </form>
            </div>

            <!-- Cart Checkout Progress -->
            <div class="cart-checkout-process col-lg-4 col-md-6 col-12 mb-30">
              <h4 class="title">Process Checkout</h4>
              <p><span>Subtotal</span><span class="cart-totals" id="subtotal">$0</span></p>
              <h5><span>Grand total</span><span class="cart-totals" id="grandtotal">$0</span></h5>
              <button class="button" id="checkoutButton">Proceed to Checkout</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

      <form action="user_carted_page.php" method="post" id="myForm">
        <input type="hidden" name="productIdss[]" value="">
        <input type="hidden" name="quantitiess[]" value="">
        <input type="hidden" name="productNamess[]" value="">
        <input type="hidden" name="productPricess[]" value="">
        
        <button type="submit" style="visibility: hidden;">Submit</button>
      </form>

      <!-- JavaScript/jQuery code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Function to calculate and update the total cost
  function updateTotalCost() {
    var totalCost = 0;
    var productIds = [];
    var prices = [];

    // Loop through each quantity input field
    $('input[name="qtybox"]').each(function() {
      var quantity = parseInt($(this).val()) || 0;
      var price = parseFloat($(this).data('price'));
      var prodid = parseInt($(this).data('product-id'));
      productIds.push(prodid);
      prices.push(price);
      var subtotal = quantity * price;
      
      totalCost += subtotal;
      // Update the subtotal for the current row
      $(this).closest('tr').find('.cart-price-total').text('$' + subtotal.toFixed(2));
      var productId = $(this).data('product-id');
      var quantitySpan = $('#prodquantity_' + productId);
      quantitySpan.text(quantity);
    });

    // Update the total cost
    $('#subtotal').text('$' + totalCost.toFixed(2));
    $('#grandtotal').text('$' + totalCost.toFixed(2));
    $('#aboveCartTotal').text('$' + totalCost.toFixed(2));
    
    return {
      productIds: productIds,
      prices: prices
    };
  }

  // Calculate and update the total cost on page load
  var cartData = updateTotalCost();
  var productIds = cartData.productIds;
  var prices = cartData.prices;
  var quantities = [];
  var prodnames = [];
  // Event listener for quantity changes
  $('input[name="qtybox"]').on('input', function() {
    updateTotalCost();
  });

  $('#checkoutButton').on('click', function() {
    var qtyboxes = document.querySelectorAll('input[name="qtybox"]');
    qtyboxes.forEach(function(qtybox) {
    var quantity = parseInt(qtybox.value);
    var prodName = qtybox.getAttribute('data-productName');
    prodnames.push(prodName);
    quantities.push(quantity);
    });
      console.log(cartData);
      console.log(quantities);
      console.log(prodnames);
    // Populate the hidden input fields with array values
productIds.forEach((id, index) => {
  document.querySelector('input[name="productIdss[]"]').value += id;
  if (index !== productIds.length - 1) {
    document.querySelector('input[name="productIdss[]"]').value += ',';
  }
});

quantities.forEach((qty, index) => {
  document.querySelector('input[name="quantitiess[]"]').value += qty;
  if (index !== quantities.length - 1) {
    document.querySelector('input[name="quantitiess[]"]').value += ',';
  }
});

prodnames.forEach((name, index) => {
  document.querySelector('input[name="productNamess[]"]').value += name;
  if (index !== prodnames.length - 1) {
    document.querySelector('input[name="productNamess[]"]').value += ',';
  }
});

prices.forEach((price, index) => {
  document.querySelector('input[name="productPricess[]"]').value += price;
  if (index !== prices.length - 1) {
    document.querySelector('input[name="productPricess[]"]').value += ',';
  }
});

// Submit the form
document.getElementById('myForm').submit();

  });

  // Event listener for delete button clicks
  $('.cart-pro-remove').on('click', function() {
    var productId = $(this).data('product-id');

    // Send an AJAX request to delete the product from the user_carted_product table
    $.ajax({
      url: 'delete_cart_product.php',
      method: 'POST',
      data: {
        productId: productId
      },
      success: function(response) {
        // Remove the table row from the HTML
        $('button[data-product-id="' + productId + '"]').closest('tr').remove();
        // Recalculate and update the total cost
        var cartData = updateTotalCost();
        productIds = cartData.productIds;
        quantities = cartData.quantities;
        prodnames = cartData.prodnames;
        prices = cartData.prices;
      },
      error: function() {
        alert('Failed to delete product');
      }
    });
  });
});

</script>
      <!-- Cart Section End-->

      <!-- Footer Section Start-->
      <div class="footer-section section bg-dark">
        <div class="container">
          <div class="row">
            <div class="col">
              <!-- Footer Top Start -->
              <div class="footer-top section pt-80 pb-50">
                <div class="row">
                  <!-- Footer Widget -->
                  <div class="footer-widget col-lg-4 col-md-6 col-12 mb-40">
                    <img class="footer-logo" src="img/plol.png " alt="logo" />
                  </div>

                  <!-- Footer Widget -->
                  <div class="footer-widget col-lg-2 col-md-3 col-12 mb-40">
                    <h4 class="widget-title">Information</h4>

                    <ul>
                      <li><a href="#">About us</a></li>
                      <li><a href="#">Shop</a></li>
                      <li><a href="#">Blog</a></li>
                      <li><a href="#">Portfolio</a></li>
                      <li><a href="#">Contact us</a></li>
                    </ul>
                  </div>

                  <!-- Footer Widget -->
                  <div class="footer-widget col-lg-2 col-md-3 col-12 mb-40">
                    <h4 class="widget-title">Categories</h4>

                    <ul>
                      <li><a href="#">Fruits</a></li>
                      <li><a href="#">Vegitables</a></li>
                      <li><a href="#">Crops</a></li>
                      <li><a href="#">Stock Export</a></li>
                      <li><a href="#">Land Renting</a></li>
                    </ul>
                  </div>

                  <!-- Footer Widget -->
                  <div class="footer-widget col-lg-4 col-md-6 col-12 mb-40">
                    <h4 class="widget-title">Contact Us</h4>

                    <ul>
                      <li>
                        <span>Address:</span>Bole Sub City, Gollagul Tower,
                        Addis Ababa
                      </li>
                      <li>
                        <span>Phone:</span> Tel: 011 667 30 04 , +251944106233
                      </li>

                      <li>
                        <span>Email:</span> contact@ethiopiandigitalfarmers.com
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Footer Top End -->

              <!-- Footer Bottom Start -->
              <div class="footer-bottom section text-center">
                <p><a href>TouchBear</a></p>
              </div>
              <!-- Footer Bottom End -->
            </div>
          </div>
        </div>
      </div>
      <!-- Footer Section End-->
    </div>
    <!-- Main Wrapper End -->

    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <!-- Popper JS -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins JS -->
    <script src="js/plugins.js"></script>
    <!-- Ajax Mail JS -->
    <script src="js/ajax-mail.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
  </body>
</html>
