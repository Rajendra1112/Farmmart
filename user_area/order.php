<?php
// include('../includes/connect.php');
// include('../functions/common_functions.php');

if(isset($_POST['order_submit']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $user_id=$_POST['user_id'];
// echo "<script>alert('$user_id')</script>";
//getting total items and total price of all intl_get_error_message
$get_ip = getIPAddress();
$total_price = 0;
$cart_query_price="Select * from `cart_details` where ip_address='$get_ip'";
$invoice_number=mt_rand();
$status='pending';
$result_cart_price = mysqli_query($con,$cart_query_price);
$count_products =mysqli_num_rows($result_cart_price);
while($row_price=mysqli_fetch_array($result_cart_price)){
    $product_id=$row_price['product_id'];
    $select_products="Select * from `products` where product_id = $product_id";
    $run_price= mysqli_query($con,$select_products);
    while($row_product_price = mysqli_fetch_array($run_price)){
        $product_price=array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price+=$product_values;
    }
}

//getting quantity from cart
$get_cart = "Select * from `cart_details`";
$run_cart = mysqli_query($con,$get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'];
if($quantity==0){
    $quantity=1;
    $subtotal = $total_price;
}else{
    $quantity=$quantity;
    // $subtotal=$total_price*$quantity;
}

$insert_orders = "INSERT INTO `user_orders`( `user_id`, `amount_due`, `total_products`, `order_status`, `invoice_number`) VALUES ($user_id,$subtotal,$count_products,'$status',$invoice_number)"; 


$sel_cart = "Select product_id, ip_address,product_title,product_price, quantity,product_image,product_category from `cart_details` where ip_address='$get_ip'";
    $result = mysqli_query($con,$sel_cart);
    $row = mysqli_num_rows($result);
    
if(mysqli_query($con,$insert_orders)){

    $order_id = mysqli_insert_id($con);
// order pending
$insert_pending_orders = "INSERT INTO `order_pending`(`order_id`,`user_id`,`quantity` ,`invoice_number`, `order_status`) VALUES ($order_id,$user_id,$count_products,$invoice_number,'$status')"; 
$result_pending_query=mysqli_query($con,$insert_pending_orders);  

    foreach($result as $key){
        $product_id = $key['product_id'];
        $sel_owner = mysqli_query($con,"select user_id from products where product_id=$product_id");
        $owner = mysqli_fetch_assoc($sel_owner);
        $owner_id = $owner['user_id'];
        $product_title = $key['product_title'];
        $product_price = $key['product_price'];
        $ip_address = $key['ip_address'];
        $product_image = $key['product_image'];
        $quantity = $key['quantity'];
        $product_category = $key['product_category'];
        $price= $product_price*$quantity;
        $invoice_number = $invoice_number;
        $quantity = 0?$quantity=1:$quantity;
        $query1 = "INSERT INTO `order_item`(`order_id`, `user_id`,`owner_id`, `product_id`, `invoice_number`, `product_title`, `product_price`, `quantity`,`ip_address`,`product_image`,`status`) VALUES ($order_id,$user_id,$owner_id,$product_id,$invoice_number,'$product_title',$price,$quantity,'$ip_address','$product_image','pending')";
        $run_res = mysqli_query($con,$query1);

   } 
   
   echo "<script>alert('Orders are submitted succesfully')</script>";
    echo "<script>window.open('account.php','_self')</script>";
    // delete from cart
    $empty_query = "Delete from `cart_details` where ip_address='$get_ip'";
    $result_delete = mysqli_query($con,$empty_query);
    
}

}


?>

