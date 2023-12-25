<section class="cart_wrapper text-center">
    <div class="container">
      <div class="cart_box">
        <div class="cart_title d-flex justify-content-between">
          <h1 class="sm-heading">Cart</h1>
          <button id="close_cart">
            <i class="fas fa-xmark"></i>
          </button>
        </div>
        <div class="cart_item">
          <div class="cart_item_remove">
            <button>
              <i class="fas fa-xmark"></i>
            </button>
          </div>
          <!-- //adding cart item function -->
          <?php
            $ip = getIPAddress();
            $get_cart_ip = "Select * from `cart_details` where ip_address='$ip'";
            $query_cart = mysqli_query($con, $get_cart_ip);
          
              while ($row = mysqli_fetch_assoc($query_cart)) {
                $product_id = $row['product_id'];
                $product_image = $row['product_image'];
                $product_title = $row['product_title'];
                $product_category=$row['product_category'];
                $product_price = $row['product_price'];
                $quantity = $row['quantity'];
                if($quantity==0){
                  $quantity=1;
                }else{
                  $quantity=$quantity;
                }
                echo"
                <div class='cart_item_details'>
                      <div class='cart_item_image'>
                        <img src='../img/product_img/$product_category/$product_image' alt='$product_title'/>
                      </div>
                      <div class='cart_item_detail'>
                        <h5>$product_title</h5>
                        <p><span class='quantity'>$quantity</span> x <span class='rate'>$product_price</span></p>
                      </div>
                    </div>
                  
              ";
              
              }
          ?>
          </div>
        </div>
      </div>

      <div class="cart_total py-4 d-flex justify-content-between">
        <h1 class="sm-heading px-3">Subtotal:</h1>
        <span class="total px-5"><?php totalPriceCart();?> /-</span>
      </div>

      <a href="./checkout.php" class="checkout">Checkout</a>
      <p>Free Shipping on All Orders Over NPR. 1500!</p>
    </div>
  </section>

