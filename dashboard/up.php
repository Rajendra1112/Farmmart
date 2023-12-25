<?php 
include('../includes/connect.php');
$review_id = $_POST['name'];
        $status = 1;
        $update = mysqli_query($con, "update `user_rating` set status=$status where id=$review_id ");
        if ($update===true) {
            echo "<p id='verify'>Update successful with id = $review_id</p>";
        } else {
            echo "Update unsuccessful with id = $review_id";
        }
        ?>