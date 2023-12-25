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
    .profile-pic {
      width: 90px;
      height: 90px;
      border-radius: 100%;
      margin-right: 30px;
    }

    .pic {
      width: 180px;

      margin-right: 10px;
    }

    #product_detail_image img {
      height: 400px;
    }

    .vote {
      cursor: pointer;
    }

    .blue-text {
      color: #0091EA;
    }

    .content {
      font-size: 18px;
    }

    /* Rating bar width */
    .rating-bar {
      width: 300px;
      padding: 8px;
      border-radius: 5px;
    }

    /* The bar container */
    .bar-container {
      width: 100%;
      background-color: #f1f1f1;
      text-align: center;
      color: white;
      border-radius: 20px;
      cursor: pointer;
      margin-bottom: 5px;
    }

    .barcontainerStyle {
      height: 20px;
      background-color: #e0e0de;
      /* border-radius:50px; */
      margin: 20;
      width: 100%;
    }

    .barfillerStyle {
      background-color: green;
      height: 100%;
      border-radius: inherit;
      text-align: right;
      transition: width 1s ease-in-out;
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

  <!-- //adding cart function -->
  <?php
  cart();
  ?>


  <!-- offcanvas cart -->
  <?php include('./includes/offcanvas_cart.php'); ?>

  <!-- Product Detail -->
  <?php
  product_detail();
  ?>

  <!-- view_related products -->

  <div class='container'>
    <div class='row'>
      <div class='col-md-12'>
        <h1 class='text-center col-md-12'><span class=" border-bottom border-2 border-success">Related Products</span></h1>
        <div id='' class='tab-detail text-center col-md-12'>
          <div class='product_tab'>
            <?php
            related_products();
            ?>

            <?php
            viewmore_related();
            ?>
            <!-- review  -->
            <?php
            if (isset($_GET['product_id']) and isset($_GET['product_title'])) {
              $product_id = $_GET['product_id'];
              $product_title = $_GET['product_title'];
              $sel_review = mysqli_query($con, "Select * from `user_rating` where product_id=$product_id and status=1");
              $num_rows = mysqli_num_rows($sel_review);

            ?>
              <div class="container-fluid px-1 py-5 mx-auto">
                <div class="row justify-content-center">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-12 text-center mb-5">
                    <div class="card px-2 ">
                      <div class="head_rev d-flex justify-content-left bg-success text-white">
                        <p>Ratings & Reviews of <?php echo $product_title ?> </p>
                      </div>
                      <div class="row justify-content-left d-flex mt-3">
                        <div class="col-md-4 d-flex flex-column">
                          <?php
                          $rev_select = mysqli_query($con, "Select `rating` from `user_rating` where product_id=$product_id and status=1");
                          $countt = mysqli_num_rows($rev_select);
                          $count = mysqli_num_rows($rev_select);
                          $arr = array();
                          $rating_sum = 0;
                          $ratingNumber = 0;
                          $cont = 0;
                          $fiveStar = 0;
                          $fourStar = 0;
                          $threeStar = 0;
                          $twoStar = 0;
                          $oneStar = 0;
                          while ($a = mysqli_fetch_array($rev_select, MYSQLI_ASSOC)) {
                            $arr[] = $a['rating'];
                            $cont += 1;

                            if ($a['rating'] == 5) {
                              $fiveStar += 1;
                            } else if ($a['rating'] == 4) {
                              $fourStar += 1;
                            } else if ($a['rating'] == 3) {
                              $threeStar += 1;
                            } else if ($a['rating'] == 2) {
                              $twoStar += 1;
                            } else if ($a['rating'] == 1) {
                              $oneStar += 1;
                            }
                          }
                          $arr = array_filter($arr);
                          $countt = count($arr) == 0 ? 1 : count($arr);
                          $average = 0;
                          $average = array_sum($arr) / $countt;
                          // $avg = floor($average * 2) / 2;
                          $avg = floor($average);
                          ?>
                          <div class="rating-box">
                            <h1 class="pt-4"><?php echo round($average, 1) ?><small style="font-size: 28px; color:#777676; ">/5</small></h1>
                          </div>
                          <div>
                            <?php
                            for ($i = 0; $i < 5; $i++) {
                              echo "
                               
                                <span class='fa fa-star star mx-1'></span>";
                            }
                            echo "<br><span style='color:#777676; font-size: 14px;'>($count Ratings)</span>";

                            ?>
                            <script>
                              const star = document.querySelectorAll('.star');
                              for (var i = 0; i < <?php echo $avg ?>; i++) {
                                star[i].classList.add('text-success');

                              }
                              <?php
                              if (is_float($average)) {
                                $avg = $avg;
                                echo "
                              star[$avg].classList.remove('fa-star');
                              star[$avg].classList.add('fa-star-half-alt');
                              star[$avg].classList.add('text-success');";
                              }
                              ?>
                            </script>
                          </div>
                        </div>
                        <div class="col-md-8">
                          <div class="rating-bar0 justify-content-center">
                            <table class="text-left mx-auto">
                              <?php
                              $ratingVal = ["Terrible", "Poor", "Average", "Good", "Excellent"];
                              $ratingCount = [$oneStar, $twoStar, $threeStar, $fourStar, $fiveStar];
                              for ($i = 4; $i >= 0; $i--) {
                                $m = $i;
                                $ii = $i + 1;
                                $query = mysqli_query($con, "Select `rating` from `user_rating` where product_id=$product_id and rating=$ii and status=1");
                                $num_rows_rating = mysqli_num_rows($query);
                                if ($ratingCount[$i] == 0) {
                                  $w = 0;
                                } else {
                                  $w = $num_rows_rating / $countt * 100;
                                }

                                echo "<tr>
                                <td class='rating-label'>$ratingVal[$m]</td>
                                <td class='rating-bar'>

                                    <div class = 'barcontainerStyle'>
                                    <div class='barfillerStyle' style='width:$w%'>
                                        <span class='barlabelStyle' ></span>
                                    </div>
                                </div>
                                  
                                </td>
                                <td class='text-right'>($num_rows_rating)</td>
                              </tr>";
                              }
                              ?>

                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="rev-body d-flex flex-column my-5 border-bottom border-top py-2">
                        <p><span class=" border-2 border-success mb-3 border-bottom">Product Reviews</span></p>
                        <?php
                        if ($num_rows > 0) {
                          while ($review = mysqli_fetch_assoc($sel_review)) {
                            $username = $review['username'];
                            $date = $review['date'];
                            $rating = $review['rating'];
                            $reviews = $review['review'];
                            $user_id = $review['user_id'];
                            $image = $review['image'];
                            $sel_user = mysqli_query($con, "Select user_image from user_table where user_id=$user_id");
                            $user_image = mysqli_fetch_assoc($sel_user);
                            $user_img = $user_image['user_image'];

                        ?>
                            <div class="card mt-3 py-3">
                              <div class="row d-flex w-100 justify-content-end">
                                <div class=" justify-content-end">
                                  <img class="profile-pic shadow-xl" src="./user_area/user_images/<?php echo $user_img ?> " alt='user'>
                                </div>
                                <div class="d-flex flex-column justify-content-left">
                                  <h3 class="mt-2 mb-0"><?php echo $username ?></h3>
                                  <div>
                                    <p class="text-left"><span class="text-muted"></span>
                                      <?php
                                      for ($j = 0; $j < $rating; $j++) {
                                        echo "<span class='fa fa-star text-success user-star ml-3'></span>";
                                      }
                                      $rem = 5 - $rating;
                                      for ($j = 0; $j < $rem; $j++) {
                                        echo "<span class='fa fa-star user-star ml-3'></span>";
                                      }
                                      ?>
                                    </p>
                                  </div>

                                </div>
                                <div class="ml-auto">
                                  <p class="text-muted pt-5 pt-sm-3"><?php echo $date ?></p>
                                </div>
                              </div>
                              <div class="row text-left">
                                <!-- <h4 class="blue-text mt-3">"An awesome activity to experience"</h4> -->
                                <p class="content"><?php echo ucwords($reviews)  ?></p>
                              </div>
                              <div class="row d-flex justify-content-center text-left">
                                <img class="pic" src="./user_area/rating_img/<?php echo $image ?>" alt="rev_img">
                              </div>
                              <!-- <div class="row text-left mt-4">
                          <div class="like mr-3 vote">
                            <img src="https://i.imgur.com/mHSQOaX.png"><span class="blue-text pl-2">20</span>
                          </div>
                          <div class="unlike vote">
                            <img src="https://i.imgur.com/bFBO3J7.png"><span class="text-muted pl-2">4</span>
                          </div>
                        </div> -->
                            </div>
                        <?php }
                        } else {
                          echo "<h4>No reviews found for this product</h4>";
                        } ?>

                      </div>
                    </div>

                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
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
  <?php include('./includes/search.php') ?>

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
        <img src='./img/product_img/$product_category/$product_image' alt='$product_title' />
      </div>
    </div>
  </div>
  <script>
    function changeMainImage(newImageSrc) {
      // Get the main image element
      var mainImage = document.getElementById('product_detail_image').getElementsByTagName('img')[0];

      // Set the new image source
      mainImage.src = newImageSrc;

    }

    var thumbnailImages = document.querySelectorAll('.detail_img img');

  thumbnailImages.forEach(function (thumbnail) {
    thumbnail.addEventListener('click', function () {
      changeMainImage(thumbnail.src);
    });
  });
  </script>


  <script type="text/javascript">
    <?php require_once('js/index.js') ?>
  </script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>