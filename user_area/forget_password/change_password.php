<?php
include('../../includes/connect.php');
session_start();
include('../../includes/email/code.php');

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
        }
    </style>
</head>

<body>
    <?php
    if($_SESSION['otp_email'] && $_SESSION['otp']){
    //change password
    if (isset($_POST['update_password'])) {
        $email =  $_SESSION['otp_email'];
        $new_password = $_POST['new_password'];
        $hash_password = password_hash($new_password, PASSWORD_BCRYPT, $options = ['cost' => 12,]);
        $confirm_password = $_POST['cpassword'];
        // $user_id_query = mysqli_query($con, "select * from `user_table` where `email`=$email");
        // $user_id_sel = mysqli_fetch_assoc($user_id_query);
        // $user_id = $user_id_sel['user_id'];
        //update_query
        echo $email;

        if ($new_password !== $confirm_password) {
            echo "<script>alert('Password not matched !!!')</script>";
        } else if (strlen($new_password) < 8) {
            echo "<script>alert('Password must be 8 character long!')</script>";
        } else {
            $update_query = "update `user_table` set password='$hash_password' where email='$email'";
            $result_query_update = mysqli_query($con, $update_query);
            global $result_query_update;
            if ($result_query_update) {
                unset($_SESSION['otp']);
                unset($_SESSION['otp_email']);
                echo "<script>alert('Password Change Successful..')</script>";
                echo "<script>window.open('../user_login.php','_self')</script>";
            }
        }
    }
    ?>
    <div class="container height-100 d-flex justify-content-center align-items-center">
        <div class="position-relative">
            <div class="card p-2 text-center">
                <?php
                echo '<h6>Please enter the Email address</h6>';
                ?>
                <form action="" method="post">
                    <div id="otp" class="inputs d-flex flex-column justify-content-center mt-2">
                        <?php
                        echo ' <input class="m-2 text-center form-control rounded" type="password" placeholder= "Enter new password" name="new_password" required />
                            <input class="m-2 text-center form-control rounded" type="password" placeholder= "confirm password" name="cpassword" required />';

                        ?>
                    </div>
                    <div class="mt-4">
                        <?php
                        echo '<button class="btn btn-danger px-4 validate" name="update_password">Change Password</button>';
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    } else {
        header("Location: ../user_login.php");
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>

</html>