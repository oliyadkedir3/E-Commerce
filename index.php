<?php
session_start();
$isLoggedIn = isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == true;
require "db.inc.php";
require "validation.inc.php";

$sql = "SELECT * FROM product_table";
$products = $conn->query($sql);

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
    $sql = "SELECT * from product_table";
    
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
                    <li class="active"><a href="index.php">home</a></li>
                    <li>
                      <a href="shop.php">shop</a>
                    </li>
                    <li><a href="about.php">about</a></li>
                    <li><a href="cart.php">cart</a></li>
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

      <!-- Hero Slider Start-->
      <div class="hero-slider section fix">
        <!-- Hero Slide Item Start-->
        <div
          class="hero-item"
          style="background-image: url(img/hero/image-1920x874.jpg); border-radius: 50px;"
        >
          <!-- Hero Content Start-->
          <div class="hero-content text-center m-auto">
            <h1>Welcome to</h1>
            <h2>Ethiopian Digital Farmers</h2>
            <p>
              Join us on our mission to shape the future of agriculture. See
              more for today and unlock a world of possibilities for your
              farming endeavors. Together, let's cultivate a brighter future for
              agriculture!
            </p>
            <a href="about.php">LEARN MORE</a>
          </div>
          <!-- Hero Content End-->
        </div>
        <!-- Hero Slide Item End-->

        <!-- Hero Slide Item Start-->
        <div class="hero-item" style="background-image: url(img/hero/tyu.png); border-radius: 50px;">
          <!-- Hero Content Start-->
          <div class="hero-content text-center m-auto">
            <h2>We Are..</h2>
            <h1>Ethiopian Digital Farmers</h1>
            <p>
              we are passionate about revolutionizing the way farming is done.
              We believe that the integration of technology and agriculture can
              bring forth a new era of sustainable and efficient farming
              practices.
            </p>
            <a href="about1.php">LEARN MORE</a>
          </div>
          <!-- Hero Content End-->
        </div>
        <!-- Hero Slide Item End-->
      </div>
      <!-- Hero Slider End-->

      <!-- Product Section Start-->
      <div class="product-section section pt-70 pb-60">
        <div class="container">
          <!-- Section Title Start-->
          <div class="row">
            <div class="section-title text-center col mb-60">
              <h1>Featured Products</h1>
            </div>
          </div>
          <!-- Section Title End-->

          <!-- Product Wrapper Start-->
          <div class="row">
            <!-- Product Start-->
            <?php
// Assuming you have already established a database connection and fetched the product data

// Loop through each product data and generate HTML code
foreach ($products as $product) {
    $image_url = $product['product_image_url'];
    $title = $product['product_name'];
    $price = $product['product_price'];
    $product_id = $product['product_id'];

    echo '<div class="col-lg-4 col-md-6 col-12 mb-60">';
    echo '<div class="product">';
    echo '<div class="image">';
    echo '<a href="product-details.php?image_url='. $image_url .'" class="img">';
    echo '<img src="' . $image_url . '" alt="Product">';
    echo '</a>';
    echo '<a href="#" class="wishlist"><i class="fa fa-heart-o"></i></a>';
    echo '</div>';
    echo '<div class="content">';
    echo '<div class="head fix">';
    echo '<div class="title-category float-left">';
    echo '<h5 class="title">';
    echo '<a href="product-details.php">' . $title . '</a>';
    echo '</h5>';
    echo '<a href="shop.php" class="category">Per Quintals</a>';
    echo '</div>';
    echo '<div class="price float-right">';
    echo '<span class="new">$' . $price . '</span>';
    echo '</div>';
    echo '</div>';
    echo '<div class="action-button fix">';
    echo '<a href="add-to-cart.php?product_id=' . $product_id . '">add to cart</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}


?>

      <!-- Banner Section Start-->
    <div class="banner-section section pt-120">
      <div class="container">
          <div class="row">
              
              <div class="col-lg-6 col-12 mb-30">
                  
                  <div class="single-banner">
                      <img src="img/image-570x320 (2).jpg" alt="banner">
                      <div class="banner-content right">
                          <h1 class="white"><span>Looking For</span>Contractual farming</h1>
                          <a href="#" class="button">Negotiate</a>
                      </div>
                  </div>
                  
              </div>
              
              <div class="col-lg-6 col-12 mb-30">
                  
                  <div class="single-banner">
                      <img src="img/meaw.png" alt="banner">
                      <div class="banner-content left">
                          <h2 class="black"><span class="small">Contact Our Sales<span class="red"></span></span><span class="red">Get</span> Good offer</h2>
                          <a href="#" class="link">Contact Now</a>
                      </div>
                  </div>
                  
              </div>
              
          </div>
      </div>
  </div><!-- Banner Section End-->

      <!-- Testimonial Section Start-->
      <div class="testimonial-section section bg-gray pt-100 pb-65">
        <div class="container">
          <!-- Section Title Start-->
          <div class="row">
            <div class="section-title text-center col mb-60">
              <h1>Three things you will love about us...</h1>
            </div>
          </div>
          <!-- Section Title End-->

          <div class="row">
            <div class="col-lg-8 col-md-10 col-12 ml-auto mr-auto">
              <!-- Testimonial Slider Start -->
              <div class="testimonial-slider text-center">
                <!-- Single Testimonial -->
                <div class="single-testimonial">
                  <img src="img/testimonial/quality.png" alt="customer" />
                  <h1>Our quality</h1>
                </div>

                <!-- Single Testimonial -->
                <div class="single-testimonial">
                  <img src="img/testimonial/punctuality.png" alt="customer" />
                  <h1>Punctuality</h1>
                </div>

                <!-- Single Testimonial -->
                <div class="single-testimonial">
                  <img src="img/testimonial/relationship.png" alt="customer" />
                  <h1>Coustmer Relation</h1>
                </div>
              </div>
              <!-- Testimonial Slider End -->
            </div>
          </div>
        </div>
      </div>
      <!-- Testimonial Section End-->

      <!-- Newsletter Section Start-->

<!-- Your HTML code -->
<div class="newsletter-section section pt-100 pb-120">
  <div class="container"  <?php if ($isLoggedIn) echo 'style="display: none;"'; ?>>
    <!-- Section Title Start -->
    <div class="row">
      <div class="section-title text-center col mb-55">
        <h1>Sign Up to get updates</h1>
        <p>
          By signing up to receive updates, you'll be at the forefront of all the latest new products & announcements.
        </p>
      </div>
    </div>
    <!-- Section Title End -->

    <div class="row">
      <div class="text-center col">
        <!-- Newsletter Form -->
        <button class="logbtn">
          <a href="animatedsignup.php">Sign Up</a>
        </button>
        <br />
        <button class="logbtn">
          <a href="animatedLogin.php">Login</a>
        </button>
      </div>
    </div>
  </div>
</div>

      <!-- Testimonial Section End-->

     
      <!-- Footer Section Start-->
      <div
        class="footer-section section bg-dark"
      >
        <div class="container">
          <div class="row">
            <div class="col">
              <!-- Footer Top Start -->
              <div class="footer-top section pt-80 pb-50">
                <div class="row">
                  <!-- Footer Widget -->
                  <div class="footer-widget col-lg-4 col-md-6 col-12 mb-40">
                    <img
                      class="footer-logo"
                      src="img/plol.png "
                      alt="logo"
                    />
                    
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
                      <li><a href="#">Costumes</a></li>
                      <li><a href="#">Lights</a></li>
                      <li><a href="#">Lights</a></li>
                      <li><a href="#">Christmas Trees</a></li>
                      <li><a href="#">Decorations</a></li>
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
                  
            
                     
                      <li><span>Email:</span> contact@ethiopiandigitalfarmers.com</li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Footer Top End -->

              <!-- Footer Bottom Start -->
              <div class="footer-bottom section text-center">
                <p><a href=>TouchBear</a></p>
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
