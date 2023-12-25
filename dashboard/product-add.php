<?php
$email = $_SESSION['email'];
$select_query_user= "Select * from `user_table` where email = '$email'";
$result_user = mysqli_query($con,$select_query_user);
$user = mysqli_fetch_assoc($result_user);
$user_count = mysqli_num_rows($result_user);
if($user_count==0){
  echo "<script>alert('No user')</script>";
}else{
  $user_id = $user['user_id'];
  $location = $user['address'];
}

if(isset($_POST['insert_product']) && $_SERVER['REQUEST_METHOD'] == "POST"){
  $product_title = $_POST['product_title'];
  $user_id = $user_id;
  $product_keywords = $_POST['product_keywords'];
  $product_price = $_POST['product_price'];
  $discount = $_POST['discount'];
  $product_category = $_POST['product_category'];
  $product_description = $_POST['product_description'];
  $product_highlight = $_POST['product_highlight'];
  $qty = $_POST['qty'];
  $product_status = 'true';
  $rand=rand(1,999999);

  //accessing images
  $product_image = $_FILES['product_image']['name'];
  $product_image1 = $_FILES['product_image1']['name'];
  $product_image2 = $_FILES['product_image2']['name'];
  $product_image3 = $_FILES['product_image3']['name'];

  //accessing image tmp name
  $temp_image = $_FILES['product_image']['tmp_name'];
  $temp_image1 = $_FILES['product_image1']['tmp_name'];
  $temp_image2 = $_FILES['product_image2']['tmp_name'];
  $temp_image3 = $_FILES['product_image3']['tmp_name'];


  //checking empty condition
  if($product_title=='' or $product_price=='' or $discount=='' or $product_category=='' or $product_description=='' or $product_highlight==''  or $product_image=='' or $product_image1=='' or $product_image2=='' or $product_image3==''){
    echo "<script>alert('Please fill all the avaliable fields')</script>";
  }
  else{
    //storing image to folder
    move_uploaded_file($temp_image,"../img/product_img/$product_category/$rand$product_image");
    move_uploaded_file($temp_image1,"../img/product_img/$product_category/$rand$product_image1");
    move_uploaded_file($temp_image2,"../img/product_img/$product_category/$rand$product_image2");
    move_uploaded_file($temp_image3,"../img/product_img/$product_category/$rand$product_image3");

    //insert query
  $insert_query = "INSERT INTO `products`(user_id,product_title,product_keywords,product_price,discount,quantity,product_description,product_category,product_highlight,location,product_image,product_image1,product_image2,product_image3,date,status)
  VALUES ('$user_id','$product_title','$product_keywords',$product_price,$discount,$qty,'$product_description','$product_category','$product_highlight','$location','$rand$product_image','$rand$product_image1','$rand$product_image2','$rand$product_image3',NOW(),'$product_status')";
  $result = mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('Product insert successfully.')</script>";
  }
  if(!$result){
    echo "<script>alert('Product insert not successfully.')</script>";
  }
  }
}
?>

<div class="container">
              <div class="new_product">
                <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
                  <fieldset class="name">
                    <!-- <legend>Product Title</legend> -->
                    <label for="product_title">Product Title</label>
                    <input type="text" name="product_title" placeholder="Add a Title" required/>
                  </fieldset>
                  <div class="price">
                    <label>Price</label>
                    <input type="number" name="product_price" required>
                  </div>
                  <div class="price">
                    <label>Discount</label>
                    <input type="number" name="discount" required>
                  </div>
                  <div class="price">
                    <label>Quantity</label>
                    <input type="number" name="qty" required placeholder="in kg">
                  </div>
                  
                  <div class="new_product_category">
                    <label for="product_category">Select The Category</label>
                    <select name="product_category" id="">
                      <?php
                      $select_query = "Select * from `category`";
                      $result_query = mysqli_query($con,$select_query);
                      while($row = mysqli_fetch_assoc($result_query)){
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_title'>$category_title</option>";
                      }
                      ?>
                  
                    </select>
                  </div>
                  <ul class="new_product-highlight">
                    <label for="highlight">Add Highlights</label>
                    <li><input type="text" name="product_highlight" id="" required></li>
                    <!-- <li><input type="text" name="product_highlight" id="" /></li>
                    <li><input type="text" name="product_highlight" id="" /></li> -->
                    <a href="#" class="more-highlight">Add More</a>
                  </ul>
                  <div class="product_keywords">
                  <label for="product_keywords">Product keywords:</label>
                    <input type="text" name="product_keywords" placeholder="product keywords" required>
                  </div>

                  <div class="new_product_desctiption">
                    <label for="description">Describe Your Product</label>
                    <textarea name="product_description" id="" cols="30" rows="5"></textarea>
                  </div>
                  <div class="new_product_image">
                    <img src="" alt="" />
                    <p>Select a Featured Image for Blog</p>
                    <input type="file" name="product_image" id="featuredImage" required/>
                    <input type="file" name="product_image1" id="featuredImage" required/>
                    <input type="file" name="product_image2" id="featuredImage" required/>
                    <input type="file" name="product_image3" id="featuredImage" required/>
                  </div>
                  <button type="submit" name="insert_product" value="Update Product" class="update">Update Product</button>
                </form>
              </div>
            </div>