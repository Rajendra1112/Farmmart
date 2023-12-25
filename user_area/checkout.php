<!-- include connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
include '../includes/payenment/setting.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../css/bootstrap.min.css" />

  <!-- Font-awesome icons -->
  <link rel="stylesheet" href="../css/all.min.css" />
  <link rel="stylesheet" href="../css/fontawesome.min.css" />

  <!-- FavIcon -->
  <link rel="shortcut icon" href="../img/company/favicon.png" type="image/x-icon" />

  <!-- Custom style -->
  <link rel="stylesheet" href="../css/styles.css" />


  <!-- Lightbox -->
  <!-- Slick -->

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fresh - Digital Farm Nepal</title>

  <style>
    .card {
      height: 50%;
      overflow-x: hidden;
      /* overflow-y: hidden; */
    }

    .card:hover {
      /* height: 50%; */
      overflow-x: hidden;
    }

    .card-header {
      background-color: #fff;
      border-bottom: 1px solid #aaaa !important;
    }

    p {
      font-size: 18px;
    }

    .small {
      text-align: right;
      font-size: 12px !important;
    }

    .form-control-sm {
      height: calc(2.2em + .5rem + 2px);
      font-size: .875rem;
      line-height: 1.5;
      border-radius: 0;
    }

    .cursor-pointer {
      cursor: pointer;
    }

    .bell {
      opacity: 0.5;
      cursor: pointer;
    }

    @media (max-width: 767px) {
      .breadcrumb-item+.breadcrumb-item {
        padding-left: 0
      }
    }
  </style>
</head>

<body>

  <!-- Top header -->
  <?php include('../includes/top_header.php') ?>
  <!-- 
    Menu bar 
      1. Logo
      2. Navigation Menu 1 dropdown 1 mega menu for desktop and no mega menu for mobile
      
    -->

  <!-- Menu section -->
  <?php include('../includes/dashboard/menu.php') ?>


  <!-- Checkout section -->
  <section class="checkout">
    <div class="container">
      <?php
      //php code to access user id
      $user_ip = getIPAddress();

      if (!isset($_SESSION['email'])) {
        // include('user_login.php');
        echo "
          
      <div class='container'>
      <div class='form-wrapper'>
        <div class='section-title'>
          <h1 class='md-heading'>Please Fill the form below with the valid informations</h1>
        </div>
        <div class='row'>
          <div class='col-sm-12 col-md-12 col-sm-12'>
            <form class='sign_form' method='post'>
              <fieldset class='social-accounts'>
                <div class='apple text-center'>
                  <button>
                    <i class='fab fa-apple'></i>
                    <span>Continue With Apple</span>
                  </button>
                </div>
                <div class='google text-center'>
                  <button>
                    <i class='fab fa-google'></i>
                    <span>Continue With Google</span>
                  </button>
                </div>
              </fieldset>

              <div class='divider mb-5'>
                <hr />
                <p>OR</p>
              </div>

              <div class='sign-form'>
                <fieldset class='email'>
                  <label for='email'>Email <span>*</span></label>
                  <input type='email' name='email' id='email' required />
                </fieldset>

                <fieldset class='password'>
                  <label for='password'>Password <span>*</span></label>
                  <input type='password' name='password' id='password' required />
                </fieldset>
                <div class='mb-4'>
                  <label for='remember'><input type='checkbox' name='remember' id='remember' /> Remember Me</label>
                </div>
                <div class='submit-btn text-center'>
                  <button type='submit' name='user_login'>Login</button>
                </div>
                <div>
                  <h5 class='py-3'>Don't have accout <a class='' href='signup.php'>click here</a></h5>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
 ";
        // include('../includes/connect.php');
        // include('../functions/common_functions.php');
        if (isset($_POST['user_login'])) {
          $user_email = $_POST['email'];
          $user_password = $_POST['password'];
          $user_ip = getIPAddress();

          $select_query = "Select * from `user_table` where email='$user_email'";
          $result = mysqli_query($con, $select_query);
          $row_count = mysqli_num_rows($result);
          $row_data = mysqli_fetch_assoc($result);

          //cart item
          $select_query_cart = "Select * from `cart_details` where ip_address='$user_ip'";
          $result_cart = mysqli_query($con, $select_query_cart);
          $row_count_cart = mysqli_num_rows($result_cart);
          if ($row_count > 0) {
            $_SESSION['email'] = $user_email;
            if (password_verify($user_password, $row_data['password'])) {
              // echo"<script>alert('Login Successful')</script>";
              if ($row_count == 1 and $row_count_cart == 0) {
                $_SESSION['email'] = $user_email;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('account.php','_self')</script>";
              } else {
                $_SESSION['email'] = $user_email;
                echo "<script>alert('Login Successful')</script>";
                echo "<script>window.open('payment.php','_self')</script>";
              }
            } else {
              echo "<script>alert('Invalid Credentials')</script>";
            }
          } else {
            echo "<script>alert('Invalid Credentials')</script>";
          }
        }
      } else {
        $email_user = $_SESSION['email'];
        $get_user = "Select * from `user_table` where email='$email_user'";
        $result_user_id = mysqli_query($con, $get_user);
        $run_query = mysqli_fetch_array($result_user_id);
        $user_id = $run_query['user_id'];
        $total_price = 0;
        if (isset($_GET['id']) && isset($_GET['q'])) {
          $product_id = $_GET['id'];
          $cart_query_price = "Select `product_id` from `products` where product_id=$product_id";
        } else {
          $cart_query_price = "Select * from `cart_details` where ip_address='$user_ip'";
        }
        $invoice_number = mt_rand();
        $status = 'pending';
        $result_cart_price = mysqli_query($con, $cart_query_price);
        $count_products = mysqli_num_rows($result_cart_price);
        while ($row_price = mysqli_fetch_array($result_cart_price)) {
          $product_id = $row_price['product_id'];
          $quantity = $row_price['quantity']??$_GET['q'];
          $select_products = "Select * from `products` where product_id = $product_id";
          $run_price = mysqli_query($con, $select_products);
          while ($row_product_price = mysqli_fetch_array($run_price)) {
            $product_price = $row_product_price['product_price'];
            $discount = $row_product_price['discount'];
            $product_after_price = floor($product_price-$product_price*$discount/100);
            $prices =  $product_after_price*$quantity;
            $price =  array($prices);
            $product_values = array_sum($price);
            $total_price += $product_values;
          }
        }
        if ($count_products > 0) {
          if (isset($_GET['id']) && isset($_GET['q'])) {
            $get_prod = "Select `product_id` from `products` where product_id=$product_id";
            $quantity = $_GET['q'];
          } else {
            $get_prod = "Select * from `cart_details` where ip_address='$user_ip'";
            //getting quantity from cart
            $run_cart = mysqli_query($con, $get_prod);
            $get_item_quantity = mysqli_fetch_array($run_cart);
            $quantity = $get_item_quantity['quantity'];
          }

          if ($quantity == 0) {
            $quantity = 1;
            $subtotal = $total_price;
            // $_SESSION['actualamount']= $subtotal;
          } else {
            $quantity = $quantity;
            $subtotal = $total_price * $quantity;
            // $_SESSION['actualamount']= $subtotal;
          }
        } else {
          $quantity = 1;
          $subtotal = $total_price * $quantity;
          // $_SESSION['actualamount']= $subtotal;
        }

        if (isset($_POST['update_checkout'])) {
          $fname = $_POST['fname'];
          $lname = $_POST['lname'];
          $email = $_POST['email'];
          $phone = $_POST['phone'];
          $street_address = $_POST['street_address'];
          $city = $_POST['city'];
          $tole = $_POST['tole'];
          $appartment = $_POST['appartment'];

          if ($count_products > 0) {
            $order_id = mysqli_insert_id($con);
            $insert_query = "INSERT INTO `checkout`(`order_id`,`user_id`, `invoice_number`, `first_name`, `last_name`, `email`, `phone`, `street_address`, `city`, `tole`, `appartment`,`amount_due`,`total_products`, `date`, `ip_address`) VALUES ($order_id,$user_id,$invoice_number,'$fname','$lname','$email','$phone','$street_address','$city','$tole','$appartment',$subtotal,$count_products,NOW(),'$user_ip')";
            $result_insert = mysqli_query($con, $insert_query);

            //delete from cart
            $empty_query = "Delete from `cart_details` where ip_address='$user_ip'";
            $result_delete = mysqli_query($con, $empty_query);
          }
        }
        echo "
        <div class='row justify-content-center'>
          <div class='col-xl-12 col-md-12 col-sm-12'>
            <div class='section-title'>
              <h3>Billing Details</h3>
            </div>
            <div class='row'>
            <div class=' col checkout_form col-xl-6 col-md-6 col-sm-6'>
              <form class='billing_form' method='post'>
                <fieldset class='name'>
                  <div class='row'>
                    <div class='col-sm-6 col-md-6 col-sm-12'>
                      <label for='fname'>First Name</label>
                      <input type='text' name='fname' placeholder='First Name' required />
                    </div>
                    <div class='col-sm-6 col-md-6 col-sm-12'>
                      <label for='lname'>Last Name</label>
                      <input type='text' name='lname' placeholder='Last Name' required />
                    </div>
                  </div>
                </fieldset>
                <fieldset class='email'>
                  <label for='email'>Email Address</label>
                  <input type='email' name='email' placeholder='Email Address' />
                </fieldset>
                <fieldset class='tel'>
                  <label for='tel'>Phone Number</label>
                  <input type='tel' name='phone' placeholder='Phone Number' required />
                </fieldset>
                <fieldset class='address'>
                  <label for='address'> Address</label>
                  <input type='text' name='street_address' placeholder='Street Address' required />
                  <input type='text' name='city' placeholder='City' required />
                  <input type='text' name='tole' placeholder='Street Address' required />
                  <input type='text' name='appartment' placeholder='Appartment,Suit (optional)' />
                </fieldset>

          <div class='col-xl-12 col-md-12 col-sm-12 m-auto shopping_cart_bill'>
               <h4>Total Amount</h4>

               <table class='table'>
                <tbody>
                <tr>
                  <td>Cart Subtotal</td>
                  <td>Rs. $total_price</td>
                </tr>
                <tr>
                  <td>Shipping and Handing</td>
                  <td>Rs. 00.00</td>
                </tr>
                <tr>
                  <td>Vat</td>
                  <td>Rs.00.00</td>
                </tr>
                <tr>
                  <td><strong>Order Total</strong></td>
                  <td><strong>Rs. $total_price</strong></td>
                </tr>
              </tbody>
            </table>
            <div class='checkout_form_btn text-center w-100 '>
                  <button type='submit' name='update_checkout' class='more-btn w-100 m-auto'>Update</button>
                </div>
          </div>
              </form>
            </div>
            <div class=' col col-xl-6 col-md-6 col-sm-6 mt-2'>
            <div class='card border-0 col-xl-10 col-md-10 col-sm-10 m-auto'>
                            <div class='card-header bg-white card-2 d-flex '>
                                <p class='card-text text-muted mt-md-4  mb-2 space'>YOUR ORDER  </p>
                                <a href='../cart.php' class='col-md-8 justify-content-right small text-muted ml-2 cursor-pointer mt-md-4 space'>EDIT SHOPPING BAG</a>
                                <hr class='my-2'>
                            </div>";
        $ip = getIPAddress();
        $email = $_SESSION['email'];
        $select_user = mysqli_query($con, "Select `user_id` from `user_table` where email='$email'");
        $row_id = mysqli_fetch_assoc($select_user);
        $user_id = $row_id['user_id'];
        // echo "$user_id";
        if (isset($_GET['id']) && isset($_GET['q'])) {
          $get_buy = "Select * from `products` where product_id=$product_id";
          $qtty = $_GET['q'];
        } else {
          $get_buy = "Select * from `cart_details` where ip_address='$ip'";
        }
        $query_buy = mysqli_query($con, $get_buy);

        while ($row = mysqli_fetch_assoc($query_buy)) {
          $product_id = $row['product_id'];
          $product_image = $row['product_image'];
          $product_title = $row['product_title'];
          $product_category = $row['product_category'];
          if (isset($_GET['id']) && isset($_GET['q'])) {
            $price = $row['product_price'];
            $discount = $row['discount'];
            $product_price = floor($price-$price*$discount/100);
            $qtty = $_GET['q'];
          } else {
            $product_price = $row['product_price'];
            $qtty = $row['quantity'];
          }
          if ($qtty == 0) {
            $qtty = 1;
          } else {
            $qtty = $qtty;
          }
          $total_price_item = $product_price * $qtty;
          echo "
          <div class='row  justify-content-between text-success border-bottom px-1 py-3'>
          <div class='col-auto col-md-7'>
              <div class='media flex-column flex-sm-row'>
                  <img class=' img-fluid' src='../img/product_img/$product_category/$product_image' alt='$product_title'' width='62' height='62'>
                  <div class='media-body  my-auto'>
                      <div class='row '>
                          <div class='col-auto'><p class='mb-0'><b>$product_title</b></p><small class='text-muted'>$product_category</small></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class=' pl-0 flex-sm-col col-2  my-auto'> <p class='text-left'>$qtty</p></div>
          <div class=' pl-0 flex-sm-col col-3  my-auto '><p><b>$total_price_item /-</b></p></div>
      </div>
          ";
        }
        echo "
          </div>
      </div>

          <div class='col-md-12 mt-60'>
            <div class='payment-method'>
              <h3>Choose a Payment Method</h3>
              <ul class='accordion-box'>
                <li class='accordion block'>
                  <div class='acc-btn d-flex justify-content-between'>
                    <span> Other Payment</span>
                  </div>
                  <div class='acc-content' style='display: none'>
                  ";
                  $tax = $subtotal+30;
                  $t = 10;
                  $psc = 10;
                  $pdc = 10;
                  
                  ?>
                  
                  <form action=<?php echo $epay_url?> method='POST'>
                  <input value='<?php echo $tax?>' name='tAmt' type='hidden'>
                  <input value='<?php echo $subtotal?>' name='amt' type='hidden'>
                  <input value='<?php echo $t?>' name='txAmt' type='hidden'>
                  <input value='<?php echo $psc?>' name='psc' type='hidden'>
                  <input value='<?php echo $pdc?>' name='pdc' type='hidden'>
                  <input value=<?php echo $merchant_code?>  name='scd' type='hidden'>
                  <input value='<?php echo $pid?>' name='pid' type='hidden'>
                  <input value=<?php echo $successurl?> type='hidden' name='su'>
                  <input value=<?php echo $failedurl?> type='hidden' name='fu'>
                  <input value='Pay with Esewa Rs <?php echo $subtotal?>' type='submit' class='btn btn-primary'>
                  </form>

                  </div>
                </li>
                <?php
        if (isset($_GET['id']) && isset($_GET['q'])) {
          include('./direct_order.php');
        } else {
          include('./order.php');
        }
      ?>
        <li class='accordion block'>
          <form action="" method="post">
            <?php if (isset($_GET['id']) && isset($_GET['q'])) {
              $p_id = $_GET['id'];
              $qty = $_GET['q'];
              echo "<input type='hidden' name='p_id' value=' $p_id ' />
                  <input type='hidden' name='quantity' value='$qty' />
                  <input type='hidden' name='user_id' value='$user_id' />";
            } else {
              echo "<input type='hidden' name='user_id' value='$user_id' />";
            }
            ?>

            <button type='submit' name='order_submit'>Pay Offline</button>
          </form>
        <?php echo "</li>
              </ul>
            </div>
          </div>
        </div>";
      }
        ?>
    </div>
  </section>

  <!-- Footer -->
  <?php include('../includes/footer.php'); ?>

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

  <script src="../js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script type="text/javascript" src="../js/index.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>