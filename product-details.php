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
    
  }
}
if (isset($_GET['image_url'])){
  $image_url = $_GET['image_url'];
  $sql = "SELECT * FROM product_table WHERE product_image_url = '$image_url'";
  $result2 = $conn->query($sql);
}
if ($result2 === false){
  die("Query failed: " . $conn->error); 
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
                          </div>
                        </li>
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
                    <li class="active">
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

      <!-- Page Banner Section Start-->
      <div
        class="page-banner-section section"
        style="background-image: url(img/bg/pexels-jatuphon-buraphon-348689.jpg)"
      >
        <div class="container">
          <div class="row">
            <!-- Page Title Start -->
            <div class="page-title text-center col">
              <h1 style="color: black;">Product details</h1>
            </div>
            <!-- Page Title End -->
          </div>
        </div>
      </div>
      <!-- Page Banner Section End-->

      <!-- Product Section Start-->
      <?php
// Assuming you have established a database connection

// Fetch the product details from the database
$row2 = $result2->fetch_assoc();

// Extract the individual values from the fetched row
$title = $row2['product_name'];
$price = $row2['product_price'];
$image = $row2['product_image_url'];
$description = $row2['product_description'];
$more_info = $row2['more_info'];
$data_sheet = $row2['data_sheet'];
$product_id = $row2['product_id'];

// Explode the data_sheet into separate sections
$data_sheet_sections = explode(',', $data_sheet);
$compositions = $data_sheet_sections[0];
$styles = $data_sheet_sections[1];
$properties = $data_sheet_sections[2];

// Output the product details in the corresponding HTML sections
?>
<div class="product-section section pt-110 pb-90">
    <div class="container">
        <!-- Product Wrapper Start-->
        <div class="row">
            <!-- Product Image & Thumbnail Start -->
            <div class="col-lg-7 col-12 mb-30">
                <!-- Product Image -->
                <div class="single-product-image product-image-slider fix">
                    <div class="single-image">
                        <img src="<?php echo $image; ?>" alt="" />
                    </div>
                </div>
            </div>
            <!-- Product Image & Thumbnail End -->

            <!-- Product Content Start -->
            <div class="single-product-content col-lg-5 col-12 mb-30">
                <!-- Title -->
                <h1 class="title"><?php echo $title; ?></h1>

                <!-- Product Rating -->
                <span class="product-rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>

                <!-- Price -->
                <span class="product-price">€ <?php echo $price; ?></span>

                <!-- Description -->
                <div class="description">
                    <p><?php echo $description; ?></p>
                </div>

                <!-- Quantity & Cart Button -->
                <?php
                // Generate the URL with the product_id parameter
                $url = 'add-to-cart.php?product_id=' . $product_id;
                ?>
                <div class="product-quantity-cart fix">
                <a href="<?php echo $url; ?>" class="add-to-cart">Add to Cart</a>
                </div>
                
                <!-- Action Button -->
                <div class="product-action-button fix">
                    <button>
                        <i class="ion-ios-email-outline"></i>Email to a friend
                    </button>
                    <button><i class="ion-ios-heart-outline"></i>Wishlist</button>
                    <button><i class="ion-ios-printer-outline"></i>Print</button>
                </div>

                <!-- Social Share -->
                <div class="product-share fix">
                    <h6>Share :</h6>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                </div>
            </div>
            <!-- Product Content End -->
        </div>
        <!-- Product Wrapper End-->

        <!-- Product Additional Info Start-->
        <div class="row">
            <!-- Nav tabs -->
            <div class="col-12 mt-30">
                <ul class="pro-info-tab-list nav">
                    <li>
                        <a class="active" data-toggle="tab" href="#more-info">More info</a>
                    </li>
                    <li><a data-toggle="tab" href="#data-sheet">Data sheet</a></li>
                    <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
                </ul>
            </div>

            <!-- Tab panes -->
            <div class="tab-content col-12">
                <div class="pro-info-tab tab-pane active" id="more-info">
                    <p><?php echo $more_info; ?></p>
                </div>

                <div class="pro-info-tab tab-pane" id="data-sheet">
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="odd">
                                <td>Compositions</td>
                                <td><?php echo $compositions; ?></td>
                            </tr>
                            <tr class="even">
                                <td>Styles</td>
                                <td><?php echo $styles; ?></td>
                            </tr>
                            <tr class="odd">
                                <td>Properties</td>
                                <td><?php echo $properties; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pro-info-tab tab-pane" id="reviews">
                    <a class="button" href="#">Be the first to write your review!</a>
                </div>
            </div>
        </div>
        <!-- Product Additional Info End-->
    </div>
</div>

      <!-- Product Section End-->

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
