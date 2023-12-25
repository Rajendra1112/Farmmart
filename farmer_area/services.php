<?php
$plan_id = $_GET['plan_id'];
if (isset($_GET['plan_category'])) {
    $category = $_GET['plan_category'];
    $Cat = ucfirst($category);
    echo "
    <div class='container m-0'>
    <div class='new_product pt-3 pb-0'>
    <h1 class='text-success font-weight-bold w-25 border-bottom border-success border-3'>$Cat</h1>";
    $select_services = "Select * from `services` where plan_id=$plan_id and category='$category'";
    $query = mysqli_query($con, $select_services);
    $sn = 1;
    while ($row = mysqli_fetch_assoc($query)) {
        $service = $row['service'];
        $service_id = $row['service_id'];
        echo " 
                        <li class='text-capitalize text-dark'>$sn. <span class='text-success'>$service</span></li>
                                 <span class='px-2 border'> 
                            <a href='./account.php?plans&edit_service=$service_id&service=$service&sn=$sn#service'>edit</a></button>
                        </span>
                        <span class='px-2 border' id='delete'>
                        <a onclick='javascript:confirmationDelete($(this));return false;'' href='./account.php?delete_service=$service_id'>delete</a></button>
                         </span><br><br>
                         ";
        $sn++;
    }


    echo "
    </div>
</div>
<div class='w-100 border border-3 p-3 bold'>
<label for='highlight'>Add Services</label>
        <form action='' method='post' class=''>
            <div class='plan  p-3 form-group'>
                <ul class='new_plan-highlight ' id='faqs'>
                    ";

    echo "
                    <li><input type='text' class='form-control' placeholder='add new' name='services' id='' required/></li>

                </ul>
            </div>
            <button type='submit' name='insert_service' value='Update plan' class='update mt-3 btn btn-success'>Update plan</button>
        </form>
        </div>
";

?>
<!-- //pop-up -->


<!-- edit -->
<?php

    ?>
</div>
<?php } ?>