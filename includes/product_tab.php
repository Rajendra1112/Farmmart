<section class="product section-wrapper ">
    <div class="container">
      <div class="row border-bottom">
        <div class="col-lg-3 col-md-12 ">
          <div class="product_category">
            <div class="product_category_title d-flex justify-content-between align-items-center">
              <!-- <i class="fa-solid fa-bars"></i> -->
              <h1 class="sm-heading">Categories</h1>
              <!-- <i class="fa-solid fa-angle-down"></i> -->
            </div>
            <div class="tab-nav d-flex flex-column align-items-start">
              <?php
              //calling catogey function
              getcategory();

              ?>
            </div>
          </div>
        </div>
        <div class="col-lg-9 col-md-12">
          <div id='firstTab' class='tab-detail text-center'>
            <div class='product_tab'>
              <div class='product_list'>
                <!-- //fetching products -->
                <?php
                //calling function
                search_product();
                featuredProduct();
                getproducts();
                get_unique_products();

                // $ip = getIPAddress();  
                // echo 'User Real IP Address - '.$ip;
                ?>

              </div>
              <div class="category-btn py-5">
                <?php
                viewmore();
                viewmoreall('all');
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

   <!-- flash sale  -->
   <section class="product section-wrapper mb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 border-bottom">
          <h4 class="mb-5 text-secondary">On Sale Now</h4>
          <div id='firstTab' class='tab-detail text-center'>
            <div class='product_tab'>
              <div class='product_list'>
                <!-- //fetching products -->
                <?php
                //calling function
                search_product();
                flashSale();
                get_unique_products();

                // $ip = getIPAddress();  
                // echo 'User Real IP Address - '.$ip;
                ?>

              </div>
              <div class="category-btn py-5">
                <?php
                viewmore();
                viewmoreall('flash_sale');
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

   <!-- discountes prev sale  -->
   <section class="product section-wrapper mb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 border-bottom">
          <h4 class="mb-5 text-secondary">Old products</h4>
          <div id='firstTab' class='tab-detail text-center'>
            <div class='product_tab'>
              <div class='product_list'>
                <!-- //fetching products -->
                <?php
                //calling function
                search_product();
                oldSale();
                get_unique_products();

                // $ip = getIPAddress();  
                // echo 'User Real IP Address - '.$ip;
                ?>

              </div>
              <div class="category-btn py-5">
                <?php
                viewmore();
                viewmoreall('old_product');
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>  

  <!-- //heavy discount -->
  <section class="product section-wrapper mb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 border-bottom">
          <h4 class="mb-5 text-secondary">Heavy Discount</h4>
          <div id='firstTab' class='tab-detail text-center'>
            <div class='product_tab'>
              <div class='product_list'>
                <!-- //fetching products -->
                <?php
                //calling function
                search_product();
                discount();
                get_unique_products();

                // $ip = getIPAddress();  
                // echo 'User Real IP Address - '.$ip;
                ?>

              </div>
              <div class="category-btn py-5">
                <?php
                viewmore();
                viewmoreall('discount');
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

    <!-- //trending today -->
    <section class="product section-wrapper mb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 border-bottom">
          <h4 class="mb-5 text-secondary">Trending Today</h4>
          <div id='firstTab' class='tab-detail text-center'>
            <div class='product_tab'>
              <div class='product_list'>
                <!-- //fetching products -->
                <?php
                //calling function
                search_product();
                trendingProduct();
                get_unique_products();

                // $ip = getIPAddress();  
                // echo 'User Real IP Address - '.$ip;
                ?>

              </div>
              <div class="category-btn py-5">
                <?php
                viewmore();
                viewmoreall('trending');
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

      <!-- //location based -->
      <?php if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $sel_location = mysqli_query($con,"Select address from user_table where email='$email'");
        $loc = mysqli_fetch_assoc($sel_location);
        $location = $loc['address']; ?>
      <section class="product section-wrapper mb-0">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 border-bottom">
          <h4 class="mb-5 text-secondary">In Your Area</h4>
          <div id='firstTab' class='tab-detail text-center'>
            <div class='product_tab'>
              <div class='product_list'>
                <!-- //fetching products -->
                <?php
                //calling function
                search_product();
                getproductsLocation();
                get_unique_products();

                // $ip = getIPAddress();  
                // echo 'User Real IP Address - '.$ip;
                ?>

              </div>
              <div class="category-btn py-5">
                <?php
                viewmore();
                viewmoreall('location');
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
 <?php 
}?>