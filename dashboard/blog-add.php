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
}

if(isset($_POST['insert_blog']) && $_SERVER['REQUEST_METHOD'] == "POST"){
  $blog_title = $_POST['blog_title'];
  $user_id = $user_id;
  $blog_description = $_POST['blog_description'];
  $blog_highlight = $_POST['blog_highlight'];
  $rand=rand(1,999999);

  //accessing images
  $blog_image = $_FILES['blog_image']['name'];
  $blog_image1 = $_FILES['blog_image1']['name'];
  $blog_image2 = $_FILES['blog_image2']['name'];
  $blog_image3 = $_FILES['blog_image3']['name'];

  //accessing image tmp name
  $temp_image = $_FILES['blog_image']['tmp_name'];
  $temp_image1 = $_FILES['blog_image1']['tmp_name'];
  $temp_image2 = $_FILES['blog_image2']['tmp_name'];
  $temp_image3 = $_FILES['blog_image3']['tmp_name'];

  //checking empty condition
  if($blog_title=='' or $blog_description=='' or $blog_highlight==''  or $blog_image=='' or $blog_image1=='' or $blog_image2=='' or $blog_image3==''){
    echo "<script>alert('Please fill all the avaliable fields')</script>";
  }
  else{
    //storing image to folder
    move_uploaded_file($temp_image,"./blog_images/$rand$blog_image");
    move_uploaded_file($temp_image1,"./blog_images/$rand$blog_image1");
    move_uploaded_file($temp_image2,"./blog_images/$rand$blog_image2");
    move_uploaded_file($temp_image3,"./blog_images/$rand$blog_image3");

    //insert query
  $insert_query = "INSERT INTO `blogs`(user_id,blog_title,blog_description,blog_highlight,blog_image,blog_image1,blog_image2,blog_image3)
  VALUES ($user_id,'$blog_title','$blog_description','$blog_highlight','$rand$blog_image','$rand$blog_image1','$rand$blog_image2','$rand$blog_image3')";
  $result = mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('Blog insert successfully.')</script>";
  }
  if(!$result){
    echo "<script>alert('Blog insert not successfully.')</script>";
  }
  }
}
?>

<div class="container">
              <div class="new_product">
                <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
                  <fieldset class="name">
                    <!-- <legend>Product Title</legend> -->
                    <label for="blog_title">Blog Title</label>
                    <input type="text" name="blog_title" placeholder="Add a Title" required/>
                  </fieldset>
                  <ul class="new_product-highlight">
                    <label for="highlight">Add Highlights</label>
                    <li><input type="text" name="blog_highlight" id="" required></li>
                    <!-- <li><input type="text" name="product_highlight" id="" /></li>
                    <li><input type="text" name="product_highlight" id="" /></li> -->
                    <a href="#" class="more-highlight">Add More</a>
                  </ul>
                  <div class="new_product_desctiption">
                    <label for="description">Describe Your Product</label>
                    <textarea name="blog_description" id="" cols="30" rows="5"></textarea>
                  </div>
                  <div class="new_product_image">
                    <img src="" alt="" />
                    <p>Select a Featured Image for Blog</p>
                    <input type="file" name="blog_image" id="featuredImage" required/>
                    <input type="file" name="blog_image1" id="featuredImage" required/>
                    <input type="file" name="blog_image2" id="featuredImage" required/>
                    <input type="file" name="blog_image3" id="featuredImage" required/>
                  </div>
                  <button type="submit" name="insert_blog" value="Update Blog" class="update">Add Blog</button>
                </form>
              </div>
            </div>