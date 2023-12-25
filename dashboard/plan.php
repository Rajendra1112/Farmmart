<?php
include('../includes/connect.php');
if($con){
  // die(mysqli_error($con));
  echo "dies";
}
if(isset($_POST['insert_plan']) && $_SERVER['REQUEST_METHOD'] == "POST"){
  $plan_title = $_POST['plan_title'];
  $plan_price = $_POST['plan_price'];
  $plan_category = $_POST['plan_category'];
  $plan_highlight = $_POST['plan_highlight'];
  
  //select data from database
  $select_query = "Select * from `plan` where plan_title ='$plan_title'";
  $result_select = mysqli_query($con,$select_query);
  $number = mysqli_num_rows($result_select);
  if($number>0){
    echo "<script>alert('Already have the same plan.')</script>";
  }else{
  $insert_query = "INSERT INTO `plan`(plan_title,plan_price,plan_category,plan_highlight)
  VALUES ('$plan_title',$plan_price,'$plan_category','$plan_highlight');";
  $result = mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('Plan insert successfully.')</script>";
  }
  if(!$result){
    echo "<script>alert('Plan insert successfully.')</script>";
  }
}
}
?>


<div class="container">
              <div class="new_product">
                <form action="" method="post" class="add_new_product">
                  <fieldset class="name">
                    <!-- <legend>Product Title</legend> -->
                    <label for="plan_title">Plan Title</label>
                    <input type="text" name="plan_title" placeholder="Add a Title" />
                  </fieldset>
                  <div class="plan_price">
                    <label>Price</label>
                    <input type="text" name="plan_price" />
                  </div>

                  <div class="new_product_category">
                    <label for="product_category">Select The Category</label>
                    <select name="plan_category" id="">
                      <option value="Weekly">Weekly</option>
                      <option value="Daily">Daily</option>
                      <option value="14Days">14 days</option>
                      <option value="Monthly">Monthly</option>
                    </select>
                  </div>

                  <ul class="new_product-highlight">
                    <label for="highlight">Add plan Highlight</label>
                    <li><input type="text" name="plan_highlight" id="" /></li>
                    <!-- <li><input type="text" name="plan_highlight" id="" /></li>
                    <li><input type="text" name="plan_highlight" id="" /></li> -->
                    <a href="#" class="more-highlight">Add More</a>
                  </ul>

                  <button type="submit" name="insert_plan" class="update">Update Plan</button>
                </form>
              </div>
            </div>