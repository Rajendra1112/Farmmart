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
    echo $_SESSION['otp'];
    if (isset($_POST['verify_otp']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $code = $_POST['otp'];
        $email = $_SESSION['otp_email'];
        $sel = mysqli_query($con, "Select * from `user_table` where email='$email' and verify_status=1");
        $num_rows = mysqli_num_rows($sel);
        if ($num_rows > 0) {
            $email_result = mysqli_fetch_assoc($sel);
            $otp = $email_result['otp'];
            if ($otp === $code) {
                echo $email;
                echo "<script>window.open('./change_password.php','_self')</script>";
            }else{
                echo "<script>alert('OTP not matched!')</script>";
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
                           echo ' <input class="m-2 text-center form-control rounded" type="text" placeholder= "Enter Otp" name="otp" required />';
                        
                        ?>
                    </div>
                    <div class="mt-4">
                        <?php
                            echo '<button class="btn btn-danger px-4 validate" name="verify_otp">Verify OTP</button>';
                        
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