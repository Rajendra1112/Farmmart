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

    <!-- //supplier section -->
    <div class="container my-sm-5 border p-0 bg-sec-light" style="min-height: 60vh;">
        <div id="content">
            <div class="bg-light p-2 px-md-4 px-3 shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="user-select-none">Home</div>
                    <div class="fas fa-angle-right px-2"></div>
                    <div id="navigator" class="text-primary"></div>
                </div>
            </div>
            <div >
                <?php
                $supplier_name = $_GET['supplier_name']??'';
                $location = $_GET['location']??'';
                $area = $_GET['Area']??'';
                ?>
                <form action="" method="get" class="d-sm-flex align-items-sm-center py-sm-3 px-md-3 farm">
                 <input type="text" placeholder="Supplier name" value="<?php echo $supplier_name;?>" name="supplier_name" class="mx-sm-2 mx-3 my-sm-0 my-2 form-control"> 
                 <input type="text" placeholder="Location" value="<?php echo $location;?>" name="location" class=" mx-md-2 mx-sm-1 mx-3 my-sm-0 my-2 form-control"> 
                 <input type="text" placeholder="Area" value="<?php echo $area;?>" name="Area" class=" mx-md-2 mx-sm-1 mx-3 my-sm-0 my-2 form-control"> 
                 <button type="submit" value="Supplier"  name="search_result" class="btn btn-primary mx-3 my-sm-0 mb-2">search</button>
                 </form>
                 </div>
                 
            <div class="d-sm-flex py-sm-3 px-md-3 justify-content-center" style="height:100%">

                <div class="row bg-white border" id="farmer">
                    <?php
                    getSupplier();
                    searchSupplier();
                     
                    ?>


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

    <script type="text/javascript" src="js/index.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>