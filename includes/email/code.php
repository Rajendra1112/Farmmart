<?php
// session_start();
// 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// require_once 'PHPMailer/src/Exception.php';
// require_once 'PHPMailer/src/SMTP.php';
// require_once 'PHPMailer/src/PHPMailer.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendEmail($name, $email, $verify_token)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'digitalfarmnepal@gmail.com'; //SMTP username
    $mail->Password = 'rfndaqvqnqwgrfmb'; //SMTP password
    $mail->SMTPSecure = "tls"; //Enable implicit TLS encryption
    $mail->Port = "587"; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('digitalfarmnepal@gmail.com', $name);
    $mail->addAddress($email);
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Email Verification for Farm Management System';
    $email_template = "
        <h2>You Have Register with Farm Management System Nepal.</h2>
        <h5 class='mb-5'>Verify Your Email address to login with the below given OTP</h5>
        <h2 class='text-center'>$verify_token</h2>
        ";
    $mail->Body = $email_template;

    $mail->send();
}


function sendContact($name, $email,$phone,$type,$message)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'digitalfarmnepal@gmail.com'; //SMTP username
    $mail->Password = 'rfndaqvqnqwgrfmb'; //SMTP password
    $mail->SMTPSecure = "tls"; //Enable implicit TLS encryption
    $mail->Port = "587"; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('digitalfarmnepal@gmail.com', $name);
    $mail->addAddress($email);
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Contact';
    $email_template = "
        <h2>$type</h2>
        <h5 class='mb-5'>$name</h5>
        <h5 class='mb-5'>$email</h5>
        <h5 class='mb-5'>$phone</h5>
        <p>$message</p>
        
        ";
    $mail->Body = $email_template;

    $mail->send();
}
function productRequest($username, $email,$phone,$role_company_name,$message)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'digitalfarmnepal@gmail.com'; //SMTP username
    $mail->Password = 'rfndaqvqnqwgrfmb'; //SMTP password
    $mail->SMTPSecure = "tls"; //Enable implicit TLS encryption
    $mail->Port = "587"; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($email, $username);
    $mail->addAddress('digitalfarmnepal@gmail.com');
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Contact';
    $email_template = "
        <h2>$message</h2>
        <h5 class='mb-5'>$username</h5>
        <h5 class='mb-5'>$email</h5>
        <h5 class='mb-5'>$phone</h5>
        <h5 class='mb-5'>$role_company_name</h5>
        <p>$message</p>
        
        ";
    $mail->Body = $email_template;

    $mail->send();
}

function productAccept($email,$message)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'digitalfarmnepal@gmail.com'; //SMTP username
    $mail->Password = 'rfndaqvqnqwgrfmb'; //SMTP password
    $mail->SMTPSecure = "tls"; //Enable implicit TLS encryption
    $mail->Port = "587"; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('digitalfarmnepal@gmail.com');
    $mail->addAddress($email);
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Contact';
    $email_template = "
        <h5 class='mb-5'>Product Accepted</h5>
        <p>$message</p>
        
        ";
    $mail->Body = $email_template;

    $mail->send();
}


if (isset($_POST['user_register']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $user_name = $_POST['fullName'];
    $user_email = $_POST['email'];
    $contact = $_POST['phone'];
    $user_role = $_POST['role'];
    $role_company = $_POST['role_company_name'];
    $address = $_POST['address'];
    $area = $_POST['area'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_BCRYPT, $options = ['cost' => 12,]);
    $send_email = $_POST['send_email'];
    $terms = $_POST['terms'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();
    $otp = rand(19999, 99999);
    $verify_status = 0;

    //select query
    $select_query = "Select * from `user_table` where email='$user_email' or role_company_name='$role_company'";
    $result = mysqli_query($con, $select_query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0) {
        echo "<script>alert('Role exist!');</script>";
    } else {
        // $_SESSION['otp']=$otp;
        //  // Login time is stored in a session variable
        //  $_SESSION["otp"] = time();
        //  header("Location:verify_otp.php");
        //insert query
        move_uploaded_file($user_image_temp, "./user_images/$user_image");
        $insert_query = "INSERT INTO `user_table`(`username`, `email`, `phone`, `role`,`role_company_name`,`address`, `password`, `user_image`, `terms`, `user_ip`,`send_email`,`Area`,`otp`,`verify_status`) VALUES ('$user_name','$user_email',$contact,'$user_role','$role_company','$address','$hash_password','$user_image','$terms','$user_ip','$send_email','$area',$otp,$verify_status)";
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            $_SESSION['otp_email'] = $user_email;
            $_SESSION['otp'] = $otp;
            $_SESSION['user'] = $user_name;
            sendEmail("$user_name", "$user_email", "$otp");
            echo "<script>alert('Register successful!');</script>";
            echo "<script>window.open('../user_area/verify_otp.php')</script>";
        } else {
            echo "<script>alert('Register unsuccessful!');</script>";
        }
    }
    //selecting cart items
    // $select_cart_items="Select * from `cart_details` where ip_address = '$user_ip'";
    // $result_cart = mysqli_query($con,$select_cart_items);
    // $rows_count = mysqli_num_rows($result_cart);
    // if($rows_count>0){
    //     $_SESSION['email']=$user_email;
    //     echo "<script>alert('You have items in cart');</script>";
    //     echo "<script>window.open('../user_area/checkout.php','_self');</script>";
    // }
    // else{
    //     echo "<script>window.open('./user_login.php','_self');</script>";
    // }
}

//contact form
if (isset($_POST['submit_contact']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $inqury_type = $_POST['inqury_type'];
    $contact_image = $_FILES['contact_image']['name'];
    $contact_image_temp = $_FILES['contact_image']['tmp_name'];
    $message = $_POST['message'];

    $rand = rand(1, 898798);
    move_uploaded_file($contact_image_temp, "./img/contact/$rand$contact_image");

    $insert = mysqli_query($con, "INSERT INTO `contact`(`email`, `name`, `phone`, `contact_image`, `type`, `message`) VALUES ('$email','$name',$phone,'$rand$contact_image','$inqury_type','$message')");
    if ($insert) {
        echo "<script>document.querySelector('.alert').innerHTML = 'successfully submitted..';</script>";
        sendContact($name, $email,$phone,$inqury_type,$message);
    } else {
      echo "<h5 id ='contact-close'> Please Try Again..</h5>";
    }
  }
