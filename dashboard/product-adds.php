<?php
include('../includes/connect.php');
if($con){
  // die(mysqli_error($con));
  echo "dies";
}

  
if(isset($_POST['insert_product']) && $_SERVER['REQUEST_METHOD'] == "POST"){
  $product_tit = $_POST['product_title'];
  $product_pri = $_POST['product_price'];
  // $product_category = $_POST['product_category'];
  // $product_description = $_POST['product_description'];
  // $product_highlight = $_POST['product_highlight'];
  // $product_descript = $_POST['product_descript'];
  // $product_image = $_POST['product_image'];

  //select data from database
  // $select_query = "Select * from `product` where product_title ='$product_title'";
  // $result_select = mysqli_query($con,$select_query);
  // $number = mysqli_num_rows($result_select);
  // if($number>0){
  //   echo "<script>alert('Already have the same product.')</script>";
  // }
  $insert_query = "INSERT INTO `produ`(product_title,product_price)
  VALUES ('.$product_tit.',$product_pri);";
  $result = mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('Product insert successfully.')</script>";
  }
  if(!$result){
    echo "<script>alert('Product insert successfully.')</script>";
  }
  // $insert_query = "INSERT INTO `produ`(product_title,product_price)
  // VALUES ('djshd',67);";
  // $result = mysqli_query($con,$insert_query);
  // if($result){
  //   echo "<script>alert('Product insert successfully.')</script>";
  // }
  // if(!$result){
  //   echo "<script>alert('Product insert successfully.')</script>";
  // }
  
}
?>

<div class="container">
              <div class="new_product">
                <form action="" method="post" class="add_new_product">
                  <fieldset class="name">
                    <!-- <legend>Product Title</legend> -->
                    <label for="product_title">Product Title</label>
                    <input type="text" name="product_title" placeholder="Add a Title" />
                  </fieldset>
                  <div class="price">
                    <label>Price</label>
                    <input type="text" name="product_price">
                  </div>
                 
                  <button type="submit" name="insert_product" value="Update Product" class="update">Update Product</button>
                </form>
              </div>
            </div>