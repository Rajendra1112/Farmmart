<?php
if(isset($_GET['complete_order'])){
$user_email = $_SESSION['email'];
$get_user = "Select * from `user_table` where email = '$user_email'";
$result = mysqli_query($con,$get_user);
$row_fetch = mysqli_fetch_assoc($result);
$user_id = $row_fetch['user_id'];

$get_orders = "Select * from `order_item` where user_id=$user_id and status='complete' order by date";
$result_orders = mysqli_query($con,$get_orders);
$num_of_rows = mysqli_num_rows($result_orders);
if($num_of_rows==0){
    echo "
    <div class='border border-2 border-success text-center p-4'>
    <h3 class='text-danger'>You hanve $num_of_rows pending orders.</h3>
    <button class='btn border-success mt-2'><a href='../index.php'>Continue Shopping</a></button>
    </div>
    ";
}else{
    echo "
<div id='main-content' class='bg-white border'>
<div class='container mt-5'>
    <div class='d-flex justify-content-center row'>
        <div class='col-md-12'>
            <div class='rounded'>
                <div class='table-responsive table-borderless'>
                    <table class='table table-bordered  text-dark'>
                               
                                        <thead>
                                            <tr> 
                                                    <th class='th-lg'>Order Number</th>
                                                    <th class='th-lg'>Product Title</th>
                                                    <th class='th-lg'>Quantity</th>
                                                    <th class='th-lg'>Invoice Number</th>
                                                    <th class='th-lg'>Image</th>
                                                    <th class='th-lg'>Product Price</th>
                                                    <th class='th-lg'>status</th>
                                                    <th class='th-lg'>Rating and reviews</th>
                                                    
                                                </tr>
                                            </thead>
                        
                        <tbody class='table-body text-secondary'>";
                            $number = 1;
                            $total_price=0;
                             while($row_orders = mysqli_fetch_assoc($result_orders)){
                                $product_id = $row_orders['product_id'];
                                $amount_due = $row_orders['product_price'];
                                $sum = array($amount_due);
                                $total = array_sum($sum);
                                $total_price+=$total;
                                $product_title = $row_orders['product_title'];
                                $order_id = $row_orders['order_id'];
                                $quantity = $row_orders['quantity'];
                                $status = $row_orders['status'];
                                $product_image = $row_orders['product_image'];
                                $invoice_no = $row_orders['invoice_number'];
                                $sel_cat = mysqli_query($con,"Select `product_category` from `products` where product_id=$product_id");
                                $row_cat = mysqli_fetch_assoc($sel_cat);
                                $cat = $row_cat['product_category'];
                                
                                echo "
                                <tr class='cell-1'>
                                <td>$order_id</td>
                                <td>$product_title</td>
                                <td>$quantity</td>
                                <td>$invoice_no</td>
                                <td><img class='img-thumbnail' style='height:100px; width:150px' src='../img/product_img/$cat/$product_image' alt='$product_image'/></td>
                                <td>Rs. $amount_due /-</td>
                                <td>$status </td>
                                <td><a href='./account.php?my_review&p=$product_id' class='btn btn-success p-1' style ='font-size:12px;'>Write a review</a></td>
                            </tr>
                                ";
                             $number++;}
                             echo"                          
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>
";
}
}
?>