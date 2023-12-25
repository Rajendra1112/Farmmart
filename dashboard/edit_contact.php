<?php
// edit
if(isset($_GET['edit_contact'])){
$email = $_SESSION['email'];
  $sel_contact = "Select * from `user_table` where email='$email'";
        $query = mysqli_query($con,$sel_contact);
        $contact_row = mysqli_fetch_assoc($query);
        $email = $contact_row['email'];    
        $user_id = $contact_row['user_id'];    
        $phone = $contact_row['phone'];
        $address = $contact_row['address'];
        $Area = $contact_row['Area'];
    echo "
    <!-- Contact Info -->
    <div class='contact section-wrapper'>
      <div class='container'>
        <div class='row'>
          <div class='col-xl-4 col-md-6 col-sm-12'>
            <div class='contact_method'>
              <div class='contact_method_detail'>
                <i class='fas fa-phone'></i>
                <span>Phone</span>
                <a href='tel:9812767046'>+977 9812767046</a>
                <a href='tel:9812767046'>1660-01-10101</a>
              </div>
            </div>
          </div>
          <div class='col-xl-4 col-md-6 col-sm-12'>
            <div class='contact_method'>
              <div class='contact_method_detail'>
                <i class='fas fa-envelope-open-text'></i>
                <span>Email</span>
                <a href='mailto:support@digitalfarm.com'>support@digitalfarm.com</a>
                <a href='mailto:support@digitalfarm.com'>info@gmail.com</a>
              </div>
            </div>
          </div>
          <div class='col-xl-4 col-md-6 col-sm-12'>
            <div class='contact_method'>
              <div class='contact_method_detail'>
                <i class='fas fa-location'></i>
                <span>Address</span>
                <span>Kathmandu Nepal</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     ";

//   echo "<form action='' method='post' class='add_new_product'>
//       <div class='plan border border-3 p-3'>
//           <ul class='new_plan-highlight ' id='faqs'>
//               <label for='highlight'>edit service</label>
//               <li><input type='text' placeholder='' name='services' value='$' id='' required/></li>

//           </ul>
//       </div>
//       <button type='submit' name='edit_contact' value='Update service' class='update mt-3'>Update service</button>
//   </form>";
    }
    ?>