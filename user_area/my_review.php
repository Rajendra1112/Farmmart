<?php
if (isset($_GET['my_review']) and isset($_GET['p']) and $_SESSION['email']) {
    // $user = $_GET('user_rating');
    $prod_id = $_GET['p'];
    $sel_prod = mysqli_query($con, "select * from `products` where  product_id =$prod_id");
    $total = mysqli_num_rows($sel_prod);
    if ($total > 0) {
        $row_data = mysqli_fetch_assoc($sel_prod);
        $p_name = $row_data['product_title'];
        $p_image = $row_data['product_image'];
        $p_cat = $row_data['product_category'];


?>
        <?php
        if (isset($_POST['review_submit'])) {
            $rating = $_POST['star-rating'];
            $review = $_POST['rating_message'];
            $image = $_FILES['rating_image']['name'];
            $image_temp = $_FILES['rating_image']['tmp_name'];
            $rand = rand(1, 99999999);
            $status = 0;
            move_uploaded_file($image_temp, "./rating_img/$rand$image");

            $query = mysqli_query($con, "Insert into `user_rating` (`product_id`, `user_id`,`username`,`role`, `rating`, `review`,`image`,`status`) VALUES($prod_id, $userId,'$name','$role', '$rating','$review','$rand$image',$status)");
            if ($query) {
                echo "<script>alert('review sent successfull');</script>";
                echo "<script>window.open('./account.php','_self')</script>";
                
            } else {
                echo "<script>alert('review sent unsuccessfull');</script>";
                echo "<script>window.open('./account.php','_self')</script>";
            }
        }
        ?>

        <div class="head_rev mb-2">
            <h5>Write Review</h5>
        </div>
        <div id='main-content' class='bg-light border'>
            <div class='container my-2'>
                <div class='d-flex justify-content-center row'>
                    <div class='col-md-12'>
                        <div class="review_section">
                            <div class="purchase">
                                <p class="time">Delivered on 22 Apr 2023</p>
                                <p class="mb-4">Rate and review purchased product:</p>
                            </div>
                            <div class="img_product">
                                <?php echo "<img src='../img/product_img/$p_cat/$p_image' style='height: 80px;' alt='' srcset=''>" ?>
                            </div>
                            <div class="product_rating">
                                <div class="product_name">
                                    <p class="text-success"><?php echo $p_name ?></p>
                                </div>
                                <div class="rating">
                                    <form action="" method="post" enctype="multipart/form-data">

                                        <div class="container-wrapper">
                                            <div class="container d-flex align-items-center justify-content-center">
                                                <div class="row justify-content-center">

                                                    <!-- star rating -->
                                                    <div class="rating-wrapper">

                                                        <!-- star 5 -->
                                                        <input type="radio" id="5-star-rating" name="star-rating" value="5">
                                                        <label for="5-star-rating" class="star-rating">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                        <!-- star 4 -->
                                                        <input type="radio" id="4-star-rating" name="star-rating" value="4">
                                                        <label for="4-star-rating" class="star-rating star">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                        <!-- star 3 -->
                                                        <input type="radio" id="3-star-rating" name="star-rating" value="3">
                                                        <label for="3-star-rating" class="star-rating star">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                        <!-- star 2 -->
                                                        <input type="radio" id="2-star-rating" name="star-rating" value="2">
                                                        <label for="2-star-rating" class="star-rating star">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                        <!-- star 1 -->
                                                        <input type="radio" id="1-star-rating" name="star-rating" value="1">
                                                        <label for="1-star-rating" class="star-rating star">
                                                            <i class="fas fa-star d-inline-block"></i>
                                                        </label>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div class=" px-3 form-group">
                                            <textarea class="text-muted bg-white mt-4 mb-3" name="rating_message" placeholder="write your review"></textarea>
                                        </div>
                                        <div class="review-image border p-2 my-3">
                                            <input type="file" id="imageInput" name="rating_image" onclick="rating()"><br>
                                            <img id="previewImage" style="width: 100px;">
                                        </div>
                                        <div class="rev-btn d-flex justify-content-end">
                                            <button class="btn btn-success px-3" type="submit" name="review_submit">Post Review</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php } else {
        echo "Product not found";
    }
} ?>