<section class="nav_bar">
    <div class="container">
      <div class="row justify-content-end align-items-center">
        <div class="nav_bar_left">
          <a href="index.php">
            <img src="./img/company/fm.png" style="height: 60px;" alt="fm" />
          </a>
        </div>
        <div class="nav_bar_center">
          <ul class="menu_items d-flex justify-content-between d-none d-lg-flex">
            <li><a href="index.php" class="">Home</a></li>
            <li class="dropdown">
              <a href="display_all_products.php">Products</a>
              <ul class="dropdown_items border px-2 py-0">
                <?php

                $select_category = "Select * from `category`";
                $result_category = mysqli_query($con, $select_category);
                while ($row_data = mysqli_fetch_assoc($result_category)) {
                  $category_title = $row_data['category_title'];
                  $category_id = $row_data['category_id'];
                  echo "<li class='bprder-1 border-bottom'><a href='display_all_products.php?category=$category_title'>$category_title</a></li>";
                }

                ?>
              </ul>
            </li>
            <li><a href="suppliers.php">Suppliers</a></li>
            <li><a href="farmers.php">Farmers</a></li>
            <li><a href="blog.php">Blogs</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php
            if (!isset($_SESSION['email'])) {
              echo "<li><a href='user_area/user_login.php'>LogIn</a></li>";
            } else {
              echo "<li><a href='user_area/logout.php'>LogOut</a></li>";
            }
            ?>
          </ul>
        </div>
        <div class="nav_bar_right text-end">
          <?php include('./includes/profile_icon.php');?>
          <button class="search-icon pe-2">
            <i class="fas fa-magnifying-glass"></i>
          </button>
          <button class="cart pe-2">
            <i class="fas fa-cart-shopping"></i>
            <span class="total_cart_items"><?php cartItem(); ?></span>
          </button>
          <button class="cart order pe-2">
          <i class="fa-solid fa-globe"></i>
            <span class="total_cart_items"><?php orderItem();?> </span>
          </button>
          <div class="burger_menu">
            <span class="burger_menu_btn"> </span>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
     function activeNav() {
          var btn = document.querySelectorAll('.menu_items');
          var btns = document.querySelectorAll('.menu_items li a');
          for (var i = 0; i < btns.length; i++) {
            if (decodeURI(window.location.pathname).includes(btns[i].getAttribute('href'))) {
              btns[i].classList.add('active');

            }
          }
        }
        activeNav();
      </script>
  </script>