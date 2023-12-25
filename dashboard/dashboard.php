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
  if ($user_role == 'admin') {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" />

    <!-- Fontawesome -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <link rel="stylesheet" href="../css/fontawesome.min.css" />

    <!-- FavIcon -->
    <link rel="shortcut icon" href="../img/company/favicon.png" type="image/x-icon" />

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/styles.css" />

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Digital Farm</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.4.4.min.js"></script> 
    <style>
      .dash_menu_items_item a .active{
        color: #78c473;
      }
    </style>
  </head>
  <body>
    <!-- dashboard Header -->
    <header class="header" style="z-index:100;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-6 col-sm-6">
            <div class="header_left">
              <button class="dashboard_burger">
                <i class="fas fa-bars"></i>
              </button>
              <a href="#">
                <img src="../img/company/favicon.png" alt="" />
              </a>
              <a href="../index.php">
                <i class="fas fa-home"></i>
                <span class="d-none d-md-inline-block">FarmMart</span>
              </a>
            </div>
          </div>
          <div class="col-xl-6 col-sm-6">
            <div class="user-profile text-end">
              <button>
              <?php
                  $admin_name = $_SESSION['email'];
                  $select_name= "Select * from `user_table` where email='$admin_name'";
                  $result_query = mysqli_query($con,$select_name);
                  $row = mysqli_fetch_assoc($result_query);
                  $name = $row['username'];
                  $image = $row['user_image'];
                  echo "<a class='text-dark' href = './dashboard/dashboard.php'><img class='rounded-circle'style='width:40px;' src='../user_area/user_images/$image' ></a>";
                  echo "<span> $name</span>";
                  ?>
              </button>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Dashboard Dashboard content -->
    <div class="dashboard-body-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2 p-0">
            <!-- Admin Menu -->
            <nav class="dash_menu">
              <ul class="dash_menu_items">
                <li class="dash_menu_items_item active">
                  <a href="dashboard.php?dashboard">
                    <i class="fa-solid fa-gauge"></i>
                    Dashboard
                  </a>
                </li>
                <li class="dash_menu_items_item dash_menu_dropdown">
                  <a href="#">
                    <i class="fa-solid fa-upload"></i>
                    Post
                  </a>
                  <ul class="dash_menu_dropdown_items">
                    <li>
                      <a href="dashboard.php?post">All Post</a>
                    </li>
                    <li>
                      <a href="dashboard.php?category">Add New Category</a>
                    </li>
                    <li>
                      <a href="dashboard.php?product-add">Add New Product</a>
                    </li>
                    <li>
                      <a href="dashboard.php?blog-add">Add New Blog</a>
                    </li>
                    <li>
                      <a href="dashboard.php?plan">Add New Plan</a>
                    </li>
                    <li>
                      <a href="dashboard.php?edit_contact">Edit Contact</a>
                    </li>
                  </ul>
                </li>
                <li class="dash_menu_items_item">
                  <a href="dashboard.php?comments">
                    <i class="fas fa-comments"></i>
                    Comments
                  </a>
                </li>
                <li class="dash_menu_items_item">
                  <a href="dashboard.php?media">
                    <i class="fa-solid fa-image"></i>
                    Media
                  </a>
                </li>
                <li class="dash_menu_items_item">
                  <a href="dashboard.php?users">
                    <i class="fas fa-people-group"></i>
                    Users
                  </a>
                </li>
                <li class="dash_menu_items_item">
                  <a href="dashboard.php?review">
                    <i class="fas fa-people-group"></i>
                    Reviews
                  </a>
                </li>
                <li class="dash_menu_items_item">
                  <a href="dashboard.php?product_request">
                    <i class="fa-brands fa-product-hunt"></i>
                    Product Request
                  </a>
                </li>
                <li class="dash_menu_items_item">
                  <a href="dashboard.php?view_products">
                  <i class="fa-brands fa-product-hunt"></i>
                    My Products
                  </a>
                </li>
                <li class="dash_menu_items_item">
                  <a href="dashboard.php?products&all">
                  <i class="fa-brands fa-product-hunt"></i>
                    All Products
                  </a>  
                </li>
                <li class="dash_menu_items_item">
                  <a href="dashboard.php?users">
                  <i class="fa-solid fa-blog"></i>
                    My Blogs
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="col-lg-10 col-md-12 col-sm-12"><div class="container">
              <div class="new_product">
            <?php
            // include_once('das.php');
            // dashboard blog
           
            // post blog
              if(isset($_GET['post'])){
                include('post.php');
              }
              // add-product blog
              if(isset($_GET['product-add'])){
                include('product-add.php');
              }
              // add blog blog
              if(isset($_GET['blog-add'])){
                include('blog-add.php');
              }
              // add-plan blog
              if(isset($_GET['plan'])){
                include('plan.php');
              }
              // view my contact
              if(isset($_GET['edit_contact'])){
                include('./edit_contact.php');
              }
              // add-category blog
              if(isset($_GET['category'])){
                include('insert_category.php');
              }
              // view my product
              if(isset($_GET['view_products'])){
                include('./view_products.php');
              }
              // view all product
              if(isset($_GET['products']) ){
                echo "<div class='col-lg-11 col-md-12'>
                <div id='firstTab' class='tab-detail text-center'>
                <h3 class='pb-2 mb-3  border-bottom border-2 border-success'>All Products</h3>
                <div class='product_tab'>
                  <div class='product_list'>";
                    get_all_products();
                  echo "</div>
                </div>
              </div>
            </div>";
              }
              // users
              if(isset($_GET['users']) or isset($_GET['search_user'])){
                include('user.php');
              }
              //review and ratings
              if(isset($_GET['review']) or isset($_GET['search_review'])){
                include('review.php');
              }
              if(isset($_GET['product_request'])){
                include('request_product.php');
              }
              if(isset($_GET['dashboard']) ){
                //count users
                $select_users = "Select * from `user_table`";
                $query_users = mysqli_query($con , $select_users);
                $num_of_users = mysqli_num_rows($query_users);

                //count products
                $select_products = "Select * from `products`";
                $query_product = mysqli_query($con , $select_products);
                $total_products = mysqli_num_rows($query_product);

                //count blogs
                $select_blogs = "Select * from `blogs`";
                $query_blog = mysqli_query($con , $select_blogs);
                $total_blogs = mysqli_num_rows($query_blog);

                echo "
                
                <div class='col-lg-10 col-md-12 col-sm-12'>
            <div class='container'>
              <div class='row dashboard_content justify-content-center'>
                <!-- Seller Dashboard -->
                <div class='col-xl-4 col-md-6 col-sm-12'>
                  <div class='dashboard_item'>
                    <i class='fa-solid fa-check'></i>
                    <h4>Product Published</h4>
                    <span>$total_products</span>
                  </div>
                </div>
                <div class='col-xl-4 col-md-6 col-sm-12'>
                  <div class='dashboard_item'>
                    <i class='fa-solid fa-check'></i>
                    <h4>Blog Published</h4>
                    <span>$total_blogs</span>
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
                    <i class='fa-solid fa-check'></i>
                    <h4>Toal Users</h4>
                    <span>$num_of_users</span>
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
            ?>
          </div>
        </div>
      </div>
        </div>
      </div>
    </div>
    
    <script>
      function Delete(){
        return confirm("Are you seur??");
      }
    </script>
    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<script>
    function activeCat() {
      var btn = document.querySelector('.dash_menu_items_item');
      var btns = document.querySelectorAll('.dash_menu_items_item a');
      for (var i = 0; i < btns.length; i++) {
        if (decodeURI(window.location.href).includes(btns[i].getAttribute('href'))) {
          btns[i].classList.add('active');
        }
      }
    }
    activeCat();
  </script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/admin.js"></script>
  </body>
</html>
<?php }
else{
  echo "<script>window.open('../index.php','_self')</script>";
}
}
?>