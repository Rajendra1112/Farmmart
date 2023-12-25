<div id='firstTab' class='tab-detail text-center'>
            <div class='product_tab'>
<?php
global $con;  //for function we cant directly access the local variable so making that globle variable.

//condition to check isset or not
if (isset($_GET['view_products'])) {
  $email = $_SESSION['email'];
  $select_query_farm = "Select * from `user_table` where email='$email'";
  $result_farm = mysqli_query($con,$select_query_farm);
  $select_farm=mysqli_fetch_assoc($result_farm);
  $user_id=$select_farm['user_id'];
  $select_query = "Select * from `products` where user_id=$user_id order by rand()";
  $result_query = mysqli_query($con, $select_query);
  $num_of_rows = mysqli_num_rows($result_query);
  if ($num_of_rows == 0) {
    echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
  }
  echo "<h3 class='text-success mb-4 pb-2 border-2 border-bottom border-success'>You have <span class = 'border px-2'>$num_of_rows</span> products</h3>
  <div class='product_list'>";
  
  while ($row = mysqli_fetch_assoc($result_query)) {
    $product_id = $row['product_id'];
    $product_image = $row['product_image'];
    $product_title = $row['product_title'];
    $discount = $row['discount'];
    $product_category = $row['product_category'];
    $product_price = $row['product_price'];
    $product_after_price = $product_price-$product_price*$discount/100;
    echo "
    
  <div class='product_list_item'>
  <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class='text-white'></span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
  <div class='product_list_item_image'>
    <a href='./account.php?product_id=$product_id'>
      <img src='../img/product_img/$product_category/$product_image' alt='$product_title' />
    </a>
  </div>
  <div class='product_list_item_detail'>
    <a href='./product-details.html' class='sm-heading'>$product_title</a>
    <del>NPR. $product_price</del>
    <span>NPR. $product_after_price </span>
  </div>
  <div class='product_list_item_hover'>
    <ul class='d-flex justify-content-between align-items-center'>
      <li>
        <a href='account.php?product_id=$product_id' class='view_icon'>
          <i class='fas fa-eye'></i>
        </a>
      </li>
      <li>
        <a href='account.php?edit_product=$product_id' class='view_icon'>
        <i class='fa-solid fa-pen-to-square'></i>
        </a>
      </li>
    </ul>
  </div>
</div>";
  }
}
?>
              </div></div></div>