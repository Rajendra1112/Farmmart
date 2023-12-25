<?php

if(isset($_POST['order_submit']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $user_id=$_POST['user_id'];
    $prod_id = $_POST['p_id'];
    $qtty = $_POST['quantity'];
$get_ip = getIPAddress();
$total_price = 0;
$prod_query_price="Select * from `products` where product_id = $prod_id";
$invoice_number=mt_rand();
$status='pending';
$run_price = mysqli_query($con,$prod_query_price);
$count_products =mysqli_num_rows($run_price);
$row_product_price = mysqli_fetch_array($run_price);
        $product_pric = $row_product_price['product_price'];
        $product_values = $product_price;
        $total_price+=$product_values;


if($quantity==0){
    $quantity=1;
    $subtotal = $total_price;
}else{
    $quantity=$quantity;
    $subtotal=$total_price*$quantity;
}

$insert_orders = "INSERT INTO `user_orders`( `user_id`, `amount_due`, `total_products`, `order_date`, `order_status`, `invoice_number`) VALUES ($user_id,$subtotal,$count_products,NOW(),'$status',$invoice_number)"; 

    
if(mysqli_query($con,$insert_orders)){

    $order_id = mysqli_insert_id($con);
// order pending
$insert_pending_orders = "INSERT INTO `order_pending`(`order_id`, `user_id`, `invoice_number`, `quantity`, `product_id`, `order_status`) VALUES ($order_id,$user_id,$invoice_number,$count_products,$prod_id,'$status')"; 
$result_pending_query=mysqli_query($con,$insert_pending_orders);  

        $product_id = $prod_id;
        $sel_owner = mysqli_query($con,"select user_id from products where product_id=$product_id");
        $owner = mysqli_fetch_assoc($sel_owner);
        $owner_id = $owner['user_id'];
        $product_title = $row_product_price['product_title'];
        $product_price = $row_product_price['product_price'];
        $product_image = $row_product_price['product_image'];
        $quantity = $quantity;
        $product_category = $row_product_price['product_category'];
        $price= $product_price*$quantity;
        $invoice_number = $invoice_number;
        $query1 = "INSERT INTO `order_item`(`order_id`, `user_id`,`owner_id`, `product_id`, `invoice_number`, `product_title`, `product_price`, `quantity`,`ip_address`,`product_image`,`status`) VALUES ($order_id,$user_id,$owner_id,$product_id,$invoice_number,'$product_title',$price,$quantity,'$get_ip','$product_image','$status')";
        $run_res = mysqli_query($con,$query1);
 
   
   echo "<script>alert('Orders are submitted succesfully')</script>";
    echo "<script>window.open('account.php','_self')</script>";
    // delete from cart
    $empty_query = "Delete from `cart_details` where ip_address='$get_ip'";
    $result_delete = mysqli_query($con,$empty_query);
    
}

}


?>

