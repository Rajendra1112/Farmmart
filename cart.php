<!-- include connect file -->
<?php
include('includes/connect.php');
include('functions/common_functions.php');
session_start();
if (isset($_SESSION['email'])) {
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
    <style>
      .cart_image a img {
        height: 70px;
        width: 120px;
        object-fit: contain;
      }
    </style>


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
    // remove_cart_item();
    ?>

    <!-- Cart page -->

    <div class="cart_page">
      <div class="container">
        <div class="row justify-content-end">
          <div class="col-xl-12 col-sm-12">

            <table class="table">
              <tbody class="tbody">
                <?php
                global $con;
                $total = 0;
                $ip = getIPAddress();
                $cart_query = "Select * from `cart_details` where ip_address='$ip'";
                $result = mysqli_query($con, $cart_query);
                $result_count = mysqli_num_rows($result);
                if ($result_count > 0) {
                  while ($row = mysqli_fetch_array($result)) {
                    $product_id = $row['product_id'];
                    $select_products = "Select * from `cart_details` where product_id=$product_id";
                    $result_product = mysqli_query($con, $select_products);

                    while ($row_product_price = mysqli_fetch_array($result_product)) {
                      $item_price = $row_product_price['product_price'];
                      $id = $row_product_price['product_id'];
                      $product_category = $row_product_price['product_category'];
                      $price_table = $row_product_price['product_price'];
                      $quantity = $row_product_price['quantity'];
                      $get_ip = getIPAddress();
                      $totals = $price_table;
                      if ($quantity == 0) {
                        $quantity = 1;
                      } else {
                        $quantity = $quantity;
                      }
                      $totals = $totals * $quantity;
                      $product_price = array($totals);
                      $product_title = $row_product_price['product_title'];
                      $product_image = $row_product_price['product_image'];
                      $product_price_sum = array_sum($product_price);
                      $total += $product_price_sum;
                      echo "
                <tr>
              <td class='cart_product_remove'>
                    <form method='post'>
                      <button type='submit' value='$product_id' class='outline-none' name='remove_cart'><i class='fas fa-xmark'></i></button>
                    </form>
                </td>
                  <td class='cart_image'>
                    <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
                      <img src='./img/product_img/$product_category/$product_image' />
                    </a>
                  <td class='cart_product_info'>
                    <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
                  </td>
                  <form action='' method='post'>
                  <td>
                  ";



                      echo "
                    <div class='cart_product_quantity d-flex justify-content-around p-0'>
                      <p class='dec dec-quantity btn border-0 mb-0 fw-bold ' style='height: 100%; font-size: 30px;'>-</p>
                      <input type='hidden' name='id'  value='$id' />
                      <input type='number' name='qty' min='1' value='$quantity' class='cart_quantity border-3 border-success border-end border-start' />
                      <p class='inc btn  mb-0 fw-bold border-0' style='height: 100%; font-size: 30px;'>+</p>
                    </div>
                    ";
                      echo "
                  </td>
                  <td class='cart_product_add_cart'>
                    <input type ='submit' class='more-btn border-0' value='Update cart' name='update_cart'>
                  </td>
                  <td class='cart_product_item_total'>
                    <span>NPR $totals /-</span>
                </td>
                </form>
         </tr>";
                    }
                  }
                } else {
                  echo "<h2 class='text-danger mx-auto d-flex justify-content-center'>Cart is empty</h2>";
                }
                if ($result_count > 0) {
                  echo "<tr class='cart-coupon-row'>
        <td colspan='5'>
    <div class='cart-coupon text-start'>
      <input type='text'  placeholder='Coupon code' class='p-3' />
      <button type='' class='more-btn'>Apply Coupon</button>
    </div>
  </td>
  <td>
    <button type='submit' name='' class='more-btn'>Update Cart</button>
  </td>
</tr>
</tbody>
</table>

</div>

<div class='col-xl-5 col-md-6 col-sm-12 shopping_cart_bill'>
<h4>Total Amount</h4>

<table class='table'>
<tbody>
<tr>
  <td>Cart Subtotal</td>
  <td>$total /-</td>
</tr>
<tr>
  <td>Shipping and Handing</td>
  <td>$15.00</td>
</tr>
<tr>
  <td>Vat</td>
  <td>$00.00</td>
</tr>
<tr>
  <td><strong>Order Total</strong></td>
  <td><strong>$total /-</strong></td>
</tr>
</tbody>
</table>
<a href='./user_area/checkout.php' class='more-btn'>Proceed to checkout</a>
</div>";
                  echo "<a href='index.php' class='more-btn m-3 '>Continue shopping</a>";
                } else {
                  echo "<a href='index.php' class='more-btn m-3 col-xl-5 col-md-6'>Continue shopping</a>";
                }
                // foreach($id as $p){echo $p ;}
                ?>


          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php
    include('./includes/footer.php');
    ?>
    <?php if (isset($_POST['update_cart'])) {
      $quantities = $_POST['qty'];
      $pro_id = $_POST['id'];
      $update_cart = "Update `cart_details` set quantity='$quantities' where ip_address='$get_ip' and product_id=$pro_id";
      $result_quantity = mysqli_query($con, $update_cart);

      if ($result_quantity) {
        echo "<script>window.open('cart.php','_self')</script>";
      }
    }

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
        // Increase decrease cart item
        const increaseCart = document.querySelector(".inc");
        const decreaseCart = document.querySelector(".dec");
        const cartProductValue = document.querySelector(".cart_quantity");

        increaseCart.addEventListener("click", increase);

        function increase() {
          cartProductValue.value++;
          if (cartProductValue.value <= 0) {
            decreaseCart.disabled = true;
          } else {
            decreaseCart.disabled = false;
          }
        }

        decreaseCart.addEventListener("click", decrease);

        function decrease() {
          cartProductValue.value--;
          if (cartProductValue.value <= 0) {
            decreaseCart.disabled = true;
          } else {
            decreaseCart.disabled = false;
          }
        }
      </script>

      <script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>
      <script>
        <?php require('./js/index.js'); ?>
      </script>
      <script src="js/bootstrap.bundle.min.js"></script>

  </body>

  </html>
<?php } else {
  header("Location: index.php");
} ?>