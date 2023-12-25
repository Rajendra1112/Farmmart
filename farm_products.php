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
    <link rel="stylesheet" href="./css/farmer_page.css" />


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

    <!-- //product section -->
    <section class="product section-wrapper">
    <div class="container">
      <div class="row">
      <div class="col-lg-12 col-md-12 ">
          <div id='firstTab' class='tab-detail text-center'>
            
    <?php
    //condition to check isset or not
  if (isset($_GET['farm_id'])) {
    $farm_id = $_GET['farm_id'];

    //select farm
    $select_farm = "Select * from `user_table` where user_id=$farm_id";
    $result_farm = mysqli_query($con,$select_farm);
    $farm_data = mysqli_fetch_assoc($result_farm);
    $farm_name = $farm_data['role_company_name'];
    //product count
    $select_product_query = "Select * from `products` where user_id=$farm_id";
    $result_product_query = mysqli_query($con, $select_product_query);
    $row_product_data = mysqli_num_rows($result_product_query);
     echo "
     <div class='border mb-3 text-success'>
        <h1>$farm_name</h1>
        <p>Total Products: $row_product_data</p>
     </div>
     <div class='product_tab'>
     <div class='product_list'>
     ";

    $select_query = "Select * from `products`where user_id=$farm_id order by rand()";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='d-block text-center text-danger'>No stoke for this Farm</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_image = $row['product_image'];
      $product_title = $row['product_title'];
      $product_category = $row['product_category'];
      $product_price = $row['product_price'];
      $product_after_price = $row['product_after_price'];
      echo "
    <div class='product_list_item'>
    <div class='product_list_item_image'>
      <a href='./product_details.php?product_id=$product_id&&product_title=$product_title'>
        <img src='./img/product_img/$product_category/$product_image' alt='$product_title' />
      </a>
    </div>
    <div class='product_list_item_detail'>
      <a href='./product-details.html' class='sm-heading'>$product_title</a>
      <del>NPR. $product_price</del>
      <span>NPR. $product_after_price </span>
    </div>
    <div class='product_list_item_hover'>
      <ul class='d-flex justify-content-between align-items-center'>
        <li>
          <a href='#' class='view_icon'>
            <i class='fas fa-eye'></i>
          </a>
        </li>
        <li>
          <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
            <i class='fas fa-cart-shopping'></i>
          </a>
        </li>
        <li>
          <a href='#' class='add_wish_icon'>
            <i class='fas fa-heart'></i>
          </a>
        </li>
      </ul>
    </div>
  </div>";
    }
  }
    ?>
    </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

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



    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>