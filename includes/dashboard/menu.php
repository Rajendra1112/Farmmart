<section class="nav_bar">
    <div class="container">
      <div class="row justify-content-end align-items-center">
        <div class="nav_bar_left">
          <a href="../index.php">
            <img src="../img/company/fm.png" alt="fms" style="height: 60px;" />
          </a>
        </div>
        <div class="nav_bar_center">
          <ul class="menu_items d-flex justify-content-between d-none d-lg-flex">
            <li><a href="../index.php" class="active">Home</a></li>
            <li class="dropdown">
              <a href="../display_all_products.php">Products</a>
            </li>
            <li><a href="../suppliers.php">Suppliers</a></li>
            <li><a href="../farmers.php">Farmers</a></li>
            <li><a href="../blog.php">Blogs</a></li>
            <li><a href="../contact.php">Contact</a></li>
          </ul>
        </div>
        <div class="nav_bar_right text-end">
          <button class="profile pe-2">
          <a href="./account.php" class="text-dark font-weight-bold">
          <?php
            if(!isset($_SESSION['email'])){
              echo "<i class='fas fa-user'></i>";
            }else{
              $img_select =$_SESSION['email'];
              $select = "Select * from `user_table` where email='$img_select'";
              $result_img = mysqli_query($con,$select);
              $num_rows= mysqli_fetch_assoc($result_img);
              $user_img = $num_rows['user_image'];
              $user_name = $num_rows['username'];
              echo "<a class='text-dark' href = './account.php'><img class='rounded-circle'style='width:40px;' src='../user_area/user_images/$user_img' > $user_name</a>";
              $_SESSION['username'] = $user_name;
            }
            
            ?>
            
            </a>
          </button>
          <button class="cart pe-2">
            <i class="fas fa-cart-shopping"></i>
            <span class="total_cart_items"><?php cartItem();?></span>
          </button>
          <div class="burger_menu">
            <span class="burger_menu_btn"> </span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Mobile-Menu Items -->
  <nav class="nav justify-content-end">
    <ul class="nav_items">
      <li class="nav_item">
        <div class="mobile-header d-flex justify-content-between">
          <a href="#">
            <img src="../img/company/logo.png" alt="" />
          </a>
          <button class="close_nav">
            <i class="fas fa-xmark fa-2x"></i>
          </button>
        </div>
      </li>
      <li><a href="../index.php" class="active">Home</a></li>
      <li class="dropdown boarder">
        <a href="../products.php">Products</a>
        <ul class="dropdown_items">
          <?php

          $select_category = "Select * from `category`";
          $result_category = mysqli_query($con, $select_category);
          while ($row_data = mysqli_fetch_assoc($result_category)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];
            echo "<li><a href='../index.php?category=$category_title'>$category_title</a></li>";
          }
          ?>
        </ul>
      </li>
      <li><a href="../farmers.php">Vendors</a></li>
      <li><a href="../farmers.php">Farmers</a></li>
      <li><a href="../blog.php">Blogs</a></li>
      <li><a href="../contact.php">Contact</a></li>
    </ul>
  </nav>