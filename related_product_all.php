<?php
      session_start();
      ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./css/bootstrap.min.css" />

    <!-- Font-awesome icons -->
    <link rel="stylesheet" href="./css/all.min.css" />
    <link rel="stylesheet" href="./css/fontawesome.min.css" />

    <!-- FavIcon -->
    <link rel="shortcut icon" href="./img/company/favicon.png" type="image/x-icon" />

    <!-- Custom style -->
    <link rel="stylesheet" href="./css/styles.css" />

    <!-- Lightbox -->
    <!-- Slick -->

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fresh - Digital Farm Nepal</title>
  </head>
  <body>
    <!-- Top header -->
    <?php include('./includes/top_header.php'); ?>

    <!-- 
    Menu bar 
      1. Logo
      2. Navigation Menu 1 dropdown 1 mega menu for desktop and no mega menu for mobile
      
    -->

  <!-- Menu section -->
  <?php include('./includes/menu_section.php'); ?>

  <!-- Mobile-Menu Items -->
  <?php include('./includes/mobile_menu.php'); ?>

    <!-- //cart function -->
  <?php
          cart();
          ?>

    <!-- offcanvas cart -->
    <?php include('./includes/offcanvas_cart.php');?>

    <!-- Product tab
    1. Prodcut tab
    
    -->

    <section class="product section-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <div class="product_list">
              <div class="product_list_item">
                <div class="product_list_item_image">
                  <a href="./product-details.html">
                    <img src="./img/product/10.png" alt="Kiwi" />
                  </a>
                </div>
                <div class="product_list_item_detail">
                  <a href="./product-details.html" class="sm-heading">Onions</a>
                  <del>NPR. 400 </del>
                  <span>NPR. 400 </span>
                </div>
                <div class="product_list_item_hover">
                  <ul class="d-flex justify-content-between align-items-center">
                    <li>
                      <a href="#" class="view_icon">
                        <i class="fas fa-eye"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_cart_icon">
                        <i class="fas fa-cart-shopping"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_wish_icon">
                        <i class="fas fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="product_list_item">
                <div class="product_list_item_image">
                  <a href="./product-details.html">
                    <img src="./img/product/10.png" alt="Kiwi" />
                  </a>
                </div>
                <div class="product_list_item_detail">
                  <a href="./product-details.html" class="sm-heading">Onions</a>
                  <del>NPR. 400 </del>
                  <span>NPR. 400 </span>
                </div>
                <div class="product_list_item_hover">
                  <ul class="d-flex justify-content-between align-items-center">
                    <li>
                      <a href="#" class="view_icon">
                        <i class="fas fa-eye"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_cart_icon">
                        <i class="fas fa-cart-shopping"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_wish_icon">
                        <i class="fas fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="product_list_item">
                <div class="product_list_item_image">
                  <a href="./product-details.html">
                    <img src="./img/product/10.png" alt="Kiwi" />
                  </a>
                </div>
                <div class="product_list_item_detail">
                  <a href="./product-details.html" class="sm-heading">Onions</a>
                  <del>NPR. 400 </del>
                  <span>NPR. 400 </span>
                </div>
                <div class="product_list_item_hover">
                  <ul class="d-flex justify-content-between align-items-center">
                    <li>
                      <a href="#" class="view_icon">
                        <i class="fas fa-eye"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_cart_icon">
                        <i class="fas fa-cart-shopping"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_wish_icon">
                        <i class="fas fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="product_list_item">
                <div class="product_list_item_image">
                  <a href="./product-details.html">
                    <img src="./img/product/10.png" alt="Kiwi" />
                  </a>
                </div>
                <div class="product_list_item_detail">
                  <a href="./product-details.html" class="sm-heading">Onions</a>
                  <del>NPR. 400 </del>
                  <span>NPR. 400 </span>
                </div>
                <div class="product_list_item_hover">
                  <ul class="d-flex justify-content-between align-items-center">
                    <li>
                      <a href="#" class="view_icon">
                        <i class="fas fa-eye"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_cart_icon">
                        <i class="fas fa-cart-shopping"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_wish_icon">
                        <i class="fas fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="product_list_item">
                <div class="product_list_item_image">
                  <a href="./product-details.html">
                    <img src="./img/product/10.png" alt="Kiwi" />
                  </a>
                </div>
                <div class="product_list_item_detail">
                  <a href="./product-details.html" class="sm-heading">Onions</a>
                  <del>NPR. 400 </del>
                  <span>NPR. 400 </span>
                </div>
                <div class="product_list_item_hover">
                  <ul class="d-flex justify-content-between align-items-center">
                    <li>
                      <a href="#" class="view_icon">
                        <i class="fas fa-eye"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_cart_icon">
                        <i class="fas fa-cart-shopping"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_wish_icon">
                        <i class="fas fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="product_list_item">
                <div class="product_list_item_image">
                  <a href="./product-details.html">
                    <img src="./img/product/10.png" alt="Kiwi" />
                  </a>
                </div>
                <div class="product_list_item_detail">
                  <a href="./product-details.html" class="sm-heading">Onions</a>
                  <del>NPR. 400 </del>
                  <span>NPR. 400 </span>
                </div>
                <div class="product_list_item_hover">
                  <ul class="d-flex justify-content-between align-items-center">
                    <li>
                      <a href="#" class="view_icon">
                        <i class="fas fa-eye"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_cart_icon">
                        <i class="fas fa-cart-shopping"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_wish_icon">
                        <i class="fas fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="product_list_item">
                <div class="product_list_item_image">
                  <a href="./product-details.html">
                    <img src="./img/product/10.png" alt="Kiwi" />
                  </a>
                </div>
                <div class="product_list_item_detail">
                  <a href="./product-details.html" class="sm-heading">Onions</a>
                  <del>NPR. 400 </del>
                  <span>NPR. 400 </span>
                </div>
                <div class="product_list_item_hover">
                  <ul class="d-flex justify-content-between align-items-center">
                    <li>
                      <a href="#" class="view_icon">
                        <i class="fas fa-eye"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_cart_icon">
                        <i class="fas fa-cart-shopping"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_wish_icon">
                        <i class="fas fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="product_list_item">
                <div class="product_list_item_image">
                  <a href="./product-details.html">
                    <img src="./img/product/10.png" alt="Kiwi" />
                  </a>
                </div>
                <div class="product_list_item_detail">
                  <a href="./product-details.html" class="sm-heading">Onions</a>
                  <del>NPR. 400 </del>
                  <span>NPR. 400 </span>
                </div>
                <div class="product_list_item_hover">
                  <ul class="d-flex justify-content-between align-items-center">
                    <li>
                      <a href="#" class="view_icon">
                        <i class="fas fa-eye"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_cart_icon">
                        <i class="fas fa-cart-shopping"></i>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="add_wish_icon">
                        <i class="fas fa-heart"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <ul class="pagination d-flex pt-3"></ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-md-6 col-sm-12 footer1">
            <div class="footer-logo">
              <a href="#">
                <img src="./img/company/logo-2.png" alt="" />
              </a>
            </div>
            <p>We're providing every day fresh and quality products for you.</p>
            <div class="socials">
              <a href="#">
                <i class="fab fa-facebook"></i>
              </a>

              <a href="#">
                <i class="fab fa-twitter"></i>
              </a>

              <a href="#">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-12 footer2">
            <h1 class="sm-heading">Explore</h1>
            <ul>
              <li>
                <a href="vegetable.html">Product</a>
              </li>
              <li>
                <a href="wishlist.html">WishList</a>
              </li>
              <li>
                <a href="farmers.html">Farmers</a>
              </li>
              <li>
                <a href="cart.html">Cart</a>
              </li>
            </ul>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-12 footer3">
            <h1 class="sm-heading">Support</h1>
            <ul>
              <li>
                <div class="icon">
                  <i class="fas fa-phone"></i>
                </div>
                <div class="detail">
                  <span>Phone</span>
                  <span>+977 9812767046</span>
                </div>
              </li>
              <li>
                <div class="icon">
                  <i class="fas fa-location"></i>
                </div>
                <div class="detail">
                  <span>Address</span>
                  <span>New Baneshowr, Kathmandu</span>
                </div>
              </li>
              <li>
                <div class="icon">
                  <i class="fas fa-envelope-open-text"></i>
                </div>
                <div class="detail">
                  <span>Email</span>
                  <span>support@digitalfarm.com</span>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-xl-3 col-md-6 col-sm-12 footer4">
            <h1 class="sm-heading">NewsLetter</h1>
            <ul>
              <li>
                <input type="email" placeholder=" Enter Your Email" required />
              </li>
              <li class="sub-btn">
                <button type="submit">Subscribe</button>
              </li>
            </ul>
          </div>
          <div class="col-xl-12 col-md-12 col-sm-12 copyright text-center">
            <p>&copy; Copyright <span>2023</span>. All Right Reserved</p>
          </div>
        </div>
      </div>
    </footer>

    <!-- back to top -->
    <button id="back_to_top">
      <i class="fas fa-angle-up"></i>
    </button>

    <!-- Search -->
    <div class="search-wrapper">
      <div class="close_search text-end">
        <i class="fas fa-xmark"></i>
      </div>
      <div class="search-bar-wrapper">
        <div class="search-bar">
          <input type="search" name="search" id="search" placeholder="Enter Keyword Here" />
          <i class="fa-solid fa-magnifying-glass"></i>
        </div>
      </div>
    </div>

    <!-- View Product -->
    <div class="product_view">
      <div class="product_view_box">
        <div class="row align-items-center">
          <div class="col-lg-6 col-md-12">
            <div class="product_image">
              <img src="./img/seed/3.jpg" alt="" />
            </div>
          </div>
          <div class="col-lg-6 col-md-12">
            <div class="product_details">
              <button class="close_quick_view">
                <i class="fas fa-xmark"></i>
              </button>

              <div class="product_detail">
                <h1 class="sm-heading">Papaya</h1>
                <span>NPR. 500 Per KG</span>
                <del>NPR. 800 Per KG</del>
              </div>

              <ul class="product_specs">
                <li class="title">Product Feature:</li>
                <li>Fresh</li>
                <li>Organic</li>
                <li>Authentic</li>
              </ul>

              <div class="cart-section">
                <div class="quantity">
                  <button class="dec">-</button>
                  <input type="text" min="0" value="2" class="cart_quantity" />
                  <button class="inc">+</button>
                </div>

                <div class="cart-btn">
                  <button class="more-btn">
                    <i class="fas fa-cart-shopping"></i>
                    Add to Cart
                  </button>
                </div>
              </div>

              <div class="wishlist_add">
                <button class="wishlist_added">
                  <i class="fas fa-heart"></i>
                  <span>Add to Wishlist</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Added to cart -->
    <div class="mini_cart_added">
      <div class="message_box">
        <div class="row align-items-center">
          <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="product_image">
              <img src="./img/bread/3.jpeg" alt="" />
            </div>
          </div>
          <div class="col-xl-8 col-md-8 col-sm-12">
            <div class="message_info">
              <button class="close_modal">
                <i class="fas fa-xmark"></i>
              </button>
              <h1 class="sm-heading">Gauva</h1>
              <p>Successfully added to your Cart</p>
              <div class="modal_btns">
                <a href="#" class="more-btn">View Cart</a>
                <a href="#" class="more-btn">Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Added to wishlist -->
    <div class="wish_message">
      <div class="wish_message_box">
        <div class="row align-items-center">
          <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="product_image">
              <img src="./img/bread/3.jpeg" alt="" />
            </div>
          </div>
          <div class="col-xl-8 col-md-8 col-sm-12">
            <div class="message_info">
              <button class="close_wish_msg">
                <i class="fas fa-xmark"></i>
              </button>
              <h1 class="sm-heading">Gauva</h1>
              <p>Successfully added to your WishList</p>
              <div class="modal_btns">
                <a href="#" class="more-btn">View WishList</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./js/app.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
  </body>
</html>
