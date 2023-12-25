<?php
if(isset($_SESSION['email'])){
echo "<div class='container rounded bg-white mb-1 '>
    <div class='row'>
        <div class='col-md-11 border-right m-auto'>
            <div class='pb-5 border border-2'>
                ";
                $user_email = $_SESSION['email'];
                $user_image_query = "Select * from `user_table` where email='$user_email'";
                $user_image = mysqli_query($con, $user_image_query);
                $row_image = mysqli_fetch_array($user_image);
                $image = $row_image['user_image'];
                $name = $row_image['username'];
                $address = $row_image['address'];
                $area = $row_image['Area'];
                echo " 
                <div  class='tab-detail text-center col-md-12'>
                <div class='profile'>
                 <img src='../user_area/user_images/$image' alt='$image ' />
                 </div>
                <h3 class='name'>$name</h3>
                <h5 class='name'>$area, $address</h5>
                </div>
                ";
            echo "</div>
        </div>
    </div>
</div>";
}
else{
    echo "<script>window.open('../user_area/user_login.php', '_self');</script>";
}
?>