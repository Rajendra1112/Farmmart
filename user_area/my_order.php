<?php
$user_email = $_SESSION['email'];
$get_user = "Select * from `user_table` where email = '$user_email'";
$result = mysqli_query($con,$get_user);
$row_fetch = mysqli_fetch_assoc($result);
$user_id = $row_fetch['user_id'];
$role = $row_fetch['role'];

$get_orders = "Select * from `user_orders` where user_id = '$user_id' and order_status='pending'";
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
                               <div class='heading'  style='font-size: 18px;'> You have <span class='text-success'>$num_of_rows</span> pending orders</div>
                                        <thead>
                                            <tr> 
                                                 <th class='th-lg'>S.N</th>
                                                    <th class='th-lg'>Order Number</th>
                                                    <th class='th-lg'>Amount Due</th>
                                                    <th class='th-lg'>Total Products</th>
                                                    <th class='th-lg'>Invoice Number</th>
                                                    <th class='th-lg'>Date</th>
                                                    <th class='th-lg'>Complete/Incomplete</th>
                                                    <th class='th-lg'>Status</th>
                                                </tr>
                                            </thead>
                        
                        <tbody class='table-body text-secondary'>";
                            $number = 1;
                             while($row_orders = mysqli_fetch_assoc($result_orders)){
                                $order_id = $row_orders['order_id'];
                                $amount_due = $row_orders['amount_due'];
                                $total_products = $row_orders['total_products'];
                                $invoice_no = $row_orders['invoice_number'];
                                $order_status = $row_orders['order_status'];
                                $order_date = $row_orders['order_date'];
                                if($order_status =='pending'){
                                    $order_status ='Incomplete';
                                }else{
                                    $order_status='Complete';
                                }
                                
                                echo "
                                <tr class='cell-1'>
                                <td>$number</td>
                                <td>$number</td>
                                <td>Rs. $amount_due /-</td>";
                                if($role=='consumer' or $role =='vendor'){
                                    echo "<td>$total_products <span><a href='./account.php?order=$order_id'>View</a></td>";
                                }if($role=='farmer'){
                                    echo "<td>$total_products <span><a href='../farmer_area/account.php?order=$order_id'>View</a></td>";
                                }if($role=='supplier'){
                                    echo "<td>$total_products <span><a href='../supplier_area_area/account.php?order=$order_id'>View</a></td>";
                                }
                                echo "
                                <td>$invoice_no</td>
                                <td>$order_date</td>
                                <td>$order_status</td>
                                <td><a href='./account.php?confirm_payment&o=$order_id' class='text-primary'><u>Confirm</u></a></td>
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
?>