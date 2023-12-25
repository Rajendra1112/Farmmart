<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
session_start();
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  $select_role = "select * from `user_table` where email='$email'";
  $result_role = mysqli_query($con, $select_role);
  $num_rows = mysqli_fetch_assoc($result_role);
  $user_role = $num_rows['role'];
  if ($user_role == 'vendor' || $user_role == 'consumer') {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <!-- Bootstrap -->
      <link rel="stylesheet" href="../css/bootstrap.min.css" />

      <!-- Font-awesome icons -->
      <link rel="stylesheet" href="../css/all.min.css" />
      <link rel="stylesheet" href="../css/fontawesome.min.css" />

      <!-- FavIcon -->
      <link rel="shortcut icon" href="../img/company/favicon.png" type="image/x-icon" />

      <!-- Custom style -->
      <link rel="stylesheet" href="../css/admin.css" />
      <link rel="stylesheet" href="../css/user.css" />
      <link rel="stylesheet" href="../css/styles.css" />
      


      <!-- jquery -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
      <title>Welcome <?php echo $_SESSION['username'] ?></title>
      <style>
        .edit_image {
          width: 100px;
          height: 100px;
          object-fit: contain;
        }

        .rating-wrapper {
          align-self: center;

          display: inline-flex;
          direction: rtl !important;
          padding: 1.5rem 2.5rem;
          margin-left: auto;
        }

        .rating-wrapper label {
          color: black;
          cursor: pointer;
          display: inline-flex;
          font-size: 3rem;
          padding: 1rem 0.6rem;
          transition: color 0.5s;
        }



        .rating-wrapper input {
          height: 100%;
          width: 100%;
        }

        .rating-wrapper input {
          display: none;
        }

        .rating-wrapper label:hover,
        .rating-wrapper label:hover,
        .rating-wrapper input:checked~label {
          color: green;
        }

        .rating-wrapper label:hover,
        .rating-wrapper label:hover~label,
        .rating-wrapper input:checked~label {
          color: green;
        }

        /* text area  */
        textarea {
          padding: 15px 20px;
          border-radius: 10px;
          box-sizing: border-box;
          color: #616161;
          border: 1px solid #F5F5F5;
          font-size: 16px;
          letter-spacing: 1px;
          height: 220px ;
          width: 100%;
        }

        textarea:focus {
          -moz-box-shadow: none !important;
          -webkit-box-shadow: none !important;
          box-shadow: none !important;
          border: 1px solid #00C853 !important;
          outline-width: 0 !important;
        }

        .product_rating{
          display: flex;
          flex-direction: column;
        }
        .product_rating .product_name p{
          font-size: 25px;
        }
        .review_section .purchase .time{
          color: #79807f;
        }

      </style>
    </head>

    <body>
      <!-- Top header -->
      <header class="header-wrapper">
        <div class="container">
          <div class="row">
            <div class="d-none d-lg-block col-lg-12">
              <div class="grid-container d-flex justify-content-between">
                <div class="about d-flex align-items-center">
                  <div class="location">
                    <i class="fas fa-location-dot"></i>
                    <span>New Baneshwor Kathmandu Nepal</span>
                  </div>
                  <div class="email">
                    <i class="fas fa-envelope-open-text"></i>
                    <a href="mailto:support@digitalfarm.com">support@digitalfarm.com</a>
                  </div>
                  <div class="phone">
                    <i class="fas fa-phone"></i>
                    <a href="tel:9812767046">+977 9812767046</a>
                  </div>
                </div>
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
            </div>
          </div>
        </div>
      </header>
      <!-- 
    Menu bar 
      1. Logo
      2. Navigation Menu 1 dropdown 1 mega menu for desktop and no mega menu for mobile
      
    -->

      <!-- Menu section -->
      <?php include('../includes/dashboard/menu.php') ?>

      <!-- //cart function -->
      <?php
      cart();
      ?>

      <!-- offcanvas cart -->
      <?php include('../includes/cart_open.php'); ?>

      <!-- Account page -->
      <div class="container mt-4 mb-4">
        <div class="row">
          <div class="col-lg-3 my-lg-0 my-md-1">
            <div id="sidebar" class="bg-purple">
              <?php
              $user_email = $_SESSION['email'];
              $user_image_query = "Select * from `user_table` where email='$user_email'";
              $user_image = mysqli_query($con, $user_image_query);
              $row_image = mysqli_fetch_array($user_image);
              $image = $row_image['user_image'];
              $name = $row_image['username'];
              $userId = $row_image['user_id'];
              $role = $row_image['role'];
              echo " 
          <div class=' user-image d-flex flex-column align-items-center bg-light text-center p-3 py-5'>
          <img class='rounded-circle ' width='100px' src='./user_images/$image'>
          <span class='font-weight-bold'>$name</span><span class='text-black-50'>$user_email</span><span> </span></div>
          ";
              ?>

              <ul>
                <li class="naver">
                  <a href="account.php?dashboard" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-box pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Dashboard</div>
                      <div class="link-desc">View & Manage orders and returns</div>
                    </div>
                  </a>
                </li>
                <li class="">
                  <a href="account.php?my_order" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-box pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Pending Order</div>
                      <div class="link-desc">View & Manage orders and returns</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="account.php?complete_order" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-box-open pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">My Orders</div>
                      <div class="link-desc">View & Manage orders and returns</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="account.php?profile" class="text-decoration-none d-flex align-items-start">
                    <div class="far fa-address-book pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Address Book</div>
                      <div class="link-desc">View & Manage Addresses</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="account.php?profile" class="text-decoration-none d-flex align-items-start">
                    <div class="far fa-user pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">My Profile</div>
                      <div class="link-desc">Change your profile details & password</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="#" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-headset pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Help & Support</div>
                      <div class="link-desc">Contact Us for help and support</div>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="./logout.php" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-solid fa-right-from-bracket pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Log Out</div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-9 my-lg-0 my-1">
            <?php getUserDetails();
            if (isset($_GET['profile'])) {
              
              include('./profile.php');
            }
            if (isset($_GET['my_review'])) {
              include('./my_review.php');
            }
            if (isset($_GET['myRatings'])) {
              include('./my_review.php');
            }
            if (isset($_GET['view_orders'])) {
              include('../user_area/view_orders.php');
            }
            if (isset($_GET['myRatings'])) {
              include('./my_review.php');
            }
            if (isset($_GET['view_products'])) {
              include('../dashboard/view_products.php');
            }
            if (isset($_GET['product_id'])) {
              include('./product_details.php');
            }
            if (isset($_GET['my_order'])) {
              include('../user_area/my_order.php');
            }
            if (isset($_GET['order'])) {
              include('../user_area/view_order.php');
            }
            if (isset($_GET['complete_order'])) {
              include('../user_area/complete_order.php');
            }
            if (isset($_GET['confirm_payment'])) {
              include('../user_area/confirm_payment.php');
            }
            
            if (isset($_GET['dashboard'])) {
              //fetch farmers
              $role = 'farmer';
              $select_query = "Select * from `user_table` where role='$role'";
              $result_query = mysqli_query($con, $select_query);

              // echo "<h1>$row_product_data</h1>";
              while ($row_query_data = mysqli_fetch_assoc($result_query)) {
                $role_company_name = $row_query_data['role_company_name'];
                $user_image = $row_query_data['user_image'];
                $address = $row_query_data['address'];
                $Area = $row_query_data['Area'];
                $experience = $row_query_data['experience'];
                $user_id = $row_query_data['user_id'];

                //product count
                $select_product_query = "Select * from `farmer_products` where user_id='$user_id'";
                $result_product_query = mysqli_query($con, $select_product_query);
                $row_product_data = mysqli_num_rows($result_product_query);
              }
              echo "
          <div class='col-lg-10 col-md-12 col-sm-12'>
          <div class='container'> 
            <div class='row dashboard_content justify-content-center'>
              <!-- Seller Dashboard -->
              <div class='col-xl-4 col-md-6 col-sm-12'>
                <div class='dashboard_item'>
                <i class='fa-solid fa-upload'></i>
                  <h4>Product Published</h4>
                  <span>200</span>
                </div>
              </div>
              <div class='col-xl-4 col-md-6 col-sm-12'>
                <div class='dashboard_item'>
                <i class='fa-solid fa-blog'></i>
                  <h4>Blog Published</h4>
                  <span>200</span>
                </div>
              </div>
              <div class='col-xl-4 col-md-6 col-sm-12'>
                <div class='dashboard_item'>
                  <i class='fa-solid fa-check'></i>
                  <h4>Product Sold</h4>
                  <span>200</span>
                </div>
              </div>
              <!-- Dashboard for Admin -->
              <div class='col-xl-4 col-md-6 col-sm-12'>
                <div class='dashboard_item'>
                <i class='fa-solid fa-users'></i>
                  <h4>Toal Users</h4>
                  <span>200</span>
                </div>
              </div>
              <div class='col-xl-4 col-md-6 col-sm-12'>
                <div class='dashboard_item'>
                  <i class='fa-solid fa-check'></i>
                  <h4>User Registration per Day</h4>
                  <span>200</span>
                </div>
              </div>
              <div class='col-xl-4 col-md-6 col-sm-12'>
                <div class='dashboard_item'>
                  <i class='fa-solid fa-check'></i>
                  <h4>Daily Site Visitors</h4>
                  <span>200</span>
                </div>
              </div>
            </div>
          </div>
        </div>
          ";
            } else {
              // include('./home.php');
            }
            ?>
          </div>
        </div>

      </div>

      <!-- Footer -->
      <?php include('../includes/footer.php')?>

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
      <script src="../js/user.js"></script>
      <script> <?php include("../js/index.js");?></script>
      <script>                                  
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>
      <script>
        
 
        function active() {
          var header = document.getElementById('sidebar');
          var btn = document.querySelectorAll('#sidebar ul li');
          var btns = document.querySelectorAll('#sidebar ul li a');
          for (var i = 0; i < btns.length; i++) {
            if ((window.location.href).includes(btns[i].getAttribute('href'))) {
              btn[i].classList.add('active');
            }
          }
        }
        active();
      </script>


      <script>
        const edit = document.getElementById('edit');
        edit.addEventListener('click', () => {
          const edit_plan = document.querySelector('.edit_plan');
          edit_plan.style.display = 'block';
        })
      </script>
      <script src="../js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

      <!-- //pop up  -->

    </body>

    </html>
<?php } else {
    echo "<script>window.open('../index.php','_self')</script>";
  }
} else {
  echo "<script>window.open('../user_area/user_login.php','_self')</script>";
} ?>