<section class="cart_wrapper text-center">
    <div class="container">
      <div class="cart_box">
        <div class="cart_title d-flex justify-content-between">
          <h1 class="sm-heading">Cart</h1>
          <button id="close_cart">
            <i class="fas fa-xmark"></i>
          </button>
        </div>
        <?php

if(isset($_POST['remove_cart_item'])){
  $id=$_POST['id'];
  $ip = getIPAddress();
  $delete_query="DELETE FROM `cart_details` WHERE product_id=$id and ip_address='$ip'";
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
        <div class="cart_item">
          
          <!-- //adding cart item function -->
          <?php
          cartOpen();
          ?>
        </div>
      </form>

      <?php
      $ip = getIPAddress();
      $query_cart = mysqli_query($con, "Select * from `cart_details` where ip_address='$ip'");
      $cart_count=mysqli_num_rows($query_cart);
      if($cart_count>0){
        echo"<button><a href='cart.php' class='checkout'>View Cart</a></button>";
      }else{
        echo "<h4>You have no items in cart</h4>";
      }
      ?>
      </div>
    </div>
<!-- remove cart  -->

    <div class="cart_total py-4 d-flex justify-content-between">
      <h1 class="sm-heading px-3">Subtotal:</h1>
      <span class="total px-5"><?php totalPriceCart(); ?> /-</span>
    </div>

    <a href="./user_area/checkout.php" class="checkout">Checkout</a>
    <p>Free Shipping on All Orders Over NPR. 1500!</p>
    </div>
  </section>