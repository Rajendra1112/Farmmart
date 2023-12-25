<section class="order_wrapper text-center">
    <div class="container">
      <div class="order_box">
        <div class="order_title d-flex justify-content-between">
          <h1 class="sm-heading">Orders</h1>
          <button id="close_order">
            <i class="fas fa-xmark"></i>
          </button>
        </div>
        <?php

if(isset($_POST['remove_order_item'])){
  $id=$_POST['id'];
  $delete_query="DELETE FROM `order_details` WHERE product_id=$id";
  $result=mysqli_query($con,$delete_query);
  if($result){
              echo "<script>window.open('index.php','_self')</script>";
  }
  else{
    echo "<script>window.open('index.php','_self')</script>";

  }
}
?>
        <form action="" method="post">
        <div class="order_item">
          
          <!-- //adding order item function -->
          <?php
          orderOpen();
          ?>
        </div>
      </form>
      </div>
    </div>
    <?php
    $email = $_SESSION['email'];
    $select_user = mysqli_query($con, "Select `role` from `user_table` where email='$email'");
    $row_id = mysqli_fetch_assoc($select_user);
    $user_role = $row_id['role'];

    if($user_role=='farmer'){
        echo "    <a href='./farmer_area/account.php?view_orders' class='checkout'>View Orders</a>
        <p>VIew and manage your order</p>";
    }
    if($user_role=='vendor'){
        echo "    <a href='./suppliers/account.php?view_orders' class='checkout'>View Orders</a>
        <p>VIew and manage your order</p>";
    } if($user_role=='supplier'){
        echo "    <a href='./suppliers/account.php?view_orders' class='checkout'>View Orders</a>
        <p>VIew and manage your order</p>";
    }
    ?>

    </div>
  </section>