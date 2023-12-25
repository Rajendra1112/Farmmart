<?php
include('../includes/connect.php');
if(isset($_POST['insert_category']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $category_title = $_POST['category_title'];
    $category_role = $_POST['role'];
    
    //select data from database
    $select_query = "Select * from `category` where category_title ='$category_title'";
    $result_select = mysqli_query($con,$select_query);
    $number = mysqli_num_rows($result_select);
    if($number>0){
      echo "<script>alert('Already have the same category.')</script>";
    }else{
  //creating folder
        $dir_name = $category_title;
        if(!file_exists('../img/product_img/'.$dir_name)){
          if(mkdir('../img/product_img/'.$dir_name)){
            echo "<script>alert('successful');</script>";
            $insert_query = "INSERT INTO `category`(`category_title`,`category_for`)
            VALUES ('$category_title','$category_role');";
            $result = mysqli_query($con,$insert_query);
            if($result){
            echo "<script>alert('category insert successfully.')</script>";
          }else{
            echo "<script>alert('category insert unsuccessfully.')</script>";
            
          }
        }     
    }
    else{
      echo "<script>alert('unsuccessful');</script>";
    }
    
  }
}
?>

<div class="container">
              <div class="">
                <form action="" method="post" class="add_new_product">
                  <fieldset class="category">
                    <legend>Add Category</legend>
                    <!-- <label for="category">Add Category</label> -->
                    <input type="text" name="category_title" placeholder="Add Category" />
                  </fieldset>
                  <fieldset class="new_product_category">
                    <label class="text-dark" for="product_category">Select The Category</label>
                    <select name="role" id="">
                        <option value='Farmer'>Farmer</option>                
                        <option value='Vendor'>Vendor</option>                
                        <option value='Supplier'>Supplier</option>                
                        <option value='Consumer'>Consumer</option>                
                    </select>
                  </fieldset>

                  <button type="submit" name="insert_category" class="update">Insert Category</button>
                </form>
              </div>
            </div>