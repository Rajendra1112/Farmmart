<?php
include('../includes/connect.php');
if($con){
  // die(mysqli_error($con));
}
$email = $_SESSION['email'];
$select_query_user= "Select * from `user_table` where email = '$email'";
$result_user = mysqli_query($con,$select_query_user);
$user = mysqli_fetch_assoc($result_user);
$user_count = mysqli_num_rows($result_user);
if($user_count==0){
  echo "<script>alert('No user')</script>";
}else{
  $user_id = $user['user_id'];
  $address = $user['address'];
}

if(isset($_POST['insert_plan']) && $_SERVER['REQUEST_METHOD'] == "POST"){
  $plan_title = $_POST['plan_title'];
  $user_id = $user_id;
  $address=$address;
  $plan_price = $_POST['plan_price'];
  $plan_after_price = $_POST['plan_after_price'];
  $plan_category = $_POST['plan_category'];
  $plan_description = $_POST['plan_description'];

  //checking empty condition
  if($plan_title=='' or $plan_price=='' or $plan_after_price=='' or $plan_category=='' or $plan_description==''){
    echo "<script>alert('Please fill all the avaliable fields')</script>";
  }
  else{
    $sel_query = "Select `user_id` from `plan` where plan_category='$plan_category' and user_id=$user_id";
    $res_query = mysqli_query($con,$sel_query);
    $num_row = mysqli_num_rows($res_query); 
    if($num_row==0){ 
    //insert query
  $insert_query = "INSERT INTO `plan`(user_id,plan_title,address,plan_price,plan_after_price,plan_description,plan_category,date)
  VALUES ($user_id,'$plan_title','$address','$plan_price','$plan_after_price','$plan_description','$plan_category',NOW())";
  $result = mysqli_query($con,$insert_query);
  // $num = mysqli_num_rows($result);
  if($result){
    echo "<script>alert('plan insert successfully.')</script>";
    // $message[] = 'product could not be deleted';
  }
  if(!$result){
    echo "<script>alert('plan insert not successfully.')</script>";
  }
  }else{
    echo "<script>alert('plan already exist.')</script>";
  }
}
}

//inserting services
if(isset($_GET['plan_id'])){
  if(isset($_GET['plan_category'])){
  $plan_id  = $_GET['plan_id'];
  $plan_category  = $_GET['plan_category'];

if(isset($_POST['insert_service']) && $_SERVER['REQUEST_METHOD'] == "POST"){
  $user_id = $user_id;
  $services = $_POST['services'];
    //insert query
    $sel_query = "Select `category` from `services` where category='$plan_category' and user_id=$user_id";
    $res_query = mysqli_query($con,$sel_query);
    $num_row = mysqli_num_rows($res_query); 

  $insert_query = "INSERT INTO `services`(plan_id,user_id,category,service)
  VALUES ($plan_id,$user_id,'$plan_category','$services')";
  $result = mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('plan insert successfully.')</script>";
  }
  if(!$result){
    echo "<script>alert('plan insert not successfully.')</script>";
  }
}
}
}
?>

<div class="container" id='add_plan'>
              <div class="new_product">
                <form action="" method="post" class="add_new_product" enctype="multipart/form-data">
                   
                  <div class="new_plan_category">
                    <label for="plan_category">Select The Category</label>
                    <select name="plan_category" id="">
                      <option value='daily'>Daily Plan</option>
                      <option value='weekly'>Weekly Plan</option>
                      <option value='double weekly'>Double Week Plan</option>
                      <option value='monthly'>Monthly Plan</option>
                  
                    </select>
                  </div>
                  <fieldset class="name">
                    <!-- <legend>plan Title</legend> -->
                    <label for="plan_title">plan Title</label>
                    <input type="text" name="plan_title" placeholder="Add a Title" required/>
                  </fieldset>
                  <div class="price">
                    <label>Price</label>
                    <input type="text" name="plan_price" required>
                  </div>
                  <div class="price">
                    <label>After Price</label>
                    <input type="text" name="plan_after_price" required>
                  </div>

                  <div class="new_plan_desctiption">
                    <label for="description">Describe Your plan</label>
                    <textarea name="plan_description" id="" cols="30" rows="5"></textarea>
                  </div>
          
                  <button type="submit" name="insert_plan" value="Insert plan" class="update">Insert plan</button>
                </form>

                
              </div>
            </div>
        <div class="container" id="service">
          <div class="new_product mx-5">
            <div class="addservices  mb-1 ">
                <label for="services"><h3>Add/Delete services</h3></label>
            </div>
            <div  class="border border-2 border-success p-4">
              <ul class="">
                <?php
                  $sel_query = "Select * from `plan` where user_id=$user_id";
                  $result = mysqli_query($con,$sel_query);
                  $num = mysqli_num_rows($result);
                  if($num==0){
                    echo "<a href='#add_plan'>Add Plan</a>";
                  }
                  else{
                    while($row=mysqli_fetch_assoc($result)){
                      $plan_category=$row['plan_category'];
                      $plan_id=$row['plan_id'];
                      echo "
                        <li class='btn border-success active' style='text-transform: capitalize; ' id='$plan_category'><a href='./account.php?plans&plan_id=$plan_id&plan_category=$plan_category#service'>$plan_category</a></li>

                      ";
                    }
                    if(isset($_GET['plan_id'])){
                      include('./services.php');
                  }
                  if (isset($_GET['edit_service'])) {
                    include('../dashboard/edit_delete_service.php');
                  }
                  }
                ?>
              </ul>
            </div>
        </div>
        </div>
        