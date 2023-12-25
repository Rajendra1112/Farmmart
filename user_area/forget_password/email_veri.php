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
            width: 140px
        }
    </style>
</head>

<body>
    <?php
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
                    echo "<script>window.open('./otp.php','_self')</script>";
                }
            } else {
                echo "<h3 style='position:absolute; top: 5rem; width:100%;'><span class='d-block m-auto text-center text-danger'>Faile!</span></h3>";
            }
        } else {
            echo "<h3 style='position:absolute; top: 5rem; width:100%;'><span class='d-block m-auto text-center text-danger'>Account not found!</span></h3>";
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
                            echo '<input class="m-2 text-center form-control rounded" type="email" placeholder="Enter Email" name="email" required />';
                        
                        ?>
                    </div>
                    <div class="mt-4">
                        <?php
                            echo '<button class="btn btn-danger px-4 validate" name="send_otp">Send OTP</button>';
                        
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