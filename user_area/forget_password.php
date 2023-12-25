<?php
include('../includes/connect.php');
session_start();
include('../includes/email/code.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #79bb6f;
        }

        .height-100 {
            height: 100vh;
        }

        .card {
            width: 400px;
            border: none;
            height: 300px;
            box-shadow: 0px 5px 20px 0px #d2dae3;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .card h6 {
            color: green;
            font-size: 20px
        }

        .inputs input {
            width: 80%;
            height: 40px
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0
        }

        .card-2 {
            background-color: #fff;
            padding: 10px;
            width: 350px;
            height: 100px;
            bottom: -50px;
            left: 20px;
            position: absolute;
            border-radius: 5px
        }

        .card-2 .content {
            margin-top: 50px
        }

        .card-2 .content a {
            color: green
        }

        .form-control:focus {
            box-shadow: none;
            border: 2px solid green
        }

        .validate {
            border-radius: 20px;
            height: 40px;
            background-color: green;
            border: 1px solid green;
            width: 140px
        }
    </style>
</head>

<body>
    <?php
    $_SESSION['reset_status']='true';
    if ($_SESSION['otp_email']) {
        echo $_SESSION['otp'];
        echo $_SESSION['reset_status'];
    }

    // if (isset($_SESSION['reset_password'])) {
    if (isset($_POST['send_otp']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        //verify_email`
        $sel = mysqli_query($con, "Select * from `user_table` where email='$email' and verify_status=1");
        $num_rows = mysqli_num_rows($sel);
        if ($num_rows > 0) {
            $otp = rand(19999, 99999);
            $email_result = mysqli_fetch_assoc($sel);
            $user_email = $email_result['email'];
            $username = $email_result['username'];
            if ($email === $user_email) {
                $update = mysqli_query($con, "UPDATE `user_table` SET `otp`=$otp where email='$user_email'");
                echo "<script>alert('Otp Sent Successful..')</script>";
                if ($update) {
                    $_SESSION['otp'] = $otp;
                    $_SESSION['otp_email'] = $user_email;
                    sendEmail("$username", "$user_email", "$otp");
                    echo "<script>window.open('./forget_password.php?reset_password','_self')</script>";
                }
            } else {
                echo "<h3 style='position:absolute; top: 5rem; width:100%;'><span class='d-block m-auto text-center text-danger'>Faile!</span></h3>";
            }
        } else {
            echo "<h3 style='position:absolute; top: 5rem; width:100%;'><span class='d-block m-auto text-center text-danger'>Account not found!</span></h3>";
        }
    }
    if (isset($_POST['resendOtp']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        unset($_SESSION['otp']);
        $otp = rand(19999, 99999);
        // $user_name = $_SESSION['name'];
        $user_email = $_SESSION['otp_email'];
        $update_query = "Update `user_table` set `otp`=$otp where email=$user_email";
        $sql_execute = mysqli_query($con, $update_query);
        if ($sql_execute) {
            // $_SESSION['otp_email'] = $user_email;
            $_SESSION['otp'] = $otp;
            sendEmail("", "$user_email", "$otp");
            echo "<script>alert('OTP sent successful');</script>";
            echo "<script>window.open('./forget_password.php','_self')</script>";
        } else {
            echo "<script>alert('Otp unsuccessful!');</script>";
        }
    }

    if (isset($_POST['verify_otp']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $code = $_POST['otp'];
        $email = $_SESSION['otp_email'];
        $sel = mysqli_query($con, "Select * from `user_table` where email='$email' and verify_status=1");
        $num_rows = mysqli_num_rows($sel);
        if ($num_rows > 0) {
            $email_result = mysqli_fetch_assoc($sel);
            $otp = $email_result['otp'];
            if ($otp === $code) {
                $_SESSION['reset_status_code'] = 'true';
                echo $email;
                echo "<script>window.open('./forget_password.php?reset_password','_self')</script>";
                echo "<script>alert('dddd')</script>";
            }
        }
    }
    //change password
    if (isset($_POST['update_password'])) {
        $email =  $_SESSION['otp_email'];
        $new_password = $_POST['new_password'];
        $hash_password = password_hash($new_password, PASSWORD_BCRYPT, $options = ['cost' => 12,]);
        $confirm_password = $_POST['cpassword'];
        $user_id_query = mysqli_query($con, "selecr user_id from user_table where email=$email");
        $user_id_sel = mysqli_fetch_assoc($user_id_query);
        $user_id = $user_id_sel['user_id'];
        //update_query
        $update_query = "update `user_table` set password='$hash_password' where user_id=$user_id";
        $result_query_update = mysqli_query($con, $update_query);
        global $result_query_update;
        if ($result_query_update) {
            echo "<script>alert('Password Change Successful..')</script>";
            echo "<script>window.open('./user_login.php','_self')</script>";
        }
    }


    ?>
    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
                <?php
                if (!isset($_GET['reset_password']) && $_SESSION['reset_status'] !=='true') {
                    echo '<h6>Please enter the Email address</h6>';
                } else {
                    if ($_SESSION['otp_email']) {
                        $email = ($_SESSION['otp_email']); ?>
                        <h6>A code has been sent to <br><span class=" text-primary"><?php echo $email; ?></span></h6>
                <?php
                    }
                }
                ?>
                <form action="" method="post">
                    <div id="otp" class="inputs d-flex flex-column justify-content-center mt-2">
                        <?php
                        if (!isset($_GET['reset_password']) && $_SESSION['reset_status']=== 'false') {
                            echo '<input class="m-2 text-center form-control rounded" type="email" placeholder="Enter Email" name="email" required />';
                        }
                        else if (isset($_GET['reset_password']) && $_SESSION['reset_status'] !== 'true') {
                            echo ' <input class="m-2 text-center form-control rounded" type="text" placeholder= "Enter Otp" name="otp" required />';
                        } else if (isset($_GET['reset_password']) && $_SESSION['reset_status'] === 'true') {
                            echo ' <input class="m-2 text-center form-control rounded" type="password" placeholder= "Enter new password" name="new_password" required />
                            <input class="m-2 text-center form-control rounded" type="password" placeholder= "confirm password" name="cpassword" required />';
                        }
                        ?>
                    </div>
                    <div class="mt-4">
                        <?php
                        if (!isset($_GET['reset_password']) && $_SESSION['reset_status'] !== 'true') {
                            echo '<button class="btn btn-danger px-4 validate" name="send_otp">Send OTP</button>';
                        }
                        else if (isset($_GET['reset_password']) && $_SESSION['reset_status'] !== 'true') {
                            echo '<button class="btn btn-danger px-4 validate" name="verify_otp">Verify OTP</button>';
                        } else {
                            echo '<button class="btn btn-danger px-4 validate" name="update_password">Change Password</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    // } else {
    //     header("Location: user_login.php");
    // }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>

</html>