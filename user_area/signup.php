<!-- include connect file -->
<?php
session_start();
include('../includes/connect.php');
include('../functions/common_functions.php');
include('../includes/email/code.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="../css/bootstrap.min.css" />

  <!-- Font-awesome icons -->
  <link rel="stylesheet" href="../css/all.min.css" />
  <link rel="stylesheet" href="../css/fontawesome.min.css" />

  <!-- FavIcon -->
  <link rel="shortcut icon" href="../img/company/favicon.png" type="image/x-icon" />

  <!-- Custom style -->
  <?php echo "<link rel='stylesheet' href='../css/styles.css' />"; ?>

  <!-- Lightbox -->
  <!-- Slick -->

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fresh - Digital Farm Nepal</title>
  <style>
    label span{
      color: red;
      padding-left: 5px;
    }
  </style>
</head>

<body>
  <?php 
    include('../includes/top_header.php');
    include('../includes/dashboard/menu.php');
  ?>
  <header class="header">
    <div class="container-fluid">
      <div class="header_logo">
        <a href="index.html">
          <img src="./img/company/logo.png" alt="" />
        </a>
      </div>
    </div>
  </header>
  <div class="section-wrapper">
    <div class="container">
      <div class="form-wrapper">
        <div class="section-title">
          <h1 class="md-heading">Register Your Account</h1>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12 col-sm-12">
            <form onsubmit="return checkInput()" class="sign_form" method="post"  enctype="multipart/form-data">
             

              <div class="sign-form">
                <div class="form-control  ">
                  <fieldset class="name">
                    <label for="fullName">Full Name <span>*</span></label>
                    <input type="text" class="p-1" name="fullName" id="name" placeholder="Your Name" autocomplete="off" required />
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                  </fieldset>
                </div>
                <div class="form-control">
                  <fieldset class="email">
                    <label for="email">Email <span>*</span></label>
                    <input type="email" name="email" id="email" required autocomplete="off" />
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                  </fieldset>
                </div>
                <div class="form-control">
                  <fieldset class="email">
                    <label for="user_image">User Image <span>*</span></label>
                    <span class="input-group-text" id="basic-addon1">Select profile Image</span>
                    <!-- <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required> -->
                    <input type="file" name="user_image" id="featuredImage" autocomplete="off" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1" required />
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                  </fieldset>
                </div>

                <div class="form-control">
                  <fieldset class="Phone">
                    <label for="Phone">Phone <span>*</span></label>
                    <input type="number" name="phone" id="phone" required autocomplete="off" />
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                  </fieldset>
                </div>
                <div class="form-control">
                  <fieldset class="d-flex flex-column">
                    <label for="role">Select Any One <span>*</span></label>
                    <select name="role">
                      <?php
                      
                      if (isset($_GET['role'])) {
                        $role = $_GET['role'];
                        $role_name = ucfirst($role);
                        echo "<option value='$role'>$role_name</option>";
                      } else {
                        echo "<option value='farmer'>Farmer</option>
                      <option value='consumer'>Consumer</option>
                      <option value='vendor'>Vendor</option>
                      <option value='admin'>Admin</option>
                      <option value='supplier'>Supplier</option>";
                      }
                      ?>
                    </select><br>
                    <label for="address">District<span>*</span></label>
                    <select name="address" id="district-dropdown">
                    <option value="Kathmandu">Kathmandu</option>
                    </select>

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small><br>



                    <label for="user_image">Name of company <span></span></label>
                    <input type="text" name="role_company_name" autocomplete="off" />

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>

                    <label for="Area">Area <span>*</span></label>
                    <input type="text" name="area" autocomplete="off" required />
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                  </fieldset>
                </div>
                <div class="form-control">
                  <fieldset class="password">
                    <label for="password">Password <span>*</span></label>
                    <input type="password" name="password" id="password" placeholder="New Password" required />
                    <i class="fas fa-eye" onclick="passwordFun()"></i>
                    <i class="fas fa-eye-slash" onclick="passwordFun()"></i>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                  </fieldset>
                </div>
                <div class="form-control">
                  <fieldset class="re-password">
                    <label for="password">Retype Password <span>*</span></label>
                    <input type="password" name="password2" id="password2" placeholder="Retype Password" required />
                    <i class="fas fa-eye" onclick="passwordFun() "></i>
                    <i class="fas fa-eye-slash" onclick="passwordFun()"></i>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error Message</small>
                  </fieldset>
                </div>
                <div class="agreement mb-4">
                  <div class="agreement_1">
                    <label><input type="checkbox" value="true" name="send_email" checked /> Send me helpful emails to find rewarding work and job
                      leads.</label>
                  </div>
                  <div class="agreement_2 mt-2">
                    <label>
                      <input type="checkbox" name="terms" value="true" required /> Yes, I understand and agree to the Upwork <a href="#">Terms and
                        Services</a> , including the
                      <a href="#">Privacy Policy</a> .
                    </label>
                  </div>
                </div>
                <div class="submit-btn text-center">
                  <button type="submit" name="user_register">Create My Account</button>
                </div>
              </div>
            </form>


          </div>
        </div>
      </div>
    </div>
  </div>

  <script> 
    const districts = ["Achham", "Arghakhanchi", "Baglung", "Baitadi", "Bajhang", "Bajura", "Banke", "Bara", "Bardiya", "Bhaktapur", "Bhojpur", "Chitwan", "Dadeldhura", "Dailekh", "Dang", "Darchula", "Dhading", "Dhankuta", "Dhanusa", "Dolakha", "Dolpa", "Doti", "Eastern Rukum", "Gorkha", "Gulmi", "Humla", "Ilam", "Jajarkot", "Jhapa", "Jumla", "Kailali", "Kalikot", "Kanchanpur", "Kapilvastu", "Kaski", "Kathmandu", "Kavrepalanchok", "Khotang", "Lalitpur", "Lamjung", "Mahottari", "Makwanpur", "Manang", "Morang", "Mugu", "Mustang", "Myagdi", "Nawalparasi", "Nuwakot", "Okhaldhunga", "Palpa", "Panchthar", "Parbat", "Parsa", "Pyuthan", "Ramechhap", "Rasuwa", "Rautahat", "Rolpa", "Rupandehi", "Salyan", "Sankhuwasabha", "Saptari", "Sarlahi", "Sindhuli", "Sindhupalchok", "Siraha", "Solukhumbu", "Sunsari", "Surkhet", "Syangja", "Tanahun", "Taplejung", "Tehrathum", "Udayapur", "Western Rukum"];

    const dropdown = document.getElementById('district-dropdown');

    for (let i = 0; i < districts.length; i++) {
      const option = document.createElement("option");
      option.text = districts[i];
      option.setAttribute("value",districts[i]);
      option.classList.add('district');
      dropdown.add(option);
    }
  </script>
  <script>
    

//sign up validation
// const form = document.getElementById('sign_form_submit');



// form.addEventListener('submit', function(e){
//   e.preventDefault();

function checkInput(){
  const username = document.getElementById('name');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
    //get the values from the inputs.
    console.log("inisde checkinput")
    const usernameValue = username.value.trim();   //Removes the leading and trailing white space and line terminator characters from a string.
    const emailValue = email.value.trim();
    const phoneValue = phone.value.trim();
    const passwordValue = password.value.trim();
    const password2Value = password2.value.trim();
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  
    if (usernameValue === '') {
      //show error
      //add error class
      setErrorFor(username, 'Username cannot be blank');
      return false;
    }
    else {
      //add success class
      setSuccessFor(username);
    }
  
    if (emailValue === '') {
      setErrorFor(email, 'Email cannot be blank');
      return false;
    }
    else if(!isEmail(emailValue)){
      setErrorFor(email, 'Enter correct email');
      return false;
    }
    else {
      setSuccessFor(email);
    }
    if (phoneValue === '') {
      setErrorFor(phone, 'Phone no. cannot be blank');
      return false;
    }
    else if (phoneValue.length !== 10) {
      setErrorFor(phone, 'Enter 10 digit phone number');
      return false;
    }
    else if(!isPhone(phoneValue)){
      setErrorFor(phone, 'Enter valid phone number');
      return false;
    }
    else {
      setSuccessFor(phone);
    }
    if (passwordValue.match(passw)) {
      setSuccessFor(password);
    }
    else if (passwordValue === '') {
      setErrorFor(password, 'Password cannot be blank');
      return false;
    }
    else {
      setErrorFor(password, 'Minimum eight characters, at least one uppercase letter, one lowercase letter and one number');
      return false;
    }
  
    if (password2Value === '') {
      setErrorFor(password2, 'Password2 cannot be blank');
      return false;
    }
    
    else if (passwordValue !== password2Value) {
      setErrorFor(password2, 'Password does not match');
      return false;
    }
    else {
      setSuccessFor(password2);
    }
    
}
;


function setErrorFor(input, message) {
  const formControl = input.parentElement;  // points to .form-condrol(here 'input' is child of '.form-control'.
  const small = formControl.querySelector('small');

  //add error class
  formControl.className = 'form-control error';

  //add error message inside small
  small.innerText = message;
  return false;

}
function setSuccessFor(input) {
  const formControl = input.parentElement;
  formControl.className = 'form-control success';
  return true;
}
function isPhone(phone){
  return /^98\d{8}$/.test(phone)
}
function isEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

//password show and hide
function passwordFun() {
  const x = document.getElementById("password");
  const x2 = document.getElementById("password2");
  const hide = document.querySelector(".fa-eye");
  const show = document.querySelector(".fa-eye-slash");

  if (x.type === "password") {
    x.type = "text";
    x2.type = "text";
    
  }
   else {
    x.type = "password";
    x2.type = "password";
    
  }
}





  </script>
  <script>
    
    (function($) {
      showSwal = function(type) {
        'use strict';
        if (type === 'auto-close') {
          swal({
            title: 'Auto close alert!',
            text: 'I will close in 2 seconds.',
            timer: 2000,
            button: false
          }).then(
            function() {},
            // handling the promise rejection
            function(dismiss) {
              if (dismiss === 'timer') {
                console.log('I was closed by the timer')
              }
            }
          )
        } else {
          swal("Error occured !");
        }
      }

    })(jQuery);
  </script>
  <script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
    
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src='../js/bootstrap.bundle.min.js'></script>

</body>

</html>