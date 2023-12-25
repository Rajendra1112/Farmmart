<?php
if (isset($_GET['profile'])) {
  $user_email = $_SESSION['email'];
  $select_query = "Select * from `user_table` where email='$user_email'";
  $result_query = mysqli_query($con, $select_query);
  $row_fetch = mysqli_fetch_assoc($result_query);
  $user_id = $row_fetch['user_id'];
  $user_password = $row_fetch['password'];
  $user_name = $row_fetch['username'];
  $user_phone = $row_fetch['phone'];
  $user_email = $row_fetch['email'];
  $user_address = $row_fetch['address'];
  $user_image = $row_fetch['user_image'];
  $user_area = $row_fetch['Area'];
  $user_experience = $row_fetch['experience'];
  $additional_experience = $row_fetch['additional_experience'];
}
  if (isset($_POST['user_update'])) {
    $update_id = $user_id; 
    $user_name = $_POST['user_name'];
    $user_phone = $_POST['user_mobile'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_area = $_POST['user_area'];
    $user_experience = $_POST['user_experience'];
    $additional_experience = $_POST['additional_experience'];

    //update_query
    $update_query = "update `user_table` set username='$user_name', phone=$user_phone, email='$user_email', address='$user_address', area='$user_area', experience='$user_experience',additional_experience='$additional_experience' where user_id=$update_id";
    $result_query_update = mysqli_query($con,$update_query);
    global $result_query_update;
  }

  //change profile
  if (isset($_POST['update_profile'])) {
    $update_id = $user_id; 
    $rand=rand(1,999999);

    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_tmp,"../user_area/user_images/$rand$user_image");

    //update_query
    $update_query = "update `user_table` set user_image='$rand$user_image' where user_id=$update_id";
    $result_query_update = mysqli_query($con,$update_query);
    global $result_query_update;
  }

  //change password
  if (isset($_POST['update_password'])) {
    $update_id = $user_id; 
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $hash_password = password_hash($new_password,PASSWORD_BCRYPT,$options = ['cost' => 12,]);
    $confirm_password = $_POST['confirm_password'];

    if(!password_verify($current_password,$user_password))
    {
      echo "<script>alert('Password not matched.')</script>";
      echo "<script>window.open('account.php?profile','_self')</script>";
    if($new_password!=$confirm_password){
      echo "<script>alert('Password not matched.')</script>";
      echo "<script>window.open('account.php?profile','_self')</script>";
    }
  }
    else{
    //update_query
    $update_query = "update `user_table` set password='$hash_password' where user_id=$update_id";
    $result_query_update = mysqli_query($con,$update_query);
    global $result_query_update;
    }
  }

  //check result
  if (isset($_POST['update_password']) or isset($_POST['update_profile']) or isset($_POST['user_update'])){
  if($result_query_update){
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
              window.open('./logout.php','_self')
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
  echo "<script>window.open('../user_area/logout.php','_self')</script>";
  echo "<script>window.open('../user_area/user_login.php','_self')</script>";
  }
  else{
    echo "<script>window.open('./account.php?profile','_self')</script>";
  }
  }
?>

<form class="border border-3 mb-1" action="" method='post' enctype="multipart/form-data">
  <div class="container rounded bg-white mb-1 ">
    <div class="row">
      <div class="col-md-11 border-right m-auto">
        <div class="p-3 py-5">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right text-success">Profile Settings</h4>
            <a class="btn border border-3" href="#change_profile">Change Profile</a>
            <a class="btn border border-3" href="#change_password">Change Password</a>
          </div>
          <div class="row mt-3">
            <div class="col-md-12"><label class="labels">Full Name</label><input type="text" class="form-control" placeholder="enter name" name="user_name" value="<?php echo $user_name ?>"></div>

            <div class="user-img ">

              <div class="col-md-12"><label class="labels">Mobile Number</label><input type="number" class="form-control" name="user_mobile" value="<?php echo $user_phone ?>"></div>

              <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" name="user_address" value="<?php echo $user_address ?>"></div>

              <div class="col-md-12"><label class="labels">Area</label><input type="text" class="form-control" name="user_area" value="<?php echo $user_area ?>"></div>

              <div class="col-md-12"><label class="labels">Email ID</label><input type="text" class="form-control" name="user_email" value="<?php echo $user_email ?>"></div>

              <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" name="user_experience" class="form-control" value="<?php echo $user_experience ?>"></div>
              <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" name="additional_experience" value="<?php echo $additional_experience ?>"></div>
            </div>
          </div>

          <div class="mt-5 text-center"><button class="btn btn-primary profile-button border text-dark" type="submit" name="user_update" onclick="showSwal('auto-close')">Save Profile</button></div>
        </div>
      </div>
    </div>
  </div>
</form>
<form class="border border-3 mb-1" action="" method='post' enctype="multipart/form-data" id="change_profile">
  <div class="container rounded bg-white mb-1 ">
    <div class="row">
      <div class="col-md-11 border-right m-auto">
        <div class="p-3 py-2">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right text-success">Change Profile Picture</h4>
          </div>
          <div class="row mt-3">
            <div class="user-img ">
              <label class="labels">Image</label>
              <div class=" form-outline form-control col-md-12 d-flex m-auto"><input type="file" class="form-control border-0" name="user_image" value="" required><img class="edit_image" src="../user_area/user_images/<?php echo $user_image ?>" alt="img">
            </div>
          </div>
          </div>
          <div class="mt-5 text-center"><button class="btn btn-primary profile-button border text-dark" type="submit" name="update_profile" onclick="showSwal('auto-close')">Save Profile</button></div>
      </div>
    </div>
  </div>
  </div>
</form>
<form class="border border-3 mb-4" action="" method='post' enctype="multipart/form-data" id="change_password">
  <div class="container rounded bg-white mb-1 ">
    <div class="row">
      <div class="col-md-11 border-right m-auto">
        <div class="p-3 py-2">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="text-right text-success">Change Profile Picture</h4>
          </div>
          <div class="row mt-3">
          <div class="col-md-12"><label class="labels">Current password </label><input type="text" class="form-control" placeholder="enter current password" name="current_password" value=""></div>
          <div class="col-md-12"><label class="labels">New password </label><input type="text" class="form-control" placeholder="enter new password" name="new_password" value=""></div>
          <div class="col-md-12"><label class="labels">Confirm New password</label><input type="text" class="form-control" placeholder="enter confirm new password" name="confirm_password" value=""></div>
          </div>
      </div>
      <div class="mt-5 text-center"><button class="btn btn-primary profile-button border text-dark" type="submit" name="update_password" onclick="showSwal('auto-close')">Save Profile</button></div>
    </div>
  </div>
  </div>
</form>