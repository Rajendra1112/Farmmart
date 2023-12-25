<?php

//getting categories
function getcategory()
{
  global $con;
  $select_category = "Select * from `category`";
  $result_category = mysqli_query($con, $select_category);
  $open_tap = array("");

  while ($row_data = mysqli_fetch_assoc($result_category)) {
    $category_title = $row_data['category_title'];
    $category_titles = trim($category_title);
    $category_id = $row_data['category_id'];
    echo "<li class='tablinks font-weight-bold'><a class='tablinks font-weight-bold' href='display_all_products.php?category=$category_title'>
                  <i class='fas fa-bag-shopping'></i>
                  $category_title
                </a></li>";
  }
}
//featured products
$aery = array();
function featuredProduct()
{
  global $aery;
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['view_product'])) {
    if (!isset($_GET['category'])) {
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $select_query = "Select * from `products` limit 0,$page";
      }

      if (isset($_GET['category']) and isset($_GET['all'])) {
        $category = $_GET['category'];
        $select_query = "Select * from `products` where product_category='$category' order by rand()";
      }
      if (isset($_GET['all'])) {
        $select_query = "Select * from `products` order by rand() limit 0,20";
      }
      if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
        $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
        $select_query = "Select * from `products` where user_id=$id order by rand() limit 0,8";
      } else {
        $select_query = "Select product_id from `order_item`";
      }
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "";
      }
      $select_query_id = "Select product_id,COUNT(*) as count from `order_item` group by product_id order by count desc limit 0,3";
      $result_query_id = mysqli_query($con, $select_query_id);
      $numr = mysqli_num_rows($result_query_id);

      while ($row = mysqli_fetch_assoc($result_query_id)) {
        $product_id = $row['product_id'];
        array_push($aery, $product_id);

        $select_idp = "Select * from user_rating where product_id = $product_id order by rating desc";
        $result_idp = mysqli_query($con, $select_idp);
        while ($numr_rows = mysqli_fetch_assoc($result_idp)) {
          $product_idps = $numr_rows['product_id'];
          $select_idps = "Select * from products where product_id = $product_idps ";
          $result_idps = mysqli_query($con, $select_idps);
          $numr_row = mysqli_fetch_assoc($result_idps);


          $product_category = $numr_row['product_category'];
          $product_image = $numr_row['product_image'];
          $product_title = $numr_row['product_title'];
          $product_price = $numr_row['product_price'];
          $discount = $numr_row['discount'];
          $product_after_price = floor($product_price - $product_price * $discount / 100);
          echo "
      <div class='product_list_item'>
      <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class=' p-1 bg-success text-white'>Featured</span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
      <div class='product_list_item_image'>";
          if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
            echo "<a href='./product_details.php?farm_id=$id&product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
          } else {
            echo "
          <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>
         ";
          }

          echo "
        </div>
      
      <div class='product_list_item_detail'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
        <del>NPR. $product_price</del>
        <span>NPR. $product_after_price </span>
      </div>
      <div class='product_list_item_hover'>
        <ul class='d-flex justify-content-between align-items-center'>
          <li>
            <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='view_icon'>
              <i class='fas fa-eye'></i>
            </a>
          </li>
          <li>
            <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
              <i class='fas fa-cart-shopping'></i>
            </a>
          </li>
        
        </ul>
      </div>
    </div>";
        }
      }
    }
  }
}

//getting products
function getproducts()
{
  global $aery;
  // print_r($aery);
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['view_product'])) {
    if (!isset($_GET['category'])) {
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $select_query = "Select * from `products` limit 0,$page";
      }

      if (isset($_GET['category']) and isset($_GET['all'])) {
        $category = $_GET['category'];
        $select_query = "Select * from `products` where product_category='$category' order by rand()";
      }
      if (isset($_GET['all'])) {
        $select_query = "Select * from `products` order by rand() limit 0,20";
      }
      if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
        $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
        $select_query = "Select * from `products` where user_id=$id order by rand() limit 0,8";
      } else {
        if (count($aery) == 0) {
          $select_query = "Select * from `products` order by rand() limit 0,8";
        } else {
          $select_query = "Select * from `products` where product_id!=$aery[0] and product_id!=$aery[2] order by rand() limit 0,6";
        }
      }
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        if (count($aery) == 0) {
          echo "sdshjk";
        } else {
          echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
        }
      }


      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_category = $row['product_category'];
        $product_image = $row['product_image'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $discount = $row['discount'];
        $product_after_price = floor($product_price - $product_price * $discount / 100);
        echo "
      <div class='product_list_item'>
      <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class='bg-success text-white'></span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
      <div class='product_list_item_image'>";
        if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
          echo "<a href='./product_details.php?farm_id=$id&product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
        } else {
          echo "
          <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>
         ";
        }

        echo "
        </div>
      
      <div class='product_list_item_detail'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
        <del>NPR. $product_price</del>
        <span>NPR. $product_after_price </span>
      </div>
      <div class='product_list_item_hover'>
        <ul class='d-flex justify-content-between align-items-center'>
          <li>
            <a href='index.php?view_product&product_id=$product_id' class='view_icon'>
              <i class='fas fa-eye'></i>
            </a>
          </li>
          <li>
            <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
              <i class='fas fa-cart-shopping'></i>
            </a>
          </li>
        
        </ul>
      </div>
    </div>";
      }
    }
  }
}

//location
//getting products
function getproductsLocation()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.
  global $location;
  //condition to check isset or not
  if (!isset($_GET['view_product'])) {
    if (!isset($_GET['category'])) {
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $select_query = "Select * from `products` limit 0,$page";
      }

      if (isset($_GET['category']) and isset($_GET['all'])) {
        $category = $_GET['category'];
        $select_query = "Select * from `products` where product_category='$category' order by rand()";
      }
      if (isset($_GET['all'])) {
        $select_query = "Select * from `products` order by rand() limit 0,20";
      }
      if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
        $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
        $select_query = "Select * from `products` where user_id=$id order by rand() limit 0,8";
      } else {
        $select_query = "Select product_id,COUNT(*) as count from `order_item` group by product_id order by count desc";
      }
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
      }
      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $sel_pId = mysqli_query($con, "Select * from products where product_id = $product_id and location='$location'");
        $num_of_rows_id = mysqli_num_rows($sel_pId);
        if ($num_of_rows_id == 0 and $num_of_rows == 0) {
          echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
        } else {
          while ($row_d = mysqli_fetch_assoc($sel_pId)) {
            $product_id = $row_d['product_id'];
            $product_category = $row_d['product_category'];
            $product_image = $row_d['product_image'];
            $product_title = $row_d['product_title'];
            $product_price = $row_d['product_price'];
            $discount = $row_d['discount'];
            $product_after_price = floor($product_price - $product_price * $discount / 100);
            echo "
      <div class='product_list_item'>
      <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class=' bg-success text-white'></span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
      <div class='product_list_item_image'>";
            if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
              echo "<a href='./product_details.php?farm_id=$id&product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
            } else {
              echo "
          <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>
         ";
            }

            echo "
        </div>
      
      <div class='product_list_item_detail'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
        <del>NPR. $product_price</del>
        <span>NPR. $product_after_price </span>
      </div>
      <div class='product_list_item_hover'>
        <ul class='d-flex justify-content-between align-items-center'>
          <li>
            <a href='index.php?view_product&product_id=$product_id' class='view_icon'>
              <i class='fas fa-eye'></i>
            </a>
          </li>
          <li>
            <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
              <i class='fas fa-cart-shopping'></i>
            </a>
          </li>
        
        </ul>
      </div>
    </div>";
          }
        }
      }
    }
  }
}

//Heavy discount
//getting products
function discount()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['view_product'])) {
    if (!isset($_GET['category'])) {
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $select_query = "Select * from `products` limit 0,$page";
      }

      if (isset($_GET['category']) and isset($_GET['all'])) {
        $category = $_GET['category'];
        $select_query = "Select * from `products` where product_category='$category' order by rand()";
      }
      if (isset($_GET['all'])) {
        $select_query = "Select * from `products` order by rand() limit 0,20";
      }
      if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
        $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
        $select_query = "Select * from `products` where user_id=$id order by rand() limit 0,8";
      } else {
        $select_query = "Select * from `products` order by discount DESC limit 0,4";
      }
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
      }


      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_category = $row['product_category'];
        $product_image = $row['product_image'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $discount = $row['discount'];
        $product_after_price = floor($product_price - $product_price * $discount / 100);
        echo "
      <div class='product_list_item'>
      <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class=' bg-success text-white'></span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
      <div class='product_list_item_image'>";
        if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
          echo "<a href='./product_details.php?farm_id=$id&product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
        } else {
          echo "
          <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>
         ";
        }

        echo "
        </div>
      
      <div class='product_list_item_detail'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
        <del>NPR. $product_price</del>
        <span>NPR. $product_after_price </span>
      </div>
      <div class='product_list_item_hover'>
        <ul class='d-flex justify-content-between align-items-center'>
          <li>
            <a href='index.php?view_product&product_id=$product_id' class='view_icon'>
              <i class='fas fa-eye'></i>
            </a>
          </li>
          <li>
            <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
              <i class='fas fa-cart-shopping'></i>
            </a>
          </li>
        
        </ul>
      </div>
    </div>";
      }
    }
  }
}

//flash sale
//getting products
function flashSale()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['view_product'])) {
    if (!isset($_GET['category'])) {
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $select_query = "Select * from `products` limit 0,$page";
      }

      if (isset($_GET['category']) and isset($_GET['all'])) {
        $category = $_GET['category'];
        $select_query = "Select * from `products` where product_category='$category' order by rand()";
      }
      if (isset($_GET['all'])) {
        $select_query = "Select * from `products` order by rand() limit 0,20";
      }
      if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
        $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
        $select_query = "Select * from `products` where user_id=$id order by rand() limit 0,8";
      } else {
        $select_query = "Select * from `products` where type = 'huge' order by discount DESC limit 0,4";
      }
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
      }


      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_category = $row['product_category'];
        $product_image = $row['product_image'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $discount = $row['discount'];
        $product_after_price = floor($product_price - $product_price * $discount / 100);
        echo "
      <div class='product_list_item'>
      <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class=' p-1 bg-success text-white fw-bolder'>Sale</span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
      <div class='product_list_item_image'>";
        if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
          echo "<a href='./product_details.php?farm_id=$id&product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
        } else {
          echo "
          <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>
         ";
        }

        echo "
        </div>
      
      <div class='product_list_item_detail'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
        <del>NPR. $product_price</del>
        <span>NPR. $product_after_price </span>
      </div>
      <div class='product_list_item_hover'>
        <ul class='d-flex justify-content-between align-items-center'>
          <li>
            <a href='index.php?view_product&product_id=$product_id' class='view_icon'>
              <i class='fas fa-eye'></i>
            </a>
          </li>
          <li>
            <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
              <i class='fas fa-cart-shopping'></i>
            </a>
          </li>
        
        </ul>
      </div>
    </div>";
      }
    }
  }
}

//flash sale
//getting products
function oldSale()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['view_product'])) {
    if (!isset($_GET['category'])) {
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $select_query = "Select * from `products` limit 0,$page";
      }

      if (isset($_GET['category']) and isset($_GET['all'])) {
        $category = $_GET['category'];
        $select_query = "Select * from `products` where product_category='$category' order by rand()";
      }
      if (isset($_GET['all'])) {
        $select_query = "Select * from `products` order by rand() limit 0,20";
      }
      if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
        $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
        $select_query = "Select * from `products` where user_id=$id order by rand() limit 0,8";
      } else {
        $select_query = "Select * from `products` where product_category='Vegetables' order by date DESC limit 0,4";
      }
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
      }


      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_category = $row['product_category'];
        $product_image = $row['product_image'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $product_date = $row['date'];
        $discount = $row['discount'];
        $dateTimestamp = strtotime($product_date);
        $curr_date = time();
        if ($curr_date > $dateTimestamp) {
          $discount = $discount + 10;
        }

        $product_after_price = floor($product_price - $product_price * $discount / 100);
        echo "
      <div class='product_list_item'>
      <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class=' p-1 bg-success text-white fw-bolder'>Sale</span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
      <div class='product_list_item_image'>";
        if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
          echo "<a href='./product_details.php?farm_id=$id&product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
        } else {
          echo "
          <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>
         ";
        }

        echo "
        </div>
      
      <div class='product_list_item_detail'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
        <del>NPR. $product_price</del>
        <span>NPR. $product_after_price </span>
      </div>
      <div class='product_list_item_hover'>
        <ul class='d-flex justify-content-between align-items-center'>
          <li>
            <a href='index.php?view_product&product_id=$product_id' class='view_icon'>
              <i class='fas fa-eye'></i>
            </a>
          </li>
          <li>
            <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
              <i class='fas fa-cart-shopping'></i>
            </a>
          </li>
        
        </ul>
      </div>
    </div>";
      }
    }
  }
}

//flash sale
//getting products
function trendingProduct()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['view_product'])) {
    if (!isset($_GET['category'])) {
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $select_query = "Select * from `products` limit 0,$page";
      }

      if (isset($_GET['category']) and isset($_GET['all'])) {
        $category = $_GET['category'];
        $select_query = "Select * from `products` where product_category='$category' order by rand()";
      }
      if (isset($_GET['all'])) {
        $select_query = "Select * from `products` order by rand() limit 0,20";
      }
      if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
        $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
        $select_query = "Select * from `products` where user_id=$id order by rand() limit 0,8";
      } else {
        $select_query = "SELECT * FROM order_item WHERE DATE(date) = CURDATE()";
      }
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
      }


      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_image = $row['product_image'];
        $product_title = $row['product_title'];
        $cat_query = mysqli_query($con, "Select * from products where product_id = $product_id");
        $cat_row = mysqli_fetch_assoc($cat_query);
        $product_category = $cat_row['product_category'];
        $discount = $cat_row['discount'];
        $product_price = $cat_row['product_price'];
        $product_after_price = floor($product_price - $product_price * $discount / 100);

        echo "
      <div class='product_list_item'>
      <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class='  bg-success text-white fw-bolder'></span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
      <div class='product_list_item_image'>";
        if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
          echo "<a href='./product_details.php?farm_id=$id&product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
        } else {
          echo "
          <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>
         ";
        }

        echo "
        </div>
      
      <div class='product_list_item_detail'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
        <del>NPR. $product_price</del>
        <span>NPR. $product_after_price </span>
      </div>
      <div class='product_list_item_hover'>
        <ul class='d-flex justify-content-between align-items-center'>
          <li>
            <a href='index.php?view_product&product_id=$product_id' class='view_icon'>
              <i class='fas fa-eye'></i>
            </a>
          </li>
          <li>
            <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
              <i class='fas fa-cart-shopping'></i>
            </a>
          </li>
        
        </ul>
      </div>
    </div>";
      }
    }
  }
}

//getting all products
function get_all_products()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['category'])) {
    $limit = 8;
    $page = 1;
    if (isset($_GET['farm_id'])) {
      $farm_id = $_GET['farm_id'];
      $select_query = "Select * from `products` where user_id=$farm_id order by rand()";
    }

    if (isset($_GET['products'])) {
      $select_query = "Select * from `products`";
    } else if (isset($_GET['all'])) {
      $select_query = "Select * from `products` limit 0,8";
      $product = mysqli_query($con, "Select * from `products`");
      $value = 'all';
      if (isset($_GET['page'])) {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        // $product = mysqli_query($con, "Select * from `products`");
        if (mysqli_num_rows($product) > 0) {
          $total_products = mysqli_num_rows($product);
          $total_page = ceil($total_products / $limit);
          if ($page > $total_page) {
            $page = $total_page;
            $select_query = "Select * from `products` limit 0,$limit ";
          } else {
            $select_query = "Select * from `products` limit $limit offset $offset";
          }
        }
      }
    } else if (isset($_GET['flash_sale'])) {
      $select_query = "Select * from `products` where type = 'huge' order by discount DESC limit 0,$limit";
      $product = mysqli_query($con, "Select * from `products` where type = 'huge' order by discount DESC");
      $value = 'flash_sale';
      if (isset($_GET['page'])) {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        // $product = mysqli_query($con, "Select * from `products`");
        if (mysqli_num_rows($product) > 0) {
          $total_products = mysqli_num_rows($product);
          $total_page = ceil($total_products / $limit);
          if ($page > $total_page) {
            $page = $total_page;
            $select_query = "Select * from `products` where type = 'huge' order by discount DESC  0,$limit ";
          } else {
            $select_query = "Select * from `products` where type = 'huge' order by discount DESC  limit $limit offset $offset";
          }
        }
      }
    } else if (isset($_GET['old_product'])) {
      $select_query = "Select * from `products` where product_category='Vegetables' order by discount DESC limit 0,$limit";
      $product = mysqli_query($con, "Select * from `products` where  product_category='Vegetables' order by date DESC");
      $value = 'flash_sale';
      if (isset($_GET['page'])) {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        // $product = mysqli_query($con, "Select * from `products`");
        if (mysqli_num_rows($product) > 0) {
          $total_products = mysqli_num_rows($product);
          $total_page = ceil($total_products / $limit);
          if ($page > $total_page) {
            $page = $total_page;
            $select_query = "Select * from `products` where  product_category='Vegetables' order by date DESC  0,$limit ";
          } else {
            $select_query = "Select * from `products` where  product_category='Vegetables' order by date DESC  limit $limit offset $offset";
          }
        }
      }
    } else if (isset($_GET['discount'])) {
      $select_query = "Select * from `products` order by discount DESC limit 0,$limit";
      $product = mysqli_query($con, "Select * from `products` order by discount DESC");
      $value = 'discount';

      if (isset($_GET['page'])) {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        // $product = mysqli_query($con, "Select * from `products`");
        if (mysqli_num_rows($product) > 0) {
          $total_products = mysqli_num_rows($product);
          $total_page = ceil($total_products / $limit);
          if ($page > $total_page) {
            $page = $total_page;
            $select_query = "Select * from `products` order by discount DESC limit 0,$limit ";
          } else {
            $select_query = "Select * from `products` order by discount DESC limit $limit offset $offset";
          }
        }
      }
    } else if (isset($_GET['trending'])) {
      $select_query = "SELECT * FROM order_item WHERE DATE(date) = CURDATE()";
      $product = mysqli_query($con, "SELECT * FROM order_item WHERE DATE(date) = CURDATE()`");
      $value = 'trending';
      if (isset($_GET['page'])) {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;
        // $product = mysqli_query($con, "Select * from `products`");
        if (mysqli_num_rows($product) > 0) {
          $total_products = mysqli_num_rows($product);
          $total_page = ceil($total_products / $limit);
          if ($page > $total_page) {
            $page = $total_page;
            $select_query = "SELECT * FROM order_item WHERE DATE(date) = CURDATE() limit 0,$limit ";
          } else {
            $select_query = "SELECT * FROM order_item WHERE DATE(date) = CURDATE() limit $limit offset $offset";
          }
        }
      }
    } else {
      $select_query = "Select * from `products`";
      $product = mysqli_query($con, "Select * from `products`");
      $value = 'all';
    }
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $user_id = $row['user_id'];
      $product_category = $row['product_category'];
      $product_image = $row['product_image'];
      $product_title = $row['product_title'];
      $product_price = $row['product_price'];
      $product_date = $row['date'];
      $discount = $row['discount'];
      $product_after_price = floor($product_price - $product_price * $discount / 100);

      if (isset($_GET['old_product'])) {
        $dateTimestamp = strtotime($product_date);
        $curr_date = time();
        if ($curr_date > $dateTimestamp) {
          $discount = $discount + 10;
          $product_after_price = floor($product_price - $product_price * $discount / 100);
        }
      }

      echo "
    <div class='product_list_item'>
    <div class='product_list_item_image'>
    <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class=' bg-success text-white'></span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>";
      if (isset($_GET['farm_id'])) {
        echo "<a href='./product_details.php?farm_id=$farm_id&product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
      }
      if (isset($_GET['products'])) {
        echo "<a href='../product_details.php?user_id=$user_id&product_id=$product_id&product_title=$product_title'>
          <img src='../img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
      } else {
        echo "
          <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
          </a>";
      }

      echo "
      </div>
    <div class='product_list_item_detail'>
      <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
      <del>NPR. $product_price</del>
      <span>NPR. $product_after_price </span>
    </div>
    <div class='product_list_item_hover'>
      <ul class='d-flex justify-content-between align-items-center'>
        <li>
          <a href='#' class='view_icon'>
            <i class='fas fa-eye'></i>
          </a>
        </li>
        <li>
          <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
            <i class='fas fa-cart-shopping'></i>
          </a>
        </li>
       
      </ul>
    </div>
  </div>";
    }
    if (isset($_GET['farm_id']) or isset($_GET['products']) or isset($_GET['all']) or isset($_GET['flash_sale']) or isset($_GET['trending']) or isset($_GET['discount'])) {

      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

      if (mysqli_num_rows($product) > 0) {
        $total_products = mysqli_num_rows($product);
        $total_page = ceil($total_products / $limit);
        echo "</div><nav class='border-top border-bottom p-2'>
          <ul class='pagination'>";
        if ($page > 1) {
          $prev = $page - 1;
          echo "<li class='page-item'><a class='page-link' href='./display_all_products.php?$value&page=$prev'>Prev</a> </li>";
        }
        for ($i = 1; $i <= $total_page; $i++) {
          if ($i == $page) {
            $active = 'active';
          } else {
            $active = '';
          }
          echo "<li class='page-item'><a class='px-2 page-link $active' href='./display_all_products.php?$value&page=$i'>$i</a></li>";
        }
        if ($total_page > $page) {
          $next = $page + 1;
          echo "<li class='page-item'><a class='page-link' href='./display_all_products.php?$value&page=$next'>Next</a> </li>";
        }
        echo "</ul></nav>";
      }
    }
  } else {
    echo "";
  }
}

//get type
// function getType($type){
//   global $con;

// }

//getting unique products
function get_unique_products()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (isset($_GET['category'])) {
    $category_title = $_GET['category'];
    $limit = 4;
    $page = 1;

    if (isset($_GET['all'])) {
      $select_query = "Select * from `products` where product_category='$category_title' order by rand()";
    }
    if (isset($_GET['page'])) {
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $page = $page < 1 ? 1 : $page;
      $offset = ($page - 1) * $limit;
      $product = mysqli_query($con, "Select * from `products` where product_category='$category_title'");
      if (mysqli_num_rows($product) > 0) {
        $total_products = mysqli_num_rows($product);
        $total_page = ceil($total_products / $limit);
        if ($page > $total_page) {
          $page = $total_page;
          $select_query = "Select * from `products` where product_category='$category_title' limit 0,$limit ";
        } else {
          $select_query = "Select * from `products` where product_category='$category_title' limit $limit offset $offset";
        }
      }
    } else {
      $select_query = "Select * from `products` where product_category='$category_title' order by rand() limit 0,$limit";
    }
    $result_query = mysqli_query($con, $select_query);

    //checking the products if not then this will run.
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
      $product_id = $row['product_id'];
      $product_category = $row['product_category'];
      $product_image = $row['product_image'];
      $product_title = $row['product_title'];
      $product_price = $row['product_price'];
      $discount = $row['discount'];
      $product_after_price = floor($product_price - $product_price * $discount / 100);
      echo "
      
      <div class='product_list_item'>
    <div class='product_list_item_image'>
    <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class=' p-1 bg-success text-white'>Featured</span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
      <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
        <img src='./img/product_img/$product_category/$product_image' alt='Kiwi' />
      </a>
    </div>
    <div class='product_list_item_detail'>
      <a href='./product-details.html' class='sm-heading'>$product_title</a>
      <del>NPR. $product_price</del>
      <span>NPR. $product_after_price </span>
    </div>
    <div class='product_list_item_hover'>
      <ul class='d-flex justify-content-between align-items-center'>
        <li>
          <a href='' class='view_icon'>
            <i class='fas fa-eye'></i>
          </a>
        </li>
        <li>
          <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
            <i class='fas fa-cart-shopping'></i>
          </a>
        </li>
       
      </ul>
   
  </div>
  </div>
  ";
    }
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $product = mysqli_query($con, "Select * from `products` where product_category='$category_title'");
    if (mysqli_num_rows($product) > 0) {
      $total_products = mysqli_num_rows($product);
      $total_page = ceil($total_products / $limit);
      echo "</div><nav class='border-top d-flex justify-content-end border-bottom p-2'>
          <ul class='pagination'>";
      if ($page > 1) {
        $prev = $page - 1;
        echo "<li class='page-item border-0'><a class='page-link border-0' href='./display_all_products.php?category=$category_title&page=$prev'>Prev</a> </li>";
      }
      for ($i = 1; $i <= $total_page; $i++) {
        if ($i == $page) {
          $active = 'active';
        } else {
          $active = '';
        }

        echo "<li class='page-item border-0'><a class=' page-link $active' href='./display_all_products.php?category=$category_title&page=$i'>$i</a></li>";
      }
      if ($total_page > $page) {
        $next = $page + 1;
        echo "<li class='page-item border-0'><a class='page-link' href='./display_all_products.php?category=$category_title&page=$next'>Next</a> </li>";
      }
      echo "</ul></nav>";
    }
  }
}

//view products
function viewProduct()
{
  global $con;
  if (isset($_GET['view_product'])) {
    if (isset($_GET['product_id'])) {
      $product_id = $_GET['product_id'];
      $select_query = "Select * from `products` where product_id='$product_id'";

      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);

      $row = mysqli_fetch_assoc($result_query);
      $product_image = $row['product_image'];
      $product_title = $row['product_title'];
      $product_price = $row['product_price'];
      $product_category = $row['product_category'];
      $discount = $row['discount'];
      $product_after_price = floor($product_price - $product_price * $discount / 100);
      echo "
       <div class='product_view'>
       <div class='product_view_box active'>
      <div class='row align-items-center'>
        <div class='col-lg-6 col-md-12'>
          <div class='product_image'>
            <img src='./img/product_img/$product_category/$product_image' alt='' />
          </div>
        </div>
        <div class='col-lg-6 col-md-12'>
          <div class='product_details'>
            <button class='close_quick_view'>
              <i class='fas fa-xmark'></i>
            </button>

            <div class='product_detail'>
              <h1 class='sm-heading'>$product_title</h1>
              <span>NPR. $product_after_price Per KG</span>
              <del>NPR. $product_price Per KG</del>
            </div>

            <ul class='product_specs'>
              <li class='title'>Product Feature:</li>
              <li>Fresh</li>
              <li>Organic</li>
              <li>Authentic</li>
            </ul>

            <div class='cart-section'>
              <div class='quantity'>
                <button class='dec'>-</button>
                <input type='text' min='0' value='2' class='cart_quantity' />
                <button class='inc'>+</button>
              </div>

              <div class='cart-btn'>
                <button class='more-btn'>
                  <i class='fas fa-cart-shopping'></i>
                  Add to Cart
                </button>
              </div>
            </div>

           
          </div>
        </div>
      </div>
    </div>
    </div>
       ";
    }
  }
}


//reladed product view more
function product_detail()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (isset($_GET['product_id'])) {
    if (!isset($_GET['category'])) {
      $product_id = $_GET['product_id'];
      $select_query = "Select * from `products` where product_id='$product_id'";

      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
      }

      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_image = $row['product_image'];
        $product_image1 = $row['product_image1'];
        $product_image2 = $row['product_image2'];
        $product_image3 = $row['product_image3'];
        $product_title = $row['product_title'];
        $quantity = $row['quantity'];
        $product_price = $row['product_price'];
        $product_category = $row['product_category'];
        $discount = $row['discount'];
        $product_after_price = floor($product_price - $product_price * $discount / 100);
        if ($quantity == 0) {
          $quantity = 'Out of stock';
          $qty = 0;
        } else {
          $qty = $quantity;
        }
        echo "
    <div class='product_detail'>
    <div class='container'>
      <div class='row'>
        <div class='col-xl-6 col-md-12 col-sm-12'>
          <div class='image-slider'>
            <div id='product_detail_image' class='detail'>
            <img src='./img/product_img/$product_category/$product_image' alt='$product_title' />
          </div>
          </div>
          <ul class='image_slider_nav'>
            <li class='detail_img'>
             
                <img  src='./img/product_img/$product_category/$product_image' alt='$product_title' />
              
            </li>
            <li class='detail_img'>
             
                <img  src='./img/product_img/$product_category/$product_image1' alt='$product_title' />
              
            </li>
            <li class='detail_img'>
             
                <img src='./img/product_img/$product_category/$product_image2' alt='$product_title' />
              
            </li>
            <li class='detail_img'>
             
                <img src='./img/product_img/$product_category/$product_image3' alt='$product_title' />
              
            </li>
          </ul>
        </div>
        <div class='col-xl-6 col-md-12 col-sm-12'>
        <form method='get' action='./user_area/checkout.php?p=$product_id'>
          <div class='product_title'>
            <h1 class='md-heading'>$product_title</h1><br>
            <span>Rs.<del>$product_price</del></span>
            <span>$product_after_price</span>
          </div>
          <p class='product_highlight'>
            Aliquam hendrerit a augue insuscipit. Etiam aliquam massa quis des mauris commodo venenatis ligula commodo leez sed blandit convallis
            dignissim onec vel pellentesque neque.
          </p>
          <div class='quantity mb-2 d-inline-flex'>
            <span class='text '> Quantity: </span>&nbsp;&nbsp;&nbsp;&nbsp;
            <input class='form-control w-25' type='hidden' name='id' value='$product_id' />
            <input class='form-control w-25' type='number' max='$qty' min='1' name='q' value='1' />&nbsp; &nbsp; &nbsp;<span>/ $quantity </span>
          </div>

          <div class='product_detail_btn'>
          ";
        if ($qty == 0) {
          echo "<button class='more-btn' type = '' name=''>Buy Now</button>";
        } else {
          echo "<button class='more-btn' type = 'submit' name=''>Buy Now</button>";
        }
        echo "<a href='index.php?add_to_cart=$product_id' class='more-btn'>Add to Cart</a>
          </div>
          </form>
        </div>

        <div class='col-xl-12 col-md-12 col-sm-12'>
          <div class='product_description'>
            <span class='more-btn'>Description</span>

            <p>
              Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima obcaecati numquam repellendus dicta itaque, cumque pariatur assumenda
              facilis earum optio officia quo porro eaque possimus nihil cupiditate omnis perspiciatis sit iusto. Officiis alias, quisquam animi at
              laudantium laboriosam. Commodi fugiat ullam facere molestias porro nobis. Facere commodi modi cumque perferendis.
            </p>
            <ul class='key-feature'>
              <li>Nam at elit nec neque suscipit gravida.</li>
              <li>Aenean egestas orci eu maximus tincidunt.</li>
              <li>Curabitur vel turpis id tellus cursus laoreet.</li>
            </ul>

            <p>
              All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on
              the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem
              Ipsum which looks reasonable.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
";
      }
    }
  }
}

function related_products()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  if (isset($_GET['product_id']) and isset($_GET['product_title'])) {
    if (!isset($_GET['category'])) {
      $product_id = $_GET['product_id'];
      $product_id_title = $_GET['product_title'];
      $words = explode(' ', $product_id_title);
      $select_product = "Select * from `products` where product_id=$product_id";
      $result_product_query = mysqli_query($con, $select_product);
      $cat_select = mysqli_fetch_assoc($result_product_query);
      $product_cat = $cat_select['product_category'];
      $user_id = $cat_select['user_id'];

      // location 
      $sel_location = mysqli_query($con, "Select `address` from `user_table` where user_id = $user_id");
      $result_loc = mysqli_fetch_assoc($sel_location);
      $location = $result_loc['address'];

      $product_keywords = $cat_select['product_keywords'];
      $word = strpos($product_keywords, $product_id_title);
      $select_query = "Select * from `products` where location='$location' or product_keywords like '$product_keywords' and product_id!=$product_id order by rand() limit 0,4";
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "<h2 class='d-block text-center text-danger'>No related products found </h2>";
      }

      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_category = $row['product_category'];
        $product_image = $row['product_image'];
        $product_title = $row['product_title'];
        $product_price = $row['product_price'];
        $discount = $row['discount'];
        $product_after_price = floor($product_price - $product_price * $discount / 100);
        echo "
  <!-- related products -->
          <div class='product_list d-inline-block'>
              <div class='product_list_item'>
              <div class='position-absolute w-100 d-flex justify-content-between'>
          <span class=' p-1 bg-success text-white'>Featured</span>
          <span class=' py-1 px-2 text-center bg-warning rounded-circle text-white'>$discount%</span>
        </div>
                <div class='product_list_item_image'>
                  <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
                    <img src='./img/product_img/$product_category/$product_image' alt='$product_title' />
                  </a>
                </div>
                <div class='product_list_item_detail'>
                  <a href='./product-details.html' class='sm-heading'>$product_title</a>
                  <del>NPR. $product_price</del>
                  <span>NPR. $product_after_price </span>
                </div>
                <div class='product_list_item_hover'>
                  <ul class='d-flex justify-content-between align-items-center'>
                    <li>
                      <a href='#' class='view_icon'>
                        <i class='fas fa-eye'></i>
                      </a>
                    </li>
                    <li>
                      <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
                        <i class='fas fa-cart-shopping'></i>
                      </a>
                    </li>
                    <li>
                      <a href='#' class='add_wish_icon'>
                        <i class='fas fa-heart'></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              </div>
              
  ";
      }
      if ($num_of_rows > 0) {
        echo "<div class='category-btn py-5'>
        <a href='related_product_all.php?product_title=$product_category' class='more-btn'>View All</a>
      </div>";
      }
    }
  }
}
function viewmore_related()
{
  if (isset($_GET['product_id']) and isset($_GET['product_title'])) {
    if (!isset($_GET['category'])) {
      $product_category = $_GET['product_id'];
      //     echo "
      // <div class='category-btn py-5'>
      //   <a href='related_product_all.php?product_title=$product_category' class='more-btn'>View All</a>
      // </div>";
    }
  }
}



//view more link
function viewmore()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.
  if (isset($_GET['category'])) {
    $category_title = $_GET['category'];
    $category_title_lowercase = strtolower($category_title);
    echo "<a href='display_all_products.php?category=$category_title&all' class='more-btn'>View All</a>";
  }
}
function viewmoreall($get)
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.
  if (!isset($_GET['category'])) {
    echo "<a href='display_all_products.php?$get' class='more-btn'>View All</a>";
  }
}


//searching product function

function search_product()
{
  global $con;
  //search bar matching
  if (isset($_GET['search_data_product'])) {
    $search_data_value = $_GET['search_data'];
    $limit = 4;
    $page = 1;
    if (isset($_GET['page'])) {
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $page = $page < 1 ? 1 : $page;
      $offset = ($page - 1) * $limit;
      $product = mysqli_query($con, "Select * from `products` where product_keywords like '%$search_data_value%'");
      $numof = mysqli_num_rows($product);
      if (mysqli_num_rows($product) > 0) {
        $total_products = mysqli_num_rows($product);
        $total_page = ceil($total_products / $limit);
        if ($page > $total_page) {
          $page = $total_page;
          $search_query = "Select * from `products` where product_keywords like '%$search_data_value%' limit 0,$limit ";
        } else {
          $search_query = "Select * from `products` where product_keywords like '%$search_data_value%' limit $limit offset $offset";
        }
      }
    } else {
      $search_query = "Select * from `products` where product_keywords like '%$search_data_value%' order by rand() limit 0,$limit";
    }
    // if (isset($_GET['category']) and isset($_GET['all'])) {
    //   $category = $_GET['category'];
    //   $search_query = "Select * from `products` where product_category='$category' and product_keywords like '%$search_data_value%'";
    // } else {
    //   $search_query = "Select * from `products` where product_keywords like '%$search_data_value%' limit 0,$limit";
    // }
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);
    $num = isset($_GET['page']) ? $numof : $num_of_rows;

    if ($num == 0) {
      echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
    } else {
      echo "<div class='search-prod d-none'>
              <h5 id='search-prod' ><span class='text-success'>$num</span> products found for <span class='text-primary'>“ $search_data_value ”</span></h5>
            </div>";
      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_image = $row['product_image'];
        $product_title = $row['product_title'];
        $product_category = $row['product_category'];
        $product_price = $row['product_price'];
        $discount = $row['discount'];
        $product_after_price = floor($product_price - $product_price * $discount / 100);
        echo "
      <div class='product_list_item'>
      <div class='product_list_item_image'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title'>
          <img src='./img/product_img/$product_category/$product_image' alt='$product_title' />
        </a>
      </div>
      <div class='product_list_item_detail'>
        <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='sm-heading'>$product_title</a>
        <del>NPR. $product_price</del>
        <span>NPR. $product_after_price </span>
      </div>
      <div class='product_list_item_hover'>
        <ul class='d-flex justify-content-between align-items-center'>
          <li>
            <a href='./product_details.php?product_id=$product_id&product_title=$product_title' class='view_icon'>
              <i class='fas fa-eye'></i>
            </a>
          </li>
          <li>
            <a href='index.php?add_to_cart=$product_id' class='add_cart_icon'>
              <i class='fas fa-cart-shopping'></i>
            </a>
          </li>
          <li>
            <a href='#' class='add_wish_icon'>
              <i class='fas fa-heart'></i>
            </a>
          </li>
        </ul>
      </div>
      
      </div>
    ";
      }
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $product = mysqli_query($con, "Select * from `products` where product_keywords like '%$search_data_value%'");
      if (mysqli_num_rows($product) > 0) {
        $total_products = mysqli_num_rows($product);
        $total_page = ceil($total_products / $limit);
        echo " </div><nav class='border-top border-bottom p-2'>
          <ul class='pagination justify-content-end'>";
        if ($page > 1) {
          $prev = $page - 1;
          echo "<li class='page-item border-0  m-0'><a class='page-link ' href='./search_product.php?search_data=$search_data_value&search_data_product=Search&page=$prev'>Prev</a> </li>";
        }
        for ($i = 1; $i <= $total_page; $i++) {
          if ($i == $page) {
            $active = 'active';
          } else {
            $active = '';
          }

          echo "<li class='page-item border-0 m-0'><a class='px-2 page-link $active' href='./search_product.php?search_data=$search_data_value&search_data_product=Search&page=$i'>$i</a></li>";
        }
        if ($total_page > $page) {
          $next = $page + 1;
          echo "<li class='page-item border-0 m-0'><a class='page-link' href='./search_product.php?search_data=$search_data_value&search_data_product=Search&page=$next'>Next</a> </li>";
        }
        echo "</ul></nav>";
      }
    }
  }
}


//plan
function getPlan()
{
  global $con;
  if (isset($_GET['farm_id']) or isset($_GET['supplier_id'])) {
    $id = $_GET['farm_id'] ?? $_GET['supplier_id'];

    $select = "Select * from `plan` where user_id=$id";
    $result = mysqli_query($con, $select);
    $num = mysqli_num_rows($result);
    if ($num == 0) {
      echo "<h1 class='text-center py-5 text-danger'>No Plans </h1>";
    } else {
      while ($row = mysqli_fetch_array($result)) {
        $plan_id = $row['plan_id'];
        $plan_after_price = $row['plan_after_price'];
        $category = $row['plan_category'];
        $cat = ucfirst($category);
        // $services = $row['service'];
        echo "
    <div class='col-sm-12 col-md-6 col-lg-4 col-xl-3'>
              <div class='package '>
                <div class='plan'>
                  <div class='price'>
                    <h1 class='lg-heading'>Rs. $plan_after_price</h1>
                    <p>Per Day</p>
                  </div>
                  <div class='plan_title'>
                    <h1 class='sm-heading'>$cat plan</h1>
                  </div>
                  <ul>";
        $sel_services = "Select * from `services` where plan_id=$plan_id and user_id=$id and category='$category'";
        $result_services = mysqli_query($con, $sel_services);
        while ($row = mysqli_fetch_assoc($result_services)) {
          $service = $row['service'];
          echo "<li>$service</li>";
        }
        echo "
                  </ul>
                  <div class='pricing_btn text-center'>
                    <a href='#' class='sub_btn'>
                      <span>Subscribe</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
    ";
      }
    }
  }
}

//function to get ip address
function getIPAddress()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
// $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;

//cart function
function cart()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $ip = getIPAddress();
    $get_product_id = $_GET['add_to_cart'];
    $get_product = "Select * from `products` where product_id=$get_product_id";
    $result_query_product = mysqli_query($con, $get_product);
    $row = mysqli_fetch_assoc($result_query_product);
    $product_image = $row['product_image'];
    $product_title = $row['product_title'];
    $product_category = $row['product_category'];
    $product_price = $row['product_price'];
    $discount = $row['discount'];
    $product_after_price = floor($product_price - $product_price * $discount / 100);
    $select_query = "Select * from `cart_details` where ip_address='$ip' and product_id=$get_product_id";

    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows > 0) {
      echo "<script>alert('This product is already present inside cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";  //self-> redirect to same page.
    } else {
      $insert_query = "INSERT INTO `cart_details`(`product_id`, `ip_address`, `product_title`,`product_category`, `product_price`, `quantity`, `product_image`) VALUES ($get_product_id,'$ip','$product_title','$product_category',$product_after_price,1,'$product_image')";
      $result_query = mysqli_query($con, $insert_query);
      echo "<script>alert('Product is added to cart')</script>";
      echo "<script>window.open('index.php','_self')</script>";
    }
  }
}


//function to get cart number
function cartItem()
{
  if (isset($_GET['add_to_cart'])) {
    global $con;
    $ip = getIPAddress();
    $select_query = "Select * from `cart_details` where ip_address='$ip'";

    $result_query = mysqli_query($con, $select_query);
    $count_cart_item = mysqli_num_rows($result_query);
  } else {
    global $con;
    $ip = getIPAddress();
    $select_query = "Select * from `cart_details` where ip_address='$ip'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_item = mysqli_num_rows($result_query);
  }
  echo $count_cart_item;
}

//cart open function
function cartOpen()
{
  global $con;
  $ip = getIPAddress();
  $get_cart_ip = "Select * from `cart_details` where ip_address='$ip'";
  $query_cart = mysqli_query($con, $get_cart_ip);

  while ($row = mysqli_fetch_assoc($query_cart)) {
    $product_id = $row['product_id'];
    $product_image = $row['product_image'];
    $product_title = $row['product_title'];
    $product_category = $row['product_category'];
    $product_price = $row['product_price'];

    $quantity = $row['quantity'];
    if ($quantity == 0) {
      $quantity = 1;
    } else {
      $quantity = $quantity;
    }
    echo "
    
      <div class='cart_item_details'>
      <div class='px-2'>
        
        <input type='hidden' name='id'  value='$product_id'/>
            <button type='submit' name='remove_cart_item'>
              <i class='fas fa-xmark'></i>
            </button>
            
          </div>
            <div class='cart_item_image'>
              <img src='./img/product_img/$product_category/$product_image' alt='$product_title'/>
            </div>
            <div class='cart_item_detail'>
              <h5>$product_title</h5>
              <p><span class='quantity'>$quantity</span> x <span class='rate'>$product_price</span></p>
            </div>
          </div>
        
    ";
  }
}

//total price cart function
function totalPriceCart()
{
  global $con;
  $total = 0;
  $ip = getIPAddress();
  $cart_query = "Select * from `cart_details` where ip_address='$ip'";
  $result = mysqli_query($con, $cart_query);
  while ($row = mysqli_fetch_array($result)) {
    $product_id = $row['product_id'];
    $select_products = "Select * from `cart_details` where product_id=$product_id";
    $result_product = mysqli_query($con, $select_products);
    while ($row_product_price = mysqli_fetch_array($result_product)) {
      $item_price = $row_product_price['product_price'];

      $product_price = array($item_price);
      $product_price_sum = array_sum($product_price);
      $total += $product_price_sum;
    }
  }

  // if(isset($_GET)){
  echo "$total";
  // }


}

//delete cart function
function remove_cart_item()
{
  global $con;
  $ip = getIPAddress();
  if (isset($_POST['remove_cart'])) {
    $remove_id = $_POST['remove_cart'];
    $delete_query = "Delete from `cart_details` where product_id=$remove_id and ip_address='$ip'";
    $run_delete = mysqli_query($con, $delete_query);
    if ($run_delete) {
      echo "<script>window.open('cart.php','_self'</script>";
    }
  }
}

//function call to remove item
echo $remove_item = remove_cart_item();

//order item
//function to get order number
function orderItem()
{
  global $con;
  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sel_user = mysqli_query($con, "Select user_id from user_table where email ='$email'");
    $row = mysqli_fetch_assoc($sel_user);
    $user_id = $row['user_id'];

    $select_order = mysqli_query($con, "Select * from order_item where user_id= $user_id and status='incomplete'");
    $num = mysqli_num_rows($select_order);
    echo $num;
  }
}

//cart open function
//cart open function
function orderOpen()
{
  global $con;
  $ip = getIPAddress();
  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sel_user = mysqli_query($con, "Select user_id from user_table where email ='$email'");
    $row = mysqli_fetch_assoc($sel_user);
    $user_id = $row['user_id'];

    $select_order = mysqli_query($con, "Select * from order_item where user_id= $user_id and status = 'incomplete'");
    $num = mysqli_num_rows($select_order);
    if ($num == 0) {
      echo "<span>You have no orders</span>";
    }
    while ($row_data = mysqli_fetch_assoc($select_order)) {
      $product_id = $row_data['product_id'];
      $sel_product = mysqli_query($con, "Select * from products where product_id =$product_id");
      $row_data_product = mysqli_fetch_assoc($sel_product);
      $product_image = $row_data_product['product_image'];
      $product_title = $row_data_product['product_title'];
      $product_category = $row_data_product['product_category'];
      $product_price = $row_data['product_price'];

      $quantity = $row_data['quantity'];
      if ($quantity == 0) {
        $quantity = 1;
      } else {
        $quantity = $quantity;
      }
      echo "
    
      <div class='cart_item_details border border-bottom-3 mb-3'>
      <div class='px-2'>

            
          </div>
            <div class='cart_item_image '>
              <img src='./img/product_img/$product_category/$product_image' alt='$product_title' />
            </div>
            <div class='cart_item_detail'>
              <h5>$product_title</h5>
              <p><span class='quantity'>Qty: $quantity</span><br><span class='rate'>Price: $product_price</span></p>
            </div>
          </div>
        
    ";
    }
  }
}

// get user order details
function getUserDetails()
{
  global $con;
  $useremail = $_SESSION['email'];
  $get_details = "Select * from `user_table` where email='$useremail'";
  $result_query = mysqli_query($con, $get_details);
  while ($row = mysqli_fetch_array($result_query)) {
    $user_id = $row['user_id'];
    if (!isset($_GET['profile'])) {
      if (!isset($_GET['my_order'])) {
        if (!isset($_GET['address'])) {
          $get_orders = "Select * from `user_orders` where user_id='$user_id' and order_status='pending'";
          $result_orders_query = mysqli_query($con, $get_orders);
          $row_count = mysqli_num_rows($result_orders_query);
          if ($row_count > 0) {
            echo "
            <h1>You have $row_count pending orders.</h1>
            ";
          }
        }
      }
    }
  }
}


//farmer
function getFarm()
{
  global $con;
  if (!isset($_GET['search_farm'])) {
    //fetch farmers
    $role = 'farmer';
    $select_query = "Select * from `user_table` where role='$role'";
    $result_query = mysqli_query($con, $select_query);

    // echo "<h1>$row_product_data</h1>";
    while ($row_query_data = mysqli_fetch_assoc($result_query)) {
      $role_company_name = $row_query_data['role_company_name'];
      $user_image = $row_query_data['user_image'];
      $address = $row_query_data['address'];
      $Area = $row_query_data['Area'];
      $experience = $row_query_data['experience'] ?? '';
      $user_id = $row_query_data['user_id'];

      //product count
      $select_product_query = "Select * from `products` where user_id='$user_id'";
      $result_product_query = mysqli_query($con, $select_product_query);
      $row_product_data = mysqli_num_rows($result_product_query);


      echo "
                        <div class='hotel pb-4 border col col-lg-6 col-md-6 mb-4 '>
                        <div class='row'>
                            <div class='col-lg-4 pt-2'> <img src='./user_area/user_images/$user_image' alt='' class='hotel-img' style='height:200px;'> </div>
                            <div class='col-lg-8'>
                                <div class='d-md-flex align-items-md-center'>
                                    <div class='name'>$role_company_name <div class='city'><span class='text-success me-2'><i class='fa-solid fa-location-dot'> </i></span>$address, $Area </div>
                                    </div>
                                </div>
                                
                                <div class='d-flex flex-column tags pt-1'>
                                    <div><span>Total Products: </span>$row_product_data</div><br>
                                    <div><span>$experience</span></div>
                                </div>
                            </div>
                        </div>
                        <div class='d-flex justify-content-end mt-1'>
                            <a href='user.php?farm_id=$user_id''><div class='btn border enquiry text-uppercase mx-2'>Visit Us</div></a>
                            <a href='farm_products.php?farm_id=$user_id''><div class='btn btn-success text-uppercase'>View Products</div><a>
                        </div>
                    </div>
                        ";
    }
  }
}

function searchFarm()
{
  global $con;
  //search bar matching
  if (isset($_GET['farm_name'])) {
    if (isset($_GET['location'])) {
      if (isset($_GET['Area'])) {
        $farm_name = $_GET['farm_name'];
        $location = $_GET['location'];
        $area = $_GET['Area'];
        $role = 'farmer';
        $search_query = "Select * from `user_table` where role='$role' and (role_company_name like '%$farm_name%' or address like '%$location%' or Area like '%$area%')";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
          echo "<h2 class='d-block text-center text-danger'>Farm not found!</h2>";
        }

        while ($row = mysqli_fetch_assoc($result_query)) {
          $user_image = $row['user_image'];
          $role_company_name = $row['role_company_name'];
          $experience = $row['experience'];
          $user_id = $row['user_id'];
          $address = $row['address'];
          $Area = $row['Area'];
          echo "
                        <div class='hotel pb-4 border col-xl-6 col-md-6 mb-4 '>
                        <div class='row'>
                            <div class='col-lg-4'> <img src='./user_area/user_images/$user_image' alt='' class='hotel-img'> </div>
                            <div class='col-lg-8'>
                                <div class='d-md-flex align-items-md-center'>
                                    <div class='name'>$role_company_name <div class='city'><span class='text-success me-2'><i class='fa-solid fa-location-dot'> </i></span>$address, $Area </div>
                                    </div>
                                </div>
                                <div class='rating'> <span class='fas fa-star'></span> <span class='fas fa-star'></span> <span class='fas fa-star'>
                                    </span> <span class='fas fa-star'></span> <span class='far fa-star'></span> <span class='px-2 text-success'><i class='fa-regular fa-user' text-secondary></i> 222</span>
                                </div>
                                <div class='d-flex flex-column tags pt-1'>
                                    <div><span>Total Products: </span>row_product_data</div><br>
                                    <div><span>$experience</span></div>
                                </div>
                            </div>
                        </div>
                        <div class='d-flex justify-content-end mt-1'>
                            <a href='farm_details.php?farm_id=$user_id''><div class='btn enquiry text-uppercase mx-2'>Visit Us</div></a>
                            <a href='farm_products.php?farm_id=$user_id''><div class='btn btn-success text-uppercase'>View Products</div><a>
                        </div>
                    </div>
                        ";
        }
      }
    }
  }
}

//farmer
function getSupplier()
{
  global $con;
  if (!isset($_GET['search_result'])) {
    //fetch farmers
    $role = 'supplier';
    $select_query = "Select * from `user_table` where role='$role'";
    $result_query = mysqli_query($con, $select_query);

    // echo "<h1>$row_product_data</h1>";
    while ($row_query_data = mysqli_fetch_assoc($result_query)) {
      $role_company_name = $row_query_data['role_company_name'];
      $user_image = $row_query_data['user_image'];
      $address = $row_query_data['address'];
      $Area = $row_query_data['Area'];
      $experience = $row_query_data['experience'] ?? '';
      $user_id = $row_query_data['user_id'];

      //product count
      $select_product_query = "Select * from `products` where user_id='$user_id'";
      $result_product_query = mysqli_query($con, $select_product_query);
      $row_product_data = mysqli_num_rows($result_product_query);


      echo "
    <div class='hotel pb-4 border col-xl-6 col-md-6 mb-4 '>
    <div class='row'>
        <div class='col-lg-4'> <img src='./user_area/user_images/$user_image' alt='' class='hotel-img'> </div>
        <div class='col-lg-8'>
            <div class='d-md-flex align-items-md-center'>
                <div class='name'>$role_company_name <div class='city'><span class='text-success me-2'><i class='fa-solid fa-location-dot'> </i></span>$address, $Area </div>
                </div>
            </div>
           
            <div class='d-flex flex-column tags pt-1'>
                <div><span>Total Products: </span>$row_product_data</div><br>
                <div><span>$experience</span></div>
            </div>
        </div>
    </div>
    <div class='d-flex justify-content-end mt-1'>
        <a href='user.php?supplier_id=$user_id''><div class='btn border enquiry text-uppercase mx-2'>Visit Us</div></a>
        <a href='supplier_products.php?supplier_id=$user_id''><div class='btn btn-success text-uppercase'>View Products</div><a>
    </div>
</div>
    ";
    }
  }
}

function searchSupplier()
{
  global $con;
  //search bar matching
  if (isset($_GET['supplier_name'])) {
    if (isset($_GET['location'])) {
      if (isset($_GET['Area'])) {
        $supplier_name = $_GET['supplier_name'];
        $location = $_GET['location'];
        $area = $_GET['Area'];
        $role = 'supplier';
        $search_query = "Select * from `user_table` where role='$role' and (role_company_name like '%$supplier_name%' or address like '%$location%' or Area like '%$area%')";
        $result_query = mysqli_query($con, $search_query);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
          echo "<h2 class='d-block text-center text-danger'>Suppliers not found!</h2>";
        }

        while ($row = mysqli_fetch_assoc($result_query)) {
          $user_image = $row['user_image'];
          $role_company_name = $row['role_company_name'];
          $experience = $row['experience'];
          $user_id = $row['user_id'];
          $address = $row['address'];
          $Area = $row['Area'];
          $user_id = $row['user_id'];

          //product count
          $select_product_query = "Select * from `products` where user_id='$user_id'";
          $result_product_query = mysqli_query($con, $select_product_query);
          $row_product_data = mysqli_num_rows($result_product_query);

          echo "
    <div class='hotel pb-4 border col-xl-6 col-md-6 mb-4 '>
    <div class='row'>
        <div class='col-lg-4'> <img src='./user_area/user_images/$user_image' alt='' class='hotel-img'> </div>
        <div class='col-lg-8'>
            <div class='d-md-flex align-items-md-center'>
                <div class='name'>$role_company_name <div class='city'><span class='text-success me-2'><i class='fa-solid fa-location-dot'> </i></span>$address, $Area </div>
                </div>
            </div>
            <div class='rating'> <span class='fas fa-star'></span> <span class='fas fa-star'></span> <span class='fas fa-star'>
                </span> <span class='fas fa-star'></span> <span class='far fa-star'></span> <span class='px-2 text-success'><i class='fa-regular fa-user' text-secondary></i> 222</span>
            </div>
            <div class='d-flex flex-column tags pt-1'>
                <div><span>Total Products: </span>$row_product_data</div><br>
                <div><span>$experience</span></div>
            </div>
        </div>
    </div>
    <div class='d-flex justify-content-end mt-1'>
        <a href='supplier_details.php?supplier_id=$user_id''><div class='btn enquiry text-uppercase mx-2'>Visit Us</div></a>
        <a href='supplier_products.php?supplier_id=$user_id''><div class='btn btn-success text-uppercase'>View Products</div><a>
    </div>
</div>
    ";
        }
      }
    }
  }
}


// Blog function 
function get_Blogs()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['blog_name'])) {
    if (isset($_GET['farm_id'])) {
      $farm_id = $_GET['farm_id'];
      $select_query = "Select * from `blogs` where user_id=$farm_id order by date DESC limit 0,3";
    } else {
      $select_query = "Select * from `blogs` order by date DESC limit 0,3";
    }
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='d-block text-center text-danger'>No Blogs Found!!!</h2>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $blog_id = $row['blog_id'];
      $user_id = $row['user_id'];
      $blog_image = $row['blog_image'];
      $blog_title = $row['blog_title'];
      $blog_highlight = $row['blog_highlight'];
      $blog_description = $row['blog_description'];
      $blog_time = $row['date'];
      $time = strtotime($blog_time);
      $Month = date("M", $time);
      $Day = date("d", $time);

      $select_author = "Select * from `user_table` where user_id=$user_id";
      $author_query = mysqli_query($con, $select_author);
      $author = mysqli_fetch_assoc($author_query);
      $aut = $author['username'];
      $role = $author['role'];

      $select_comment = "Select * from `comment` where blog_id=$blog_id";
      $comment_query = mysqli_query($con, $select_comment);
      $comment_count = mysqli_num_rows($comment_query);

      echo "
      <div class='col-sm-12 col-md-6 col-lg-4'>
            <div class='blog_item'>
              <div class='blog_image'>
                <a href='blog_details.php?blog_id=$blog_id'>
                  <img src='./dashboard/blog_images/$blog_image' alt='$blog_image ' />
                </a>
              </div>
              <div class='blog_details'>
                <div class='blog_date'>
                  <p class='text-center'>
                  $Day<br />
                    $Month
                  </p>
                </div>
                <ul class='blog_info d-block'>
                  <li>
                    <i class='fas fa-user'></i>
                    <p>by <span>$aut ($role)</span></p>
                  </li>
                  <li>
                    <i class='fas fa-comments'></i>
                    <p><span>$comment_count </span>Comments</p>
                  </li>
                </ul>
                <div class='blog_detail'>
                  <h4><a href='#'> $blog_title</a></h4>
                  <p>$blog_description</p>
                </div>
                <div class='blog_btn text-center'>
                  <a href='blog_details.php?blog_id=$blog_id' class='more-btn'> Read More </a>
                </div>
              </div>
            </div>
          </div>
    ";
    }
  }
}

//getting all products
function get_all_Blogs()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (!isset($_GET['blog_name'])) {
    if (isset($_GET['farm_id'])  or isset($_GET['supplier_id'])) {
      $id = $_GET['farm_id'] ?? $_GET['supplier_id'];
      $select_query = "Select * from `blogs` where user_id=$id order by date DESC limit 0,3";
    } else {
      $select_query = "Select * from `blogs` order by date DESC";
    }
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='d-block text-center text-danger'>No Blogs Found!!!</h2>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $blog_id = $row['blog_id'];
      $user_id = $row['user_id'];
      $blog_image = $row['blog_image'];
      $blog_title = $row['blog_title'];
      $blog_highlight = $row['blog_highlight'];
      $blog_description = $row['blog_description'];
      $blog_time = $row['date'];
      $time = strtotime($blog_time);
      $Month = date("M", $time);
      $Day = date("d", $time);
      $select_author = "Select * from `user_table` where user_id=$user_id";
      $author_query = mysqli_query($con, $select_author);
      $author = mysqli_fetch_assoc($author_query);
      $aut = $author['username'];
      $role = $author['role'];

      $select_comment = "Select * from `comment` where blog_id=$blog_id";
      $comment_query = mysqli_query($con, $select_comment);
      $comment_count = mysqli_num_rows($comment_query);
      echo "
      <div class='col-sm-12 col-md-6 col-lg-4'>
            <div class='blog_item'>
              <div class='blog_image'>
                <a href='blog_details.php?blog_id=$blog_id'>
                  <img src='./dashboard/blog_images/$blog_image' alt='' />
                </a>
              </div>
              <div class='blog_details'>
                <div class='blog_date'>
                  <p class='text-center'>
                  $Day<br />
                    $Month
                  </p>
                </div>
                <ul class='blog_info d-block'>
                  <li>
                    <i class='fas fa-user'></i>
                    <p>by <span>$aut ($role)</span></p>
                  </li>
                  <li>
                    <i class=' fs-5 fas fa-comments'></i>
                    <p><span>$comment_count </span>Comments</p>
                  </li>
                </ul>
                <div class='blog_detail'>
                  <h4><a href='#'> $blog_title</a></h4>
                  <p>$blog_description</p>
                </div>
                <div class='blog_btn text-center'>
                  <a href='blog_details.php?blog_id=$blog_id' class='more-btn'> Read More </a>
                </div>
              </div>
            </div>
          </div>
    ";
    }
  }
}

//blog details
function blog_detail()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (isset($_GET['blog_id'])) {
    $blog_id = $_GET['blog_id'];
    $select_query = "Select * from `blogs` where blog_id=$blog_id";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='d-block text-center text-danger'>No Information related to this blog</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
      $blog_id = $row['blog_id'];
      $user_id = $row['user_id'];
      $blog_image = $row['blog_image'];
      $blog_title = $row['blog_title'];
      $blog_highlight = $row['blog_highlight'];
      $blog_description = $row['blog_description'];

      $select_author = "Select * from `user_table` where user_id=$user_id";
      $author_query = mysqli_query($con, $select_author);
      $author = mysqli_fetch_assoc($author_query);
      $aut = $author['username'];
      $role = $author['role'];

      $select_comment = "Select * from `comment` where blog_id=$blog_id";
      $comment_query = mysqli_query($con, $select_comment);
      $comment_count = mysqli_num_rows($comment_query);

      echo "
    <div class='blog_featured_image'>
                <img src='./dashboard/blog_images/$blog_image ' alt='' />
              </div>
              <div class='blog_detail_publish d-flex justify-content-start py-4'>
                <div class='admin pe-4'>
                  <i class='fas fa-user'></i>
                  <span>$aut ($role)</span>
                </div>
                <div class='comments'>
                  <i class='fas fa-comments'></i>
                  <span> $comment_count Comments</span>
                </div>
              </div>
              <div class='blog_description'>
                <h2>$blog_title</h2>
                <p>
                $blog_highlight <br>
                <span>$blog_description</span>
                </p>
              </div>

              ";
    }
  }
}
//latest products
function related_Blogs()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.
  if (isset($_GET['blog_id'])) {
    $blog_id = $_GET['blog_id'];
    $select_query = "Select * from `blogs` where blog_id !=$blog_id  order by date DESC limit 0,3";
    $result_query = mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<h2 class='d-block text-center text-danger'>No Latest Blogs Found!!!</h2>";
    }
    while ($row = mysqli_fetch_assoc($result_query)) {
      $blog_id = $row['blog_id'];
      $user_id = $row['user_id'];
      $blog_image = $row['blog_image'];
      $blog_title = $row['blog_title'];

      $select_author = "Select * from `user_table` where user_id=$user_id";
      $author_query = mysqli_query($con, $select_author);
      $author = mysqli_fetch_assoc($author_query);
      $aut = $author['username'];
      $role = $author['role'];
      echo "
      <div class='latest_blog_item'>
                <div class='image'>
                  <a href='blog_details.php?blog_id=$blog_id'><img src='./dashboard/blog_images/$blog_image' alt='' /></a>
                </div>
                <div class='latest_blog_item_detail'>
                  <div class='author'>
                    <i class='fas fa-user'></i>
                    <span>$aut ($role)</span>
                  </div>
                  <a href='blog_details.php?blog_id=$blog_id'>$blog_title</a>
                </div>
              </div>
    ";
    }
  }
}

// search blogs
function searchBlog()
{
  global $con;
  if (isset($_GET['blog_name'])) {
    $blog = $_GET['blog_name'];
    $search_query = "Select * from `blogs` where blog_title like '%$blog%'";
    $result_query = mysqli_query($con, $search_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if ($num_of_rows == 0) {
      echo "<div class='row'><h2 class='d-block text-center text-danger'>Farm not found!</h2>";
    }
    echo "<div class='row'><h2 class='d-block text-center text-dark mb-3 border-bottom'><span class='text-success border'>$num_of_rows</span> blogs found.</h2>";
    while ($row = mysqli_fetch_assoc($result_query)) {
      $blog_id = $row['blog_id'];
      $user_id = $row['user_id'];
      $blog_image = $row['blog_image'];
      $blog_title = $row['blog_title'];
      $blog_highlight = $row['blog_highlight'];
      $blog_description = $row['blog_description'];
      $blog_time = $row['date'];
      $time = strtotime($blog_time);
      $Month = date("M", $time);
      $Day = date("d", $time);
      $select_author = "Select * from `user_table` where user_id=$user_id";
      $author_query = mysqli_query($con, $select_author);
      $author = mysqli_fetch_assoc($author_query);
      $aut = $author['username'];
      $role = $author['role'];
      echo "
      <div class='col-sm-12 col-md-6 col-lg-4'>
            <div class='blog_item'>
              <div class='blog_image'>
                <a href='blog_details.php?blog_id=$blog_id'>
                  <img src='./dashboard/blog_images/$blog_image' alt='' />
                </a>
              </div>
              <div class='blog_details'>
                <div class='blog_date'>
                  <p class='text-center'>
                  $Day<br />
                    $Month
                  </p>
                </div>
                <ul class='blog_info'>
                  <li>
                    <i class='fas fa-user'></i>
                    <p>by <span>$aut ($role)</span></p>
                  </li>
                  <li>
                    <i class='fas fa-comments'></i>
                    <p><span>2 </span>Comments</p>
                  </li>
                </ul>
                <div class='blog_detail'>
                  <h4><a href='#'> $blog_title</a></h4>
                  <p>$blog_description</p>
                </div>
                <div class='blog_btn text-center'>
                  <a href='blog_details.php?blog_id=$blog_id' class='more-btn'> Read More </a>
                </div>
              </div>
            </div>
          </div>
          
    ";
    }
  }
}

//subscription
function subscription()
{
  global $con;
  if (isset($_SESSION['email'])) {
    $user_email = $_SESSION['email'];
    $select_address = mysqli_query($con, "Select address from user_table where email = '$user_email'");
    $address_row = mysqli_fetch_assoc($select_address);
    $address = $address_row['address'];
    $select_plan = "select * from `plan` where address='$address' order by rand() limit 0,4";
  } else {
    $select_plan = "select * from `plan` limit 0,4";
  }
  $query = mysqli_query($con, $select_plan);
  $num_rows = mysqli_num_rows($query);
  if ($num_rows == 0) {
    echo "<h3>No plans</h3>";
  } else {
    while ($row = mysqli_fetch_assoc($query)) {
      $plan_title = $row['plan_title'];
      $plan_price = $row['plan_price'];
      $plan_after_price = $row['plan_after_price'];
      $plan_id = $row['plan_id'];
      $plan_category = $row['plan_category'];
      $category = strtoupper($plan_category);

      echo "<div class='col-sm-12 col-md-6 col-lg-4 col-xl-3'>
            <div class='plan'>
              <div class='price'>
                <h1 class='lg-heading'><small class='' style='font-size: 25px;'>Rs. </small>$plan_after_price</h1>
                <p>Per Day</p>
              </div>
              <div class='plan_title'>
                <h1 class='sm-heading text-center'>$category</h1>
              </div>
              <ul>";
      $select_plans = "select `service` from `services` where plan_id=$plan_id and category='$plan_category'";
      $query_plan = mysqli_query($con, $select_plans);
      $num_rows = mysqli_num_rows($query_plan);
      while ($row_plan = mysqli_fetch_assoc($query_plan)) {
        $service = $row_plan['service'];
        echo "<li>$service</li>";
      }
      echo "
              </ul>
              <div class='pricing_btn text-center'>
                <a href='#' class='sub_btn'>
                  <span>Subscribe</span>
                </a>
              </div>
            </div>
          </div>";
    }
  }
}

//comment
function comment()
{
  global $con;  //for function we cant directly access the local variable so making that globle variable.
  if (isset($_GET['blog_id'])) {
    $blog_id = $_GET['blog_id'];
    if (isset($_POST['post_comment']) && $_SERVER['REQUEST_METHOD'] == "POST") {
      if ($_SESSION['email']) {
        $useremail = $_SESSION['email'];
        $comment = $_POST['comment_msg'];
        $email = $useremail;
        $status = 'post';
        $blog_id = $blog_id;

        $insert_query = "INSERT INTO `comment`( `user_email`, `blog_id`, `comment`, `status`, `date`) VALUES ('$email',$blog_id,'$comment','$status',NOW())";
        $result_query = mysqli_query($con, $insert_query);
        if ($result_query) {
          // echo "<script>window.open('blog_details.php?blog_id=$blog_id#comment','_self');</script>";
          echo " <meta http-equiv='refresh' content='0'>";
          echo "<script>
      alert('Comment successfully!');</script>";
        } else {
          echo "<script>
      alert('Comment unsuccessful!');</script>";
        }
      } else {
        echo "<script>window.open('./user_area/user_login.php','_self')</script>";
      }
    }
  }
}

//view comment
function viewComment()
{
  global $con;
  if (isset($_GET['blog_id'])) {
    $blog_id = $_GET['blog_id'];
    $status = 'post';
    $scelct_query = "Select * from `comment` where blog_id=$blog_id and status='$status' order by date DESC limit 0,3";
    $scelct_query_all = "Select * from `comment` where blog_id=$blog_id and status='$status'";
    $result = mysqli_query($con, $scelct_query);
    $result_all = mysqli_query($con, $scelct_query_all);
    $cmt_count = mysqli_num_rows($result_all);
    if ($cmt_count == 0) {
      echo "No Comments";
    } else {
      $select_comment = "Select * from `comment` where blog_id=$blog_id";
      $comment_query = mysqli_query($con, $select_comment);
      $comment_count = mysqli_num_rows($comment_query);

      echo "<div class='comment_title pb-3'>
          <h3><span class='total_cmnt pe-3'>$comment_count</span>Comments</h3>
      </div>";
      while ($row_data = mysqli_fetch_array($result)) {
        $comment = $row_data['comment'];
        $comment_id = $row_data['comment_id'];
        $email = $row_data['user_email'];
        $select = "Select * from `user_table` where email='$email'";
        $result_query = mysqli_query($con, $select);
        $data = mysqli_fetch_assoc($result_query);
        $username = $data['username'];
        $user_email = $data['email'];
        $user_image = $data['user_image'];
        echo "
        <form action = 'blog_details.php?blog_id=$blog_id&comment_id=$comment_id' method='post'>
        <div class='comment'>
                  <div class='user_profile'>
                    <img src='./user_area/user_images/$user_image' alt='user_image' />
                  </div>
                  <div class='comment_details'>
                    <h1 class='md-heading'>$username</h1>
                    <p>
                      $comment
                    </p>";
        $reply_query = "Select * from `comment` where reply_id=$comment_id";
        $result_reply = mysqli_query($con, $reply_query);
        $num_reply = mysqli_num_rows($result_reply);
        while ($row_reply = mysqli_fetch_assoc($result_reply)) {
          $reply_cmt = $row_reply['comment'];
          $reply_email = $row_reply['user_email'];
          $email_query = "Select * from `user_table` where email='$reply_email'";
          $result_email = mysqli_query($con, $email_query);
          $email_sel = mysqli_fetch_array($result_email);
          $email_val = $email_sel['username'];
          echo "<h4>$email_val</h4>
                      <p>$reply_cmt</p>";
        }
        echo "  
                    <a href='#' class='reply-btn' onclick='replyFunction()'>
                      <i class='fa-solid fa-reply'></i>
                      Reply
                    </a>

                    <div class='reply-box active'>
                      <textarea name='reply_comment' id='' cols='100' rows='2'></textarea>
                      <button name='reply' type='submit'>Post Reply</button>
                    </div>
                  </div>
                </div>
                </form>
        ";
      }
    }
  }
}
function reply()
{
  global $con;
  if (isset($_GET['blog_id'])) {
    if (isset($_GET['comment_id'])) {
      $comment_id = $_GET['comment_id'];
      $blog_id = $_GET['blog_id'];
      if (isset($_POST['reply'])) {
        if ($_SESSION['email']) {
          $email = $_SESSION['email'];
          $comment = $_POST['reply_comment'];
          $status = 'reply';
          // $blog_id = $blog_id;

          $insert_query = "INSERT INTO `comment`( `user_email`,`reply_id`, `blog_id`, `comment`, `status`, `date`) VALUES ('$email','$comment_id',$blog_id,'$comment','$status',NOW())";
          $result_query = mysqli_query($con, $insert_query);
          if ($result_query) {
            // echo "<script>window.open('blog_details.php?blog_id=$blog_id#comment','_self');</script>";
            echo "<script>alert('Comment successfully!');</script>";
            echo " <meta http-equiv='refresh' content='0'>";
          } else {
            echo "<script>alert('Comment unsuccessful!');</script>";
          }
        } else {
          echo "<script>window.open('./user_area/user_login.php','_self')</script>";
        }
      }
    }
  }
}
