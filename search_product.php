<!-- include connect file -->
<?php
include('includes/connect.php');
include('functions/common_functions.php');
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
  <title>Fresh - Digital Farm Nepal </title>
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
  
  <?php include('./includes/menu_section.php');?>

  <!-- Mobile-Menu Items -->
  <?php include('./includes/mobile_menu.php');?>


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
          <div class="p-3 border-bottom border-top">
            <h5 id="prod-res"></h5>
          </div>
      </div>
        <div class="col-lg-12 col-md-12 mt-3">
          <div >
            <h5 id="prod-res"></h5>
          </div>
          <div id='firstTab' class='tab-detail text-center'>
          <div class='product_tab'>
              <div class='product_list' id="myProduct">
                <!-- //fetching products -->
                <?php
                //calling function
                search_product();

                // get_all_products();
                // get_unique_products();
                ?>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

    <!-- Subscription list -->
    <!-- <div class="package section-wrapper">
    <div class="container">
      <div class="section-title pb-4">
        <h1 class="lg-heading">Subscription Plans</h1>
        <h1 class="sm-heading">Buy Product on Subscription Basis</h1>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
          <div class="plan">
            <div class="price">
              <h1 class="lg-heading">Rs. 100</h1>
              <p>Per Day</p>
            </div>
            <div class="plan_title">
              <h1 class="sm-heading">Daily Plan</h1>
            </div>
            <ul>
              <li>1 Ltr. Pure Milk</li>
              <li>Coriender Leaves</li>
              <li>2 Eggs</li>
              <li>Sharp 6:00 AM delivery</li>
              <li>Online Payment</li>
            </ul>
            <div class="pricing_btn text-center">
              <a href="#" class="sub_btn">
                <span>Subscribe</span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
          <div class="plan">
            <div class="price">
              <h1 class="lg-heading">Rs. 500</h1>
              <p>Per Week</p>
            </div>
            <div class="plan_title">
              <h1 class="sm-heading">Weekly Plan</h1>
            </div>
            <ul>
              <li>1 Ltr. Pure Milk</li>
              <li>Coriender Leaves</li>
              <li>2 Eggs</li>
              <li>Sharp 6:00 AM delivery</li>
              <li>Online Payment</li>
            </ul>
            <div class="pricing_btn text-center">
              <a href="#" class="sub_btn">
                <span>Subscribe</span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
          <div class="plan">
            <div class="price">
              <h1 class="lg-heading">Rs. 1500</h1>
              <p>Per 14 Day</p>
            </div>
            <div class="plan_title">
              <h1 class="sm-heading">Double Week Plan</h1>
            </div>
            <ul>
              <li>1 Ltr. Pure Milk</li>
              <li>Coriender Leaves</li>
              <li>2 Eggs</li>
              <li>Sharp 6:00 AM delivery</li>
              <li>Online Payment</li>
            </ul>
            <div class="pricing_btn text-center">
              <a href="#" class="sub_btn">
                <span>Subscribe</span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
          <div class="plan">
            <div class="price">
              <h1 class="lg-heading">Rs. 2000</h1>
              <p>Per Month</p>
            </div>
            <div class="plan_title">
              <h1 class="sm-heading">Monthly Plan</h1>
            </div>
            <ul>
              <li>1 Ltr. Pure Milk</li>
              <li>Coriender Leaves</li>
              <li>2 Eggs</li>
              <li>Sharp 6:00 AM delivery</li>
              <li>Online Payment</li>
            </ul>
            <div class="pricing_btn text-center">
              <a href="#" class="sub_btn">
                <span>Subscribe</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Training blog -->
  <!-- <div class="blog section-wrapper">
    <div class="container">
      <div class="section-title pb-4">
        <h1 class="lg-heading">News and Updates</h1>
        <h1 class="sm-heading">Go through our blogs for being upto date with the agro industry</h1>
      </div>
      <div class="row">
          <?php get_blogs(); ?>
          
      </div>
    </div>
  </div> -->
  
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
    <?php viewProduct();?>
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
    <?php require('js/index.js'); ?>

</script>
  <script>
        //search result
const search_res = document.getElementById('search-prod').innerHTML;
// search_res.style.display="none";
const prod_res = document.getElementById('prod-res').innerHTML=search_res;
  </script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>