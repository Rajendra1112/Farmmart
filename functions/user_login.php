<?php
// include('../includes/connect.php');
session_start();
include('../includes/email/code.php');


if(isset($_POST['user_register']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    
    $user_name = $_POST['fullName'];
    $user_email = $_POST['email'];
    $contact = $_POST['phone'];
    $user_role = $_POST['role'];
    $role_company = $_POST['role_company_name'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $password = $_POST['password'];
    $hash_password = password_hash($password,PASSWORD_BCRYPT,$options = ['cost' => 12,]);
    $send_email = $_POST['send_email'];
    $terms = $_POST['terms'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();
    $otp = rand(19999,99999);
    $verify_status = 0;

    //select query
    $select_query = "Select * from `user_table` where email='$user_email'";
    $result = mysqli_query($con,$select_query);
    $num_rows= mysqli_num_rows($result);
    if($num_rows>0){
        echo "<script>alert('Role exist!');</script>";
    }
    else{
        // $_SESSION['otp']=$otp;
        //  // Login time is stored in a session variable
        //  $_SESSION["otp"] = time();
        //  header("Location:verify_otp.php");
    //insert query
    move_uploaded_file($user_image_temp, "./user_images/$user_image");
    $insert_query = "INSERT INTO `user_table`(`username`, `email`, `phone`, `role`,`role_company_name`,`address`, `password`, `user_image`, `terms`, `user_ip`,`send_email`,`Area`,`otp`,`verify_status`) VALUES ('$user_name','$user_email',$contact,'$user_role','$role_company','$address','$hash_password','$user_image','$terms','$user_ip','$send_email','$area',$otp,$verify_status)";
    $sql_execute = mysqli_query($con,$insert_query);
    if($sql_execute){
        sendEmail("$user_name", "$user_email", "$otp");
        $_SESSION['otp_email']=$user_email;
        $_SESSION['otp']=$otp;
        echo "<script>alert('Register successful!');</script>";
        header("Location: ../user_area/verify_otp.php");
    }
    else{
        echo "<script>alert('Register unsuccessful!');</script>";
    }
}
//selecting cart items
// $select_cart_items="Select * from `cart_details` where ip_address = '$user_ip'";
// $result_cart = mysqli_query($con,$select_cart_items);
// $rows_count = mysqli_num_rows($result_cart);
// if($rows_count>0){
//     $_SESSION['email']=$user_email;
//     echo "<script>alert('You have items in cart');</script>";
//     echo "<script>window.open('../user_area/checkout.php','_self');</script>";
// }
// else{
//     echo "<script>window.open('./user_login.php','_self');</script>";
// }
}

?>
