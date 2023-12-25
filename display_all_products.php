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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fresh - Digital Farm Nepal </title>
  <style>
    .product_category .tab-nav a {
      color: black;
    }

    .product_category .tab-nav .active {
      background-color: green;
      color: white;
    }
    /* //pagination */
    .pagination{
      justify-content: end;
    }
    .pagination li{
      border: none;
      padding: 0;
      margin: 0;
    }
    .pagination li .active{
      background-color: green;
    }
    .pagination li a{
      color: green;
      padding: 0.2rem 0.3rem;
    }
    .pagination li a:hover{
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

  <!-- Product tab
    1. Prodcut tab
    -->
  <section class="product section-wrapper">
    <div class="container">
      <div class="row">
        <!-- <div class="col-lg-3 col-md-12">
          <div class="product_category">
            <div class="product_category_title d-flex justify-content-between align-items-center">
              <i class="fa-solid fa-bars"></i>
              <h1 class="sm-heading">Categories</h1>
              <i class="fa-solid fa-angle-down"></i>
            </div>
            <div class="tab-nav d-flex flex-column align-items-start">
              <?php
              //calling catogey 
              $select_category = "Select * from `category`";
              $result_category = mysqli_query($con, $select_category);
              $open_tap = array("");

              while ($row_data = mysqli_fetch_assoc($result_category)) {
                $category_title = $row_data['category_title'];
                $category_titles = trim($category_title);
                $category_id = $row_data['category_id'];
                echo "<a class='tablinks font-weight-bold' href='display_all_products.php?category=$category_title'>
                              <i class='fas fa-bag-shopping'></i>
                              $category_title
                            </a>";
              }
              ?>
            </div>
          </div>
        </div> -->
        <div class="col-lg-12 col-md-12">
          <div id='firstTab' class='tab-detail text-center'>
            <span class="my-2 d-flex text-dark">
            <?php if(isset($_GET['category'])){
              $cat = $_GET['category'];
              echo "<a href='display_all_products.php'> > products</a> > <a href='#'> $cat</a>";
            }else{
              echo "><a href='display_all_products.php'>products</a>";
            } ?>
              
            </span>
            <!-- Search form -->
            <form class="form-inline active-cyan-4 mb-3">
              <input class="form-control form-control-sm mr-3 w-50 justify-content-end" type="text" placeholder="Search products" id="productSearch" aria-label="Search">
            </form>
            <div class='product_tab'>
              <div class='product_list' id="myProduct">
                <!-- //fetching products -->
                <?php
                //calling function
                search_product();

                get_all_products();
                get_unique_products();
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


  <script>
    var btn = document.querySelector('.tab-nav');
    var btns = document.querySelectorAll('.tab-nav a');
    for (var i = 0; i < btns.length; i++) {
      if (decodeURI(window.location.href).includes(btns[i].getAttribute('href'))) {
        btns[i].classList.add('active');
      }
    }
  </script>
  <!-- //searching algorithm -->
  <script>
    $(document).ready(function() {
  $("#productSearch").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myProduct .product_list_item").each(function() {
      var text = $(this).text().toLowerCase();
      if (linearSearch(text, value)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});

function linearSearch(text, value) {
  for (var i = 0; i < text.length - value.length + 1; i++) {
    var match = true;
    for (var j = 0; j < value.length; j++) {
      if (text[i + j] !== value[j]) {
        match = false;
        break;
      }
    }
    if (match) {
      return true;
    }
  }
  return false;
}
  </script>
  <script type="text/javascript" src="js/index.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>