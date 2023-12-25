<?php 
if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    if(isset($_GET['confirm_payment']) and isset($_GET['o'])){
        $order_id = $_GET['o'];
        $user_query = mysqli_query($con, "Select user_id from user_table where email='$email'");
        $user_row = mysqli_fetch_assoc($user_query);
        $user_id = $user_row['user_id'];

        $update = mysqli_query($con,"Update `order_item` set status='complete' where order_id=$order_id and user_id=$user_id");
        if($update){
            $update_order = mysqli_query($con,"Update `user_orders` set order_status='complete' where order_id=$order_id and user_id=$user_id");
        if($update_order){
            $updates = mysqli_query($con,"Update `order_pending` set order_status='complete' where order_id=$order_id and user_id=$user_id");
        if($updates){
            echo "<script>alert('Order complete successfull');</script>";
            echo "<script>window.open('./account.php?my_order','_self')</script>";
        }else{
            echo "<script>alert('Order unsuccessfull');</script>";
            echo "<script>window.open('./account.php?my_order','_self')</script>";
        }
        }else{
            echo "<script>alert('Order unsuccessfull');</script>";
            echo "<script>window.open('./account.php?my_order','_self')</script>";
        }
            
        }else{
            echo "<script>alert('Order unsuccessfull');</script>";
            echo "<script>window.open('./account.php?my_order','_self')</script>";
        }
    } 
}
?>