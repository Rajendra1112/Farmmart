<?php
if (isset($_GET['edit_product'])) {
    $product_id = $_GET['edit_product'];
    $user_email = $_SESSION['email'];
    $select_user = "select * from `user_table` where email='$user_email'";
    $result = mysqli_query($con, $select_user);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $select_query = "Select * from `products` where product_id=$product_id and user_id=$user_id";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $product_title = $row_fetch['product_title'];
    $product_price = $row_fetch['product_price'];
    $discount = $row_fetch['discount'];
    $product_category = $row_fetch['product_category'];
    $product_highlight = $row_fetch['product_highlight'];
    $product_keywords = $row_fetch['product_keywords'];
    $product_description = $row_fetch['product_description'];
    $product_description = $row_fetch['product_description'];
    $product_image = $row_fetch['product_image'];
    $product_image1 = $row_fetch['product_image1'];
    $product_image2 = $row_fetch['product_image2'];
    $product_image3 = $row_fetch['product_image3'];
}

//change title
if (isset($_POST['update_title'])) {
    $update_id = $product_id;
    $product_title = $_POST['product_title'];

    //update_query
    $update_query = "update `products` set product_title='$product_title' where product_id=$update_id";
    $result_query_update = mysqli_query($con, $update_query);
    global $result_query_update;
}
//update price
if (isset($_POST['update_price'])) {
    $update_id = $product_id;
    $product_price = $_POST['product_price'];

    //update_query
    $update_query = "update `products` set product_price='$product_price' where product_id=$update_id";
    $result_query_update = mysqli_query($con, $update_query);
    global $result_query_update;
}
//update price2
if (isset($_POST['update_after_price'])) {
    $update_id = $product_id;
    $discount = $_POST['discount'];

    //update_query
    $update_query = "update `products` set discount='$discount' where product_id=$update_id";
    $result_query_update = mysqli_query($con, $update_query);
    global $result_query_update;
}
//update category
if (isset($_POST['update_category'])) {
    $update_id = $product_id;
    $product_category = $_POST['product_category'];

    //update_query
    $update_query = "update `products` set product_category='$product_category' where product_id=$update_id";
    $result_query_update = mysqli_query($con, $update_query);
    global $result_query_update;
}
//update category
if (isset($_POST['update_highlight'])) {
    $update_id = $product_id;
    $product_highlight = $_POST['product_highlight'];

    //update_query
    $update_query = "update `products` set product_highlight='$product_highlight' where product_id=$update_id";
    $result_query_update = mysqli_query($con, $update_query);
    global $result_query_update;
}
//update product_keywords
if (isset($_POST['update_keywords'])) {
    $update_id = $product_id;
    $product_keywords = $_POST['product_keywords'];

    //update_query
    $update_query = "update `products` set product_keywords='$product_keywords' where product_id=$update_id";
    $result_query_update = mysqli_query($con, $update_query);
    global $result_query_update;
}
//update product_description
if (isset($_POST['update_description'])) {
    $update_id = $product_id;
    $product_description = $_POST['product_description'];

    //update_query
    $update_query = "update `products` set product_description='$product_description' where product_id=$update_id";
    $result_query_update = mysqli_query($con, $update_query);
    global $result_query_update;
}
//change image
    if (isset($_POST['update_product_image'])) {
    $update_id = $product_id;
    $rand = rand(1, 999999);
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];
        move_uploaded_file($product_image_tmp, "../img/product_img/$product_category/$rand$product_image");

        $update_query = "update `products` set product_image='$rand$product_image' where product_id=$update_id";
        $result_query_update = mysqli_query($con, $update_query);
        global $result_query_update;
    }
    if (isset($_POST['update_product_image1'])) {
        $update_id = $product_id;
        $rand = rand(1, 999999);
        $product_image1 = $_FILES['product_image1']['name'];
        $product_image_tmp = $_FILES['product_image1']['tmp_name'];
        move_uploaded_file($product_image_tmp, "../img/product_img/$product_category/$rand$product_image1");

        $update_query = "update `products` set product_image1='$rand$product_image1' where product_id=$update_id";
        $result_query_update = mysqli_query($con, $update_query);
        global $result_query_update;
    }
    if (isset($_POST['update_product_image2'])){
        $update_id = $product_id;
    $rand = rand(1, 999999);
        $product_image2 = $_FILES['product_image2']['name'];
        $product_image_tmp = $_FILES['product_image2']['tmp_name'];
        move_uploaded_file($product_image_tmp, "../img/product_img/$product_category/$rand$product_image2");

        $update_query = "update `products` set product_image2='$rand$product_image2' where product_id=$update_id";
        $result_query_update = mysqli_query($con, $update_query);
        global $result_query_update;
    }
    if (isset($_POST['update_product_image3'])) {
        $update_id = $product_id;
    $rand = rand(1, 999999);
        $product_image3 = $_FILES['product_image3']['name'];
        $product_image_tmp = $_FILES['product_image3']['tmp_name'];
        move_uploaded_file($product_image_tmp, "../img/product_img/$product_category/$rand$product_image3");

        $update_query = "update `products` set product_image3='$rand$product_image3' where product_id=$update_id";
        $result_query_update = mysqli_query($con, $update_query);
        global $result_query_update;
    }
    //update_query
    



//check result
if (isset($_POST['update_title']) or isset($_POST['update_price']) or isset($_POST['update_after_price']) or isset($_POST['update_category']) or isset($_POST['update_highlight']) or isset($_POST['update_keywords']) or isset($_POST['update_description']) or isset($_POST['update_product_image']) or isset($_POST['update_product_image1']) or isset($_POST['update_product_image2']) or isset($_POST['update_product_image3'])) {
    if ($result_query_update) {
        echo "<script>
    (function($) {
    showSwal = function(type) {
      'use strict';
       if (type === 'auto-close') {
        swal({
          title: 'Profile updated.',
          timer: 2000,
          button: false
        }).then(
          function() {},
          // handling the promise rejection
          function(dismiss) {
            if (dismiss === 'timer') {
              window.open('./account.php?edit_product=$product_id','_self')
            }
          }
        )
      }else{
          swal('Error occured !');
      } 
    }
  
  })(jQuery);
  </script>
  ";
        echo "<script>alert('Product Update Successfully');</script>";
        echo "<script>window.open('./account.php?edit_product=$product_id','_self')</script>";
    } else {
        echo "<script>alert('Update unsuccessfully');</script>";
        echo "<script>window.open('./account.php?edit_product=$product_id','_self')</script>";
    }
}
?>

<div class="container">
    <div class="new_product">
        <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
            <fieldset class="name">
                <!-- <legend>Product Title</legend> -->
                <label for="product_title"><h5>Change Product Title</h5></label>
                <input type="text" name="product_title" placeholder="Add a Title" value="<?php echo $product_title; ?>" required />
            </fieldset>
            <button type="submit" name="update_title" value="Update Product" class="update">Update Product</button>
        </form>

        <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
            <div class="price">
                <label><h5>Change Price</h5></label>
                <input type="number" name="product_price" value="<?php echo $product_price; ?>" required>
            </div>
            <button type="submit" name="update_price" value="Update Product" class="update">Update Product</button>
        </form>

        <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
            <div class="price">
                <label><h5>Discount</h5></label>
                <input type="number" name="discount" max="100" value="<?php echo $discount; ?>" required>
            </div>
            <button type="submit" name="update_after_price" value="Update Product" class="update">Update Product</button>
        </form>

        <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
            <div class="new_product_category">
                <label for="product_category"><h5>Change The Category</h5></label>
                <select name="product_category" id="">
                    <?php
                    $select_query = "Select * from `category` where category_for='Supplier'";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];

                        if ($category_title == $product_category) {
                            echo "<option value='$category_title' selected>$category_title</option>";
                        } else {
                            echo "<option value='$category_title'>$category_title</option>";
                        }
                    }
                    ?>

                </select>
            </div>
            <button type="submit" name="update_category" value="Update Product" class="update">Update Product</button>
        </form>
        <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
            <ul class="new_product-highlight">
                <label for="highlight"><h5>Add Highlights</h5></label>
                <li><input type="text" name="product_highlight" id="" value="<?php echo $product_highlight; ?>" required></li>
                <!-- <li><input type="text" name="product_highlight" id="" /></li>
                    <li><input type="text" name="product_highlight" id="" /></li> -->
                <a href="#" class="more-highlight">Add More</a>
            </ul>
            <button type="submit" name="update_highlight" value="Update Product" class="update">Update Product</button>
        </form>

        <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
            <div class="product_keywords">
                <label for="product_keywords"><h5>Change Product keywords:</h5></label>
                <input type="text" name="product_keywords" placeholder="product keywords" value="<?php echo $product_keywords; ?>" required>
            </div>
            <button type="submit" name="update_keywords" value="Update Product" class="update">Update Product</button>
        </form>

        <div class="col-md-11 border-right m-auto add_new_product">
            <div class="p-1 py-2">
            <div class="new_product_image">
            <h4>Change a Featured Image for Blog</h4>
            <form action="" method="post" class="d-flex flex-column border border-2 p-3 my-2" enctype="multipart/form-data">
               <div class="d-flex"> 
                <input type="file" name="product_image" class="border-0" required />
                <img class="edit_image" src="../img/product_img/<?php echo $product_category ?>/<?php echo $product_image ?>" alt="img">  
                </div>   
                <button type="submit" name="update_product_image" value="Update Product" class="update w-25">Update Product</button>
            </form>

            <form action="" method="post" class="d-flex flex-column border border-2 p-3 my-2" enctype="multipart/form-data">
               <div class="d-flex"> 
               <input type="file" name="product_image1" id="featuredImage" class="border-0" required />
                <img class="edit_image" src="../img/product_img/<?php echo $product_category ?>/<?php echo $product_image1 ?>" alt="img">  
                </div>   
                <button type="submit" name="update_product_image1" value="Update Product" class="update w-25">Update Product</button>
            </form>

            <form action="" method="post" class="d-flex flex-column border border-2 p-3 my-2" enctype="multipart/form-data">
               <div class="d-flex"> 
               <input type="file" name="product_image2" id="featuredImage" class="border-0" required />
                <img class="edit_image" src="../img/product_img/<?php echo $product_category ?>/<?php echo $product_image2 ?>" alt="<?php $product_image2?>">  
                </div>   
                <button type="submit" name="update_product_image2" value="Update Product" class="update w-25">Update Product</button>
            </form>

            <form action="" method="post" class="d-flex flex-column border border-2 p-3 my-2" enctype="multipart/form-data">
               <div class="d-flex"> 
               <input type="file" name="product_image3" id="featuredImage" class="border-0" required />
                <img class="edit_image" src="../img/product_img/<?php echo $product_category ?>/<?php echo $product_image3 ?>" alt="img">  
                </div>   
                <button type="submit" name="update_product_image3" value="Update Product" class="update w-25">Update Product</button>
            </form>

            </div>
            </div>
        </div>
        <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
            <div class="new_product_desctiption">
                <label for="description"><h5>Describe Your Product</h5></label>
                <textarea name="product_description" id="" cols="30" rows="5"><?php echo $product_description; ?></textarea>
            </div>
            <button type="submit" name="update_description" value="Update Product" class="update">Update Product</button>
        </form>
    </div>
</div>