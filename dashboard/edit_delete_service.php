<?php

// delete
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
if(!isset($_GET['edit_service'])){
    if(isset($_GET['delete_service'])){
        $delete_service = $_GET['delete_service'];
        $sel_cat = "Select * from `services` where service_id=$delete_service and user_id=$user_id";
        $query = mysqli_query($con,$sel_cat);
        $cat_row = mysqli_fetch_assoc($query);
        $cat = $cat_row['category'];
        $plan_id = $cat_row['plan_id'];

        $delete_query = "Delete from `services` where service_id=$delete_service and user_id=$user_id";
        $result = mysqli_query($con,$delete_query);
        if($result){
          // header('location:account.php');
            echo "<script>alert('service deleted..')</script>";
            echo "<script>window.open('../farmer_area/account.php?plans&plan_id=$plan_id&plan_category=$cat#service','_self')</script>";
            
        }
      } 
    }
// edit
if(isset($_GET['edit_service'])){
  if(isset($_GET['service'])){
    if(isset($_GET['sn'])){
  $service_id = $_GET['edit_service'];
  $service = $_GET['service'];
  $sn = $_GET['sn'];
  $sel_cat = "Select * from `services` where service_id=$service_id and user_id=$user_id";
        $query = mysqli_query($con,$sel_cat);
        $cat_row = mysqli_fetch_assoc($query);
        $cat = $cat_row['category'];
        $plan_id = $cat_row['plan_id'];
  echo "<form action='' method='post' class='add_new_product'>
      <div class='plan border border-3 p-3'>
          <ul class='new_plan-highlight ' id='faqs'>
              <label for='highlight'>edit service</label>
              <li>$sn. $service<input type='text' placeholder='' name='services' value='$service' id='' required/></li>

          </ul>
      </div>
      <button type='submit' name='edit_service' value='Update service' class='update mt-3'>Update service</button>
  </form>";

if (isset($_POST['edit_service'])) {
  $service_name = $_POST['services'];
  //update_query
  $update_query = "update `services` set `service`='$service_name' where service_id=$service_id and user_id=$user_id";
  $result_query_update = mysqli_query($con, $update_query);
  if ($result_query_update) {
      echo "<script>alert('service updated..')</script>";
      echo "<script>window.open('../farmer_area/account.php?plans&plan_id=$plan_id&plan_category=$cat#service','_self')</script>";
  }
}
}
}
} 
?>