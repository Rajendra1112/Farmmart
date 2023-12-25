  <!-- Product Detail -->

  <?php
 
  global $con;  //for function we cant directly access the local variable so making that globle variable.

  //condition to check isset or not
  if (isset($_GET['product_id'])) {
    if (!isset($_GET['category'])) {
      $product_ids = $_GET['product_id'];
      $select_query = "Select * from `products` where product_id='$product_ids' ";
      $result_query = mysqli_query($con, $select_query);
      $num_of_rows = mysqli_num_rows($result_query);
      if ($num_of_rows == 0) {
        echo "<h2 class='d-block text-center text-danger'>No stoke for this category</h2>";
      }

      while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['product_id'];
        $product_image = $row['product_image'];
        $product_image1= $row['product_image1'];
        $product_image2 = $row['product_image2'];
        $product_image3 = $row['product_image3'];
        $product_title = $row['product_title'];
        $product_category = $row['product_category'];
        $product_price = $row['product_price'];
        $product_after_price = $row['product_after_price'];
        echo "
        <ol class='breadcrumb indigo lighten-6 first-1 shadow-lg mb-5  '>
            <li class='breadcrumb-item '><a class='black-text active-2' href='account.php?view_products'><img  id ='home' src='https://img.icons8.com/ios-filled/50/000000/dog-house.png' class='mr-md-2 mr-1 mb-1 '  width='22' height='19'><span  >HOME</span></a><img class='ml-md-3 ml-1' src='https://img.icons8.com/metro/50/000000/chevron-right.png ' width='20' height='20'> </li>
        </ol>
    <div class='product_detail'>
    <div class='container'>
      <div class='row'>
        <div class='col-xl-6 col-md-12 col-sm-12'>
          <div class='image-slider'>
            <div id='product_detail_image' class='image'>
              <img src='../img/product_img/$product_category/$product_image' alt='$product_image' />
            </div>
          </div>
          <ul class='image_slider_nav'>
            <li class='detail_img'>
             
                <img  src='../img/product_img/$product_category/$product_image1' alt='$product_title'/>
              
            </li>
            <li class='detail_img'>
             
                <img src='../img/product_img/$product_category/$product_image2' alt='$product_title' />
              
            </li>
            <li class='detail_img'>
             
                <img src='../img/product_img/$product_category/$product_image3  ' alt='$product_title' />
              
            </li>
          </ul>
        </div>
        <div class='col-xl-6 col-md-12 col-sm-12'>
          <div class='product_title'>
            <h1 class='md-heading'>$product_title</h1>
            <span>Rs.<del>$product_price</del></span>
            <span>$product_after_price</span>
          </div>
          <p class='product_highlight'>
            Aliquam hendrerit a augue insuscipit. Etiam aliquam massa quis des mauris commodo venenatis ligula commodo leez sed blandit convallis
            dignissim onec vel pellentesque neque.
          </p>

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

  ?>
