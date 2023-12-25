<!-- include connect file -->
<?php
include('includes/connect.php');
include('functions/common_functions.php');
session_start();
include('./includes/email/code.php');
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

  <!-- offcanvas cart -->
  <?php include('./includes/offcanvas_cart.php'); ?>

  <!-- Contact Info -->
  <div class="contact section-wrapper">
    <div class="container">
        <div class="alert"></div>
      <div class="row">
        <div class="col-xl-4 col-md-6 col-sm-12">
          <div class="contact_method">
            <div class="contact_method_detail">
              <i class="fas fa-phone"></i>
              <span>Phone</span>
              <a href="tel:9812767046">+977 9812767046</a>
              <a href="tel:9812767046">1660-01-10101</a>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12">
          <div class="contact_method">
            <div class="contact_method_detail">
              <i class="fas fa-envelope-open-text"></i>
              <span>Email</span>
              <a href="mailto:support@digitalfarm.com">support@digitalfarm.com</a>
              <a href="mailto:support@digitalfarm.com">info@gmail.com</a>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 col-sm-12">
          <div class="contact_method">
            <div class="contact_method_detail">
              <i class="fas fa-location"></i>
              <span>Address</span>
              <span>Kathmandu Nepal</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Contact Form -->

  <div class="contact_form">
    <div class="container">
      <div class="section-title">
        <h1 class="sm-heading">Contact From</h1>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-8 col-md-8 col-sm-12">
          <form class="inqury_form" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Your Name" required />
            <input type="email" name="email" placeholder="Your Email" required />
            <input type="tel" name="phone" placeholder="Your Phone No." required />
            <select name="inqury_type" class="inqury_options">
              <option value="support">Support</option>
              <option value="inqury" selected>Inqury</option>
              <option value="report">Report</option>
            </select>
            <div>
              <input type="file" class="m-0" name="contact_image" id="imageInput" onclick="rating()" />
              <img id="previewImage" style="width: 100px;">
            </div><br>
            <textarea name="message" placeholder="message"></textarea>
            <input type="submit" name="submit_contact" value="Submit" />
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include('./includes/footer.php'); ?>

  <!-- back to top -->
  <button id="back_to_top">
    <i class="fas fa-angle-up"></i>
  </button>

  <!-- Search -->
  <?php include('./includes/search.php')?>

  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
  <script>
    <?php include("./js/index.js"); ?>
  </script>
  <script>
    function rating() {
      const imageInput = document.getElementById("imageInput");
      const previewImage = document.getElementById("previewImage");

      // add an event listener to the input element
      imageInput.addEventListener("change", function() {
        // create a new FileReader object
        const reader = new FileReader();

        // define what should happen when the reader loads the file
        reader.onload = function(event) {
          // set the src attribute of the preview image to the data URL
          previewImage.src = event.target.result;
        };

        // read the file as a data URL
        reader.readAsDataURL(imageInput.files[0]);
      });
    }

   //auto close alert
    setTimeout(()=>{
      document.querySelector('.alert').style.display = "none";
    },5000);
  </script>

  <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>