<div class="container mt-0">
    <div class="section-header d-flex justify-content-between border-bottom">
        <div class="bulk_actions">

        </div>

        <form method="get" class="admin_search_form">
            <input type="search" name="search_review" class="" autocomplete="off" id="" />
            <button type="submit">Search</button>
        </form>
    </div>
    <!-- //review  -->
    <?php
    // verify 
    if (isset($_POST['verify'])) {
        $review_id = $_POST['rating_id'];
        $status = 1;
        $update = mysqli_query($con, "update `user_rating` set status=$status where id=$review_id ");
        if ($update) {
            echo "<p id='verify'>Update successful with id = $review_id</p>";
        } else {
            echo "Update unsuccessful with id = $review_id";
        }
    }
    //delete
    if (isset($_POST['delete'])) {
        $review_id = $_POST['rating_id'];
        $status = 1;
        $update = mysqli_query($con, "delete from `user_rating` where id=$review_id");
        if ($update) {
            echo "<p id='verify'>Delete successful with id = $review_id</p>";
        } else {
            echo "delete unsuccessful with id = $review_id";
        }
    }
    ?>
    <?php
    if (isset($_GET['review']) or isset($_GET['search_review'])) {
        if (isset($_GET['search_review'])) {
            $input = $_GET['search_review'];
            $select_user = "Select * from `user_rating` where user_id like '%$input%' or product_id like '%$input' or username like '%$input%'  or role like '%$input%' ";
        } else {
            $select_user = "Select * from `user_rating`";
        }
        $result_query = mysqli_query($con, $select_user);
        $row_count = mysqli_num_rows($result_query);
        if ($row_count == 0) {
            echo "<h3 class='mt-4 text-danger'>No Reviews Found!!</h3>";
        } else {
            echo "
                          <div class='all_products user table-responsive col-sm-12'>
                          <table class='table text-center'>
                  <thead class='thead'>
                    <tr>
                      <th>Action</th>
                      <th>User Id</th>
                      <th>Username</th>
                      <th>Role</th>
                      <th>Product Id</th>
                      <th>Rating</th>
                      <th>Review</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                  </thead>

                  <tbody class='tbody '>
                          ";
            $count = 1;
            while ($row = mysqli_fetch_array($result_query)) {
                $user_id = $row['user_id'];
                $rating_id = $row['id'];
                $user_name = $row['username'];
                $role = $row['role'];
                $product_id = $row['product_id'];
                $rating = $row['rating'];
                $review = $row['review'];
                $image = $row['image'];
                $status = $row['status'];
                $date = $row['date'];


                echo "
                          <tr>
                          <th>
                            <strong>$count</strong>
                            <div class='actions border-top border-bottom'>
                              <form method='post'>  
                                <input type='hidden' name='rating_id' value='$rating_id'>";
                if ($status == 0) {
                    echo "<button type='submit' name='verify' class='text-success border-end px-2'>verify</button>";
                } else {
                    echo "<button type='button' class='text-success border-end px-2'>verfied</button>";
                }
                echo "
                                <button type='submit' name='delete' class='text-danger' onclick='Delete()'>Delete</button>
                              </form>
                            </div>
                          </th>
                          <td><strong>$user_id</strong></td>
                          <td>$user_name</td>
                          <td>$role</td>
                          <td>$product_id</td>
                          <td>$rating</td>
                          <td>$review</td>
                          <td>
                                <img style='width: 100px' src='../user_area/rating_img/$image' alt='rev_img' srcset=''>
                            </td>
                          <td>$status</td>
                          <td>$date</td>
                        </tr>
                          ";
                $count++;
            }
        }
    }
    ?>
    </tbody>
    </table>
</div>
</div>