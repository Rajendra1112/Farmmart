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
  <?php include('./includes/menu_section.php'); ?>

  <!-- Mobile-Menu Items -->
  <?php include('./includes/mobile_menu.php'); ?>


<!-- //cart function -->
  <?php
          cart();
          ?>

  <!-- offcanvas cart -->
  <?php include('./includes/offcanvas_cart.php');?>

<!-- Blog Details -->
<div class="blog_details">
      <div class="container">
        <div class="row">
          <div class="col-xl-8 col-md-6 col-sm-12">
            <div class="blog_details_inner">
              <?php
              blog_detail();
              ?>
              <div class='row related_blogs pb-4 justify-content-evenly'>
                <div class='col-xl-5 col-md-12 col-sm-12 related_blog related_blog_prev'>
                  <a href='#'>True factors of the modern healthy lifestyle</a>
                </div>
                <div class='col-xl-5 col-md-12 col-sm-12 related_blog related_blog_next'>
                  <a href='#'>True factors of the modern healthy lifestyle</a>
                </div>
              </div>
              <div class="comment_section">
                <div class="comment_title pb-3">
                  <h2 class="border"><span class="total_cmnt pe-3"></span>Comments</h2>
                </div>

                <?php viewComment();?>
                <?php comment();?>
                <?php reply();?>
                <div class="comment_form">
                  <h3 class="pb-3">Leave A Comment</h3>

                  <form action="" method="post" id="comment">
                    <div class="row">
                      <!-- <div class="col-6">
                        <input type="text" name="name" placeholder="Enter name" />
                      </div>
                      <div class="col-6">
                        <input type="email" placeholder="Enter Email" />
                      </div> -->
                      <div class="col-12">
                        <textarea name="comment_msg" id="comment_msg" cols="30" rows="10" placeholder="Leave A comment"></textarea>
                      </div>

                      <div class="submit-btn">
                        <button type="submit" name="post_comment">Commnet</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
          <div class="col-xl-4 col-md-6 col-sm-12">
            <div class="aside-search">
              <form class="sidebar_search" action="./blog.php" method="get">
                <input type="search" placeholder="Search here" name="blog_name" />
                <button type="submit" >
                  <i class="fas fa-magnifying-glass"></i>
                </button>
              </form>
            </div>

            <div class="latest_blog">
              <h3 class="pb-3">Latest Post</h3>
                <?php related_Blogs(); ?>
            </div>
          </div>
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
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
  <script type="text/javascript" src="js/index.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>


