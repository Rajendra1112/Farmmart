<nav class="nav justify-content-end">
    <ul class="nav_items">
      <li class="nav_item">
        <div class="mobile-header d-flex justify-content-between">
          <a href="index.php">
            <img src="./img/company/fm.png" style="height: 60px;" alt="fms" />
          </a>
          <button class="close_nav">
            <i class="fas fa-xmark fa-2x"></i>
          </button>
        </div>
      </li>
      <li><a href="index.php" class="active">Home</a></li>
      <li class="dropdown">
        <a href="#">Products</a>
        <ul class="dropdown_items">
          <?php

          $select_category = "Select * from `category`";
          $result_category = mysqli_query($con, $select_category);
          while ($row_data = mysqli_fetch_assoc($result_category)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];
            echo "<li><a href='display_all_products.php?category=$category_title'>$category_title</a></li>";
          }

          ?>
        </ul>
      </li>
      <li><a href="display_all_products.php">Vendors</a></li>
      <li><a href="farmers.php">Farmers</a></li>
      <li><a href="blog.php">Blogs</a></li>
      <li><a href="contact.php">Contact</a></li>

      <?php
      if (!isset($_SESSION['email'])) {
        echo "<li><a href='user_area/user_login.php'>LogIn</a></li>";
      } else {
        echo "<li><a href='user_area/logOut.php'>LogOut</a></li>";
      }
      ?>

    </ul>
  </nav>
  <script>
  function activeNav() {
          var btn = document.querySelectorAll('.menu_items li');
          var btns = document.querySelectorAll('.menu_items li a');
          for (var i = 0; i < btns.length; i++) {
            if (decodeURI(window.location.pathname).includes(btns[i].getAttribute('href'))) {
              btns[i].classList.add('active');
            }
          }
        }
        activeNav();
      </script>