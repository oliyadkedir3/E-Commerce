<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Page</title>
  <!-- Add your CSS and JS files here -->
  <link rel="stylesheet" href="style.css" />
</head>
<body>
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
                  <a href="index.php" class="logo"><img src="img/logo.png" alt="logo" /></a>
                </div>

                <!-- Account Menu -->
                <div class="account-menu col-md-4 col-12">
                  <?php
                  // Insert your PHP code here
                  ?>
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
              <a href="index.php" class="logo"><img src="img/logo.png" alt="logo" /></a>
            </div>

            <!-- Main Menu -->
            <nav id="main-menu" class="main-menu">
              <ul>
                <li><a href="index.php">home</a></li>
                <li>
                  <a href="shop.php">shop</a>
                  <ul class="sub-menu">
                    <li><a href="shop.php">shop page</a></li>
                    <li><a href="product-details.php">product details</a></li>
                  </ul>
                </li>
                <li><a href="about.php">about</a></li>
                <li class="active">
                  <a href="#">pages</a>
                  <ul class="sub-menu">
                    <li class="active"><a href="cart.php">cart</a></li>
                    <li><a href="checkout.php">checkout</a></li>
                    <li><a href="wishlist.php">wishlist</a></li>
                    <li><a href="under-construction.php">Under Construction</a></li>
                  </ul>
                </li>
                <li>
                  <a href="blog.php">blog</a>
                  <ul class="sub-menu">
                    <li><a href="blog.php">blog page</a></li>
                    <li><a href="blog-details.php">blog details</a></li>
                  </ul>
                </li>
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

  <!-- Main Content Section -->
  <main>
    <!-- Blog Content... -->
  </main>

  <!-- Footer Section Start -->
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
                  <li><span>Address:</span>Bole Sub City, Gollagul Tower, Addis Ababa</li>
                  <li><span>Phone:</span> Tel: 011 667 30 04 , +251944106233</li>
                  <li><span>Email:</span> contact@ethiopiandigitalfarmers.com</li>
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
  <!-- Footer Section End -->
</body>
</html>
