<div class="container ">
              <div class="section-header d-flex justify-content-between border-bottom">
                <div class="bulk_actions">
                  <select name="bulk" id="" class="p-1">
                    <option value="01">Bulk Action</option>
                    <option value="01">Edit</option>
                    <option value="01">Trash</option>
                  </select>
                  <button type="submit">Apply</button>
                </div>

                <form method="get" class="admin_search_form">
                  <input type="search" name="search_user" class="" autocomplete="off" id="" />
                  <button type="submit">Search</button>
                </form>
              </div>
                    <?php
                      if(isset($_GET['users']) or isset($_GET['search_user'])){
                        if(isset($_GET['search_user'])){
                          $input = $_GET['search_user'];
                          $select_user = "Select * from `user_table` where user_id like '%$input%' or username like '%$input%' or phone like '%$input%' or role like '%$input%' or email like '%$input%' or address like '%$input%' or Area like '%$input%' or role_company_name like '%$input%'";
                        }else{
                        $select_user = "Select * from `user_table`";
                        }
                        $result_query = mysqli_query($con,$select_user);
                        $row_count = mysqli_num_rows($result_query);
                        if($row_count==0 ){
                          echo "<h3 class='mt-4 text-danger'>No User Found!!</h3>";
                        }else{
                          echo "
                          <div class='all_products user table-responsive col-sm-12'>
                          <table class='table text-center'>
                  <thead class='thead'>
                    <tr>
                      <td><input type='checkbox' name='check_all' id='' /></td>
                      <th>User Id</th>
                      <th>Username</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Company Name</th>
                      <th>Address</th>
                      <th>Total Products</th>
                      <th>Total Blogs</th>
                      <th>Total Plan</th>
                    </tr>
                  </thead>

                  <tbody class='tbody '>
                          ";
                        while($row = mysqli_fetch_array($result_query) ){
                          $user_id = $row['user_id'];
                          $user_name = $row['username'];
                          $phone = $row['phone'];
                          $email = $row['email'];
                          $role = $row['role'];
                          $role_company_name = $row['role_company_name'];
                          $address = $row['address'];
                          $area = $row['Area'];

                          //product count
                          $select_product = "Select * from `products` where user_id = $user_id";
                          $query_product = mysqli_query($con,$select_product);
                          $product_count = mysqli_num_rows($query_product);

                          //blog_count
                          $select_blog = "Select * from `blogs` where user_id = $user_id";
                          $query_blog = mysqli_query($con,$select_blog);
                          $blog_count = mysqli_num_rows($query_blog);

                          //plan_count
                          // $select_plan = "Select * from `plans` where user_id = $user_id";
                          // $query_plan = mysqli_query($con,$select_plan);
                          // $plan_count = mysqli_num_rows($query_plan);

                          echo "
                          <tr>
                          <td><input type='checkbox' name='product' id='' /></td>
                          <th>
                            <strong>$user_id</strong>
                            <div class='actions border-top border-bottom'>
                              <a href='edit.html'>Edit</a>
                              <a href='#' class='text-danger'>Delete</a>
                            </div>
                          </th>
                          <td><strong>$user_name</strong></td>
                          <td>$phone</td>
                          <td>$email</td>
                          <td>$role</td>
                          <td>$role_company_name</td>
                          <td>$area, $address</td>
                          <td>$product_count</td>
                          <td>$blog_count</td>
                          <td>0</td>
                        </tr>
                          ";
                        }
                      }
                    }
                    ?>
                   
                  </tbody>
                </table>
              </div>
            </div>