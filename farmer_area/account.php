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
  if ($user_role == 'farmer') {
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
      <link rel="stylesheet" href="../css/admin.css" />
      <link rel="stylesheet" href="../css/user.css" />
      <link rel="stylesheet" href="../css/styles.css" />


      <!-- jquery -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">


      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Welcome <?php echo $_SESSION['username'] ?></title>
      <style>
        .edit_image {
          width: 100px;
          height: 100px;
          object-fit: contain;
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

      <!-- //cart function -->
      <?php
      cart();
      ?>

      <!-- offcanvas cart -->
      <?php include('../includes/cart_open.php'); ?>

      <!-- Account page -->
      <div class="container mt-4 mb-5">
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
              echo " 
          <div class=' user-image d-flex flex-column align-items-center bg-light text-center p-3'>
          <img class=' ' width='300px' height='200px' src='../user_area/user_images/$image'>
          <span class='font-weight-bold'>$name</span><span class='text-black-50'>$user_email</span><span> </span></div>
          ";
              ?>

              <ul>
                <li class=" naver">
                  <a href="account.php?dashboard" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-solid fa-plus pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Account</div>
                      <div class="link-desc">View & Manage orders and returns</div>
                    </div>
                  </a>
                </li>
                <li class="">
                  <a href="account.php?view_orders" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-solid fa-plus pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">View Orders</div>
                      <div class="link-desc">View & Manage orders and returns</div>
                    </div>
                  </a>
                </li>
                <li class="">
                  <a href="account.php?add_products" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-solid fa-plus pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Add Products</div>
                      <div class="link-desc">View & Manage orders and returns</div>
                    </div>
                  </a>
                </li>
                <li class="">
                  <a href="account.php?huge_product" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-solid fa-plus pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Sell Products</div>
                      <div class="link-desc">View & Manage orders and returns</div>
                    </div>
                  </a>
                </li>
                <li class="">
                  <a href="account.php?blogs" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-solid fa-plus pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Add/Edit Blogs</div>
                      <div class="link-desc">View & Manage Blogs</div>
                    </div>
                  </a>
                </li>
                <li class="">
                  <a href="account.php?plans" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-solid fa-plus pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Add/Edit Plans</div>
                      <div class="link-desc">View & Manage Plans</div>
                    </div>
                  </a>
                </li>
                <li class="">
                  <a href="account.php?view_products" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-box pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">My Products</div>
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
                  <a href="account.php?my_order" class="text-decoration-none d-flex align-items-start">
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
                  <a onclick="javascript:confirmationDelete($(this));return false;" href="./logout.php" class="text-decoration-none d-flex align-items-start">
                    <div class="fas fa-solid fa-right-from-bracket pt-2 me-3"></div>
                    <div class="d-flex flex-column">
                      <div class="link">Log Out</div>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
            <div class="mb-5"></div>
          </div>
          <div class="col-lg-9 col-md-12 my-lg-0 my-1">
            <?php

            if (isset($_GET['profile'])) {
              echo "<style>
              .sidebar{
                display:none;
              }
              </style>";
              include('./profile.php');
            }
            if (isset($_GET['view_orders'])) {
              include('../user_area/view_orders.php');
            }
            if (isset($_GET['blogs'])) {
              include('./blogs.php');
            }
            if (isset($_GET['plans'])) {
              include('./plans.php');
            }
            if (isset($_GET['add_products'])) {
              include('./add_products.php');
            }
            if (isset($_GET['huge_product'])) {
              include('./huge_product.php');
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
            if (isset($_GET['edit_product'])) {
              include('./edit_product.php');
            }
            if (isset($_GET['delete_service'])) {
              include('../dashboard/edit_delete_service.php');
            }
            if (isset($_GET['order'])) {
              include('../user_area/view_order.php');
            }
            // if (isset($_GET['edit_service'])) {
            //   include('../dashboard/edit_delete_service.php');
            // }
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
                // $experience = $row_query_data['experience'];
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
            }
            if (!(isset($_GET['profile'])or isset($_GET['view_orders']) or isset($_GET['order']) or isset($_GET['blogs']) or isset($_GET['plans']) or isset($_GET['add_products']) or isset($_GET['huge_product'])  or isset($_GET['view_products']) or isset($_GET['my_order']) or isset($_GET['dashboard']) or isset($_GET['product_id']) or isset($_GET['edit_product']) or isset($_GET['delete_service']))) {
              include('./home.php');
            }
            ?>
          </div>
        </div>
        <?php

        // if (isset($message)) {
        //   foreach ($message as $message) {
        //     echo '<div class="message" style="position:sticky; top:0; right:0;"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        //   };
        // }; ?>
      </div>


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
      <script src="../js/user.js"></script>
      <script src="../js/index.js"></script>
      <script src="../js/admin.js"></script>
      <script>
        if (window.history.replaceState) {
          window.history.replaceState(null, null, window.location.href);
        }
      </script>
      <script src="../js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

      <!-- <script>
        //add highlight
        var faqs_row = 0;

        function addfaqs() {
          html = '<li id="faqs-row' + faqs_row + '" class="border border-3 p-3">';
          html += '<input type="text" name="plan_highlight" id="" required> <span class="btn btn-danger" onclick="$(\'#faqs-row' + faqs_row + '\').remove();"> Delete</span>';
          // html += '';

          html += '</li>';
          $('#faqs').append(html);

          faqs_row++;
        }
      </script> -->
      <!-- logout conformation -->

      
      <script>
        
        function confirmationDelete(anchor) {
          var conf = confirm('Are you sure ?');
          if (conf)
            window.location = button.attr("name");
        }

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

    </body>

    </html>
<?php } else {
    echo "<script>window.open('../index.php','_self')</script>";
  }
} else {
  echo "<script>window.open('../user_area/user_login.php','_self')</script>";
} ?>