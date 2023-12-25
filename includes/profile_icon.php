<button class=" profile-img pe-2">
              <?php
              if (!isset($_SESSION['email'])) {
                echo "<a href='user_area/user_login.php' class='text-dark font-weight-bold'><i class='fas fa-user'></i> Guest</a>";
              } else {
                $img_select = $_SESSION['email'];
                $select = "Select * from `user_table` where email='$img_select'";
                $result_img = mysqli_query($con, $select);
                $num_rows = mysqli_fetch_assoc($result_img);
                $user_img = $num_rows['user_image'];
                $user_name = $num_rows['username'];
                $user_role = $num_rows['role'];
                if ($user_role == 'consumer') {
                  echo "<a class='text-dark' href = './user_area/account.php'><img class='rounded-circle'style='width:40px;' src='user_area/user_images/$user_img' > $user_name</a>";
                }
                if ($user_role == 'supplier') {
                  echo "<a class='text-dark' href = './suppliers/account.php'><img class='rounded-circle'style='width:40px;' src='user_area/user_images/$user_img' > $user_name</a>";
                }
                if ($user_role == 'farmer') {
                  echo "<a class='text-dark' href = './farmer_area/account.php'><img class='rounded-circle'style='width:40px;' src='user_area/user_images/$user_img' > $user_name</a>";
                }
                if ($user_role == 'vendor') {
                  echo "<a class='text-dark' href = './user_area/account.php'><img class='rounded-circle'style='width:40px;' src='user_area/user_images/$user_img' > $user_name</a>";
                }
                if ($user_role == 'admin') {
                  echo "<a class='text-dark' href = './dashboard/dashboard.php'><img class='rounded-circle'style='width:40px;' src='user_area/user_images/admin.jpg' > $user_name</a>";
                }
              }

              ?>

            </a>
          </button>