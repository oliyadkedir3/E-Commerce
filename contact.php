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
    <link rel="stylesheet" href="https://maps.googleapis.com/maps/api/js?key=AIzaSyCS1ygI-CFuzL2kQzrVFStyGSHUMEwU_6A">
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
            </div>
            <div class="single-cart clearfix">
            </div>
            <?php
        }
        ?>

        <!-- Cart Total -->
        <div class="cart-totals">
            <h5>Total <span id="aboveCartTotal"><?php echo ($isLoggedIn) ? '$0' : '$0'; ?></span></h5>
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
                    <li><a href="cart.php">cart</a></li>
                    <li><a href="checkout.php">checkout</a></li>
                    <li class="active"><a href="contact.php">contact</a></li>
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
        style="background-image: url(img/bg/image-1920x500\ \(5\).jpg)"
      >
        <div class="container">
          <div class="row">
            <!-- Page Title Start -->
            <div class="page-title text-center col">
              <h1>contact us</h1>
            </div>
            <!-- Page Title End -->
          </div>
        </div>
      </div>
      <!-- Page Banner Section End-->

      <!-- Contact Section Start-->
      <div class="contact-section section bg-white pt-120">
        <div class="container">
          <div class="row">
            <div class="col-xl-10 col-12 ml-auto mr-auto">
              <div class="contact-wrapper">
                <div class="row">
                  <div class="contact-info col-lg-5 col-12">
                    <h4 class="title">Contact Info</h4>
                    <p>
                     We are happ
                    </p>
                    <ul>
                      <li><span>Address:</span>Bole sub city</li>
                      <li><span>Email:</span>contact@ethiopiandigitalfarmers</li>
                      <li><span>Phone:</span>09</li>
                    </ul>
                    <div class="contact-social">
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                      <a href="#"><i class="fa fa-instagram"></i></a>
                      <a href="#"><i class="fa fa-pinterest-p"></i></a>
                    </div>
                  </div>
                  <div class="contact-form col-lg-7 col-12">
                    <h4 class="title">Send Your Massage</h4>
                    <form
                      id="contact-form"
                      action="https://demo.hasthemes.com/christ-preview/christ/mail.php"
                      method="post"
                    >
                      <input type="text" name="name" placeholder="Your Name" />
                      <input
                        type="email"
                        name="email"
                        placeholder="Your Email"
                      />
                      <textarea
                        name="message"
                        placeholder="Your Message"
                      ></textarea>
                      <input type="submit" value="Submit" />
                    </form>
                    <p class="form-messege"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Contact Section End-->

      <!-- Contact Map -->
      <section class="map-section">
      <div id="contact-map"></div>
      <div id="map"></div>
      </section>
<!-- Include JavaScript code for the map provider -->


    
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
