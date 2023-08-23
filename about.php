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
                    <li class="active"><a href="about.php">about</a></li>
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

      <!-- Page Banner Section Start-->
      <div
        class="page-banner-section section"
        style="background-image: url(img/bg/po.jpg)"
      >
        <div class="container">
          <div class="row">
            <!-- Page Title Start -->
            <div class="page-title text-center col">
              <h1>About us</h1>
            </div>
            <!-- Page Title End -->
          </div>
        </div>
      </div>
      <!-- Page Banner Section End-->

      <!-- About Section Start-->
      <div class="about-section section pt-120 pb-90">
        <div class="container">
          <div class="row flex-row-reverse">
            <!-- About Image -->
            <div class="about-image col-lg-6 col-12 mb-30">
              <a
                class="video-popup"
                href="https://www.youtube.com/watch?v=7e90gBu4pas"
                ><img src="img/op.jpg" alt=""
              /></a>
            </div>

            <!-- Mission Content -->
            <div class="about-content col-lg-6 col-12 mb-30">
              <h2>About <span>EDF</span></h2>
              <p>
                Welcome to EDF (Ethiopian Digital Farmers) agricultural
                e-commerce platform, where you can find everything you need to
                grow your farm and boost your yields. We offer a wide range of
                products categories, all of which are carefully selected and
                tested to ensure their quality and effectiveness. We understand
                that farming can be a challenging and unpredictable business,
                which is why we strive to provide our customers with the best
                possible products and service. With our easy-to-use platform,
                you can browse and purchase products from the comfort of your
                home, and have them delivered right to your doorstep.
              </p>
              <a href="about1.php" class="button">Learn More</a>
            </div>
          </div>
        </div>
      </div>
      <!-- About Section End-->

      <!-- Team Section Start-->
      <div class="team-section section pb-120">
        <div class="container">
          <div class="row">
            <div class="section-title text-center col mb-60">
              <h1>Our Team</h1>
            </div>
          </div>

          <div class="team-wrapper row">
            <div class="single-team col-lg-3 col-md-6 col-12">
              <img src="img/team/image-384x384.jpg" alt="team" />
              <div class="content">
                <h4>Adege</h4>
                <span>CEO</span>
              </div>
            </div>

            <div class="single-team col-lg-3 col-md-6 col-12">
              <img src="img/team/image-384x384.jpg" alt="team" />
              <div class="content">
                <h4>B</h4>
                <span>Marketer</span>
              </div>
            </div>

            <div class="single-team col-lg-3 col-md-6 col-12">
              <img src="img/team/image-384x384.jpg" alt="team" />
              <div class="content">
                <h4>Halleli</h4>
                <span>developer</span>
              </div>
            </div>

            <div class="single-team col-lg-3 col-md-6 col-12">
              <img src="img/team/image-384x384.jpg" alt="team" />
              <div class="content">
                <h4>Ros</h4>
                <span>Designer</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Team Section End-->

      <!-- Funfact Section Start-->
      <div class="funfact-section section pb-90">
        <div class="container">
          <div class="row">
            <!-- Single Fact -->
            <div class="single-fact text-center col-sm-3 col-6 mb-30">
              <div class="wrap">
                <i class="fa fa-users"></i>
                <h2 class="counter">50</h2>
                <p>Happy Clients</p>
              </div>
            </div>

            <!-- Single Fact -->
            <div class="single-fact text-center col-sm-3 col-6 mb-30">
              <div class="wrap">
                <i class="fa fa-trophy"></i>
                <h2 class="counter">90</h2>
                <p>Award Winning</p>
              </div>
            </div>

            <!-- Single Fact -->
            <div class="single-fact text-center col-sm-3 col-6 mb-30">
              <div class="wrap">
                <i class="fa fa-thumbs-up"></i>
                <h2 class="counter">230</h2>
                <p>Project Done</p>
              </div>
            </div>

            <!-- Single Fact -->
            <div class="single-fact text-center col-sm-3 col-6 mb-30">
              <div class="wrap">
                <i class="fa fa-coffee"></i>
                <h2 class="counter">350</h2>
                <p>Cups of Coffee</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Funfact Section End-->

      <!-- Client Section Start-->
      <div class="client-section section pb-90">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="client-slider text-center">
                <!-- Single Client -->
                <div class="single-client">
                  <img src="img/client/1.png" alt="client" />
                </div>
                <div class="single-client">
                  <img src="img/client/2.png" alt="client" />
                </div>
                <div class="single-client">
                  <img src="img/client/3.png" alt="client" />
                </div>
                <div class="single-client">
                  <img src="img/client/4.png" alt="client" />
                </div>
                <div class="single-client">
                  <img src="img/client/5.png" alt="client" />
                </div>
                <div class="single-client">
                  <img src="img/client/6.png" alt="client" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Client Section End-->

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

