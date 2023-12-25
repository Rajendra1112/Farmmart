
    <?php
    include("../includes/email/code.php");
    // verify 
    if (isset($_POST['verify'])) {
        $product_id = $_POST['product_id'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $status = 'true';
        $update = mysqli_query($con, "update `products` set status='$status' where product_id=$product_id ");
        if ($update) {
            productAccept($email,$message);
            echo "<p id='verify'>Update successful with id = $product_id</p>";
        } else {
            echo "Update unsuccessful with id = $product_id";
        }
    }
    ?>
    <?php
    if (isset($_GET['product_request'])) {

        $select_products = "Select * from `products` where status='false'";
        $result_query = mysqli_query($con, $select_products);
        $row_count = mysqli_num_rows($result_query);
        if ($row_count == 0) {
            echo "<h3 class='mt-4 text-danger'>No request Found!!</h3>";
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
                      <th>Image</th>
                      <th>Status</th>
                      <th>Type</th>
                      <th>Date</th>
                    </tr>
                  </thead>

                  <tbody class='tbody '>
                          ";
            $count = 1;
            while ($row = mysqli_fetch_array($result_query)) {
                $user_id = $row['user_id'];

                $sel_user = mysqli_query($con,"Select * from user_table where user_id=$user_id");
                $result = mysqli_fetch_assoc($sel_user);
                $user_name = $result['username'];
                $role = $result['role'];
                $email = $result['email'];
                $product_id = $row['product_id'];
                $image = $row['product_image'];
                $status = $row['status'];
                $type = $row['type'];
                $category = $row['product_category'];
                $date = $row['date'];


                echo "
                          <tr>
                          <th>
                            <strong>$count</strong>
                            <div class='actions border-top border-bottom'>
                              <form method='post'>  
                                <input type='hidden' name='product_id' value='$product_id'>";
                if ($status == 'false') {
                    echo "<input type='hidden' name='message' value='Your Request accepted...'>";
                    echo "<input type='hidden' name='email' value='$email'>";
                    echo "<button type='submit' name='verify' class='text-success border-end px-2' >verify</button>";
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
                          <td>
                                <img style='width: 100px' src='../img/product_img/$category/$image' alt='prod_img' srcset=''>
                            </td>
                          <td>$status</td>
                          <td>$type</td>
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