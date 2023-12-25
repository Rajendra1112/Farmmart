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
  <title>Fresh - Digital Farm Nepal</title>
  <style>
    .header-image {
      width: 100%;
    }

    .header-image .container {
      width: 100%;
    }

    .active {
      background-color:black;
      color: white;
      padding: 5px 7px;
      margin-right: 3px;
    }
    
.contact-us{
  width: 80%;
  margin: 20px auto;
}
.contact-col{
  flex-basis: 48%;
  margin-bottom: 30px;
}
.contact-col div{
  display: flex;
  align-items: center;
  margin-bottom: 40px;
}
.contact-col div .fas{
  font-size: 28px;
  color: #f44336;
  margin: 10px;
  margin-right: 30px;
}
.contact-col div p{
  padding: 0;
}
.contact-col div h4{
  font-size: 20px;
  margin-bottom: 5px;
  color: #555;
  font-weight: 400;
}

.contact-col input, .contact-col textarea{
  width: 100%;
  padding: 15px;
  margin-bottom: 17px;
  outline: none;
  border: 1px solid #ccc;
  box-sizing: border-box;
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
  <section>
    <?php
    if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
      $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
      // $id = $_GET['supplier_id']??'';
      $select = "Select * from `user_table` where user_id=$id";
      $result = mysqli_query($con, $select);
      $user = mysqli_fetch_assoc($result);
      $user_img = $user['user_image'];
      echo "
      <div id='farmImage' class='carousel slide'>
        <div class='carousel-indicators'>
          <button type='button' data-bs-target='#farmImage' data-bs-slide-to='0' class='active' aria-current='true' aria-label='Slide 1'></button>
          <button type='button' data-bs-target='#farmImage' data-bs-slide-to='1' aria-label='Slide 2'></button>
          <button type='button' data-bs-target='#farmImage' data-bs-slide-to='2' aria-label='Slide 3'></button>
        </div>
        <div class='carousel-inner'>
          <div class='carousel-item active'>
            <img src='./user_area/user_images/$user_img' class='d-block w-100 ' alt='$user_img'>
            <div class='carousel-caption d-none d-md-block'>
              <h1>Drone Water Sprayer</h1>
              <p>The most impressive DJI spraying drone ever built. Best capacity, rotary atomization nozzles and industry-leading obstacle.</p>
            </div>
          </div>
          <div class='carousel-item'>
            <img src='./user_area/user_images/$user_img' class='d-block w-100' alt='$user_img'>
            <div class='carousel-caption d-none d-md-block'>
              <h1>Second slide label</h1>
              <p>Some representative placeholder content for the second slide.</p>
            </div>
          </div>
          <div class='carousel-item'>
            <img src='./user_area/user_images/$user_img' class='d-block w-100' alt='$user_img'>
            <div class='carousel-caption d-none d-md-block'>
              <h1>Third slide label</h1>
              <p>Some representative placeholder content for the third slide.</p>
            </div>
          </div>
        </div>
        <button class='carousel-control-prev' type='button' data-bs-target='#farmImage' data-bs-slide='prev'>
          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Previous</span>
        </button>
        <button class='carousel-control-next' type='button' data-bs-target='#farmImage' data-bs-slide='next'>
          <span class='carousel-control-next-icon' aria-hidden='true'></span>
          <span class='visually-hidden'>Next</span>
        </button>
      </div>";
    }
    ?>
  </section>
  <section class="sticky-top">
    <ul class=" farmer_nav navbar justify-content-center py-3">
      <li class="nav-item px-4 active">
        <a class="nav-link " aria-current="page" href="#farm_product">Products</a>
      </li>
      <li class="nav-item px-4">
        <a class="nav-link" href="#farm-plan">Plan</a>
      </li>
      <li class="nav-item px-4">
        <a class="nav-link" href="#farm-blog">Blogs</a>
      </li>
      <li class="nav-item px-4">
        <a class="nav-link" href="#contact">Contact</a>
      </li>
    </ul>

  </section>

  <section class="product  section-wrapper" id="farm_product">
    <div class="container">
      <div class="row justify-content-center border-bottom border-3" id="farm-products">
        <div class="col-lg-12 col-md-12 ">
          <div class="product_tab ">
            <div class="section-title">
              <h1 class="md-heading border-bottom w-25 m-auto">Our Products</h1>
            </div>
            <div class="product_list">
              <?php getproducts();
              ?>

            </div>
          </div>
        </div>
      </div>
      <!-- <div class="row py-3 justify-content-center border-bottom border-3 my-5 " id="farm-plan">
        <div class="section-title" id="farm-plans">
          <h1 class="md-heading border-bottom w-25 m-auto">Our Featured Plans</h1>
        </div>

        <?php
        getPlan();
        ?>


      </div> -->
      <div id="farm-blog" class="border-bottom border-3 my-5">
        <div class="section-title" id="farm-blog ">
          <h1 class="md-heading border-bottom w-25 m-auto">Our Blogs</h1>
        </div>
        <div class="row justify-content-center">
          <?php get_all_Blogs(); ?>
        </div>
      </div>

      <!-- contact us  -->
      <div id="contact" class="border-bottom border-3 my-5">
        <div class="section-title" id="farm-blog ">
          <h1 class="md-heading border-bottom w-25 m-auto">Contact Us</h1>
        </div>
        <div class="row justify-content-center">
        <section class="contact-us">
        <div class="row">
            <div class="contact-col">
                <div>
                    <i class="fas fa-home"></i>
                    <span>
                        <h4>Kathmandu, Budhanlkantha</h4>
                        <p>Budhanilkantha, chunikhel,Nepal</p>
                    </span>
                </div>
                <div>
                    <i class="fas fa-phone-square"></i>
                    <span>
                        <h4>+977 9810322739</h4>
                        <p>Open all Day, 24 hrs</p>
                    </span>
                </div>
                <div>
                    <i class="fas fa-envelope-open"></i>
                    <span>
                        <h4>sthaj1986@gmail.com</h4>
                        <p>Email us your query</p>
                    </span>
                </div>
            </div>
            <div class="contact-col">
                <form action="" method="post">
                    <input type="text" name="name" placeholder="Enter your name" required>
                    <input type="email" name="email" placeholder="Enter email address" required>
                    <textarea rows="8" name="message" placeholder="Message" required></textarea>
                    <button type="submit" class="hero-btn red-btn">Send Messages</button>
                </form>
            </div>
        </div>
    </section>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
<?php include('./includes/footer.php'); ?>

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
    function activeFarm() {
      var btns = document.querySelectorAll('.farmer_nav li');
      for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
          var current = document.querySelectorAll(".farmer_nav .active");
          if (current.length > 0) {   
          current[0].className = current[0].className.replace(" active", "");
          }
          this.className += " active";
        });
      }
    }
    activeFarm();
  </script>
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="./js/app.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>