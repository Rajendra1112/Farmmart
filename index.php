<!-- include connect file -->
<?php
include('includes/connect.php');
include('functions/common_functions.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php include('./includes/head.php')?>
  <style>
    .product_category .tab-nav a {
      color: black;
    }

    .product_category .tab-nav .active {
      background-color: green;
      color: white;
    }
  </style>
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
  <?php include('./includes/offcanvas_cart.php'); ?> 
  <?php
  if (isset($_SESSION['email'])) {
    include('./includes/offcanvas_order.php');
  } ?>

  <!-- Product tab
    1. Prodcut tab
    -->
  <?php include('./includes/product_tab.php');?>

  <!-- Subscription list -->
  <div class="package section-wrapper">
    <div class="container">
      <div class="section-title pb-4">
        <h1 class="lg-heading">Subscription Plans</h1>
        <h1 class="sm-heading">Buy Product on Subscription Basis</h1>
      </div>
      <div class="row">
        <?php
          subscription();
        ?>

      </div>
    </div>
  </div>

  <!-- Training blog -->
  <div class="blog section-wrapper">
    <div class="container">
      <div class="section-title pb-4">
        <h1 class="lg-heading">News and Updates</h1>
        <h1 class="sm-heading">Go through our blogs for being upto date with the agro industry</h1>
      </div>
      <div class="row">
        <?php get_blogs(); ?>

      </div>
    </div>
  </div>

  <!-- Footer -->
  <?php
  include('./includes/footer.php');
  ?>

  <!-- back to top -->
  <button id="back_to_top">
    <i class="fas fa-angle-up"></i>
  </button>

  <!-- Search -->
<?php include('./includes/search.php')?>

  <!-- View Product -->
  <?php viewProduct(); ?>
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


  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script>
    <?php require('js/index.js'); ?>
  </script>
  <script>
    function activeCat() {
      var btn = document.querySelector('.tab-nav');
      var btns = document.querySelectorAll('.tab-nav a');
      for (var i = 0; i < btns.length; i++) {
        if (decodeURI(window.location.href).includes(btns[i].getAttribute('href'))) {
          btns[i].classList.add('active');
        }
      }
    }
    activeCat();
  </script>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>